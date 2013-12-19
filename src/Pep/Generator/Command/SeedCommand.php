<?php namespace Pep\Generator\Command;

use Pep\Generator\Generator\SeedGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class SeedCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new seed.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $path = $this->getPath();
        $className = basename($path, '.php');
        $template = $this->option('template');

        $this->printResult($this->generator->make($path, $template), $path);

        if ($this->generator->updateDatabaseSeederRunMethod($className))
        {
            $this->info('Updated ' . app_path('database/seeds/DatabaseSeeder.php'));
        }
        else
        {
            $this->comment('Did not need to update ' . app_path('database/seeds/DatabaseSeeder.php'));
        }
    }

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
       return $this->option('path') . '/' . \Str::plural(\Str::studly($this->argument('name'))) . '_' . 'Seeder' . '.php';
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
                'Name of the seed to generate.',
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
                'Path to seeds directory.',
                app_path('database/seeds'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../templates/seed.mustache',
            ),
        );
    }

}
