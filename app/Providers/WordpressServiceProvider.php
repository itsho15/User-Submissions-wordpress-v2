<?php
namespace
App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\Submissions;

class WordpressServiceProvider extends ServiceProvider {

	/** @var \App\Helpers\LumenHelper $lumenHelper **/
	/** @var \App\Helpers\WpHelper $wpHelper **/
	private $wpHelper, $lumenHelper, $absolutePath;

	/**
	 * WordpressServiceProvider constructor.
	 * @param $app \Illuminate\Contracts\Foundation\Application
	 */
	public function __construct($app) {
		parent::__construct($app);
		$this->lumenHelper = $this->app->make('lumenHelper');
		$this->wpHelper    = $this->lumenHelper->wpHelper();

	}

	/**
	 * Register any application services.
	 * @return void
	 */
	public function register() {
		/** Add Plugin Links to Admin > Plugins Page Entry **/
		$this->wpHelper
			->addPluginLinks(array(
				'<a target="_blank" href="http://bayareawebpro.com">Developer</a>',
			));

		/** Add FrontEnd Widget **/
		$this->wpHelper
			->addWidget(
				\App\Widgets\ExampleFrontEndWidget::class
			);
			

		/** Add Admin Bar Nodes
		$this->wpHelper
		->addAdminBarNode(
		false,
		'lumen_bar_node2',
		'Lumen Bar Node',
		'#'
		)->addAdminBarNode(
		'lumen_bar_node2',
		'lumen_bar_node2_child1',
		'Node Child 1',
		'#'
		)->addAdminBarNode(
		'lumen_bar_node2',
		'lumen_bar_node2_child2',
		'Node Child 2',
		'#'
		)->addAdminBarNode(
		'lumen_bar_node2',
		'lumen_bar_node2_child3',
		'Node Child 2',
		'#'
		);
		 **/

		/** Add Shortcodes **/
		$this->wpHelper
			->addShortcode(
				'auth_register',
				function ($parameters, $content) {
					return $this->app->call('\App\Http\Controllers\Auth\RegisterShortcodeController@template', compact('parameters', 'content'));
				}
			)
			->addShortcode(
				'auth_login',
				function ($parameters, $content) {
					return $this->app->call('\App\Http\Controllers\Auth\LoginShortcodeController@template', compact('parameters', 'content'));
				}
			)->addShortcode(
			'submssions',
			function ($parameters, $content) {
				return $this->app->call('\App\Http\Controllers\SubmssionsShortcodeController@template', compact('parameters', 'content'));
			}
		);

		/** Add MetaBoxes **/
		$this->wpHelper
			->addMetaBox(
				'example_meta_box',
				'Example Meta Box',
				function ($post, $metabox_attributes) {
					$this->lumenHelper
						->response($this->app->call('\App\Http\Controllers\ExampleMetaBoxController@template', compact('post', 'metabox_attributes')))
						->sendContent();
				},
				'post',
				'normal',
				'default',
				2
			)
			->addAction(
				'save_post',
				function ($post_id, $post, $update) {
					if ($post->post_type == 'post') {
						$this->app->make('cache')->flush();
						$this->app->call('\App\Http\Controllers\ExampleMetaBoxController@save', compact('post_id', 'post', 'update'));
					}
				},
				10,
				3
			);

		/** Add Nav Menu MetaBoxes **/
		$this->wpHelper->addMetaBox(
			'example_menu_meta_box',
			'NTSCUserSubmission links',
			function ($object, $arguments) {
				$this->lumenHelper
					->response($this->app->call('\App\Http\Controllers\GlobalController@AddLinksToMenu', compact('object', 'arguments')))
					->sendContent();
			},
			'nav-menus',
			'side',
			'default',
			2
		);

		/** Add Dashboard Widget **/
		/*
			$this->wpHelper
				->addDashboardWidget(
					'example_admin_widget',
					'Example Admin Widget',
					function () {
						$this->lumenHelper
							->response($this->app->call('\App\Widgets\ExampleAdminWidget@template'))
							->sendContent();
					}
				);
		*/

		/** Add WP Rest API Route
		$this->wpHelper
		->addRestRoute('wp-lumen/api/v1', '/test', array(
		'methods'  => ['get'],
		'callback' => function () {
		return $this->app->call('\App\Http\Controllers\ExampleWpRestRouteController@get');
		},
		));
		 **/

		/** Add Dashboard Panels **/
		$this->wpHelper
			->addAdminPanel(
				'NTSCUserSubmission',
				'NTSC User Submission',
				'NTSC User Submission',
				function () {
					$this->lumenHelper
						->response($this->app->call('\App\Http\Controllers\GlobalController@Tabs'))
						->sendContent();
				},
				'manage_options'
			)->addAdminSubPanel(
			'NTSCUserSubmission',
			'lumen_settings',
			'Shortcodes',
			'Shortcodes',
			function () {
				$this->lumenHelper
					->response($this->app->call('\App\Http\Controllers\SettingsController@template'))
					->sendContent();
			},
			'manage_options'
		)->addAdminSubPanel(
			'NTSCUserSubmission',
			'import_export',
			'import/export',
			'import/export',
			function () {
				$this->lumenHelper
					->response($this->app->call('\App\Http\Controllers\SettingsController@importExport'))
					->sendContent();
			},
			'manage_options'
		);

		/** Add CSS & Scripts **/
			/** Add CSS & Scripts **/
		$this->wpHelper

			->enqueueStyle('prefix_bootstrapcssModel', $this->lumenHelper->asset('resources/assets/build/admin/bootstrapmodel.min.css'), array(), '1.0.0', 'all', 'admin')
		//frontend
			->enqueueStyle('prefix_bootstrapcssModel', $this->lumenHelper->asset('resources/assets/build/admin/bootstrapmodel.min.css'), array(), '1.0.0', 'all', '')
		//frontend
			->enqueueStyle('maincss', $this->lumenHelper->asset('resources/assets/build/admin/main.css'), array(), '1.0.0', 'all', 'admin')
			->enqueueStyle('datatablecss', $this->lumenHelper->asset('resources/assets/build/admin/datatables/datatables.min.css'), array(), '1.0.0', 'all', 'admin')
		//frontend
			->enqueueStyle('datatablecss', $this->lumenHelper->asset('resources/assets/build/admin/datatables/datatables.min.css'), array(), '1.0.0', 'all', '')
		//frontend

			->enqueueScript('bootstrapmodeljs', $this->lumenHelper->asset('resources/assets/build/admin/bootstrapmodel.min.js'), array('jquery'), '1.0.0', true, 'admin')
			->enqueueScript('datatablejs', $this->lumenHelper->asset('resources/assets/build/admin/datatables/datatables.min.js'), array('jquery'), '1.0.0', true, 'admin')
		//frontend
			->enqueueScript('datatablejsfront', $this->lumenHelper->asset('resources/assets/build/admin/datatables/datatables.min.js'), array('jquery'), '1.0.0', true, '')
		//frontend
			->enqueueScript('mainjs', $this->lumenHelper->asset('resources/assets/build/admin/main.js'), array('jquery'), '1.0.0', true, 'admin')
			->enqueueScript('mainjsfront', $this->lumenHelper->asset('resources/assets/build/admin/main.js'), array('jquery'), '1.0.0', true, '')
		// frontend
			->enqueueScript('bootstrapmodelfrontjs', $this->lumenHelper->asset('resources/assets/build/admin/bootstrapmodel.min.js'), array('jquery'), '1.0.0', true, '')
			->enqueueScript('mainfrontjs', $this->lumenHelper->asset('resources/assets/build/front/mainfront.js'), array('jquery'), '1.0.0', true, '');
	}
}
