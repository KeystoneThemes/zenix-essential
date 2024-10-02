<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$thumbnails_uri = fw_get_framework_directory_uri( '/core/components/extensions/manager/static/img/thumbnails' );
$github_account = 'ThemeFuse';

$extensions = array(
	'page-builder' => array(
		'display'     => true,
		'parent'      => 'shortcodes',
		'name'        => __( 'Page Builder', 'fw' ),
		'description' => __( "Let's you easily build countless pages with the help of the drag and drop visual page builder that comes with a lot of already created shortcodes.", 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/page-builder.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-PageBuilder-Extension'
			)
		),
	),


	'backups' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Backup & Demo Content', 'fw' ),
		'description' => __( 'This extension lets you create an automated backup schedule, import demo content or even create a demo content archive for migration purposes.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/backups.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Backups-Extension',
			),
		),
	),	
			

	'shortcodes' => array(
		'display'     => false,
		'parent'      => null,
		'name'        => __( 'Shortcodes', 'fw' ),
		'description' => '',
		'thumbnail'   => 'about:blank',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Shortcodes-Extension',
			),
		),
	),

	'builder' => array(
		'display'     => false,
		'parent'      => null,
		'name'        => __( 'Builder', 'fw' ),
		'description' => '',
		'thumbnail'   => 'about:blank',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Builder-Extension',
			),
		),
	),

	'forms' => array(
		'display'     => false,
		'parent'      => null,
		'name'        => __( 'Forms', 'fw' ),
		'description' => __( 'This extension adds the possibility to create a contact form. Use the drag & drop form builder to create any contact form you\'ll ever want or need.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/forms.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Forms-Extension',
			),
		),
	),

	'mailer' => array(
		'display'     => false,
		'parent'      => null,
		'name'        => __( 'Mailer', 'fw' ),
		'description' => __( 'This extension will let you set some global email options and it is used by other extensions (like Forms) to send emails.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/mailer.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Mailer-Extension',
			),
		),
	),

	'social' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Social', 'fw' ),
		'description' => __( 'Use this extension to configure all your social related APIs. Other extensions will use the Social extension to connect to your social accounts.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/social.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Social-Extension',
			),
		),
	),

	'backup' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Backup', 'fw' ),
		'description' => __( 'This extension lets you set up daily, weekly or monthly backup schedule. You can choose between a full backup or a data base only backup.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/backup.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Backup-Extension',
			),
		),
	),

	'media' => array(
		'display'     => false,
		'parent'      => null,
		'name'        => __( 'Media', 'fw' ),
		'description' => '',
		'thumbnail'   => 'about:blank',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Empty-Extension',
			),
		),
	),

	'population-method' => array(
		'display'     => false,
		'parent'      => 'media',
		'name'        => __( 'Population method', 'fw' ),
		'description' => '',
		'thumbnail'   => 'about:blank',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-PopulationMethods-Extension',
			),
		),
	),

	'translatepress-multilingual' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Translate Press', 'fw' ),
		'description' => __( 'This extension lets you translate your website in any language or even add multiple languages for your users to change at their will from the front-end.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/translation.jpg',
		'download'    => array(
			'source'  => 'custom',
			'url_set' => 'options-general.php?page=translate-press',
			'opts'    => array(
				'plugin' => 'translatepress-multilingual/index.php',
				'remote' => 'https://downloads.wordpress.org/plugin/translatepress-multilingual'
			)
		)
	),

	'styling' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Styling', 'fw' ),
		'description' => __( 'This extension lets you control the website visual style. Starting from predefined styles to changing specific fonts and colors across the website.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/styling.jpg',
		'download'    => array(
			'source' => 'github',
			'opts' => array(
				'user_repo' => $github_account . '/Unyson-Styling-Extension',
			),
		),
	)
);

