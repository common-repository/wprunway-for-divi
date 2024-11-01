<?php

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}
class WPFD_Alert extends ET_Builder_Module {
	public $slug = 'wpfd_alert';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => WPFD_PLUGIN_WEBSITE . 'module/alert/',
		'author' => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net'
	);

	public function init() {
		$this->name = esc_html__( 'Alert', 'wprunway-for-divi' );
		$this->plural = esc_html__( 'Alerts', 'wprunway-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->main_css_element = '%%order_class%%';
	}

	public function get_fields() {
		return array(
			'message' => array(
				'type' => 'text',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'label' => esc_html__( 'Alert message', 'wprunway-for-divi' ),
				'description' => esc_html__( 'Your alert box message.', 'wprunway-for-divi' ),
				'default' => esc_html__( 'Type your message here.', 'wprunway-for-divi' )
			)
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'background' => array(
				'options' => array(
					'background_color' => array(
						'default' => '#f44336'
					)
				)
			),
			'text' => false,
			'fonts' => array(
				'module' => array(
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_alert_content"
					),
					'text_color' => array(
						'default' => '#ffffff'
					)
				)
			),
			'margin_padding' => array(
				'css' => array(
					'main' => "{$this->main_css_element} .wpfd_alert_box"
				),
				'custom_padding' => array(
					'parameter_1' => '20px',
					'parameter_2' => '20px'
				)
			)
		);
	}

	public function render($attrs, $content = null, $render_slug) {
		$message = $this->props['message'];

		return sprintf( '<div class="wpfd_alert_box">
				<div class="wpfd_alert_content">%1$s</div>
				<span class="wpfd_alert_closebtn" onclick="this.parentElement.parentElement.parentElement.style.display=\'none\';">&times;</span>
			</div>', esc_html( $message ) );
	}
}

new WPFD_Alert();