<?php
/**
 * 404 Monitor Settings Module
 * 
 * @since 2.1
 */

if (class_exists('SU_Module')) {

class SU_FofsSettings extends SU_Module {
	
	static function get_parent_module() { return 'fofs'; }
	static function get_child_order() { return 20; }
	static function is_independent_module() { return false; }
	
	static function get_module_title() { return __('Opciones', 'seo-ultimate'); }
	function get_module_subtitle() { return __('Opciones', 'seo-ultimate'); }
	function get_settings_key() { return '404s'; }
	
	function get_default_settings() {
		return array(
			  'exceptions' => "*/favicon.ico\n*/apple-touch-icon.png\n*/pingserver.php\n*/xmlrpc.php"
			, 'max_log_size' => 100
			, 'log_enabled' => $this->flush_setting('log_hits', true, 'settings')
			, 'restrict_logging' => true
			, 'log_spiders' => true
			, 'log_errors_with_referers' => true
		);
	}
	
	function init() {
		add_filter('su_get_setting-404s-max_log_size', array('sustr', 'to_int'));
	}
	
	function admin_page_contents() {

		$this->admin_form_start();
		$this->checkbox('log_enabled', __('Monitorizar todos y cada uno de los nuevos errores 404', 'seo-ultimate'), __('Opciones de registro', 'seo-ultimate'));
		$this->checkboxes(array(
			  'restrict_logging' => __('Registrar únicamente los errores 404 de:', 'seo-ultimate')
			, 'log_spiders' => array('description' => __('404s generados por las arañas y bots', 'seo-ultimate'), 'indent' => true)
			, 'log_errors_with_referers' => array('description' => __('404s de páginas referidas', 'seo-ultimate'), 'indent' => true)
		), __('¡Restricciones!', 'seo-ultimate'));
		$this->textbox('max_log_size', __('Máximo de entradas que se registrarán', 'seo-ultimate'), $this->get_default_setting('max_log_size'));
		$this->textarea('exceptions', __('URLs que se ignorarán', 'seo-ultimate') . '<br /><small><em>' . __('(Recuerda que puedes usar el *)', 'seo-ultimate') . '</em></small>', 15);
		$this->admin_form_end();
	}
}

}
?>