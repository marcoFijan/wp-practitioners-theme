<?php
$shown_stories    = get_sub_field('shown_stories');
$selected_stories = get_sub_field('selected_stories');
$query_args = [
	'post_type'      => 'stories',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
];

if ($shown_stories === 'selected' && !empty($selected_stories)) {
	$query_args['post__in'] = array_map(fn($post) => $post->ID, (array)$selected_stories);
	$query_args['orderby']  = 'post__in';
}

$stories_query = new WP_Query($query_args);
if (!$stories_query->have_posts()) return;

$bg_map         = ['red' => 'bg-red', 'yellow' => 'bg-yellow', 'blue' => 'bg-blue-lighter'];
$bg_opacity_map = ['red' => 'bg-pink/10', 'yellow' => 'bg-yellow/25', 'blue' => 'bg-blue/7'];
$first_post_id   = $stories_query->posts[0]->ID;
$first_color_val = get_sub_field('color', $first_post_id);
$initial_section_bg = $bg_opacity_map[$first_color_val] ?? '';
?>

<section class="js-stories-wrapper relative w-full transition-colors duration-1000 ease-in-out py-12 md:py-24 overflow-hidden <?= esc_attr($initial_section_bg); ?>"
	data-initial-bg="<?= esc_attr($initial_section_bg); ?>">
	<div class="absolute bg-blue/7 after:bg-pink/10 before:bg-yellow/25"></div>
	<div class="swiper js-stories-slider overflow-visible static">
		<div class="swiper-wrapper">
			<?php while ($stories_query->have_posts()) : $stories_query->the_post();
				$color      = get_field('color');
				$quote      = get_field('quote');
				$name       = get_field('name');
				$job_title  = get_field('job_title');
				$btn_txt    = get_field('button_txt') ?: "Lees het verhaal van " . $name;
				$img_id     = get_field('img');
				$accent_bg  = $bg_map[$color] ?? 'bg-primary';
				$section_bg = $bg_opacity_map[$color] ?? 'bg-gray-100';
			?>
				<div class="swiper-slide h-auto bg-transparent flex flex-col items-center text-center"
					data-bg-class="<?= esc_attr($section_bg); ?>">
					<article class="prose max-w-180 mb-14 px-4">
						<h2>&ldquo;<?= esc_html($quote); ?>&rdquo;</h2>
					</article>
					<div class="relative w-full max-w-88 md:max-w-140 mx-auto">
						<?php
						get_template_part('components/media-circle', null, [
							'image_id'     => $img_id,
							'bg_color'     => $accent_bg,
							'image_class' =>  'object-contain object-bottom w-[85%] h-[85%] mx-auto',
							'class'        => 'w-full h-full aspect-square',
							'shadow_class' => 'shadow-color-inset',
							'custom_size'  => 'max-w-140 max-h-140'
						]);
						?>

						<div class="absolute name-label z-30 bg-purple text-white rounded-full py-2 md:py-[0.88rem] px-3 md:px-5 font-bold text-sm md:text-base leading-snug max-w-70 md:max-w-none text-center md:mt-44 mt-0">
							<?= esc_html($name); ?>, <span class="text-yellow-light"><?= esc_html($job_title); ?></span>
						</div>
						<div class="absolute button-label z-30 max-w-80 md:max-w-none md:translate-y-20">
							<?php
							get_template_part('components/button', null, [
								'link'    => ['url' => get_permalink(), 'title' => $btn_txt, 'target' => '_self'],
								'variant' => 'white'
							]);
							?>
						</div>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>
		<div class="md:absolute bottom-12 md:bottom-24 left-1/2 mx-auto md:-translate-x-1/2 w-full max-h-88 md:max-h-140 max-w-3/4 md:aspect-square pointer-events-none z-40">
			<div class="relative w-full h-full z-20">
				<button class="js-stories-prev cursor-pointer absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full border border-purple/20 flex items-center justify-center bg-transparent hover:bg-purple text-purple hover:text-white transition-all text-xl md:text-2xl pointer-events-auto shadow-sm">
					<span class="font-icons-outlined">arrow_left_alt</span>
				</button>
				<button class="js-stories-next cursor-pointer absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full border border-purple/20 flex items-center justify-center bg-transparent hover:bg-purple text-purple hover:text-white transition-all text-xl md:text-2xl pointer-events-auto shadow-sm">
					<span class="font-icons-outlined">arrow_right_alt</span>
				</button>
			</div>
		</div>
	</div>
</section>