<?php
function register_cpt()
{
	// General Practitioners (GP)
	register_post_type('gp', [
		'labels' => [
			'name'          => 'Praktijken',
			'singular_name' => 'Praktijk',
			'add_new'       => 'Nieuwe praktijk toevoegen',
			'add_new_item'  => 'Voeg nieuwe praktijk toe',
			'edit_item'     => 'Bewerk praktijk',
		],
		'public'             => true,
		'has_archive'        => true,
		'acfe_admin_archive' => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-businessman',
		'supports'           => ['title', 'thumbnail', 'revisions'],
		'rewrite'            => ['slug' => 'huisartsen', 'with_front' => false],
		'delete_with_user'   => false,
	]);

	// Agenda
	register_post_type('agenda', [
		'labels' => [
			'name'          => 'Agenda',
			'singular_name' => 'Agendapunt',
			'add_new'       => 'Nieuw agendapunt toevoegen',
			'add_new_item'  => 'Voeg nieuw agendapunt toe',
			'edit_item'     => 'Bewerk agendapunt',
		],
		'public'             => true,
		'has_archive'        => true,
		'acfe_admin_archive' => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-calendar-alt',
		'supports'           => ['title', 'editor', 'revisions'],
		'rewrite'            => ['slug' => 'agenda', 'with_front' => false],
		'delete_with_user'   => false,
	]);

	// Employees
	register_post_type('employees', [
		'labels' => [
			'name'          => 'Medewerkers',
			'singular_name' => 'Medewerker',
			'add_new'       => 'Nieuwe medewerker toevoegen',
			'add_new_item'  => 'Voeg nieuwe medewerker toe',
			'edit_item'     => 'Bewerk medewerker',
		],
		'public'             => false,
		'show_ui'            => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => ['title', 'thumbnail', 'revisions'],
		'rewrite'            => ['with_front' => false],
		'delete_with_user'   => false,
	]);

	// FAQ
	register_post_type('faq', [
		'labels' => [
			'name'          => 'Veelgestelde vragen',
			'singular_name' => 'Vraag',
			'add_new'       => 'Nieuwe vraag toevoegen',
			'add_new_item'  => 'Voeg nieuwe vraag toe',
			'edit_item'     => 'Bewerk vraag',
		],
		'public'             => false,
		'show_ui'            => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-editor-help',
		'supports'           => ['title', 'editor', 'revisions'],
		'rewrite'            => ['with_front' => false],
		'delete_with_user'   => false,
	]);

	// Stories
	register_post_type('stories', [
		'labels' => [
			'name'          => 'Verhalen',
			'singular_name' => 'Verhaal',
			'add_new'       => 'Nieuw verhaal toevoegen',
			'add_new_item'  => 'Nieuw verhaal toevoegen',
			'edit_item'     => 'Bewerk verhaal',
		],
		'public'             => true,
		'has_archive'        => false,
		'acfe_admin_archive' => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'menu_icon'          => 'dashicons-format-aside',
		'supports'           => ['title', 'editor', 'author', 'thumbnail', 'revisions'],
		'rewrite'            => ['slug' => 'verhalen', 'with_front' => false],
		'delete_with_user'   => false,
	]);
}

add_action('init', 'register_cpt');
