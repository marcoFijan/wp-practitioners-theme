<?php
$object_id = $args['queried_object'] ?? get_the_ID();
$hero_text         = get_field('txt', $object_id);
$hero_label        = get_field('label', $object_id);
?>

<section class=" pt-20 lg:pt-50 overflow-visible relative">
	<div class="absolute top-0 left-0 w-full h-178 bg-blue/7">
		<div class="relative h-full w-full overflow-hidden">
			<div class="w-60 absolute -top-30 -right-30 z-0">
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
		</div>
	</div>
	<div class="container grid grid-cols-12 gap-6 items-center relative z-10 text-center">
		<article class="col-span-12 md:col-span-10 md:col-start-2 lg:col-span-8 lg:col-start-3 mb-21">
			<?php if ($hero_label): ?>
				<span class="text-purple font-bold bg-white py-0.88rem px-6 rounded-full mx-auto mb-10 block w-max">
					<?= esc_html($hero_label); ?>
				</span>
			<?php endif; ?>
			<div class="prose">
				<?= $hero_text; ?>
			</div>
		</article>
	</div>
</section>