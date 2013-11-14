<?php namespace Pep\Generator\Command\Angular;

use Pep\Generator\Generator\FilterGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class FilterCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:ng:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new angular filter.';

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
       return $this->option('path') . '/' . Str::camel($this->argument('name')) . '.js';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array(
                'name',
                InputArgument::REQUIRED,
                'Name of the filter to generate.',
            ),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array(
                'appName',
                null,
                InputOption::VALUE_OPTIONAL,
                'Name of the Angular app. (default: app)',
                'app',
            ),
            array(
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to filters directory. (default: public_path(\'js/filters\')',
                public_path('js/filters'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../../templates/Angular/filter.mustache',
            ),
        );
    }

}
