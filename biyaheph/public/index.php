<?php

use CodeIgniter\Boot;
use Config\Paths;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// LOAD OUR PATHS CONFIG FILE
// This is the line that might need to be changed, depending on your folder structure.
require FCPATH . '../app/Config/Paths.php';
// ^^^ Change this line if you move your application folder

$paths = new Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

// --- Auto-bug-reporting handlers (register before request dispatch) ---
// Only register for web requests (skip CLI)
if (php_sapi_name() !== 'cli') {
    // Try to include helper that contains report_bug_exception_handler()
    $bugHelperPath = rtrim($paths->appDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'bug_helper.php';
    if (is_file($bugHelperPath)) {
        // Use require_once inside try/catch to avoid fatal on broken files
        try {
            require_once $bugHelperPath;
        } catch (\Throwable $e) {
            // If helper load fails, log and continue; do NOT halt bootstrap
            if (function_exists('log_message')) {
                log_message('error', 'Failed to load bug_helper: ' . $e->getMessage());
            } else {
                error_log('Failed to load bug_helper: ' . $e->getMessage());
            }
        }
    }

    // Convert PHP errors to ErrorException so the exception handler sees them
    set_error_handler(function ($severity, $message, $file, $line) {
        // Respect @ operator suppression
        if (!(error_reporting() & $severity)) {
            return false;
        }
        throw new \ErrorException($message, 0, $severity, $file, $line);
    });

    // Register global exception handler if function exists from helper
    if (function_exists('report_bug_exception_handler')) {
        set_exception_handler('report_bug_exception_handler');
    } else {
        // Fallback: minimal handler that logs the exception
        set_exception_handler(function ($e) {
            $msg = sprintf("%s: %s in %s on line %s\nTrace:\n%s", get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
            if (function_exists('log_message')) {
                log_message('error', 'Unhandled Exception: ' . $msg);
            } else {
                error_log('Unhandled Exception: ' . $msg);
            }
        });
    }
}

// Dispatch the request (normal framework flow)
exit(Boot::bootWeb($paths));