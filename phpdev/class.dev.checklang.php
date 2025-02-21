<?php

/**
 * Validates language files against the default English version to ensure consistency.
 *
 * Performs three main checks:
 * 1. Missing translation keys
 * 2. Format string mismatches (%s placeholders)
 * 3. Untranslated entries (comments starting with #)
 */
class DevCheckLang
{
    /** @var string Default reference language used for comparisons */
    public const DEFAULT_LANG = 'english';

    /** @var DevRoot Main application root instance for path resolution */
    private DevRoot $bearsamppevBs;

    /**
     * Initializes the language checker with dependencies
     *
     * @param DevRoot $bearsamppevBs Main application root instance
     * @param array $args CLI arguments (unused in current implementation)
     */
    public function __construct(DevRoot $bearsamppevBs, array $args)
    {
        $this->bearsamppevBs = $bearsamppevBs;
        $this->process();
    }

    /**
     * Main processing workflow for language validation
     *
     * @throws RuntimeException If required Lang class or default language file is missing
     */
    private function process(): void
    {
        require_once $this->bearsamppevBs->getClassesPath() . '/class.lang.php';

        $defaultFile = file($this->bearsamppevBs->getLangsPath() . '/' . self::DEFAULT_LANG . '.lng');
        $defaultRaw = parse_ini_file($this->bearsamppevBs->getLangsPath() . '/' . self::DEFAULT_LANG . '.lng');

        foreach ($this->getLangList() as $lang) {
            if ($lang !== self::DEFAULT_LANG) {
                $this->validateLanguageFile($lang, $defaultFile, $defaultRaw);
            }
        }

        echo PHP_EOL;
    }

    /**
     * Validates a single language file against the default
     *
     * @param string $lang Language code to validate (e.g. 'french')
     * @param array $defaultFile Line-by-line content of default language file
     * @param array $defaultRaw Parsed INI content of default language file
     */
    private function validateLanguageFile(string $lang, array $defaultFile, array $defaultRaw): void
    {
        $raw = parse_ini_file($this->bearsamppevBs->getLangsPath() . '/' . $lang . '.lng');
        if ($raw === false) return;

        echo PHP_EOL . '## ' . strtoupper($lang) . PHP_EOL;

        $missing = $badFormat = $notTranslated = [];

        foreach (Lang::getKeys() as $key) {
            $this->checkMissingKey($raw, $key, $defaultFile, $missing);
            $this->checkFormatMismatch($defaultRaw, $raw, $key, $defaultFile, $badFormat);
            $this->checkUntranslated($raw, $key, $defaultFile, $notTranslated);
        }

        $this->printResults('Missing', $missing);
        $this->printResults('Bad format', $badFormat);
        $this->printResults('Not translated', $notTranslated);
    }

    /**
     * Scans language directory and retrieves available language codes
     *
     * @return array<string> List of available language codes (e.g. ['french', 'german'])
     */
    private function getLangList(): array
    {
        $result = [];
        $handle = @opendir($this->bearsamppevBs->getLangsPath());

        if ($handle) {
            while (($file = readdir($handle)) !== false) {
                if ($file !== "." && $file !== ".." && DevUtils::endWith($file, '.lng')) {
                    $result[] = str_replace('.lng', '', $file);
                }
            }
            closedir($handle);
        }

        return $result;
    }

    /**
     * Finds line number of a translation key in the file content
     *
     * @param array $fileContent Language file content as string array
     * @param string $key Translation key to locate
     * @return int|null Line number (1-based) or null if not found
     */
    private function findLineNumber(array $fileContent, string $key): ?int
    {
        foreach ($fileContent as $lineNumber => $lineContent) {
            $expLineContent = explode('=', $lineContent);
            if (trim($expLineContent[0] ?? '') === $key) {
                return $lineNumber + 1;
            }
        }
        return null;
    }

    /**
     * Records missing translation keys
     *
     * @param array $raw Parsed INI content of current language
     * @param string $key Translation key to check
     * @param array $defaultFile Default language file content
     * @param array &$missing Reference to missing keys storage array
     */
    private function checkMissingKey(array $raw, string $key, array $defaultFile, array &$missing): void
    {
        if (!isset($raw[$key])) {
            $missing[$key] = $this->findLineNumber($defaultFile, $key);
        }
    }

    /**
     * Detects format string placeholder mismatches
     *
     * @param array $defaultRaw Parsed INI content of default language
     * @param array $raw Parsed INI content of current language
     * @param string $key Translation key to check
     * @param array $defaultFile Default language file content
     * @param array &$badFormat Reference to format errors storage array
     */
    private function checkFormatMismatch(array $defaultRaw, array $raw, string $key, array $defaultFile, array &$badFormat): void
    {
        if (isset($defaultRaw[$key], $raw[$key])) {
            $countDefault = substr_count($defaultRaw[$key], '%s');
            $countCurrent = substr_count($raw[$key], '%s');
            if ($countDefault !== $countCurrent) {
                $badFormat[$key] = $this->findLineNumber($defaultFile, $key);
            }
        }
    }

    /**
     * Identifies untranslated entries (commented out with #)
     *
     * @param array $raw Parsed INI content of current language
     * @param string $key Translation key to check
     * @param array $defaultFile Default language file content
     * @param array &$notTranslated Reference to untranslated entries storage array
     */
    private function checkUntranslated(array $raw, string $key, array $defaultFile, array &$notTranslated): void
    {
        if (isset($raw[$key]) && DevUtils::startWith($raw[$key], '#')) {
            $notTranslated[$key] = $this->findLineNumber($defaultFile, $key);
        }
    }

    /**
     * Formats and displays validation results
     *
     * @param string $type Result category name
     * @param array $items Key-line number pairs to display
     */
    private function printResults(string $type, array $items): void
    {
        echo "=> $type: ";
        if (!empty($items)) {
            echo count($items) . PHP_EOL;
            foreach ($items as $key => $line) {
                echo "  $key (line $line)" . PHP_EOL;
            }
        } else {
            echo 'N/A' . PHP_EOL;
        }
    }
}
