<?php get_header(); ?>

<section class="container grid grid-cols-12 gap-6 pb-31">
	<div class="col-span-12 lg:col-span-10 lg:col-start-2 grid grid-cols-10 gap-6">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>

				<div class="col-span-10 lg:col-span-5 flex flex-col shadow-card rounded-4xl">
					<?php
					get_template_part('components/practitioner-card', 'gp', ['post_id' => get_the_ID()]);
					?>
				</div>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>

			<div class="col-span-10">
				<p class="text-purple text-lg font-medium">Er zijn momenteel geen praktijken beschikbaar.</p>
			</div>

		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>