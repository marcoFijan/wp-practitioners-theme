<?php
$txt 					= get_field('txt', $args['queried_object']);
$link     		= get_field('link', $args['queried_object']);
$img 					= get_field('img', $args['queried_object']);
?>

<section class="bg-blue/7 py-30 lg:py-50 overflow-hidden relative min-h-dvh">
	<div class="w-60 lg:w-80 absolute -top-30 -right-30 lg:-top-40 lg:-right-40 z-0">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-red',
		]); ?>
	</div>
	<div class="w-80 absolute -bottom-40 -left-40">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-yellow',
			'class'      => 'rotate-180',
		]); ?>
	</div>

	<div class="container grid grid-cols-12 gap-6 gap-y-12 items-center relative z-10">
		<div class="col-span-12 lg:col-span-5 lg:col-start-2 relative">
			<?php
			get_template_part('components/media-circle', null, [
				'image_id'     => $img,
				'class'        => 'w-full h-full aspect-square mx-auto',
				'shadow_class' => 'shadow-color-inset',
			]);
			?>
		</div>
		<section class="col-span-12 lg:col-span-4 lg:col-start-8 ">
			<article class="prose">
				<?= $txt; ?>
			</article>
			<?php if ($link) : ?>
				<?php get_template_part('components/button', null, [
					'link' => $link,
					'variant' => 'aqua',
					'custom-class' => 'mt-12',
				]); ?>
			<?php endif; ?>
		</section>

	</div>
</section>