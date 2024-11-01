<?php

// Sécurité : empêcher un accès direct
if (!defined('ABSPATH')) {
    exit;
}

class WPFD_Note extends ET_Builder_Module {
	public $slug       = 'wpfd_note';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => WPFD_PLUGIN_WEBSITE.'module/note/',
		'author'     => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net',
	);

	public function init() {
		$this->name = esc_html__('Note', 'wprunway-for-divi');
		$this->plural = esc_html__('Notes', 'wprunway-for-divi');
		$this->icon_path = plugin_dir_path(__FILE__).'icon.svg';
		$this->main_css_element = '%%order_class%%';
	}

	public function get_fields() {
		return array(
			'message' => array(
				'label'           => esc_html__('Content', 'wprunway-for-divi'),
				'description'     => esc_html__('The content of your note.', 'wprunway-for-divi'),
				'default'		=> esc_html__('The content of your note goes here.', 'wprunway-for-divi'),
				'type'            => 'text',
			),
			'border_color' => array(
				'label'			=> esc_html__('Left border color', 'wprunway-for-divi'),
				'type'			=> 'color-alpha',
				'custom_color'	=> true,
				'default'		=> '#0000ff',
			),
			'border_gap' => array(
				'label'				=> esc_html__('Left border gap', 'wprunway-for-divi'),
				'type'				=> 'range',
				'option_category'	=> 'layout',
				'mobile_options'	=> true,
				'validate_unit'		=> true,
				'default'			=> '4px',
				'default_unit'		=> 'px',
				'default_on_front'	=> '4px',
				'allow_empty'		=> true,
				'responsive'		=> true,
				'description'		=> esc_html__( 'Here you can define a gap between the text and the badge', 'wpfd-divi-runway' ),
			),
		);
	}
	
	public function get_advanced_fields_config() {
		return array(
			'background' => array(
				'options' => array(
					'background_color' => array(
						'default' => "#8ad0d8",
					),
				),
			),
			'text' => false,
			'fonts' => array(
				'module' => array(
					'text_color' => array(
						'default' => '#0000ff',
					),
					'css' => array(
						'main'	=> "{$this->main_css_element} .wpfd_note_content",
					),
				),
			),
			'margin_padding' => array(
				'use_padding' => false,
			),
		);
	}
	
	public function render($attrs, $content = null, $render_slug) {
		$message = $this->props['message'];
		$border_color = $this->props['border_color'];
		$border_gap = $this->props['border_gap'];
		
		return sprintf(
			'<div class="wpfd_note_content" style="border-left:%1$s solid %2$s;">
				%3$s
			</div>',
			esc_attr($border_gap),
			esc_attr($border_color),
			esc_html($message)
		);
	}
}
new WPFD_Note;