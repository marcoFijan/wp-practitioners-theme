<!DOCTYPE HTML>
<html <?php language_attributes('scroll-smooth'); ?>>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<!-- Google Tag Manager -->
<script>
	(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	})(window, document, 'script', 'dataLayer', 'GTM-MHM9XD5L');
</script>
<!-- End Google Tag Manager -->

<body <?php body_class('antialiased'); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHM9XD5L"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<ul class="sr-only">
		<li><a href="#nav" class="sr-only focus:not-sr-only"><?php _e('Naar navigatie', 'linc'); ?></a></li>
		<li><a href="#content" class="sr-only focus:not-sr-only"><?php _e('Naar hoofdinhoud', 'linc'); ?></a></li>
		<li><a href="#footer" class="sr-only focus:not-sr-only"><?php _e('Naar footer', 'linc'); ?></a></li>
	</ul>

	<header class="relative w-full">
		<div class="w-full fixed left-0 top-0 bg-rainbow-sunset h-1.5 z-100"></div>
		<?php
		get_template_part('components/nav');

		if (is_archive() && !is_tax('category_post')) {
			$queried_object = get_queried_object()->name . '_archive';
		} elseif (is_home() || is_tax('category_post')) {
			$queried_object = get_option('page_for_posts');
		} elseif (is_404()) {
			$queried_object = 'options_404';
		} else {
			$queried_object = get_queried_object();
		}

		if (is_front_page()) {
			get_template_part('components/hero', 'home');
		} elseif (is_page_template('template-legal.php')) {
		} elseif (is_post_type_archive('gp') || is_post_type_archive('agenda')) {
			get_template_part('components/hero-practitioner-agenda', null, ['queried_object' => $queried_object]);
		} elseif (is_singular('stories')) {
			get_template_part('components/hero-story', null, ['queried_object' => $queried_object]);
		} else {
			get_template_part('components/hero', null, array('queried_object' => $queried_object));
		}
		?>
	</header>

	<main>