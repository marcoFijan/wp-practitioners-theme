<?php
$hero_text         = get_field('txt');
$video_btn_text    = get_field('show_video_txt');
$featured_thumb_id = get_field('featured_thumbnail');
$hero_link         = get_field('link');
$video_source      = get_field('video_source');
$yt_id             = get_field('yt_id');
$local_video_id    = get_field('featured_video');
$featured_src      = ($video_source === 'yt') ? $yt_id : $local_video_id;
$featured_type     = ($video_source === 'yt') ? 'youtube' : 'video';
$autoplay_video_id = get_field('video');
$autoplay_thumb_id = get_field('thumbnail');
$background_img_id = get_field('img');
$field_val = get_field('scrolltext');
$scroll_text = !empty($field_val) ? $field_val : 'Scroll naar beneden'; ?>

<section class="bg-blue/7 py-20 lg:pt-36 pb-15 overflow-hidden relative">
	<div class="w-60 lg:w-80 absolute -top-35 -right-30 lg:-top-47 lg:-right-40 z-0">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-red',
		]); ?>
	</div>
	<div class="w-80 lg:w-md absolute -bottom-40 -left-40 lg:-bottom-56 lg:-left-56">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-yellow',
			'class'      => 'rotate-180',
		]); ?>
	</div>
	<div class="container grid grid-cols-12 gap-6 items-center relative z-10">
		<div class="col-span-12 xl:col-span-5 xl:col-start-2">
			<article class="prose prose-lg">
				<?= $hero_text; ?>
			</article>
			<div class="flex gap-2 flex-wrap mt-12">
				<?php if ($video_btn_text && $featured_src): ?>
					<?php
					get_template_part('components/button', null, [
						'label'   => $video_btn_text,
						'variant' => 'aqua',
						'icon'    => 'motion_play',
						'data'    => [
							'lightbox' => 'featured-video-modal'
						]
					]);
					?>
					<?php
					ob_start();
					get_template_part('components/video-controller', null, [
						'type'   => $featured_type,
						'src'    => $featured_src,
						'poster' => $featured_thumb_id,
					]);
					$video_html = ob_get_clean();
					get_template_part('components/lightbox', null, [
						'id'      => 'featured-video-modal',
						'no-padding' => true,
						'content' => '<div class="aspect-video w-full h-full">' . $video_html . '</div>'
					]);
					?>
				<?php endif; ?>
				<?php if ($hero_link && $hero_link['url']): ?>
					<?php
					get_template_part('components/button', null, [
						'link'    => $hero_link,
						'variant' => 'white'
					]);
					?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-span-12 xl:col-span-6 xl:col-start-7">
			<div class="relative flex justify-center lg:justify-end items-center max-w-120 mx-auto xl:pl-6 2xl:pl-0">
				<div class="absolute top-0 right-0 md:-right-1/8 xl:-right-1/16 2xl:-right-1/8 z-0">
					<?php get_template_part('components/media-circle', null, [
						'image_id'   => $background_img_id,
						'image_size' => 'medium',
						'class'      => 'w-34 xs:40 sm:w-46'
					]); ?>
				</div>
				<div class="relative z-10">
					<?php get_template_part('components/media-circle', null, [
						'video_id'   => $autoplay_video_id,
						'poster_id'  => $autoplay_thumb_id,
						'image_id'   => $autoplay_thumb_id,
						'image_size' => 'full',
						'class'      => 'w-full mt-20 md:mt-10 xl:mt-20 2xl:mt-10'
					]); ?>
				</div>
			</div>
		</div>
		<div class="col-span-12 pt-15 gap-3 text-center flex items-center justify-center text-black text-sm">
			<img src="<?= get_stylesheet_directory_uri(); ?>/assets/media/scroll-anim.gif" class="h-6 w-auto" alt="">
			<span><?= $scroll_text; ?></span>
		</div>
	</div>
</section>