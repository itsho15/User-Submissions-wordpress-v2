<?php namespace App\Utilities;
class DeActivate {

	/**
	 * @var $app \Laravel\Lumen\Application
	 * @var $config \Illuminate\Config\Repository
	 * @var $artisan \Illuminate\Contracts\Console\Kernel
	 * @var $schema \Illuminate\Database\Schema\Builder
	 */
	protected $app, $config, $artisan, $schema;

	/**
	 * Class Initialization called by Hook (Requires Static Method)
	 * @return self
	 */
	public static function init() {
		putenv('APP_ENV=staging');
		return new self();
	}

	/**
	 * Class Constructor called by init()
	 */
	public function __construct() {
		$this->app     = \App\Helpers\LumenHelper::plugin();
		$this->config  = $this->app->make('config');
		$this->artisan = $this->app->make(\Illuminate\Contracts\Console\Kernel::class);
		$this->schema  = $this->app->make('db')->getSchemaBuilder();
		$this->schema();
		$this->data();
	}

	/**
	 * Modify Database Schema
	 */
	public function schema() {
		/*
			        if ($this->config->get('session.driver', 'file') === 'database') {
			            $this->artisan->call('migrate:reset');
			            $this->schema->dropIfExists($this->config->get('database.migrations'));
			        }
		*/
	}

	/**
	 * Process Data
	 */
	public function data() {

	}
}