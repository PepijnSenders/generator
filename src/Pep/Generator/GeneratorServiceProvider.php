<?php namespace Pep\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('pep/generator');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->registerControllerGenerator();
        $this->registerModelGenerator();
        $this->registerMigrationGenerator();
        $this->registerSeedGenerator();
        $this->registerAngularStructureGenerator();
        $this->registerAngularControllerGenerator();
        $this->registerAngularDirectiveGenerator();
        $this->registerAngularServiceGenerator();
        $this->registerAngularFilterGenerator();
        $this->registerAngularFactoryGenerator();

        $this->commands(array(
        	'generate.controller',
            'generate.model',
            'generate.migration',
            'generate.seed',
            'generate.ng.structure',
            'generate.ng.controller',
            'generate.ng.directive',
            'generate.ng.service',
            'generate.ng.filter',
            'generate.ng.factory',
    	));
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

    /**
     * Register generate:controller
     *
     * @return Commands\ControllerCommand
     */
    protected function registerControllerGenerator()
    {
        $this->app['generate.controller'] = $this->app->share(function($app)
        {
            $generator = new Generator\ControllerGenerator($app['files']);

            return new Command\ControllerCommand($generator);
        });
    }

    /**
     * Register generate:model
     *
     * @return Commands\ModelCommand
     */
    protected function registerModelGenerator()
    {
        $this->app['generate.model'] = $this->app->share(function($app)
        {
            $generator = new Generator\ModelGenerator($app['files']);

            return new Command\ModelCommand($generator);
        });
    }

    /**
     * Register generate:migration
     *
     * @return Commands\MigrationCommand
     */
    protected function registerMigrationGenerator()
    {
        $this->app['generate.migration'] = $this->app->share(function($app)
        {
            $generator = new Generator\MigrationGenerator($app['files']);

            return new Command\MigrationCommand($generator);
        });
    }

    /**
     * Register generate:seed
     *
     * @return Commands\SeedCommand
     */
    protected function registerSeedGenerator()
    {
        $this->app['generate.seed'] = $this->app->share(function($app)
        {
            $generator = new Generator\SeedGenerator($app['files']);

            return new Command\SeedCommand($generator);
        });
    }

    /**
     * Register generate:angular:structure
     *
     * @return Commands\Angular\StructureCommand
     */
    protected function registerAngularStructureGenerator()
    {
        $this->app['generate.ng.structure'] = $this->app->share(function($app)
        {
            return new Command\Angular\StructureCommand();
        });
    }

    /**
     * Register generate:angular:controller
     *
     * @return Commands\Angular\ControllerCommand
     */
    protected function registerAngularControllerGenerator()
    {
        $this->app['generate.ng.controller'] = $this->app->share(function($app)
        {
            $generator = new Generator\Angular\ControllerGenerator($app['files']);

            return new Command\Angular\ControllerCommand($generator);
        });
    }

    /**
     * Register generate:angular:directive
     *
     * @return Commands\Angular\DirectiveCommand
     */
    protected function registerAngularDirectiveGenerator()
    {
        $this->app['generate.ng.directive'] = $this->app->share(function($app)
        {
            $generator = new Generator\Angular\DirectiveGenerator($app['files']);

            return new Command\Angular\DirectiveCommand($generator);
        });
    }

    /**
     * Register generate:angular:service
     *
     * @return Commands\Angular\ServiceCommand
     */
    protected function registerAngularServiceGenerator()
    {
        $this->app['generate.ng.service'] = $this->app->share(function($app)
        {
            $generator = new Generator\Angular\ServiceGenerator($app['files']);

            return new Command\Angular\ServiceCommand($generator);
        });
    }

    /**
     * Register generate:angular:filter
     *
     * @return Commands\Angular\FilterCommand
     */
    protected function registerAngularFilterGenerator()
    {
        $this->app['generate.ng.filter'] = $this->app->share(function($app)
        {
            $generator = new Generator\Angular\FilterGenerator($app['files']);

            return new Command\Angular\FilterCommand($generator);
        });
    }

    /**
     * Register generate:angular:factory
     *
     * @return Commands\Angular\FactoryCommand
     */
    protected function registerAngularFactoryGenerator()
    {
        $this->app['generate.ng.factory'] = $this->app->share(function($app)
        {
            $generator = new Generator\Angular\FactoryGenerator($app['files']);

            return new Command\Angular\FactoryCommand($generator);
        });
    }

}