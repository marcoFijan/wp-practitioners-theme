<?php
$txt         = get_sub_field('txt');
$txt_left    = get_sub_field('txt_left');
$link_left   = get_sub_field('link_left');
$txt_center  = get_sub_field('txt_center');
$link_center = get_sub_field('link_center');
$txt_right   = get_sub_field('txt_right');
$link_right  = get_sub_field('link_right');

$cards = [
	[
		'txt'  => $txt_left,
		'link' => $link_left,
		'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>',
	],
	[
		'txt'  => $txt_center,
		'link' => $link_center,
		'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>',
	],
	[
		'txt'  => $txt_right,
		'link' => $link_right,
		'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>',
	],
];
?>

<section class="my-20 lg:my-30 container grid grid-cols-12 gap-6">

	<?php if ($txt) : ?>
		<article class="col-span-12 lg:col-span-10 lg:col-start-2 lg:px-12 prose mb-14">
			<?= $txt ?>
		</article>
	<?php endif; ?>

	<div class="col-span-12 lg:px-12 flex gap-4 flex-col xl:flex-row">
		<?php foreach ($cards as $card) : ?>
			<div class="group flex-1 flex flex-col pt-10 pb-12 px-8 md:px-10 rounded-2xl md:rounded-4xl bg-white shadow-card relative z-20 overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
				<div class="absolute top-0 left-0 right-0 h-1 bg-aqua transition-opacity duration-300 group-hover:opacity-40"></div>
				<div class="mb-6 flex items-center justify-center w-14 h-14 rounded-2xl flex-shrink-0 bg-aqua/10 text-aqua">
					<?= $card['icon'] ?>
				</div>
				<article class="prose flex-1
                    [&_ul]:pl-0 [&_ul]:list-none [&_ul]:space-y-3
                    [&_ul_li]:relative [&_ul_li]:pl-5
                    [&_ul_li]:before:content-[''] [&_ul_li]:before:block
                    [&_ul_li]:before:absolute [&_ul_li]:before:left-0 [&_ul_li]:before:top-[0.6em]
                    [&_ul_li]:before:w-2 [&_ul_li]:before:h-2 [&_ul_li]:before:rounded-full
                    [&_ul_li]:before:bg-aqua">
					<?= $card['txt'] ?>
				</article>
				<?php if ($card['link']) :
					get_template_part('components/button', null, [
						'link'         => $card['link'],
						'size'         => 'small',
						'variant'      => 'aqua',
						'custom-class' => 'mt-8',
					]);
				endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>