<?php namespace Pep\Generator\Generator\Angular;

class FilterGenerator extends AbstractGenerator {

    /**
     * Fetch the compiled template for a filter
     *
     * @param  string $template Path to template
     * @param  string $appName
     * @param  string $className
     * @return string Compiled template
     */
    protected function getTemplate($template, $appName, $className)
    {
        $this->template = $this->fileSystem->get($template);

        return $this->render(array(
            'appName' => $appName,
            'filterName' => $className,
        ));
    }

}