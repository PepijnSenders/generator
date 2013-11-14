<?php namespace Pep\Generator\Command;

use Pep\Generator\Generator\ModelGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModelCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new model.';

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
       return $this->option('path') . '/' . ucwords($this->argument('name')) . '.php';
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
                'Name of the model to generate.',
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
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to models directory.',
                app_path('models'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../templates/model.mustache',
            ),
        );
    }

}
