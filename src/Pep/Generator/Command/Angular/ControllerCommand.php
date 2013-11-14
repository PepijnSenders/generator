<?php namespace Pep\Generator\Command\Angular;

use Pep\Generator\Generator\ControllerGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class ControllerCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:ng:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new angular controller.';

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
                'Name of the controller to generate.',
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
                'Path to controllers directory. (default: public_path(\'js/controllers\')',
                public_path('js/controllers'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../../templates/Angular/controller.mustache',
            ),
        );
    }

}
