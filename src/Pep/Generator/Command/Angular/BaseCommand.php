<?php namespace Pep\Generator\Command\Angular;

use Illuminate\Console\Command;
use Pep\Generator\Generator\Angular\AbstractGenerator;

class BaseCommand extends Command {

    /**
     * Model generator instance.
     *
     * @var Pep\Generator\Generator\Angular\AbstractGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AbstractGenerator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $path = $this->getPath();
        $template = $this->option('template');
        $appName = $this->option('appName');

        $this->printResult($this->generator->make($path, $template, $appName), $path);
    }

    /**
     * Provide user feedback, based on success or not.
     *
     * @param  boolean $successful
     * @param  string $path
     * @return void
     */
    protected function printResult($successful, $path)
    {
        if ($successful)
        {
            return $this->info("Created {$path}");
        }

        $this->error("Could not create {$path}");
    }

}