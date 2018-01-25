<?php
/**
 * Slug Optimizer Module
 * 
 * @since 0.9
 */

if (class_exists('SU_Module')) {

class SU_Slugs extends SU_Module {
	
	static function get_module_title() { return __('TPSlug', 'seo-ultimate'); }
	
	static function get_parent_module() { return 'misc'; }
	function get_settings_key() { return 'slugs'; }
	function get_default_status() { return SU_MODULE_DISABLED; }
	
	function admin_page_contents() {
		$this->child_admin_form_start();
		$this->textarea('words_to_remove', __('Remover palabras/letras sobrantes cómo...', 'seo-ultimate'), 20);
		$this->child_admin_form_end();
	}
	
	function init() {
		
		add_filter('name_save_pre', array(&$this, 'optimize_slug'), 0);
		
		//Only sanitize if a permalink is being requested via AJAX
		if (isset($_POST['action']) && $_POST['action'] == 'sample-permalink')
			//The filter priority is very important to ensure our function runs before WordPress's sanitize_title_with_dashes() function
			add_filter('sanitize_title', array(&$this, 'optimize_slug_ajax'), 9);
	}
	
	function optimize_slug_ajax($title) {	
		
		if (strcmp($title, $_POST['new_title']) == 0)
			//An empty slug was given, so the post title is being used as the default! Call to action!
			return $this->optimize_slug($title);
		
		return $title;
	}
	
	function optimize_slug($slug) {
		
		//If no slug exists, start off with the post title
		if (empty($slug) && isset($_POST['post_title'])) $slug = $_POST['post_title'];
		
		//Prepare the title and the words for comparison
		$slug = sustr::tolower(stripslashes($slug));
		$words = sustr::tolower(stripslashes($this->get_setting('words_to_remove')));
		
		//Remove the stopwords from the slug
		$newslug = implode("-", array_diff(explode(" ", $slug), suarr::explode_lines($words)));
		
		//Make sure we haven't removed too much!
		if (empty($newslug))
			return $slug;
		else
			return $newslug;
	}
	
	function get_default_settings() {
		
		//Special thanks to the "SEO Slugs" plugin for the stopwords array.
		//http://wordpress.org/extend/plugins/seo-slugs/
		$defaults = array ("a", "con", "de", "la", "el", "es", "lo", "y todo lo que tu creas necesario lo metes aquí...");
		
		return array(
			
			  'words_to_remove' => implode("\n", $defaults)
			
		);
	}
	
	function add_help_tabs($screen) {
		
		$overview = __("
<ul>
	<li><strong>What it does:</strong> Slug Optimizer removes common words from the portion of a post&#8217;s or Page&#8217;s URL that is based on its title. (This portion is also known as the &#8220;slug.&#8221;)</li>
	<li><strong>Why it helps:</strong> Slug Optimizer increases keyword potency because there are fewer words in your URLs competing for relevance.</li>
	<li><strong>How to use it:</strong> Slug Optimizer works without any action required on your part. When you add a new post in your WordPress admin and specify a title for it, WordPress will generate a slug and the new post&#8217;s future URL will appear below the title box. While WordPress is generating the slug, Slug Optimizer takes common words out of it. You can use the textbox on Slug Optimizer&#8217;s admin page to specify which common words are removed.</li>
</ul>
", 'seo-ultimate');
	
		$faq = __("
<ul>
	<li><strong>What&#8217;s a slug?</strong><br />The slug of a post or page is the portion of its URL that is based on its title. When you edit a post or Page in WordPress, the slug is the yellow-highlighted portion of the Permalink beneath the Title textbox.</li>
	<li><strong>Does the Slug Optimizer change my existing URLs?</strong><br />No. Slug Optimizer will not relocate your content by changing existing URLs. Slug Optimizer only takes effect on new posts and pages.</li>
	<li>
		<p><strong>How do I see Slug Optimizer in action?</strong><br />Follow these steps:</p>
		<ol>
			<li>Create a new post/Page in WordPress.</li>
			<li>Type in a title containing some common and uncommon words.</li>
			<li>Click outside the Title box. WordPress will insert a URL labeled &#8220;Permalink&#8221; below the Title textbox. The Slug Optimizer will have removed the common words from the URL.</li>
		</ol>
	</li>
	<li><strong>What if I want to include a common word in my slug?</strong><br />When editing the post or page in question, just click the &#8220;Edit&#8221; button next to the permalink and change the slug as desired. The Slug Optimizer won&#8217;t remove words from a manually-edited slug.</li>
	<li><strong>If I edit the optimized slug but then change my mind, how do I revert back to the optimized slug?</strong><br />When editing the post or page in question, just click the &#8220;Edit&#8221; button next to the permalink; a &#8220;Save&#8221; button will appear in its place. Next erase the contents of the textbox, and then click the aforementioned &#8220;Save&#8221; button.</li>
</ul>
", 'seo-ultimate');
	
		$troubleshooting = __("
<ul>
	<li><strong>Why didn&#8217;t the Slug Optimizer remove common words from my slug?</strong><br />It&#8217;s possible that every word in your post title is in the list of words to remove. In this case, Slug Optimizer doesn&#8217;t remove the words, because if it did, you&#8217;d end up with a blank slug.</li>
</ul>
", 'seo-ultimate');
		
		if ($this->has_enabled_parent()) {
			$screen->add_help_tab(array(
			  'id' => 'su-slugs-help'
			, 'title' => __('Slug Optimizer', 'seo-ultimate')
			, 'content' => 
				'<h3>' . __('Overview', 'seo-ultimate') . '</h3>' . $overview . 
				'<h3>' . __('FAQ', 'seo-ultimate') . '</h3>' . $faq .
				'<h3>' . __('Troubleshooting', 'seo-ultimate') . '</h3>' . $troubleshooting
			));
		} else {
			
			$screen->add_help_tab(array(
				  'id' => 'su-slugs-overview'
				, 'title' => __('Overview', 'seo-ultimate')
				, 'content' => $overview));
			
			$screen->add_help_tab(array(
				  'id' => 'su-slugs-faq'
				, 'title' => __('FAQ', 'seo-ultimate')
				, 'content' => $faq));
			
			$screen->add_help_tab(array(
				  'id' => 'su-slugs-troubleshooting'
				, 'title' => __('Troubleshooting', 'seo-ultimate')
				, 'content' => $troubleshooting));
		}
	}
}



}

?>