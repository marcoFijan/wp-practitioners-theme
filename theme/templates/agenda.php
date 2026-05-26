<section class="bg-yellow/25 py-20 lg:py-30 overflow-hidden relative">
	<div class="container grid grid-cols-12 gap-6 relative z-10">
		<div class="col-span-12 lg:col-span-10 lg:col-start-2">
			<article class="prose mb-20 text-center">
				<?php if (get_sub_field('txt')) : ?>
					<?= get_sub_field('txt'); ?>
				<?php endif; ?>
			</article>
			<?php
			$show_type = get_sub_field('shown_agenda_items');
			$agenda_items  = [];
			$today        = date('Ymd');
			if ($show_type === 'selected') {
				$selected = get_sub_field('selected_agenda_items');
				$agenda_items = $selected ? (is_array($selected) ? $selected : [$selected]) : [];
			} else {
				$agenda_items = get_posts([
					'post_type'      => 'agenda',
					'posts_per_page' => -1,
					'post_status'    => 'publish'
				]);
			}
			$filtered_agenda = [];
			foreach ($agenda_items as $agenda) {
				$agenda_id  = is_object($agenda) ? $agenda->ID : $agenda;
				$event_date = get_field('date', $agenda_id);
				if ($event_date && $event_date >= $today) {
					$filtered_agenda[] = [
						'id'   => $agenda_id,
						'date' => $event_date
					];
				}
			}
			usort($filtered_agenda, function ($a, $b) {
				return strcmp($a['date'], $b['date']);
			});
			$item_count = count($filtered_agenda);
			if ($item_count > 0) : ?>
				<?php if ($item_count <= 4) : ?>
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
						<?php foreach ($filtered_agenda as $item) : ?>
							<div class="h-auto">
								<?php get_template_part('components/agenda-card', null, ['post_id' => $item['id']]); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="flex items-center justify-center mt-16">
						<?php get_template_part('components/button', null, [
							'url'     => get_post_type_archive_link('agenda'),
							'label'   => 'Bekijk gehele agenda',
							'icon'    => 'apps',
							'variant' => 'white',
						]); ?>
					</div>
				<?php else : ?>
					<div class="relative group">
						<div class="swiper js-agenda-slider overflow-visible">
							<div class="swiper-wrapper">
								<?php foreach ($filtered_agenda as $item) : ?>
									<div class="swiper-slide h-auto">
										<?php get_template_part('components/agenda-card', null, ['post_id' => $item['id']]); ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="flex items-center justify-center gap-6 mt-16">
							<button class="js-agenda-prev cursor-pointer shrink-0 w-12 h-12 rounded-full border border-black/20 flex items-center justify-center text-black hover:bg-black hover:text-white transition-all outline-none">
								<span class="font-icons-outlined text-2xl">arrow_left_alt</span>
							</button>
							<?php get_template_part('components/button', null, [
								'url'     => get_post_type_archive_link('agenda'),
								'label'   => 'Bekijk gehele agenda',
								'icon'    => 'apps',
								'variant' => 'white',
							]); ?>
							<button class="js-agenda-next cursor-pointer shrink-0 w-12 h-12 rounded-full border border-black/20 flex items-center justify-center text-black hover:bg-black hover:text-white transition-all outline-none">
								<span class="font-icons-outlined text-2xl">arrow_right_alt</span>
							</button>
						</div>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<p class="text-center text-purple/50">Er zijn momenteel geen geplande activiteiten.</p>
			<?php endif; ?>
		</div>
	</div>
</section>