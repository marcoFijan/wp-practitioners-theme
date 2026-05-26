<?php
$post_id = $args['post_id'] ?? get_the_ID();
$date_string   = get_field('date', $post_id);
$location      = get_field('location', $post_id);
$text          = get_field('txt', $post_id);
$subscribe_txt = get_field('subscribe_txt', $post_id) ?: 'Hier aanmelden';
$form_obj      = get_field('form', $post_id);
$title         = get_the_title($post_id);
$optional_txt  = get_field('opt_txt', $post_id);
$form_modal_id = 'form-modal-agenda-' . $post_id;

if ($date_string) {
	$date_obj = DateTime::createFromFormat('Ymd', $date_string);

	if ($date_obj) {
		$day   = $date_obj->format('d');
		$month = wp_date('M', $date_obj->getTimestamp());
	}
}
?>

<div class="bg-white rounded-2xl md:rounded-4xl p-6 sm:p-10 flex flex-col gap-6 h-full relative z-10 w-full">
	<div class="flex flex-col md:flex-row md:items-center gap-x-6 gap-y-4">
		<div class="bg-yellow flex flex-col justify-center items-center rounded-full w-24 h-24 text-white font-bold shrink-0">
			<span class="text-2.5xl leading-none font-extrabold"><?php echo esc_html($day); ?></span>
			<span class="leading-none font-normal"><?php echo esc_html($month); ?></span>
		</div>

		<div class="flex flex-col justify-center prose">
			<h3 class="mb-1"><?php echo get_the_title($post_id) ?></h3>
			<?php if ($location) : ?>
				<span class="text-blue-light text-sm">
					<?php echo esc_html($location); ?>
				</span>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($text) : ?>
		<article class="prose prose-p:text-purple/50 prose-p:text-base">
			<p><?php echo wp_kses_post($text); ?></p>
		</article>
	<?php endif; ?>

	<?php if ($optional_txt) : ?>
		<article class="prose prose-p:text-purple/50 prose-p:text-base">
			<hr class="border-0 h-[.05rem] bg-[rgba(216,228,255,0.5)] my-5 mb-5">
			<p><?php echo wp_kses_post($optional_txt); ?></p>
		</article>
	<?php endif; ?>

	<?php if ($subscribe_txt) : ?>
		<div class="mt-auto text-left">
			<button
				data-lightbox="<?php echo esc_attr($form_modal_id); ?>"
				class="text-pink font-medium flex items-center gap-2 group/btn w-max hover:opacity-80 transition-opacity outline-none bg-transparent border-none p-0 cursor-pointer appearance-none">
				<?php echo esc_html($subscribe_txt); ?>
				<span class="font-icons-outlined group-hover/btn:translate-x-1 transition-transform text-2xl">
					arrow_right_alt
				</span>
			</button>
		</div>
	<?php endif; ?>
</div>

<?php

ob_start(); ?>
<div class="prose prose-h3:mb-5 px-4">
	<h3><?php echo esc_html($subscribe_txt); ?></h3>
</div>

<div class="custom-cf7-wrapper">
	<?php
	$cf7_content = do_shortcode('[contact-form-7 id="062821b" title="Agenda"]');
	$cf7_content = preg_replace_callback(
		'/<input[^>]*name="agenda"[^>]*>/i',
		function ($matches) use ($title) {
			return preg_replace('/value="[^"]*"/', 'value="' . esc_attr($title) . '"', $matches[0]);
		},
		$cf7_content
	);

	ob_start();
	?>
	<div class="flex items-center gap-6 my-3">
		<div class="bg-yellow flex flex-col justify-center items-center rounded-full w-24 h-24 text-white font-bold shrink-0">
			<span class="text-2.5xl leading-none font-extrabold"><?php echo esc_html($day); ?></span>
			<span class="leading-none font-normal"><?php echo esc_html($month); ?></span>
		</div>

		<div class="flex flex-col justify-center prose">
			<h3 class="mb-1"><?php the_title(); ?></h3>
			<?php if ($location) : ?>
				<span class="text-blue-light text-sm">
					<?php echo esc_html($location); ?>
				</span>
			<?php endif; ?>
		</div>
	</div>

	<?php
	$info_block = ob_get_clean();
	$cf7_content = str_replace(
		'<div class="agenda-info"></div>',
		'<div class="agenda-info">' . $info_block . '</div>',
		$cf7_content
	);

	echo $cf7_content;
	?>
</div>
<?php
$form_content = ob_get_clean();

get_template_part('components/lightbox', null, [
	'id'         => $form_modal_id,
	'no-padding' => false,
	'content'    => $form_content
]);

?>