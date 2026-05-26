<?php
$post_id = $args['post_id'] ?? get_the_ID();

$main_img        = get_field('img', $post_id);
$has_info_btn    = get_field('has_info_button', $post_id);
$info_group      = get_field('more_info_content', $post_id);
$amount_patients = get_field('amount_patients', $post_id);
$location        = get_field('location', $post_id);
$acquisition     = get_field('acquisition', $post_id);
$team            = get_field('team', $post_id);
$offer           = get_field('offer', $post_id);
$type_praktijk   = get_field('type', $post_id);
$end_txt         = get_field('end-txt', $post_id) ?: 'Heb jij interesse in deze praktijk?';
$title           = get_the_title($post_id);

$form_modal_id = 'form-modal-' . $post_id;
$info_modal_id = 'info-modal-' . $post_id;
?>

<div class="bg-white rounded-2xl md:rounded-4xl overflow-hidden flex flex-col h-full">
	<div class="relative w-full bg-purple/40">
		<?php if ($main_img): ?>
			<?= wp_get_attachment_image($main_img, 'landscape-xs', false, ['class' => 'w-full h-auto']); ?>
		<?php endif; ?>
	</div>

	<div class="py-8 px-6 md:px-10 relative grow flex flex-col">
		<div class="flex flex-col md:items-center md:flex-row justify-between gap-4 mb-6">
			<article class="prose">
				<h3 class="mb-0">
					<?= esc_html($title); ?>
				</h3>
			</article>

			<?php if ($has_info_btn && $info_group): ?>
				<button
					data-lightbox="<?= $info_modal_id ?>"
					class="bg-yellow hover:bg-yellow-light cursor-pointer text-white px-4 py-3 h-min rounded-full self-start flex items-center gap-1 font-semibold transition-all outline-none">
					<span class="leading-none text-sm">
						<?= esc_html($info_group['button_txt'] ?: 'Informatie'); ?>
					</span>
					<span class="leading-none font-icons-outlined text-md">
						arrows_output
					</span>
				</button>
			<?php endif; ?>
		</div>

		<div class="grid grid-cols-[auto_1fr] gap-x-2 gap-y-1 mb-10 items-center text-lg">
			<?php
			$details = [
				['label' => 'Patiënten:', 'val' => $amount_patients, 'bg' => 'bg-pink/10', 'color' => 'text-purple'],
				['label' => 'Locatie:', 'val' => $location, 'bg' => 'bg-yellow/25', 'color' => 'text-purple'],
				['label' => 'Aanbod:', 'val' => $offer, 'bg' => 'bg-red/10', 'color' => 'text-purple'],
				['label' => 'Termijn:', 'val' => $acquisition, 'bg' => 'bg-aqua/10', 'color' => 'text-purple'],
				['label' => 'Team:', 'val' => $team, 'bg' => 'bg-blue/10', 'color' => 'text-purple'],
				['label' => 'Type praktijk:', 'val' => $type_praktijk, 'bg' => 'bg-gray/20', 'color' => 'text-purple'],
			];

			foreach ($details as $detail):
				if (!$detail['val']) continue;
			?>
				<span class="max-w-48 wrap-break-words text-purple text-1.5xs">
					<?= $detail['label'] ?>
				</span>
				<div class="justify-self-start">
					<span class="<?= $detail['bg'] ?> <?= $detail['color'] ?> px-2 py-1 text-1.5xs rounded-md font-bold">
						<?= esc_html($detail['val']) ?>
					</span>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="flex justify-between items-center mt-auto">
			<p class="text-purple text-base font-semibold leading-snug">
				<?= esc_html($end_txt); ?>
			</p>

			<?php get_template_part('components/button', null, [
				'variant' => 'aqua',
				'icon_only' => true,
				'icon'    => 'cardiology',
				'custom-class' => 'shrink-0',
				'data'    => [
					'lightbox' => $form_modal_id
				]
			]); ?>
		</div>
	</div>
</div>

<?php
/* =========================
   INFO MODAL
========================= */
if ($has_info_btn && $info_group):
	ob_start(); ?>
	<article class="flex flex-col prose prose-img:m-0">
		<h3 class="mb-8">
			<?= esc_html($title); ?>
		</h3>

		<?php if ($info_group['img']): ?>
			<div class="w-full overflow-hidden rounded-2xl mb-4">
				<?= wp_get_attachment_image($info_group['img'], 'landscape-sm', false, ['class' => 'w-full h-auto']); ?>
			</div>
		<?php endif; ?>

		<div class="p-6 prose prose-p:text-base">
			<?= $info_group['txt']; ?>
		</div>
	</article>
<?php
	$info_content = ob_get_clean();

	get_template_part('components/lightbox', null, [
		'id'      => $info_modal_id,
		'content' => $info_content
	]);
endif;


/* =========================
   FORM MODAL (VASTE FORM)
========================= */
ob_start(); ?>
<div class="prose prose-h3:mb-5 px-4">
	<h3>Heb jij interesse in deze praktijk?</h3>
</div>

<div class="custom-cf7-wrapper">
	<?php $cf7_content = do_shortcode('[contact-form-7 id="0e42728" title="Interesse in praktijk"]');

	$cf7_content = preg_replace_callback(
		'/<input[^>]*name="clientele"[^>]*>/i',
		function ($matches) use ($title) {
			return preg_replace('/value="[^"]*"/', 'value="' . esc_attr($title) . '"', $matches[0]);
		},
		$cf7_content
	);

	ob_start(); ?>
	<div class="flex px-6 py-3 items-center gap-6">
		<div class="rounded-full w-24 h-24 overflow-hidden bg-gray-100 shrink-0">
			<?php if ($main_img): ?>
				<?= wp_get_attachment_image($main_img, 'thumbnail', false, ['class' => 'w-full h-full object-cover object-center']); ?>
			<?php endif; ?>
		</div>
		<div>
			<p class="text-purple font-medium text-xl"><?= esc_html($title); ?></p>
			<p class="text-purple text-base"><?= esc_html($location); ?></p>
		</div>
	</div>
	<?php
	$info_block = ob_get_clean();

	$cf7_content = str_replace(
		'<div class="clientele-info"></div>',
		'<div class="clientele-info">' . $info_block . '</div>',
		$cf7_content
	);

	echo $cf7_content;
	?>
</div>
<?php $form_content = ob_get_clean();

get_template_part('components/lightbox', null, [
	'id'         => $form_modal_id,
	'no-padding' => false,
	'content'    => $form_content
]);
?>