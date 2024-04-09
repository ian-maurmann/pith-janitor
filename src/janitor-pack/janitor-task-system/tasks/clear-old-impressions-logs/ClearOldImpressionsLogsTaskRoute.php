<?php

/**
 * Clear Old Impressions Logs task route
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
 * Class ClearOldImpressionsLogsTaskRoute
 * @package Pith\Janitor
 */
class ClearOldImpressionsLogsTaskRoute extends PithRoute
{
    public string $route_type   = 'task';
    public string $pack         = '\\Pith\\Janitor\\JanitorPack';
    public string $access_level = 'task';
    public string $action       = '\\Pith\\Janitor\\ClearOldImpressionsLogsTaskAction';
    public string $view_adapter = '\\Pith\\CliViewAdapter\\PithCliViewAdapter';
}