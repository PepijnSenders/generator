<?php namespace Pep\Generator\Generator;

use Illuminate\Filesystem\Filesystem as Filesystem;

class AssetGenerator extends AbstractGenerator {

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
     * Fetch the compiled template for an asset
     *
     * @param  string $template Path to template
     * @param  string $className
     * @param  array  $arguments
     * @return string Compiled template
     */
    protected function getTemplate($template, $className, $arguments = array())
    {
        $this->template = $this->fileSystem->get($template);

        return $this->render();
    }

    /**
    * Updates the assets file
    *
    * @return boolean
    */
    public function updateAssetsFile($fileName)
    {
        $assetsFilePath = app_path('views/assets.blade.php');

        if (!file_exists($assetsFilePath))
        {
            return false;
        }

        $content = $this->fileSystem->get($assetsFilePath);

        $pos = strpos($content, "@foreach");

        if ($pos)
        {
            $content = substr($content, 0, $pos) . $this->engine->render(file_get_contents("{$this->partialsDir}/asset.mustache"), array(
                'fileName' => $fileName
            )) . substr($content, $pos);
            return $this->fileSystem->put($assetsFilePath, $content);
        }

        return false;
    }

    /**
    * Updates the assets file
    *
    * @return boolean
    */
    public function updateGruntFile($fileName)
    {
        $gruntFilePath = base_path('GruntFile.js');

        if (!file_exists($gruntFilePath))
        {
            return false;
        }

        $content = $this->fileSystem->get($gruntFilePath);

        $pos = strpos($content, "// add files here");
        $gruntFileAsset = $this->engine->render(file_get_contents("{$this->partialsDir}/grunt-file-asset.mustache"), array(
            'fileName' => $fileName
        ));

        if ($pos)
        {
            $content = substr($content, 0, $pos) . $gruntFileAsset . substr($content, $pos);
            return $this->fileSystem->put($gruntFilePath, $content);
        }

        return false;
    }

}