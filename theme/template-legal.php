<?php /* Template name: Legal */ get_header(); ?>

<section class="container lg:grid lg:grid-cols-12">
	<article class="lg:col-start-2 lg:col-end-12 prose py-20 lg:py-30">
		<?php the_field('txt'); ?>
	</article>
</section>

<?php get_footer(); ?>