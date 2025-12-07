<?php


use App\Models\BugModel;

/**
 * Global exception handler that automatically creates a bug record.
 *
 * @param \Throwable $e
 */
function report_bug_exception_handler($e)
{
    // avoid recursion
    static $reporting = false;
    if ($reporting) {
        return;
    }
    $reporting = true;

    try {
        // Only attempt when DB is available / not CLI
        if (php_sapi_name() === 'cli') {
            // log and return for CLI
            log_message('error', 'CLI Exception auto-report skipped: ' . $e->getMessage());
            $reporting = false;
            return;
        }

        // Build data
        $title = get_class($e) . ': ' . $e->getMessage();
        $description = sprintf(
            "%s\n\nFile: %s\nLine: %s\n\nTrace:\n%s",
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );

        // Use first few trace lines as steps
        $traceLines = explode("\n", $e->getTraceAsString());
        $steps = implode("\n", array_slice($traceLines, 0, 6)) ?: 'N/A';

        // map severity
        $severity = 'high';
        if ($e instanceof \ParseError || $e instanceof \Error || $e instanceof \TypeError) {
            $severity = 'critical';
        } elseif ($e instanceof \ErrorException) {
            $level = $e->getSeverity();
            if (in_array($level, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_RECOVERABLE_ERROR])) {
                $severity = 'critical';
            } elseif (in_array($level, [E_WARNING, E_USER_WARNING, E_COMPILE_WARNING])) {
                $severity = 'high';
            } elseif (in_array($level, [E_NOTICE, E_USER_NOTICE, E_STRICT])) {
                $severity = 'low';
            } else {
                $severity = 'medium';
            }
        } else {
            $severity = 'high';
        }

        // Insert bug using BugModel
        $bugModel = new BugModel();

        // Attempt to generate unique bug_id, fallback to timestamp if model not usable
        $bugId = method_exists($bugModel, 'generateBugId') ? $bugModel->generateBugId() : 'BUG-' . date('YmdHis');

        $data = [
            'bug_id' => $bugId,
            'module' => 'System',
            'title' => mb_substr($title, 0, 255),
            'description' => $description,
            'steps_to_reproduce' => $steps,
            'severity' => $severity,
            'status' => 'open',
            'screenshot' => null,
            'reported_by' => null,
        ];

        // Protect against DB errors with try/catch inside
        try {
            $bugModel->insert($data);
            log_message('error', 'Auto-reported bug created: ' . $bugId . ' — ' . $title);
        } catch (\Throwable $dbEx) {
            // If DB insert fails, log full details
            log_message('error', 'Failed to auto-insert bug: ' . $dbEx->getMessage() . ' | Orig: ' . $title);
        }
    } catch (\Throwable $any) {
        // ensure nothing bubbles up from the handler
        log_message('error', 'Exception in auto-report handler: ' . $any->getMessage());
    } finally {
        $reporting = false;
    }
}

/**
 * Convenience wrapper to report arbitrary messages as bugs.
 *
 * @param string $title
 * @param string $description
 * @param string $module
 * @param string $severity
 */
function report_bug_manual(string $title, string $description = '', string $module = 'System', string $severity = 'medium')
{
    try {
        if (php_sapi_name() === 'cli') {
            log_message('error', 'Manual bug report skipped (CLI): ' . $title);
            return;
        }

        $bugModel = new BugModel();
        $bugId = method_exists($bugModel, 'generateBugId') ? $bugModel->generateBugId() : 'BUG-' . date('YmdHis');

        $data = [
            'bug_id' => $bugId,
            'module' => $module,
            'title' => mb_substr($title, 0, 255),
            'description' => $description,
            'steps_to_reproduce' => '',
            'severity' => $severity,
            'status' => 'open',
            'screenshot' => null,
            'reported_by' => null,
        ];

        $bugModel->insert($data);
        log_message('info', 'Manual bug reported: ' . $bugId . ' — ' . $title);
    } catch (\Throwable $e) {
        log_message('error', 'Failed to manually report bug: ' . $e->getMessage());
    }
}