<?php

/**
 * Janitor Task Workspace
 * ----------------------
 *
 * @noinspection PhpClassNamingConventionInspection - Long class names are ok.
 * @noinspection PhpIllegalPsrClassPathInspection   - Using PSR-4, not PSR-0.
 */


declare(strict_types=1);


namespace Pith\Janitor;


/**
 * Class JanitorTaskWorkspace
 * @package Pith\Janitor
 */
class JanitorTaskWorkspace
{
    public array $tasks = [
        ['task', 'clear_old_impression_logs',  'Removes old impression log files from taking-up space.',  '\\Pith\\Janitor\\ClearOldImpressionLogsTaskRoute'],
        ['task', 'clear_old_php_error_logs',   'Removes old PHP error log files from taking-up space.',   '\\Pith\\Janitor\\ClearOldPhpErrorLogsTaskRoute'],
        ['task', 'clear_old_task_logs',        'Removes old task-run log files from taking-up space.',    '\\Pith\\Janitor\\ClearOldTaskLogsTaskRoute'],
        ['task', 'clear_old_task_output_logs', 'Removes old task output log files from taking-up space.', '\\Pith\\Janitor\\ClearOldTaskOutputLogsTaskRoute'],
    ];
}