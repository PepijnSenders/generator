<?php namespace Pep\Generator\Command;

use Pep\Generator\Generator\AssetGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class AssetCommand extends BaseCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:asset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add an asset to GruntFile and assets file.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $path = $this->getPath();

        if ($this->generator->updateAssetsFile($this->argument('fileName')))
        {
            $this->info('Updated ' . $this->option('assetsPath'));
        }
        else
        {
            $this->comment('Did not need to update ' . $this->option('assetsPath'));
        }

        if ($this->generator->updateGruntFile($this->argument('fileName')))
        {
            $this->info('Updated ' . $this->option('gruntFilePath'));
        }
        else
        {
            $this->comment('Did not need to update ' . $this->option('gruntFilePath'));
        }
    }

    /**
     * Get the path to the file that should be generated.
     *
     * @return string
     */
    protected function getPath()
    {
        return $this->option('assetsPath');
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
                'fileName',
                InputArgument::REQUIRED,
                'Name of the file to add.',
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
                'assetsPath',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to assets file. (default: app_path(\'views/assets.blade.php\'))',
                app_path('views/assets.blade.php'),
            ),
            array(
                'gruntFilePath',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to assets file. (default: base_path(\'GruntFile.js\'))',
                base_path('GruntFile.js'),
            ),
            array(
                'template',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to template.',
                __DIR__ . '/../templates/asset.mustache',
            ),
        );
    }

}
