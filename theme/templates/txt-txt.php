<?php
$bg_color_key = get_sub_field('bg_color') ?: 'blue';
$txt_top      = get_sub_field('txt_top');
$txt_left     = get_sub_field('txt_left');
$txt_right    = get_sub_field('txt_right');

$bg_opacity_map = [
	'red'    => 'bg-red/10',
	'yellow' => 'bg-yellow/25',
	'blue'   => 'bg-blue/7',
	'white'  => 'bg-white'
];

$selected_bg = $bg_opacity_map[$bg_color_key] ?? $bg_opacity_map['blue'];
?>

<section class="py-20 lg:py-30 <?php echo esc_attr($selected_bg); ?>">
	<div class="container mx-auto px-4">
		<article class="grid grid-cols-12 gap-y-10 gap-x-2 sm:gap-x-6 md:gap-x-10 lg:gap-x-20">
			<?php if ($txt_top): ?>
				<div class="col-span-12 lg:col-span-8 lg:col-start-2 prose max-w-none prose-h2:mb-6">
					<?php echo $txt_top; ?>
				</div>
			<?php endif; ?>
			<?php if ($txt_left): ?>
				<div class="col-span-12 lg:col-span-5 lg:col-start-2 prose max-w-none">
					<?php echo $txt_left; ?>
				</div>
			<?php endif; ?>
			<?php if ($txt_right): ?>
				<div class="col-span-12 lg:col-span-5 lg:col-start-7 prose max-w-none">
					<?php echo $txt_right; ?>
				</div>
			<?php endif; ?>
		</article>
	</div>
</section>