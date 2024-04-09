<?php

/**
 * Janitor Task Orchestrator
 * -------------------------
 *
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4, not PSR-0.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 * @noinspection PhpPropertyNamingConventionInspection - Long property names are ok.
 * @noinspection PhpVariableNamingConventionInspection - Long variable names are ok.
 * @noinspection PhpTooManyParametersInspection        - Methods with a large number of parameters are ok.
 */


declare(strict_types=1);

namespace Pith\Janitor;

use Pith\Framework\Base\PithException;
use Pith\Framework\Internal\PithTouchstoneUtility;
use Pith\Workflow\PithTaskOrchestrator;

/**
 * Class PithTaskOrchestrator
 * @package Pith\Janitor
 */
class JanitorTaskOrchestrator extends PithTaskOrchestrator
{
    protected PithTouchstoneUtility $touchstone_utility;

    public function __construct()
    {
        // Set object dependencies
        $this->touchstone_utility = new PithTouchstoneUtility();
    }

    /**
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection - Ignore for now.
     * @noinspection PhpMissingParentCallCommonInspection       - Ignore parent class method.
     * @throws PithException
     */
    public function orchestrate(bool $skip_heavy = false): array
    {
        // Default
        $orchestration_info = [
            'touchstones'        => [],
            'did_run_task'       => false,
            'ran_task_name'      => '',
            'is_heavy'           => false,
            'skipped_task_names' => [],
        ];


        $ran = $this->processTask($skip_heavy,$orchestration_info, 'janitor','clear_old_impression_logs', true, 'after 12 hour');
        if($ran){
            return $orchestration_info;
        }

        $ran = $this->processTask($skip_heavy,$orchestration_info, 'janitor','clear_old_php_error_logs', true, 'after 12 hour');
        if($ran){
            return $orchestration_info;
        }

        $ran = $this->processTask($skip_heavy,$orchestration_info, 'janitor','clear_old_task_logs', true, 'after 12 hour');
        if($ran){
            return $orchestration_info;
        }

        $ran = $this->processTask($skip_heavy,$orchestration_info, 'janitor','clear_old_task_output_logs', true, 'after 12 hour');
        if($ran){
            return $orchestration_info;
        }

        return $orchestration_info;
    }

    /**
     * @throws PithException
     */
    protected function processTask(bool $skip_heavy, array &$orchestration_info, string $task_system_name, string $task_name, bool $is_heavy, string $time_frame): bool
    {
        $touchstone_utility = $this->touchstone_utility;

        if($is_heavy && $skip_heavy){
            $orchestration_info['skipped_task_names'][] = $task_name;
        }
        else{
            // Set touchstone file
            $touchstone_file = PITH_TOUCHSTONE_FOLDER_LOCATION . $task_system_name . '/' . $task_name . '.touchstone.txt';
            $orchestration_info['touchstones'][] = $touchstone_file;

            //$run = $touchstone_utility->touchOnceIn20MinuteWindow($touchstone_file);
            $run = $touchstone_utility->touchOnceInTimeFrame($touchstone_file, $time_frame);

            if($run){
                // Build the command
                $command_string = sprintf(PITH_TASK_SHELL_COMMAND_FORMAT, $task_system_name, $task_name);

                // Run
                shell_exec($command_string);

                $orchestration_info['did_run_task'] = true;
                $orchestration_info['ran_task_name'] = $task_name;
                $orchestration_info['is_heavy'] = $is_heavy;
                
                //return $orchestration_info;
                return true;
            }
        }

        return false;
    }
}