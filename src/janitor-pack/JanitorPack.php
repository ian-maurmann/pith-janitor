<?php

/**
 * Janitor Pack
 * ------------
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 */


declare(strict_types=1);

namespace Pith\Janitor;

use Pith\Workflow\PithPack;

/**
 * Class JanitorPack
 * @package Pith\Janitor
 */
class JanitorPack extends PithPack
{
    public string $access_level = 'world';
}