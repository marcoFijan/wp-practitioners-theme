<?php
$color         	= get_field('color', $args['queried_object'] ?? get_the_ID()) ?: 'red';
$quote    			= get_field('quote', $args['queried_object'] ?? get_the_ID());
$name 					= get_field('name', $args['queried_object'] ?? get_the_ID());
$job_title      = get_field('job_title', $args['queried_object'] ?? get_the_ID());
$img_id 				= get_field('img', $args['queried_object'] ?? get_the_ID());
$bg_map         = ['red' => 'bg-red', 'yellow' => 'bg-yellow', 'blue' => 'bg-blue-lighter'];
$bg_opacity_map = ['red' => 'bg-pink/10', 'yellow' => 'bg-yellow/25', 'blue' => 'bg-blue/7'];

$scroll_text = !empty($field_val) ? $field_val : 'Scroll naar beneden'; ?>
<section class="<?= $bg_opacity_map[$color] ?> pb-15 pt-32 lg:pt-40 overflow-hidden relative">
	<div class="w-60 lg:w-80 absolute -top-30 -right-30 lg:-top-40 lg:-right-40 z-0">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-yellow',
		]); ?>
	</div>
	<div class="w-80 absolute -bottom-40 -left-40">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-blue-lighter',
			'class'      => 'rotate-180',
		]); ?>
	</div>

	<div class="container grid grid-cols-12 gap-6 items-center relative z-10 mb-20">
		<article class="col-span-12 lg:col-span-5 lg:col-start-2 prose">
			<h1 class="mb-12 lg:mr-12">&ldquo;<?= esc_html($quote); ?>&rdquo;</h1>
			<?php if ($name || $job_title) : ?>
				<div class="name-label z-30 bg-purple text-white rounded-full py-0.88rem w-min px-5 font-bold text-base whitespace-nowrap leading-none">
					<?= esc_html($name); ?>, <span class="text-yellow-light leading-none"><?= esc_html($job_title); ?></span>
				</div>
			<?php endif; ?>
			<?php
			$referer = wp_get_referer();
			$home_url = home_url();

			if ($referer && str_starts_with($referer, $home_url)) :
				get_template_part('components/button', null, [
					'url'          => $referer,
					'label'        => 'Terug naar het overzicht',
					'variant'      => 'white',
					'custom-class' => 'mt-6',
				]);
			endif;
			?>
		</article>
		<div class="col-span-12 lg:col-span-5 lg:col-start-7 relative">
			<?php
			get_template_part('components/media-circle', null, [
				'image_id'     => $img_id,
				'bg_color'     => $bg_map[$color] ?? 'bg-primary',
				'image_class'  => 'object-top pt-4 lg:pt-8 max-w-3/4 mx-auto',
				'class'        => 'w-full h-full aspect-square mx-auto',
				'shadow_class' => 'shadow-color-inset',
			]);
			?>
		</div>
	</div>
	<div class="col-span-12 pt-15 text-center flex items-center justify-center text-black text-sm">
		<img src="<?= get_stylesheet_directory_uri(); ?>/assets/media/scroll-anim.gif" class="h-6 w-auto" alt="">
		<span>Lees het hele verhaal</span>
	</div>
</section>