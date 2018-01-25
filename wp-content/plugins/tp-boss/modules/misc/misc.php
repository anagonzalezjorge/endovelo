<?php
/**
 * Miscellaneous Module
 * 
 * @since 5.8
 */

if (class_exists('SU_Module')) {

class SU_Misc extends SU_Module {
	static function get_module_title() { return __('El todo en uno', 'seo-ultimate'); }
	static function get_menu_title() { return __('TPBoss', 'seo-ultimate'); }
	static function get_menu_pos() { return 30; }
	function admin_page_contents() {
		
		echo "\n\n<div class='row'>\n";
			
		if ($this->should_show_sdf_theme_promo()) {
			echo "\n\n<div class='col-sm-8 col-md-9'>\n";
		}
		else {
			echo "\n\n<div class='col-md-12'>\n";
		}
		
		echo '<p>' . __('En este módulo puedes eliminar el <code>/category</code> y el <code>/tag</code>. Añadir bloques de anuncios (o lo que sea) antes o después de una entrada (acepta HTML lógicamente), añadir el atributo <code>nofollow</code> a multitud de enlaces sin tener que estar editando el código cada 2x3. Espera, que no es todo... también puedes optimizar el <strong>slug</strong> eliminando de forma automática las <em>stopwords</em> que no te interesan, verificar tu sitio en Bing y/o Google y realizar redirecciones 301 en paginas inexistentes.', 'seo-ultimate') . '</p>';
		$this->children_admin_pages_form();
		
		echo "\n\n</div>\n";
		
		if ($this->should_show_sdf_theme_promo()) {
			echo "\n\n<div class='col-sm-4 col-md-3'>\n";
			$this->promo_sdf_banners();
			echo "\n\n</div>\n";
		}
		
		echo "\n\n</div>\n";
		
	}
}

}
?>