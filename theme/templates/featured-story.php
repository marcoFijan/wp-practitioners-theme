<?php
$story_object = get_sub_field('story');
$target_id = ($story_object instanceof WP_Post) ? $story_object->ID : $story_object;
$color     = get_field('color', $target_id) ?: 'red';
$quote     = get_field('quote', $target_id);
$name      = get_field('name', $target_id);
$job_title = get_field('job_title', $target_id);
$img_id    = get_field('img', $target_id);
$bg_map         = ['red' => 'bg-red', 'yellow' => 'bg-yellow', 'blue' => 'bg-blue-lighter'];
$bg_opacity_map = ['red' => 'bg-pink/10', 'yellow' => 'bg-yellow/25', 'blue' => 'bg-blue/7'];

if ($target_id) :
?>
	<section class="<?= $bg_opacity_map[$color] ?> py-20">
		<div class="container grid grid-cols-12 gap-6 items-center">
			<div class="col-span-12 lg:col-span-10 lg:col-start-2 flex flex-col-reverse lg:flex-row items-center gap-14">
				<article class="prose">
					<h2 class="mb-8">&ldquo;<?= esc_html($quote); ?>&rdquo;</h2>
					<?php if ($name || $job_title) : ?>
						<div class="name-label self-start w-max z-30 bg-purple text-white rounded-full py-0.88rem px-5 font-bold text-base whitespace-nowrap leading-none">
							<?= esc_html($name); ?>, <span class="text-yellow-light leading-none"><?= esc_html($job_title); ?></span>
						</div>
					<?php endif; ?>
				</article>
				<?php
				get_template_part('components/media-circle', null, [
					'image_id'     => $img_id,
					'bg_color'     => $bg_map[$color] ?? 'bg-primary',
					'image_class'  => 'object-top pt-4 lg:pt-8 w-full mx-auto',
					'class'        => 'w-full lg:w-80 aspect-square',
					'shadow_class' => 'shadow-color-inset',
				]);
				?>
			</div>
		</div>
	</section>
<?php endif; ?>