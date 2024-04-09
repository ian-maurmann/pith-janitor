<?php

/**
 * Clear Old Impression Logs task route
 * -------------------------------------
 *
 * @noinspection PhpPropertyNamingConventionInspection - Ignore.
 * @noinspection PhpClassNamingConventionInspection    - Long class name is ok.
 * @noinspection PhpIllegalPsrClassPathInspection      - Using PSR-4, not PSR-0.
 */


declare(strict_types=1);

namespace Pith\Janitor;

use Pith\Workflow\PithRoute;

/**
 * Class ClearOldImpressionLogsTaskRoute
 * @package Pith\Janitor
 */
class ClearOldImpressionLogsTaskRoute extends PithRoute
{
    public string $route_type   = 'task';
    public string $pack         = '\\Pith\\Janitor\\JanitorPack';
    public string $access_level = 'task';
    public string $action       = '\\Pith\\Janitor\\ClearOldImpressionLogsTaskAction';
    public string $view_adapter = '\\Pith\\CliViewAdapter\\PithCliViewAdapter';
}