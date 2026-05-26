<?php
$intro_text      = get_sub_field('txt');
$chapeau         = get_sub_field('employee_chapeau') ?: 'We denken graag met je mee';
$employee_data   = get_sub_field('employee');
$employees = is_array($employee_data) ? $employee_data : ($employee_data ? [$employee_data] : []);
$faq_mode = get_sub_field('shown_faq');
$faqs     = [];

if ($faq_mode === 'selected') {
	$faqs = get_sub_field('selected_faq');
} else {
	$faqs = get_posts([
		'post_type'      => 'faq',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	]);
}
?>

<section class="overflow-hidden w-full">
	<div class="container mx-auto my-20 lg:my-30">
		<div class="grid grid-cols-12 gap-6 gap-y-16 items-start">
			<div class="col-span-12 lg:col-span-4 lg:col-start-2 lg:mt-12">
				<?php if ($intro_text) : ?>
					<article class="prose max-w-none lg:mb-14 prose-h3:mb-8">
						<?php echo $intro_text; ?>
					</article>
				<?php endif; ?>

				<?php if (!empty($employees)) : ?>
					<div class="relative group/swiper">
						<div class="swiper employee-swiper overflow-hidden">
							<div class="flex items-center justify-between mb-6">
								<p class="text-black text-lg tracking-tighter font-bold"><?php echo esc_html($chapeau); ?></p>
								<?php if (count($employees) > 1) : ?>
									<div class="flex gap-1">
										<button class="swiper-prev cursor-pointer w-10 h-10 rounded-full border border-purple/20 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-all">
											<span class="font-icons text-lg">
												arrow_left_alt
											</span>
										</button>
										<button class="swiper-next cursor-pointer w-10 h-10 rounded-full border border-purple/20 flex items-center justify-center text-purple hover:bg-purple hover:text-white transition-all">
											<span class="font-icons text-lg">
												arrow_right_alt
											</span>
										</button>
									</div>
								<?php endif; ?>
							</div>
							<div class="swiper-wrapper">
								<?php foreach ($employees as $emp) :
									$e_id = $emp->ID;
									$img_id = get_field('img', $e_id);
									$name = get_field('name', $e_id) ?: $emp->post_title;
									$pract = get_field('practice', $e_id);
									$intro = get_field('intro', $e_id);
									$emp_mail = get_field('mail', $e_id);
									$btn_txt = get_field('button_txt', $e_id) ?: 'Kan ik jou helpen?';
									$form_modal_id = 'form-modal-emp-' . $e_id;
									if (empty($emp_mail)) {
										$emp_mail = get_field('mail', 'options_contact');
									}
								?>
									<div class="swiper-slide h-auto">
										<div class="p-6 md:p-8 bg-white rounded-3xl shadow-card h-full flex flex-col">
											<div class="flex lg:flex-col xl:flex-row items-start gap-6 mb-7">
												<div class="w-24 h-24 shrink-0">
													<?php echo wp_get_attachment_image($img_id, 'thumbnail', false, ['class' => 'rounded-full object-cover w-full h-full']); ?>
												</div>
												<div>
													<h3 class="text-black font-extrabold text-xl leading-tight mb-4">
														<?php echo esc_html($name); ?>-<?php echo nl2br(esc_html($pract)); ?>
													</h3>
													<p class="text-base text-purple leading-snug"><?php echo nl2br(esc_html($intro)); ?></p>
												</div>
											</div>

											<div class="mt-auto">
												<?php get_template_part('components/button', null, [
													'label'   => esc_html($btn_txt),
													'variant' => 'aqua',
													'size'    => 'small',
													'data'    => [
														'lightbox' => $form_modal_id
													]
												]); ?>
											</div>
										</div>
									</div>

									<?php
									ob_start(); ?>
									<div class="prose prose-h3:mb-5 px-4">
										<h3>Waar kunnen we jou mee helpen?</h3>
									</div>
									<div class="custom-cf7-wrapper">
										<?php $cf7_content = do_shortcode('[contact-form-7 id="ef0feb6" title="Contactformulier"]');
										$cf7_content = preg_replace_callback(
											'/<input[^>]*name="contact-person-email"[^>]*>/i',
											function ($matches) use ($emp_mail) {
												return preg_replace('/value="[^"]*"/', 'value="' . esc_attr($emp_mail) . '"', $matches[0]);
											},
											$cf7_content
										);
										ob_start(); ?>
										<div class="flex items-center gap-6 my-3 px-6">
											<div class="w-24 h-24 shrink-0">
												<?php echo wp_get_attachment_image($img_id, 'thumbnail', false, ['class' => 'rounded-full object-cover w-full h-full']); ?>
											</div>
											<div>
												<p class="font-bold text-xl text-black"><?php echo esc_html($name); ?>-<?php echo esc_html($pract); ?></p>
												<p class="text-base text-purple m-0"><?php echo esc_html($intro); ?></p>
											</div>
										</div>
										<?php
										$info_block = ob_get_clean();
										$cf7_content = str_replace(
											'<div class="contact-info"></div>',
											'<div class="contact-info">' . $info_block . '</div>',
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
								<?php endforeach; ?>
							</div>
							<?php if (count($employees) > 1) : ?>
								<div class="swiper-pagination relative bottom-0 mt-8 flex justify-center"></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-span-12 lg:col-span-5 lg:col-start-7 space-y-4 relative z-10">
				<?php if ($faqs) : foreach ($faqs as $faq) : ?>
						<div data-toggle-container class="group bg-blue/7 rounded-2xl overflow-hidden transition-all duration-300" aria-expanded="false">
							<button
								type="button"
								data-toggle-trigger
								class="w-full flex items-center justify-between p-8 text-left focus:outline-none cursor-pointer">
								<span class="text-lg font-extrabold text-black pr-4 leading-tight">
									<?php echo get_the_title($faq->ID); ?>
								</span>

								<div class="relative shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 bg-white">
									<span class="absolute w-3.5 h-0.5 bg-aqua group-aria-expanded:bg-red"></span>
									<span class="absolute h-3.5 w-0.5 bg-aqua transition-all duration-300 group-aria-expanded:rotate-90 group-aria-expanded:opacity-0"></span>
								</div>
							</button>
							<div class="max-h-0 opacity-0 transition-all duration-500 ease-in-out group-aria-expanded:max-h-250 group-aria-expanded:opacity-100">
								<div class="p-8 pt-0">
									<div class="prose prose-slate max-w-none text-slate-600">
										<?php echo apply_filters('the_content', $faq->post_content); ?>
									</div>
								</div>
							</div>
						</div>
				<?php endforeach;
				endif; ?>
			</div>
		</div>
	</div>
</section>