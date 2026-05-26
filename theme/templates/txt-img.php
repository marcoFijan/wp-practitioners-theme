<?php
$bg_color_field = get_sub_field('bg_color');
$bg_color_key = (is_array($bg_color_field) && isset($bg_color_field['value']))
	? $bg_color_field['value']
	: $bg_color_field;

$bg_color_key = $bg_color_key ?: 'white';
$bg_opacity_map = [
	'white'  => 'bg-white',
	'red'    => 'bg-red/10',
	'yellow' => 'bg-yellow/25',
	'blue'   => 'bg-blue/7'
];

$selected_bg = $bg_opacity_map[$bg_color_key] ?? $bg_opacity_map['blue'];
?>

<section class="<?php echo esc_attr($selected_bg); ?>">
	<div class="container grid grid-cols-12 gap-x-4 gap-y-10 lg:gap-x-6 py-20 lg:py-30 items-center">
		<div class="col-span-12 lg:col-span-5 order-1
    <?php echo (get_sub_field('order')['value'] == 'img_txt')
			? 'lg:order-2 lg:col-start-7 lg:ml-12'
			: 'lg:order-1 lg:col-start-2 lg:mr-12';
		?>">
			<article class="prose">
				<?php the_sub_field('txt'); ?>
			</article>
			<?php
			$link = get_sub_field('link');
			if ($link) :
				get_template_part('components/button', null, [
					'link'    => $link,
					'custom-class' => 'mt-12'
				]);
			?>
			<?php endif; ?>
		</div>

		<div class="col-span-12 lg:col-span-5 order-2 relative
    <?php echo (get_sub_field('order')['value'] == 'img_txt')
			? 'lg:order-1 lg:col-start-2'
			: 'lg:order-2 lg:col-start-7';
		?>">
			<?php if (get_sub_field('img')) : ?>
				<div class="w-full sm:w-auto h-full mx-auto relative max-w-120">
					<?php get_template_part('components/media-circle', null, [
						'image_id'   => get_sub_field('img'),
						'image_size' => 'square-sm',
						'class'      => 'w-full h-auto mx-auto'
					]); ?>
					<?php if (get_sub_field('img_small')) : ?>
						<div class="absolute left-0 top-0 z-30">
							<?php get_template_part('components/media-circle', null, [
								'image_id'   => get_sub_field('img_small'),
								'image_size' => 'thumbnail',
								'class'      => 'w-1/4 left-0 h-auto ring-6 ring-white shadow-image-small '
							]); ?>
						</div>
					<?php endif; ?>
				</div>

			<?php endif; ?>
		</div>
	</div>
</section>