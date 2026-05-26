<?php

if (is_archive()) {
	$queried_object = get_queried_object()->name . '_archive';
} else {
	$queried_object = get_queried_object();
}

if (have_rows('flexible_content', $queried_object)) :
	while (have_rows('flexible_content', $queried_object)) : the_row();

		if (get_row_layout() == 'txt_img') :
			get_template_part('templates/txt-img');

		elseif (get_row_layout() == 'img') :
			get_template_part('templates/img');

		elseif (get_row_layout() == 'img_agenda') :
			get_template_part('templates/img-agenda');

		elseif (get_row_layout() == 'agenda') :
			get_template_part('templates/agenda');

		elseif (get_row_layout() == 'general_practitioners') :
			get_template_part('templates/general-practitioners');

		elseif (get_row_layout() == 'cards') :
			get_template_part('templates/cards');

		elseif (get_row_layout() == 'txt_txt') :
			get_template_part('templates/txt-txt');

		elseif (get_row_layout() == 'featured_story') :
			get_template_part('templates/featured-story');

		elseif (get_row_layout() == 'faq') :
			get_template_part('templates/faq');

		elseif (get_row_layout() == 'stories') :
			get_template_part('templates/stories');

		elseif (get_row_layout() == 'txt') :
			get_template_part('templates/txt');

		elseif (get_row_layout() == 'img_form') :
			get_template_part('templates/img-form');
		endif;
	endwhile;
endif;
