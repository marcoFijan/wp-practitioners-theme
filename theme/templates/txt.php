<?php
$bg_color_key = get_sub_field('bg_color') ?: 'white';
$txt      = get_sub_field('txt');
$link     = get_sub_field('link');

$bg_opacity_map = [
	'white'  => 'bg-white',
	'red'    => 'bg-pink/10',
	'yellow' => 'bg-yellow/25',
	'blue'   => 'bg-blue/7'
];

$selected_bg = $bg_opacity_map[$bg_color_key] ?? $bg_opacity_map['blue'];
?>

<section class="py-20 lg:py-30 <?php echo esc_attr($selected_bg); ?>">
	<div class="container grid grid-cols-12 gap-6">
		<div class="col-span-12 lg:col-span-8 lg:col-start-3">
			<?php if ($txt): ?>
				<article class=" prose">
					<?= $txt; ?>
				</article>
			<?php endif; ?>
			<?php if ($link) : ?>
				<?php get_template_part('components/button', null, [
					'link' => $link,
					'custom-class' => 'mt-12',
				]); ?>
			<?php endif; ?>
		</div>
	</div>
</section>