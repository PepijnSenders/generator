<?php namespace Pep\Generator\Generator;

use Illuminate\Filesystem\Filesystem as Filesystem;
use Illuminate\Support\Str;

class MigrationGenerator extends AbstractGenerator {

    private $partialsDir;

    /**
     * Constructor
     *
     * @param $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        parent::__construct($fileSystem);

        $this->partialsDir = __DIR__ . '/../partials';
    }

    /**
     * Fetch the compiled template for a migration
     *
     * @param  string $template Path to template
     * @param  string $className
     * @param  array  $arguments
     * @return string Compiled template
     */
    protected function getTemplate($template, $className, $arguments = array())
    {
        $this->template = $this->fileSystem->get($template);

        return $this->getMethod($arguments);
    }

    private function getMethod($arguments)
    {
        switch (Str::lower($arguments['method']))
        {
            case 'drop':
                $upMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/up-drop.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                $downMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/down-drop.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                break;

            case 'create':
                $upMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/up-create.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                $downMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/down-create.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                break;

            case 'add':
            case 'edit':
            case 'insert':
            case 'change':
            case 'remove':
            case 'delete':
            default:
                $upMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/up.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                $downMethod = $this->engine->render(file_get_contents("{$this->partialsDir}/down.mustache"), array(
                    'tableName' => $arguments['tableName'],
                ));
                break;
        }

        return $this->render(array(
            'up' => $upMethod,
            'down' => $downMethod,
            'name' => Str::studly($arguments['method'] . '_' . Str::plural($arguments['tableName'])) . '_' . date('YmdHi'),
        ));
    }

}