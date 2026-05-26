<?php
$url           = $args['url'] ?? $args['link']['url'] ?? '';
$title         = $args['label'] ?? $args['link']['title'] ?? '';
$target        = $args['link']['target'] ?? '_self';
$variant       = $args['variant'] ?? 'purple';
$custom_class  = $args['custom-class'] ?? '';
$icon          = $args['icon'] ?? '';
$size          = $args['size'] ?? 'normal';
$icon_only     = $args['icon_only'] ?? false;
$data_attrs    = $args['data'] ?? [];

$variant_classes = [
	'purple' => 'bg-purple text-white',
	'white'  => 'bg-white text-purple',
	'aqua'   => 'bg-aqua text-white',
	'transparent' => 'bg-white/20 text-white',
	'ghost' => 'bg-transparent text-purple border border-purple/20'
];

$hover_bg = ($variant === 'white' || $variant === 'transparent' || $variant === 'ghost') ? 'bg-gray/20' : 'bg-white/20';
$button_class = $variant_classes[$variant] ?? $variant_classes['purple'];
if ($icon_only) {
	$button_class .= ($size === 'small') ? ' p-4' : ' p-5';
} else {
	$button_class .= ($size === 'small') ? ' px-6 py-3' : ' px-8 py-5';
}

$tag = (!empty($url)) ? 'a' : 'button';
$aria_label = $title ?: ($icon ?: 'Button');
$social_icons = ['facebook', 'linkedin'];
$is_social = in_array(strtolower($icon), $social_icons);

if ($title || $icon || $icon_only || !empty($data_attrs)): ?>
	<<?= $tag; ?>
		<?php if ($tag === 'a'): ?>
		href="<?= esc_url($url); ?>"
		target="<?= esc_attr($target); ?>"
		<?php else: ?>
		type="button"
		<?php endif; ?>
		aria-label="<?= esc_attr($aria_label); ?>"
		<?php if (!empty($data_attrs)): ?>
		<?php foreach ($data_attrs as $key => $value): ?>
		data-<?= esc_attr($key); ?>="<?= esc_attr($value); ?>"
		<?php if ($key === 'lightbox'): ?> aria-controls="lightbox-<?= esc_attr($value); ?>" <?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>
		class="relative overflow-hidden no-underline hover:no-underline text-base rounded-full font-medium cursor-pointer inline-flex items-center justify-center gap-2 w-fit group/button transition-all duration-300 <?= $button_class; ?> <?= esc_attr($custom_class); ?>">
		<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3/2 aspect-square rounded-full transition-transform duration-500 ease-out scale-0 group-hover/button:scale-100 pointer-events-none <?= $hover_bg; ?>"></div>
		<?php if ($icon && $icon !== 'none'): ?>
			<span class="flex items-center justify-center <?= $is_social ? 'h-4 w-4' : 'font-icons' ?> <?= $size === 'small' ? 'text-sm' : 'text-2xl' ?> leading-none relative z-10">
				<?php if ($icon === 'facebook'): ?>
					<svg class="w-full h-full" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2.03634 9.35312V16H5.61536V9.35312H8.2842L8.83956 6.29688H5.61536V5.21562C5.61536 3.6 6.24169 2.98125 7.85842 2.98125C8.36133 2.98125 8.76551 2.99375 9 3.01875V0.246875C8.55879 0.125 7.47892 0 6.85567 0C3.55742 0 2.03634 1.57812 2.03634 4.98125V6.29688H0V9.35312H2.03634Z" fill="currentColor" />
					</svg>
				<?php elseif ($icon === 'linkedin'): ?>
					<svg class="w-full h-full" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3.58214 16H0.264286V5.31786H3.58214V16ZM1.92143 3.86071C0.860714 3.86071 0 2.98214 0 1.92143C0 1.41071 0.203572 0.925 0.564286 0.564286C0.925 0.203572 1.41429 0 1.92143 0C2.42857 0 2.91786 0.203572 3.27857 0.564286C3.63929 0.925 3.84286 1.41429 3.84286 1.92143C3.84286 2.98214 2.98214 3.86071 1.92143 3.86071ZM15.9964 16H12.6857V10.8C12.6857 9.56071 12.6607 7.97143 10.9607 7.97143C9.23571 7.97143 8.97143 9.31786 8.97143 10.7107V16H5.65714V5.31786H8.83929V6.775H8.88571C9.32857 5.93571 10.4107 5.05 12.025 5.05C15.3821 5.05 16 7.26072 16 10.1321V16H15.9964Z" fill="currentColor" />
					</svg>
				<?php else: ?>
					<?= esc_html($icon); ?>
				<?php endif; ?>
			</span>
		<?php endif; ?>
		<?php if (!$icon_only && $title): ?>
			<span class="relative z-10"><?= esc_html($title); ?></span>
		<?php endif; ?>
		<?php if (!$icon): ?>
			<span class="font-icons <?= $size === 'small' ? 'text-lg' : 'text-2xl' ?> leading-none relative z-10 <?php echo (!$icon_only) ? 'transition-transform duration-300 group-hover/button:-rotate-45' : ''; ?>">arrow_right_alt</span>
		<?php endif; ?>
	</<?= $tag; ?>>
<?php endif; ?>