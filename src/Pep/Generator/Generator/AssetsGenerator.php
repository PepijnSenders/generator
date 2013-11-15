<?php namespace Pep\Generator\Generator;

class AssetsGenerator extends AbstractGenerator {

    /**
     * Fetch the compiled template for an assets file
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

}