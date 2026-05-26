<section class="bg-purple py-20 lg:pt-30 pb-20 overflow-hidden relative">
	<div class="w-60 lg:w-102 absolute -top-30 -right-30 lg:-top-51 lg:-right-51 z-0">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-red',
		]); ?>
	</div>
	<div class="w-80 lg:w-120 absolute -bottom-40 -left-40 lg:-bottom-60 lg:-left-60">
		<?php get_template_part('components/media-circle', null, [
			'bg_color'   => 'bg-yellow',
			'class'      => 'rotate-180',
		]); ?>
	</div>

	<div class="container grid grid-cols-12 gap-6 relative z-10">
		<div class="col-span-1 relative overflow-visible">
			<img src="<?= get_stylesheet_directory_uri(); ?>/assets/media/stethoscoop.webp" class="absolute hidden sm:block right-12 lg:right-0 rotate-180 -top-10 h-90! object-contain max-w-none" alt="Stethoscope">
		</div>
		<div class="col-span-12 lg:col-span-10 lg:col-start-2">
			<article class="prose prose-white prose-h2:text-blue-lighter2 mb-20 lg:px-12">
				<?php if (get_sub_field('txt_intro')) : ?>
					<?= get_sub_field('txt_intro'); ?>
				<?php endif; ?>
				<div class="flex flex-col lg:flex-row gap-x-20 gap-y-10">
					<?php if (get_sub_field('txt_left')) : ?>
						<div>
							<?= get_sub_field('txt_left'); ?>
						</div>
					<?php endif;
					if (get_sub_field('txt_right')) : ?>
						<div>
							<?= get_sub_field('txt_right'); ?>
						</div>
					<?php endif; ?>
				</div>
			</article>

			<?php
			$show_type = get_sub_field('shown_general_practitioners');
			$gp_items  = [];

			if ($show_type === 'selected') {
				$selected = get_sub_field('selected_general_practitioners');

				if ($selected) {
					$gp_items = is_array($selected) ? $selected : [$selected];
				}
			} else {
				$gp_items = get_posts([
					'post_type'      => 'gp',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC'
				]);
			}

			if ($gp_items) : ?>
				<div class="relative group">
					<div class="swiper js-gp-slider overflow-visible">
						<div class="swiper-wrapper">
							<?php foreach ($gp_items as $gp) :
								$gp_id = is_object($gp) ? $gp->ID : $gp;
							?>
								<div class="swiper-slide h-auto">
									<?php get_template_part('components/practitioner-card', null, ['post_id' => $gp_id]); ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="flex items-center justify-center gap-6 mt-16">
						<?php if (count($gp_items) >= 3) : ?>
							<button class="js-gp-prev cursor-pointer w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-purple transition-all outline-none">
								<span class="font-icons-outlined text-2xl">
									arrow_left_alt
								</span>
							</button>
						<?php endif; ?>

						<?php get_template_part('components/button', null, [
							'url'     => get_post_type_archive_link('gp'),
							'label'   => 'Bekijk alle praktijken',
							'icon'    => 'apps',
							'variant' => 'transparent',
						]); ?>

						<?php if (count($gp_items) >= 3) : ?>
							<button class="js-gp-next cursor-pointer w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-purple transition-all outline-none">
								<span class="font-icons-outlined text-2xl">
									arrow_right_alt
								</span>
							</button>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>