<?php

/**
 * Video Controller Component
 *
 * Usage:
 *   get_template_part('components/video-controller', null, [
 *       'type'     => 'youtube',       // 'youtube' | 'video'
 *       'src'      => 'dQw4w9WgXcQ',  // YouTube ID / URL, or local video attachment ID / URL
 *       'poster'   => 123,             // (optional) Attachment ID
 *       'autoplay' => false,           // (optional) Autoplay local video (not in lightbox), default false
 *   ]);
 */

if (! function_exists('vc_extract_youtube_id')) {
	function vc_extract_youtube_id(string $url): string
	{
		preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $url, $m);
		return $m[1] ?? sanitize_text_field($url);
	}
}
$args         = $args ?? [];
$type         = $args['type']     ?? 'video';
$src          = $args['src']      ?? '';
$poster_id    = $args['poster']   ?? null;
$has_autoplay = (bool) ($args['autoplay'] ?? false);

$video_url = '';
$yt_id     = '';

if ($type === 'youtube') {
	$yt_id = filter_var($src, FILTER_VALIDATE_URL) ? vc_extract_youtube_id($src) : sanitize_text_field($src);
} elseif ($type === 'video') {
	$video_url = is_numeric($src) ? wp_get_attachment_url((int) $src) : esc_url_raw($src);
}
$poster_url = $poster_id ? wp_get_attachment_image_url((int) $poster_id, 'full') : '';
$config = wp_json_encode([
	'type'     => $type,
	'src'      => $type === 'video' ? $video_url : $yt_id,
	'autoplay' => $has_autoplay,
]);
?>

<div data-media-player='<?php echo $config; ?>'>
	<div data-video-target>
		<?php if ($type === 'video' && $has_autoplay) : ?>
			<video muted loop playsinline data-autoplay-video
				<?php if ($poster_url) : ?>poster="<?php echo esc_url($poster_url); ?>" <?php endif; ?>>
				<source data-src="<?php echo esc_url($video_url); ?>" type="video/mp4">
			</video>
		<?php else : ?>
			<div data-overlay class="relative">
				<?php if ($poster_id) : ?>
					<?php echo wp_get_attachment_image((int) $poster_id, 'full'); ?>
				<?php endif; ?>
				<?php if ($type === 'youtube') : ?>
					<div data-consent-warning hidden class="absolute group cursor-pointer w-full h-full left-0 top-0 flex flex-col justify-center items-center prose prose-white bg-black/50 text-center p-4">
						<h3>Marketing cookies nodig</h3>
						<p>Marketing cookies nodig voor het laden van deze video.</p>
						<p><span class="group-hover:font-bold group-hover:text-shadow-2xs transition-all">Klik in de video om de cookies te accepteren</span>.</p>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
