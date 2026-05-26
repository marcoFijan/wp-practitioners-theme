<?php
$img            = get_sub_field('img');
$txt            = get_sub_field('txt');
$form_chapeau   = get_sub_field('form_chapeau');
$txt_left       = get_sub_field('txt_left');
$txt_right      = get_sub_field('txt_right');
$show_lightbulp = get_sub_field('show_lightbulp');
$bg_color_key   = get_sub_field('bg_color') ?: 'white';

$bg_opacity_map = [
	'white' => 'bg-white',
	'red'    => 'bg-red/10',
	'yellow' => 'bg-yellow/25',
	'blue'   => 'bg-blue/7'
];

$selected_bg  = $bg_opacity_map[$bg_color_key] ?? $bg_opacity_map['blue'];
$modal_id     = 'contact-modal-' . wp_rand(1000, 9999);
$default_mail = get_field('mail', 'options_contact');
?>

<section class="<?php echo esc_attr($selected_bg); ?> py-20 lg:py-30 overflow-hidden relative">
	<div class="container grid grid-cols-12 gap-6 gap-y-24 items-center relative z-10">
		<div class="col-span-12 lg:col-span-4 lg:col-start-2 relative">
			<?php
			get_template_part('components/media-circle', null, [
				'image_id'     => $img,
				'class'        => 'w-full h-full aspect-square mx-auto',
			]);
			?>
			<?php if ($show_lightbulp) : ?>
				<img src="<?= get_stylesheet_directory_uri(); ?>/assets/media/lightbulp.webp" class="absolute left-1/2 -top-8 -translate-x-1/2 h-5/20 z-20" alt="Lightbulp">
			<?php endif ?>
		</div>
		<section class="col-span-12 lg:col-span-5 lg:col-start-7 ">
			<article class="prose">
				<?= $txt; ?>
			</article>
			<?php if ($form_chapeau): ?>
				<div class="mt-12 mb-6 text-base text-purple font-bold">
					<?= $form_chapeau; ?>
				</div>
			<?php endif; ?>
			<form class="mt-6" onsubmit="event.preventDefault();">
				<div class="relative">
					<div class="form-group form-floating w-full!">
						<input
							type="email"
							id="pre-email-<?php echo esc_attr($modal_id); ?>"
							placeholder="E-mailadres"
							required
							class="rounded-full py-5.5 pl-8 leading-normal" />
						<label class="px-8.5 pt-1" for="pre-email-<?php echo esc_attr($modal_id); ?>">Jouw e-mailadres</label>
					</div>
					<div class="shrink-0 absolute top-0 right-0">
						<?php get_template_part('components/button', null, [
							'icon_only'   => true,
							'data'    => [
								'lightbox'         => $modal_id,
								'flex-form-target' => $modal_id
							]
						]); ?>
					</div>
				</div>
				<div class="form-group mt-4">
					<label>
						<input type="checkbox" name="acceptance" id="pre-acceptance-<?php echo esc_attr($modal_id); ?>">
						<span>Ja, ik ga akkoord met de algemene voorwaarden</span>
					</label>
				</div>
			</form>
		</section>
	</div>
</section>

<?php ob_start(); ?>
<div class="prose prose-h3:mb-5 px-4">
	<h3>Waar kunnen we jou mee helpen?</h3>
</div>
<div class="custom-cf7-wrapper" id="cf7-wrapper-<?php echo esc_attr($modal_id); ?>">
	<?php
	$cf7_content = do_shortcode('[contact-form-7 id="ef0feb6" title="Contactformulier"]');

	if ($default_mail) {
		$cf7_content = preg_replace_callback(
			'/<input[^>]*name="contact-person-email"[^>]*>/i',
			function ($matches) use ($default_mail) {
				return preg_replace('/value="[^"]*"/', 'value="' . esc_attr($default_mail) . '"', $matches[0]);
			},
			$cf7_content
		);
	}

	$cf7_content = str_replace('<div class="contact-info"></div>', '<div class="mt-3"></div>', $cf7_content);

	echo $cf7_content;
	?>
</div>
<?php
$form_content = ob_get_clean();

get_template_part('components/lightbox', null, [
	'id'         => $modal_id,
	'no-padding' => false,
	'content'    => $form_content
]);
?>