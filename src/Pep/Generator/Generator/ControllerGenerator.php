<?php namespace Pep\Generator\Generator;

class ControllerGenerator extends AbstractGenerator {

    /**
     * Fetch the compiled template for a controller
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
            'className' => $className,
            'model' => str_replace('Controller', '', $className),
        ));
    }

}