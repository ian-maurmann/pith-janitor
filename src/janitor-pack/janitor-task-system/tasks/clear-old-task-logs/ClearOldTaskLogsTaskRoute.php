<?php

/**
 * Clear Old Task Logs task route
 * ------------------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4, not PSR-0.
 */


declare(strict_types=1);

namespace Pith\Janitor;

use Pith\Workflow\PithRoute;

/**
 * Class ClearOldTaskLogsTaskRoute
 * @package Pith\Janitor
 */
class ClearOldTaskLogsTaskRoute extends PithRoute
{
    public string $route_type   = 'task';
    public string $pack         = '\\Pith\\Janitor\\JanitorPack';
    public string $access_level = 'task';
    public string $action       = '\\Pith\\Janitor\\ClearOldTaskLogsTaskAction';
    public string $view_adapter = '\\Pith\\CliViewAdapter\\PithCliViewAdapter';
}