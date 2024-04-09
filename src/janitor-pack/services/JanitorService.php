<?php

/**
 * Janitor Service
 * ---------------
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 */


declare(strict_types=1);

namespace Pith\Janitor;

use Exception;
use Pith\Framework\Base\ThinWrappers\PithDependencyInjection;
use Pith\Workflow\PithPack;

/**
 * Class JanitorService
 * @package Pith\Janitor
 */
class JanitorService
{
    protected PithDependencyInjection $dependency_injection;

    public function __construct(PithDependencyInjection $dependency_injection)
    {
        $this->dependency_injection = $dependency_injection;
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function clearOldLogs(string $log_location, int $age_to_expire_in_seconds )
    {
        // Get the CLI format and writer
        $format     = $this->dependency_injection->container->get('\\Pith\\Framework\\PithCliFormat');
        $cli_writer = $this->dependency_injection->container->get('\\Pith\\Framework\\PithCliWriter');

        $folder = './' . $log_location;
        $files  = glob($folder . "*.log");

        // Loop through files
        foreach ($files as $file) {
            $file_age = time() - filectime($file);
            if($file_age > $age_to_expire_in_seconds){
                $cli_writer->writeLine('Deleting old log file: ' . $file);
                unlink($file);

                if(file_exists($file)){
                    $cli_writer->writeLine($format->fg_bright_red . 'Failed to delete log file: ' . $file . $format->reset);

                    throw new Exception('Failed to delete log file: ' . $file);
                }
                else{
                    $cli_writer->writeLine($format->fg_bright_green . 'Successfully deleted log file: ' . $file . $format->reset);
                }
            }
        }
    }
}