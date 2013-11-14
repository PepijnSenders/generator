<?php namespace Pep\Generator\Command\Angular;

use Illuminate\Console\Command;

class StructureCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:ng:structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate angular directory structure (needed for generating other angular elements).';

    /**
     * Directories to generate
     * @var array
     */
    private $directories = array(
        'controllers',
        'factories',
        'services',
        'directives',
        'filters',
    );

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        foreach ($this->directories as $directory)
        {
            $dir = public_path("js/{$directory}");
            if (!file_exists($dir))
            {
                mkdir($dir, 077, true);
                $this->info("$dir created");
            }
            else
            {
                $this->error("$dir path exists");
            }
        }
    }

}
