<?php
$id         = $args['id'] ?? '';
$content    = $args['content'] ?? '';
$no_padding = $args['no-padding'] ?? false;
if (!$id) return;
$grid_classes = $no_padding ? 'col-span-12 lg:col-span-10 lg:col-start-2 p-0' : 'col-span-12 lg:col-span-6 lg:col-start-4 p-6 lg:p-10';
$line_classes = $no_padding ? 'bg-white group-hover/close:bg-black' : 'bg-red group-hover/close:bg-white';
$close_btn_classes = $no_padding ? 'bg-transparent hover:bg-white top-4 right-4 lg:top-6 lg:right-6' : 'bg-purple hover:bg-red top-4 right-4 lg:top-9 lg:right-9';
?>
<div id="lightbox-<?= esc_attr($id); ?>" data-lightbox-id="<?= esc_attr($id); ?>" aria-hidden="true" class="fixed inset-0 w-screen h-screen z-100 transition-all duration-500 aria-hidden:invisible aria-hidden:opacity-0 aria-hidden:pointer-events-none" role="dialog" aria-modal="true">
	<div data-lightbox-close class="absolute inset-0 bg-purple/30 cursor-pointer"></div>
	<div class="container mx-auto h-full grid grid-cols-12 items-center pointer-events-none">
		<div class="relative z-10 bg-white rounded-2xl lg:rounded-5xl shadow-2xl transition-all duration-500 pointer-events-auto flex flex-col max-h-[90vh] overflow-y-auto <?= $grid_classes; ?>">
			<button type="button" data-lightbox-close title="sluiten" class="absolute z-30 flex items-center justify-center w-7 h-7 rounded-full bg-transparent transition-all duration-300 group/close outline-none cursor-pointer <?= $close_btn_classes; ?>" aria-label="sluiten">
				<span class="relative block w-5 h-5">
					<span class="absolute inset-0 m-auto w-full h-0.5 rotate-45 rounded-full transition-colors duration-300 <?= $line_classes; ?>"></span>
					<span class="absolute inset-0 m-auto w-full h-0.5 -rotate-45 rounded-full transition-colors duration-300 <?= $line_classes; ?>"></span>
				</span>
			</button>
			<div class="lightbox-inner-content w-full flex-1">
				<?= $content; ?>
			</div>
		</div>
	</div>
</div>