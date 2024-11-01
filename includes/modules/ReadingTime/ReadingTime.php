<?php

// Sécurité : empêcher un accès direct
if (! defined( 'ABSPATH' )) {
	exit();
}
class WPFD_ReadingTime extends ET_Builder_Module {
	public $slug = 'wpfd_reading_time';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => WPFD_PLUGIN_WEBSITE . 'module/reading-time/',
		'author' => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net'
	);

	public function init() {
		$this->name = esc_html__( 'Reading time', 'wprunway-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';
	}

	public function get_fields() {
		return array(
			'reading_speed' => array(
				'label' => esc_html__( 'Reading speed', 'wprunway-for-divi' ),
				'type' => 'range',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => false,
				'default' => '200',
				'default_unit' => esc_html__( ' Wpm', 'wprunway-for-divi' ),
				'default_on_front' => '200',
				'range_settings' => array(
					'min' => '100',
					'max' => '300',
					'step' => '10'
				),
				'description' => esc_html__( 'Reading speed in words by minute. The common value is 200 words by minutes but it can be adjusted here to fit your audience.', 'wprunway-for-divi' )
			),
			'time_format' => array(
				'label' => esc_html__( 'Time format', 'wprunway-for-divi' ),
				'type' => 'text',
				'default' => 'm:s',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text',
				'description' => esc_html__( 'Here you can set the time format.', 'wprunway-for-divi' )
			),
			'text_left' => array(
				'label' => esc_html__( 'Left text', 'wprunway-for-divi' ),
				'type' => 'text',
				'default' => esc_html__( 'Reading time: ', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text',
				'description' => esc_html__( 'This text will be displayed on the left of the time.', 'wprunway-for-divi' )
			),
			'text_right' => array(
				'label' => esc_html__( 'Right text', 'wprunway-for-divi' ),
				'type' => 'text',
				'default' => '',
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content',
				'mobile_options' => true,
				'dynamic_content' => 'text',
				'description' => esc_html__( 'This text will be displayed on the right of the time.', 'wprunway-for-divi' )
			)
		);
	}

	public function get_advanced_fields_config() {
		return array();
	}

	public function render($attrs, $content = null, $render_slug) {
		$time_format = $this->props['time_format'];
		$text_left = $this->props['text_left'];
		$text_right = $this->props['text_right'];

		$output = sprintf( '<div class="wpfd_tag_wrap">
				<span class="wpfd_readingtime_text_left">%1$s</span>
				<span class="wpfd_readingtime_time">%2$s</span>
				<span class="wpfd_readingtime_text_right">%3$s</span>
			</div>', esc_html( $text_left ), gmdate( $time_format, $this->get_reading_time() ), esc_html( $text_right ) );

		return $output;
	}

	public function get_reading_time() {
		$reading_speed = trim( $this->props['reading_speed'], esc_html__( ' Wpm', 'wprunway-for-divi' ) );

		global $post;
		$time = "";
		$content = get_post_field( 'post_content', $post->ID );
		$word_count = str_word_count( wp_strip_all_tags( $content ) );
		$readingtime = ceil( $word_count / ($reading_speed / 60) );
		$readingminutes = floor( $readingtime / 60 );
		$readingseconds = $readingtime % 60;

		if ($readingminutes <= 1) {
			$time = ' ' . $readingminutes . ' ' . __( ' minute', 'wprunway-for-divi' );
		}
		else {
			$time = ' ' . $readingminutes . ' ' . __( ' minutes', 'wprunway-for-divi' );
		}

		if ($readingseconds <= 1) {
			$time .= ' ' . $readingseconds . ' ' . __( ' second', 'wprunway-for-divi' );
		}
		else {
			$time .= ' ' . $readingseconds . ' ' . __( ' seconds', 'wprunway-for-divi' );
		}

		return $readingtime;
	}
}

new WPFD_Readingtime();