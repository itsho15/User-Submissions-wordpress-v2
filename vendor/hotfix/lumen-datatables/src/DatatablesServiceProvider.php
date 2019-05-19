<?php

namespace Hotfix\Datatables;

use Collective\Html\HtmlServiceProvider;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use Hotfix\Datatables\Generators\DataTablesMakeCommand;
use Hotfix\Datatables\Generators\DataTablesScopeCommand;

class DatatablesServiceProvider extends ServiceProvider
{
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'datatables');

        $this->publishAssets();
    }

    /**
     * Publish datatables assets.
     */
    private function publishAssets()
    {
	    app()->make('config')->set('datatables', require __DIR__ . '/config/config.php');
	    app()->configure('datatables');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('datatables', function ($app) {
            return new Datatables($app->make(Request::class));
        });

        //$this->registerAliases();
    }

    /**
     * Create aliases for the dependency.
     */
    private function registerAliases()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Datatables', \Hotfix\Datatables\Datatables::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['datatables'];
    }
}
