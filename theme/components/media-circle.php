<?php
$video_id           = $args['video_id'] ?? null;
$image_id           = $args['image_id'] ?? null;
$bg_color           = $args['bg_color'] ?? null;
$custom_size        = $args['custom_size'] ?? 'max-w-120 max-h-120';
$poster_id          = $args['poster_id'] ?? null;
$image_size         = $args['image_size'] ?? 'full';
$extra_css          = $args['class'] ?? '';
$image_custom_class = $args['image_class'] ?? '';
$shadow_custom_class = $args['shadow_class'] ?? null;

$shadow_class = $shadow_custom_class ?: ((!$video_id && !$image_id) ? 'shadow-color-inset' : 'shadow-image-inset');

if (!$video_id && !$image_id && !$bg_color) return;
$video_url  = $video_id ? wp_get_attachment_url($video_id) : null;
$poster_url = $poster_id ? wp_get_attachment_image_url($poster_id, $image_size) : '';
$media_base_classes = "w-full h-full object-cover block " . esc_attr($image_custom_class);
?>

<div class="relative overflow-hidden shrink-0 aspect-square rounded-full <?= $custom_size ?> <?= $bg_color ? '' : '' ?> <?= esc_attr($extra_css); ?> <?= esc_attr($bg_color) ?>">
	<div class="absolute inset-0 z-20 rounded-full pointer-events-none <?= $shadow_class ?>"></div>
	<?php if ($video_url) : ?>
		<video
			src="<?= esc_url($video_url); ?>"
			poster="<?= esc_url($poster_url); ?>"
			class="<?= $media_base_classes; ?>"
			autoplay
			muted
			loop
			playsinline
			disableremoteplayback>
		</video>

	<?php elseif ($image_id) : ?>
		<?= wp_get_attachment_image($image_id, $image_size, false, [
			'class' => $media_base_classes,
		]); ?>
	<?php endif; ?>
</div>