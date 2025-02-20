<?php

/**
 * Main application root and environment configuration handler
 *
 * Initializes core paths, validates environment setup, and routes CLI commands
 * to appropriate action handlers. Follows the organization's strict path resolution
 * patterns and dependency management conventions.
 *
 * @package BearsamppDev
 * @license MIT
 * @see DevUtils
 * @throws RuntimeException If core repository structure is invalid
 */
class DevRoot
{
    /** @var ?object Active command handler instance */
    private ?object $action = null;

    /** @var string Base path to bearsampp repository */
    private string $bearsamppPath;

    /** @var string Core module directory path */
    private string $corePath;

    /** @var string Class definitions directory */
    private string $classesPath;

    /** @var string Language files directory */
    private string $langsPath;

    /**
     * Initializes core environment paths and validates repository structure
     *
     * @throws RuntimeException If required core files are missing
     */
    public function __construct()
    {
        $this->bearsamppPath = DevUtils::formatUnixPath(realpath('../../bearsampp'));
        if (!file_exists($this->bearsamppPath . '/core/Root.php')) {
            throw new RuntimeException("Bearsampp repository not found in " . $this->bearsamppPath);
        }

        $this->corePath = $this->bearsamppPath . '/core';
        $this->classesPath = $this->corePath . '/classes';
        $this->langsPath = $this->corePath . '/langs';
    }

    /**
     * Processes CLI commands and delegates to action handlers
     *
     * Dynamically loads command classes based on CLI arguments following the pattern:
     * class.dev.{action}.php ➔ Dev{Action} class
     */
    public function process(): void
    {
        if ($this->isActionExists()) {
            $action = DevUtils::cleanArgv(1, 'string');
            $actionFile = 'class.dev.' . $action . '.php';
            $actionClass = 'Dev' . ucfirst($action);

            $args = array_slice($_SERVER['argv'], 2);

            if (file_exists($actionFile)) {
                require_once $actionFile;
                $this->action = new $actionClass($this, $args);
            }
        }
    }

    /**
     * Checks for valid CLI action argument
     *
     * @return bool True if a non-empty action parameter exists in position 1
     */
    private function isActionExists(): bool
    {
        return isset($_SERVER['argv'][1]) && !empty($_SERVER['argv'][1]);
    }

    /**
     * Gets base application root path
     *
     * @return string Normalized Unix-style path to bearsampp repository
     */
    public function getbearsamppPath(): string
    {
        return $this->bearsamppPath;
    }

    /**
     * Gets core module directory path
     *
     * @return string Path containing fundamental application components
     */
    public function getCorePath(): string
    {
        return $this->corePath;
    }

    /**
     * Gets class definitions directory
     *
     * @return string Path to application's class files
     */
    public function getClassesPath(): string
    {
        return $this->classesPath;
    }

    /**
     * Gets language resources directory
     *
     * @return string Path containing localization files
     */
    public function getLangsPath(): string
    {
        return $this->langsPath;
    }
}
