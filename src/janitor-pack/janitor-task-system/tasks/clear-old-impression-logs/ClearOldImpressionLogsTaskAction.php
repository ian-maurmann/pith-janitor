<?php

/**
 * Clear Old Impression Logs task action
 * -------------------------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 * @noinspection PhpMissingParentCallCommonInspection  - Action parent methods exist as fallback.
 * @noinspection PhpVariableNamingConventionInspection - Short variable names are ok.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4, not PSR-0.
 */

declare(strict_types=1);

namespace Pith\Janitor;

use Pith\Workflow\PithAction;

/**
 * Class ClearOldImpressionLogsTaskAction
 * @package Pith\Janitor
 */
class ClearOldImpressionLogsTaskAction extends PithAction
{
    protected JanitorService $janitor_service;

    public function __construct(JanitorService $janitor_service)
    {
        // Set object dependencies
        $this->janitor_service = $janitor_service;
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function runAction()
    {
        // Get the CLI format and writer
        $format     = $this->dependency_injection->container->get('\\Pith\\Framework\\PithCliFormat');
        $cli_writer = $this->dependency_injection->container->get('\\Pith\\Framework\\PithCliWriter');

        // Header
        $cli_writer->writeLine($format->fg_bright_yellow . '┏━────────────────────────────────────━┓' . $format->reset);
        $cli_writer->writeLine($format->fg_bright_yellow . '┃  Janitor: Clear Old Impression Logs  ┃' . $format->reset);
        $cli_writer->writeLine($format->fg_bright_yellow . '┗━────────────────────────────────────━┛' . $format->reset);
        $cli_writer->writeLine(' ');

        $time_21_days = 1814400; // 21 days in seconds
        $this->janitor_service->clearOldLogs(PITH_IMPRESSION_LOG_LOCATION, $time_21_days);
    }

}