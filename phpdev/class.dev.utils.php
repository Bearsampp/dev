<?php

/**
 * Development utilities for CLI argument handling and path formatting operations
 *
 * Provides type-safe command-line argument parsing and cross-platform path conversion
 * methods. Follows the organization's strict typing conventions and path handling patterns.
 *
 * @package BearsamppDev
 * @license MIT
 * @see DevRoot
 */
class DevUtils
{
    /**
     * Sanitizes and type-casts CLI arguments with validation
     *
     * @param int $key Argument position index (0-based)
     * @param string $type Expected data type: 'string', 'numeric', 'boolean', or 'array'
     * @return mixed Returns:
     *               - Trimmed string for 'string' type
     *               - Integer-cast value for 'numeric' type
     *               - Boolean existence check for 'boolean' type
     *               - Array for 'array' type
     *               - Empty string/array for missing valid values
     *               - false for invalid types or missing argv
     * @example cleanArgv(1, 'numeric') returns 8080 for "--port 8080"
     */
    public static function cleanArgv(int $key, string $type = 'string'): mixed
    {
        if (!isset($_SERVER['argv'])) {
            return false;
        }

        return match ($type) {
            'string' => isset($_SERVER['argv'][$key]) && $_SERVER['argv'][$key] !== ''
                        ? trim($_SERVER['argv'][$key])
                        : '',
            'numeric' => isset($_SERVER['argv'][$key]) && is_numeric($_SERVER['argv'][$key])
                        ? (int)$_SERVER['argv'][$key]
                        : '',
            'boolean' => isset($_SERVER['argv'][$key]),
            'array' => isset($_SERVER['argv'][$key]) && is_array($_SERVER['argv'][$key])
                      ? $_SERVER['argv'][$key]
                      : [],
            default => false,
        };
    }

    /**
     * Converts path to Windows-style directory separators
     *
     * @param string $path Input path in any format
     * @return string Path with backslash (\) separators
     * @example formatWindowsPath('src/main/java') returns 'src\main\java'
     */
    public static function formatWindowsPath(string $path): string
    {
        return str_replace('/', '\\', $path);
    }

    /**
     * Converts path to Unix-style directory separators
     *
     * @param string $path Input path in any format
     * @return string Path with forward slash (/) separators
     * @example formatUnixPath('C:\Program Files') returns 'C:/Program Files'
     */
    public static function formatUnixPath(string $path): string
    {
        return str_replace('\\', '/', $path);
    }

    /**
     * Checks if string starts with given substring (case-sensitive)
     *
     * @param string $string The string to search
     * @param string $search The substring to match
     * @return bool True if string starts with search term
     * @example startWith('bearsampp', 'bear') returns true
     */
    public static function startWith(string $string, string $search): bool
    {
        return str_starts_with($string, $search);
    }

    /**
     * Checks if string ends with given substring (case-sensitive)
     *
     * @param string $string The string to search
     * @param string $search The substring to match
     * @return bool True if string ends with search term
     * @example endWith('config.yaml', '.yaml') returns true
     */
    public static function endWith(string $string, string $search): bool
    {
        return str_ends_with($string, $search);
    }
}
