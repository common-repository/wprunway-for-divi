<?php
class WPFD_Flipbox extends ET_Builder_Module {
	public $slug = 'wpfd_flipbox';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'https://www.wprunway.com/module/flipbox',
		'author' => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net'
	);

	public function init() {
		$this->name = esc_html__( 'Flipbox', 'wprunway-for-divi' );

		$this->settings_modal_toggles = array(
			'general' => array(
				'toggles' => array(
					'front_content' => esc_html__( 'Front Content', 'wprunway-for-divi' ),
					'back_content' => esc_html__( 'Back Content', 'wprunway-for-divi' )
				)
			),
			'design' => array(
				'toggles' => array(
					'flipbox_design' => esc_html__( 'Flipbox Design', 'wprunway-for-divi' )
				)
			)
		);

		$this->advanced_fields = array(
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'wprunway-for-divi' ),
					'toggle_slug' => 'front_content'
				)
			)
		);
	}

	public function get_fields() {
		return array(
			// Front face fields
			'front_title' => array(
				'label' => esc_html__( 'Front Title', 'wprunway-for-divi' ),
				'type' => 'text',
				'toggle_slug' => 'front_content'
			),
			'front_content' => array(
				'label' => esc_html__( 'Front Content', 'wprunway-for-divi' ),
				'type' => 'textarea',
				'toggle_slug' => 'front_content'
			),
			'front_image' => array(
				'label' => esc_html__( 'Front Image', 'wprunway-for-divi' ),
				'type' => 'upload',
				'toggle_slug' => 'front_content'
			),

			// Back face fields
			'back_title' => array(
				'label' => esc_html__( 'Back Title', 'wprunway-for-divi' ),
				'type' => 'text',
				'toggle_slug' => 'back_content'
			),
			'back_content' => array(
				'label' => esc_html__( 'Back Content', 'wprunway-for-divi' ),
				'type' => 'textarea',
				'toggle_slug' => 'back_content'
			),
			'back_image' => array(
				'label' => esc_html__( 'Back Image', 'wprunway-for-divi' ),
				'type' => 'upload',
				'toggle_slug' => 'back_content'
			)
		);
	}

	public function render($attrs, $content = null, $render_slug) {
		// Front face content
		$front_title = $this->props['front_title'];
		$front_content = $this->props['front_content'];
		$front_image = $this->props['front_image'];
		$front_button = $this->render_button( 'button', array(
			'button' => 'front_button_text'
		) );

		// Back face content
		$back_title = $this->props['back_title'];
		$back_content = $this->props['back_content'];
		$back_image = $this->props['back_image'];
		$back_button = $this->render_button( 'button', array(
			'button' => 'back_button_text'
		) );

		// HTML structure with images as backgrounds
		$output = sprintf( '<div class="wpfd-flipbox">
                <div class="wpfd-flipbox-inner">
                    <div class="wpfd-flipbox-front" style="background-image: url(%1$s);">
                        %2$s %3$s %4$s
                    </div>
                    <div class="wpfd-flipbox-back" style="background-image: url(%5$s);">
                        %6$s %7$s %8$s
                    </div>
                </div>
            </div>',
			esc_url( $front_image ),
			$front_title ? '<h3>' . esc_html( $front_title ) . '</h3>' : '',
			$front_content ? '<p>' . esc_html( $front_content ) . '</p>' : '',
			$front_button,
			esc_url( $back_image ),
			$back_title ? '<h3>' . esc_html( $back_title ) . '</h3>' : '',
			$back_content ? '<p>' . esc_html( $back_content ) . '</p>' : '',
			$back_button );

		return $output;
	}
}

new WPFD_Flipbox();
