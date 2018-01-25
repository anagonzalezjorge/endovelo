/*global jQuery:false, alert */
(function($) { 
    "use strict";
jQuery(document).ready(function($) {
	
	$('#sdf-promo-carousel').hide();
	$('#sdf_dashboard_widget .inside').hide();
	var sds_promo_blog_post = $('#sds_promo_blog_post').html();
	var banners_remote = ({
"banners": [
{"banner_img":"seo-design-framework-banner.jpg", "banner_link":"http://www.seodesignframework.com/"},
{"banner_img":"sdf-website-silo-architecture.png", "banner_link":"http://vayaseo.com/teamplatino"},
{"banner_img":"seo-ultimate-plugin-done-for-you-service.jpg", "banner_link":"http://chuiso.com"},
{"banner_img":"seo-ultimate-plus-video-training.jpg", "banner_link":"https://seodesignframework.leadpages.co/seo-ultimate-video-training/"},
{"banner_img":"seo-ultimate-wordpress-dashboard.png", "banner_link":"http://vayaseo.com/teamplatino"}
],
"slides": [
{"slide_cap":"<h3>Comunidad privada SEO</h3><p>TeamPlatino es una plataforma de aprendizaje online liderada por Chuiso, con más de 10 profesores adicionales expertos en distintos ámbitos. Disponemos de clases y vídeos, foro privado, red de blogs privada, exámenes online, WikiSEO, laboratorio y mucho más...</p>", "slide_link":"http://vayaseo.com/teamplatino"},
{"slide_cap":"<h3>BlackHat SEO y...</h3><p>SEO onpage, link building, técnicas Black Hat, programas de creación de enlaces, marketing de afiliados, CPA, CPL, PPI, lockers, programación básica, scripts, scrapers, bots, redes sociales,  posicionamiento local, Google places, redirecciones, uso y empleo de PBN, ¿te parece poco?</p>", "slide_link":"http://vayaseo.com/teamplatino"}
],
"dashboard_widget": [
{"title":"Supercharge your SEO", "content":"<p>Accede ahora a <a rel=\"nofollow\" target=\"_blank\" title=\"TeamPlatino\" href=\"http://vayaseo.com/teamplatino\">TeamPlatino</a> y conviértete en un "as" del SEO... empieza a ganar dinero en Internet. :)</p><a rel=\"nofollow\" target=\"_blank\" title=\"SEO Ultimate video training\" href=\"http://go.seoultimateplus.com/get-help/\"><img src=\"" + suModulesSdfAdsSdfAdsL10n.sdf_banners_url + "seo-ultimate-wordpress-dashboard.png\" alt=\"SEO Ultimate video training\" /></a>"}
]
})

		
	var promo_carousel = $('#sdf-promo-carousel');
	if (promo_carousel.length > 0) {
		var sdf_carousel = '';
		var shuffled_banners = shuffleArray(banners_remote.banners);
		var shuffled_slides = shuffleArray(banners_remote.slides);
		// check if it's cloud hosted banner
		var banner_img = shuffled_banners[0].banner_img
		if(banner_img.indexOf('https://') == -1) banner_img = suModulesSdfAdsSdfAdsL10n.sdf_banners_url + banner_img;
		sdf_carousel = sdf_carousel + "<a href=\"" + shuffled_banners[0].banner_link + "\" rel=\"nofollow\" target=\"_blank\"><img src=\"" + banner_img + "\" alt=\"Slide "+ i +"\"></a>";
		sdf_carousel = sdf_carousel + "<div id=\"sdfCarousel\" class=\"carousel slide\"><ol class=\"carousel-indicators\">";
				
		var active_indicator = '';
		for ( var i = 0; i < shuffled_slides.length; i++ ) {
			if (i == 0) active_indicator = ' class=\"active\"';
			else active_indicator = '';
			sdf_carousel = sdf_carousel + "<li data-target=\"#sdfCarousel\" data-slide-to=\""+ i +"\""+ active_indicator +"></li>";
		};
		sdf_carousel = sdf_carousel + "<li data-target=\"#sdfCarousel\" data-slide-to=\""+ i +"\"></li>";
		sdf_carousel = sdf_carousel + "</ol><div class=\"carousel-inner\">";
		
		
		for ( var i = 0; i < shuffled_slides.length; i++ ) {
			if (i == 0) active_indicator = ' active';
			else active_indicator = '';
			sdf_carousel = sdf_carousel + "<div class=\"item"+ active_indicator +"\"><div class=\"container\"><div class=\"carousel-caption\">"+ shuffled_slides[i].slide_cap + "<p><a class=\"btn btn-large btn-warning\" href=\""+ shuffled_slides[i].slide_link + "\" rel=\"nofollow\" target=\"_blank\">Me apunto!</a></p></div></div></div>";
		};
		sdf_carousel = sdf_carousel + "<div class=\"item\"><div class=\"container\"><div class=\"carousel-caption\">"+ sds_promo_blog_post + "</div></div></div>";
		sdf_carousel = sdf_carousel + "</div><a class=\"left carousel-control\" href=\"#sdfCarousel\" data-slide=\"prev\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a><a class=\"right carousel-control\" href=\"#sdfCarousel\" data-slide=\"next\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></div>";
		
		promo_carousel.html(sdf_carousel).delay(400).fadeIn(300).carousel({ interval:7000 });
	}	
	
	// dashboard widget
	$('#sdf_dashboard_widget h3.hndle span').html(banners_remote.dashboard_widget[0].title);
	$('#sdf_dashboard_widget .inside').html(banners_remote.dashboard_widget[0].content);
	setTimeout(function(){
		$('#sdf_dashboard_widget .inside').fadeIn(300);
	},600);

});
 
})(jQuery);

/**
 * Randomize array element order in-place.
 * Using Fisher-Yates shuffle algorithm.
 */
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}