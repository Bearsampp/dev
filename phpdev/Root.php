<?php

/**
 * Main entry point for the Bearsampp development toolkit
 *
 * Initializes the core environment and routes CLI commands to appropriate handlers.
 * This script serves as the bootstrap mechanism for the development toolkit utilities.
 *
 * @package BearsamppDev
 * @license MIT
 * @see DevRoot
 * @see DevUtils
 * @throws RuntimeException If core dependencies are missing or paths are invalid
 */
declare(strict_types=1);

/**
 * Development toolkit utilities for common operations
 * @var DevUtils
 */
require_once __DIR__ . '/class.dev.utils.php';

/**
 * Core application root with environment configuration
 * @var DevRoot
 */
require_once __DIR__ . '/class.dev.root.php';

// Initialize main application instance with path resolution
$bearsamppDevBs = new DevRoot();

// Process CLI commands and delegate to appropriate handlers
$bearsamppDevBs->process();
