<?php

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}
class WPFD_Tag extends ET_Builder_Module {
	public $slug = 'wpfd_tag';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => WPFD_PLUGIN_WEBSITE . 'module/tag/',
		'author' => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net'
	);

	public function init() {
		$this->name = esc_html__( 'Tag', 'wprunway-for-divi' );
		$this->plural = esc_html__( 'Tags', 'wprunway-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->main_css_element = '%%order_class%%';
	}

	public function get_fields() {
		return array(
			'text_left' => array(
				'label' => esc_html__( 'Left text', 'wprunway-for-divi' ),
				'type' => 'text',
				'default' => '',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text'
			),
			'tag_text' => array(
				'label' => esc_html__( 'Tag text', 'wprunway-for-divi' ),
				'type' => 'text',
				'default_on_front' => 'New',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text'
			),
			'text_right' => array(
				'label' => esc_html__( 'Right text', 'wprunway-for-divi' ),
				'type' => 'text',
				'default' => '',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text'
			),
			'tag_color' => array(
				'label' => esc_html__( 'Tag Color', 'wprunway-for-divi' ),
				'type' => 'color-alpha',
				'custom_color' => true,
				'default' => et_builder_accent_color(),
				'tab_slug' => 'advanced',
				'toggle_slug' => 'tag_text'
			),
			'tag_gap_left' => array(
				'label' => esc_html__( 'Tag left gap', 'wprunway-for-divi' ),
				'type' => 'range',
				'option_category' => 'layout',
				'tab_slug' => 'advanced',
				'toggle_slug' => 'tag_text',
				'mobile_options' => true,
				'validate_unit' => true,
				'default' => '7px',
				'default_unit' => 'px',
				'default_on_front' => '7px',
				'allow_empty' => true,
				'responsive' => true,
				'description' => esc_html__( 'Here you can define a gap between the text and the badge', 'wprunway-for-divi' )
			),
			'tag_gap_right' => array(
				'label' => esc_html__( 'Tag right gap', 'wprunway-for-divi' ),
				'type' => 'range',
				'option_category' => 'layout',
				'tab_slug' => 'advanced',
				'toggle_slug' => 'tag_text',
				'mobile_options' => true,
				'validate_unit' => true,
				'default' => '7px',
				'default_unit' => 'px',
				'default_on_front' => '7px',
				'allow_empty' => true,
				'responsive' => true,
				'description' => esc_html__( 'Here you can define a gap between the text and the badge', 'wprunway-for-divi' )
			)
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'text_left' => array(
					'label' => esc_html__( 'Left text', 'wprunway-for-divi' ),
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_tag_text_left"
					)
				),
				'tag_text' => array(
					'label' => esc_html__( 'Tag text', 'wprunway-for-divi' ),
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_tag_tag"
					),
					'text_color' => array(
						'default' => '#ffffff'
					)
				),
				'text_right' => array(
					'label' => esc_html__( 'Right text', 'wprunway-for-divi' ),
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_tag_text_right"
					)
				)
			),
			'borders' => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_styles' => "{$this->main_css_element} .wpfd_tag_tag"
						)
					)
				)
			)
		);
	}

	public function render($attrs, $content = null, $render_slug) {
		$text_left = $this->props['text_left'];
		$tag_text = $this->props['tag_text'];
		$tag_color = $this->props['tag_color'];
		$tag_gap_left = $this->props['tag_gap_left'];
		$tag_gap_left_tablet = $this->props['tag_gap_left_tablet'];
		$tag_gap_left_phone = $this->props['tag_gap_left_phone'];
		$tag_gap_left_last_edited = $this->props['tag_gap_left_last_edited'];
		$tag_gap_right = $this->props['tag_gap_right'];
		$tag_gap_right_tablet = $this->props['tag_gap_right_tablet'];
		$tag_gap_right_phone = $this->props['tag_gap_right_phone'];
		$tag_gap_right_last_edited = $this->props['tag_gap_right_last_edited'];
		$text_right = $this->props['text_right'];

		if ($tag_gap_left !== '7px' || $tag_gap_left_tablet !== '' || $tag_gap_left_phone !== '') {
			$tag_gap_left_responsive_active = et_pb_get_responsive_status( $tag_gap_left_last_edited );

			$tag_gap_left_values = array(
				'desktop' => $tag_gap_left,
				'tablet' => $tag_gap_left_responsive_active ? $tag_gap_left_tablet : '',
				'phone' => $tag_gap_left_responsive_active ? $tag_gap_left_phone : ''
			);

			et_pb_responsive_options()->generate_responsive_css( $tag_gap_left_values, $this->main_css_element . ' .wpfd_tag_tag', 'margin-left', $render_slug );
		}

		if ($tag_gap_right !== '7px' || $tag_gap_right_tablet !== '' || $tag_gap_right_phone !== '') {
			$tag_gap_right_responsive_active = et_pb_get_responsive_status( $tag_gap_right_last_edited );

			$tag_gap_right_values = array(
				'desktop' => $tag_gap_right,
				'tablet' => $tag_gap_right_responsive_active ? $tag_gap_right_tablet : '',
				'phone' => $tag_gap_right_responsive_active ? $tag_gap_right_phone : ''
			);

			et_pb_responsive_options()->generate_responsive_css( $tag_gap_right_values, $this->main_css_element . ' .wpfd_tag_tag', 'margin-right', $render_slug );
		}

		$output = sprintf( '<div class="wpfd_tag_wrap">
				<span class="wpfd_tag_text_left">%1$s</span>
				<span class="wpfd_tag_tag" style="background-color:%2$s;">%3$s</span>
				<span class="wpfd_tag_text_right">%4$s</span>
			</div>', esc_html( $text_left ), esc_attr( $tag_color ), esc_html( $tag_text ), esc_html( $text_right ) );

		return $output;
	}
}

new WPFD_Tag();