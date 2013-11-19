<?php namespace Pep\Generator\Command;

use Pep\Generator\Generator\MigrationGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class MigrationCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new migration.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $path = $this->getPath();
        $template = $this->option('template');

        $this->printResult($this->generator->make($path, $template, array(
            'tableName' => $this->argument('tableName'),
            'method' => $this->argument('method'),
        )), $path);
    }

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
        return $this->option('path') . '/' . date('Y_m_d_His') .
                '_' . Str::snake($this->argument('method') . '_' .
                Str::plural($this->argument('tableName'))) . '.php';
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
                'method',
                InputArgument::REQUIRED,
                'Schema method, i.e.: Create, Drop, Change/Edit/Add/Remove',
            ),
            array(
                'tableName',
                InputArgument::REQUIRED,
                'Table name of the table to alter.',
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
                'Path to migrations directory.',
                app_path('database/migrations'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../templates/migration.mustache',
            ),
        );
    }

}
