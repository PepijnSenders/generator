<?php namespace Pep\Generator\Generator\Angular;

use Illuminate\Filesystem\Filesystem as Filesystem;
use Pep\Generator\Helper\StringHelper;
use Illuminate\Support\Str;

abstract class AbstractGenerator {

    /**
     * File path to generate
     *
     * @var string
     */
    protected $path;

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * Mustache engine
     * @var Mustache_Engine
     */
    protected $engine;

    /**
     * Constructor
     *
     * @param $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
        $this->engine = new \Mustache_Engine(array(
            'escape' => function($value) {
                return $value;
            },
        ));
        $this->addStringHelper($this->engine);
    }


    /**
     * Compile template and generate
     *
     * @param  string $path
     * @param  string $template Path to template
     * @param  string $appName
     * @return boolean
     */
    public function make($path, $template, $appName)
    {
        $this->path = $this->getPath($path);
        $className = basename($path, '.js');
        $template = $this->getTemplate($template, $appName, $className);

        if (!$this->fileSystem->exists($this->path))
        {
            return $this->fileSystem->put($this->path, $template) !== false;
        }

        return false;
    }

    /**
     * Get the path to the file
     * that should be generated
     *
     * @param  string $path
     * @return string
     */
    protected function getPath($path)
    {
        return $path;
    }

    /**
     * Render template with the Mustache Engine
     * @param   array $context
     * @return [type] [description]
     */
    protected function render($context = array())
    {
        return $this->engine->render($this->template, $context);
    }

    /**
     * Add string helper to Mustache Engine
     * @param Mustache_Engine $engine
     * @return Mustache_Engine
     */
    private function addStringHelper(\Mustache_Engine &$engine)
    {
        return $engine->addHelper('string', array(
            'studly'    => function($value)
            {
                return Str::studly($value);
            },
            'snake'     => function($value)
            {
                return Str::snake($value);
            },
            'camel'     => function($value)
            {
                return Str::camel($value);
            },
            'plural'    => function($value)
            {
                return Str::plural($value);
            },
            'singular'  => function($value)
            {
                return Str::singular($value);
            },
            'upper'     => function($value)
            {
                return Str::upper($value);
            },
            'lower'     => function($value)
            {
                return Str::lower($value);
            },
            'slug'      => function($value)
            {
                return Str::slug($value);
            },
        ));
    }

    /**
     * Get compiled template
     *
     * @param  string $template
     * @param  string $appName
     * @param  string $className
     * @return string
     */
    abstract protected function getTemplate($template, $appName, $className);

}