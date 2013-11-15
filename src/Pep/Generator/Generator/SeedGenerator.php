<?php namespace Pep\Generator\Generator;

class SeedGenerator extends AbstractGenerator {

    /**
     * Fetch the compiled template for a seed
     *
     * @param  string $template Path to template
     * @param  string $className
     * @param  array  $arguments
     * @return string Compiled template
     */
    protected function getTemplate($template, $className, $arguments = array())
    {
        $this->template = $this->fileSystem->get($template);

        return $this->render(array(
            'className' => Str::plural($className) . '_' . date('YmdHi'),
            'model' => $className,
        ));
    }

    /**
    * Updates the DatabaseSeeder file's run method to
    * call this new seed class
    * @return boolean
    */
    public function updateDatabaseSeederRunMethod($className)
    {
        $databaseSeederPath = app_path('database/seeds/DatabaseSeeder.php');

        $content = $this->fileSystem->get($databaseSeederPath);

        if (!strpos($content, "\$this->call('{$className}');"))
        {
            $content = preg_replace("/(run\(\).+?)}/us", "$1\t\$this->call('{$className}');\n\t}", $content);
            return $this->fileSystem->put($databaseSeederPath, $content);
        }

        return false;
    }

}