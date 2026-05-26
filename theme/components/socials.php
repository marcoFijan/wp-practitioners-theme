<?php
$linkedin = get_field('linkedin', 'options_socials');
$facebook = get_field('facebook', 'options_socials');
?>

<div class="flex gap-2 justify-center md:justify-start">
	<?php if ($linkedin) :
		get_template_part('components/button', null, [
			'url'     => $linkedin,
			'variant' => 'ghost',
			'icon_only' => true,
			'icon'      => 'linkedin'
		]);
	endif; ?>

	<?php if ($facebook) :
		get_template_part('components/button', null, [
			'url'     => $facebook,
			'variant' => 'ghost',
			'icon_only' => true,
			'icon'      => 'facebook'
		]);
	endif; ?>
</div>