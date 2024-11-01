<?php
class WPFD_Profile extends ET_Builder_Module {
	public $slug = 'wpfd_profile';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'https://solutions.francoisyerg.net/divi-runway/profile',
		'author' => 'François Yerg',
		'author_uri' => 'https://www.francoisyerg.net'
	);

	public function init() {
		$this->name = esc_html__( 'Profile', 'wprunway-for-divi' );
		$this->plural = esc_html__( 'Profiles', 'wprunway-for-divi' );
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->main_css_element = '%%order_class%%';

		$this->settings_modal_toggles = array(
			'general' => array(
				'toggles' => array(
					'content' => esc_html__( 'Content', 'wprunway-for-divi' )
				)
			)
		);
	}

	public function get_fields() {
		return array(
			'profile' => array(
				'label' => esc_html__( 'Profile', 'wprunway-for-divi' ),
				'type' => 'select',
				'options' => array(
					'author' => esc_html__( 'Current post author', 'wprunway-for-divi' ),
					'current' => esc_html__( 'Current user', 'wprunway-for-divi' ),
					'select_id' => esc_html__( 'Select a user', 'wprunway-for-divi' ),
					'type_id' => esc_html__( 'User ID', 'wprunway-for-divi' ),
					'manual' => esc_html__( 'Manual', 'wprunway-for-divi' )
				),
				'description' => esc_html__( 'Choose what profil you want to show. if current post is selected, nothing will be displayed on archives pages.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'profile_select_user' => array(
				'label' => esc_html__( 'Select a user', 'wprunway-for-divi' ),
				'type' => 'select',
				'options' => $this->get_wp_users(),
				'description' => esc_html__( 'Choose what profil you want to show. if current post is selected, nothing will be displayed on archives pages.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'select_id'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'profile_type_id' => array(
				'label' => esc_html__( 'User ID', 'wprunway-for-divi' ),
				'type' => 'text',
				'description' => esc_html__( 'Enter a valid user ID.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'type_id'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_avatar' => array(
				'label' => esc_html__( 'Avatar', 'wprunway-for-divi' ),
				'type' => 'upload',
				'description' => esc_html__( 'Select the profile avatar.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_name' => array(
				'label' => esc_html__( 'Displayed name', 'wprunway-for-divi' ),
				'type' => 'text',
				'description' => esc_html__( 'Enter the name to display.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_username' => array(
				'label' => esc_html__( 'Displayed username', 'wprunway-for-divi' ),
				'type' => 'text',
				'description' => esc_html__( 'Enter the username to display.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_description' => array(
				'label' => esc_html__( 'Biography', 'wprunway-for-divi' ),
				'type' => 'textarea',
				'description' => esc_html__( 'Enter the biography to display.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_email' => array(
				'label' => esc_html__( 'Email address', 'wprunway-for-divi' ),
				'type' => 'text',
				'description' => esc_html__( 'Enter the email address for the button.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'user_website' => array(
				'label' => esc_html__( 'Website', 'wprunway-for-divi' ),
				'type' => 'text',
				'description' => esc_html__( 'Enter the website URL for the button.', 'wprunway-for-divi' ),
				'show_if' => array(
					'profile' => 'manual'
				),
				'option_category' => 'basic_option',
				'toggle_slug' => 'main_content'
			),
			'demo_avatar' => array(
				'type' => 'hidden',
				'default' => plugin_dir_url( __FILE__ ) . "img/avatar.jpeg"
			),
			'demo_name' => array(
				'type' => 'hidden',
				'default' => esc_html__( 'John Doe', 'wprunway-for-divi' )
			),
			'demo_username' => array(
				'type' => 'hidden',
				'default' => esc_html__( 'johndoe', 'wprunway-for-divi' )
			),
			'demo_description' => array(
				'type' => 'hidden',
				'default' => esc_html__( 'John Nommensen Duchac (born February 25, 1953), known professionally as John Doe, is an American singer, songwriter, actor, poet, guitarist and bass player.', 'wprunway-for-divi' )
			),
			'demo_email' => array(
				'type' => 'hidden',
				'default' => esc_html__( 'exemple@exemple.com', 'wprunway-for-divi' )
			),
			'demo_website' => array(
				'type' => 'hidden',
				'default' => esc_html__( 'www.exemple.com', 'wprunway-for-divi' )
			),
			'show_avatar' => array(
				'label' => esc_html__( 'Show avatar', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'description' => esc_html__( 'Choose if you want to display or not the user avatar.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'show_name' => array(
				'label' => esc_html__( 'Show real name', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'description' => esc_html__( 'Choose if you want to display or not the name and firstname. It needs to be filled in the user profile to appear.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'show_username' => array(
				'label' => esc_html__( 'Show username', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'description' => esc_html__( 'Choose if you want to display or not the user username.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'show_description' => array(
				'label' => esc_html__( 'Show biography', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'tab_slug' => 'general',
				'description' => esc_html__( 'Choose if you want to display or not the user biography.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'show_email' => array(
				'label' => esc_html__( 'Show email button', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'tab_slug' => 'general',
				'description' => esc_html__( 'Choose if you want to display or not the contact button with the email address.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'show_website' => array(
				'label' => esc_html__( 'Show website', 'wprunway-for-divi' ),
				'type' => 'yes_no_button',
				'options' => array(
					'on' => esc_html__( 'Display', 'wprunway-for-divi' ),
					'off' => esc_html__( 'Hide', 'wprunway-for-divi' )
				),
				'default' => 'on',
				'tab_slug' => 'general',
				'description' => esc_html__( 'Choose if you want to display or not the user website link.', 'wprunway-for-divi' ),
				'option_category' => 'basic_option',
				'toggle_slug' => 'content'
			),
			'template' => array(
				'label' => esc_html__( 'Template', 'wprunway-for-divi' ),
				'type' => 'select',
				'options' => array(
					'card' => esc_html__( 'Card', 'wprunway-for-divi' ),
					'fullwidth' => esc_html__( 'Full width', 'wprunway-for-divi' )
				),
				'default' => 'card',
				'option_category' => 'layout',
				'description' => esc_html__( 'Choose a template.', 'wprunway-for-divi' ),
				'tab_slug' => 'advanced',
				'toggle_slug' => 'layout'
			),
			'card_avatar_size' => array(
				'label' => esc_html__( 'Avatar size', 'wprunway-for-divi' ),
				'type' => 'range',
				'default' => '100',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1'
				),
				'description' => esc_html__( 'Use the slider to adjust the avatar size.', 'wprunway-for-divi' ),
				'show_if' => array(
					'template' => 'card'
				),
				'tab_slug' => 'advanced',
				'toggle_slug' => 'layout'
			),
			'fullwidth_avatar_size' => array(
				'label' => esc_html__( 'Avatar size', 'wprunway-for-divi' ),
				'type' => 'range',
				'default' => '40',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1'
				),
				'description' => esc_html__( 'Use the slider to adjust the avatar size.', 'wprunway-for-divi' ),
				'show_if' => array(
					'template' => 'fullwidth'
				),
				'tab_slug' => 'advanced',
				'toggle_slug' => 'layout'
			)
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts' => array(
				'name' => array(
					'label' => esc_html__( 'Name', 'wprunway-for-divi' ),
					'use_all_caps' => true,
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_profile_name"
					),
					'header_level' => array(
						'default' => 'h4'
					)
				),
				'username' => array(
					'label' => esc_html__( 'Username', 'wprunway-for-divi' ),
					'use_all_caps' => true,
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_profile_username"
					),
					'header_level' => array(
						'default' => 'h5'
					)
				),
				'description' => array(
					'label' => esc_html__( 'Biography', 'wprunway-for-divi' ),
					'use_all_caps' => true,
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_profile_description"
					)
				),
				'email' => array(
					'label' => esc_html__( 'Email', 'wprunway-for-divi' ),
					'use_all_caps' => true,
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_profile_email"
					)
				),
				'website' => array(
					'label' => esc_html__( 'website', 'wprunway-for-divi' ),
					'use_all_caps' => true,
					'css' => array(
						'main' => "{$this->main_css_element} .wpfd_profile_website"
					)
				)
			)
		);
	}

	public function render($attrs, $content = null, $render_slug) {
		$display = false; // No return if nothing to display
		$user_id = false;
		$profile = $this->props['profile'];
		$profile_select_user = $this->props['profile_select_user'];
		$profile_type_id = $this->props['profile_type_id'];
		$show_avatar = $this->props['show_avatar'] === 'on' ? true : false;
		$show_name = $this->props['show_name'] === 'on' ? true : false;
		$show_username = $this->props['show_username'] === 'on' ? true : false;
		$show_description = $this->props['show_description'] === 'on' ? true : false;
		$show_email = $this->props['show_email'] === 'on' ? true : false;
		$show_website = $this->props['show_website'] === 'on' ? true : false;
		$template = $this->props['template'];

		if ($profile == "manual") {
			$display = true;
			$user_avatar = $this->props['user_avatar'];
			$user_name = $this->props['user_name'];
			$user_username = $this->props['user_username'];
			$user_description = $this->props['user_description'];
			$user_email = $this->props['user_email'];
			$user_website = $this->props['user_website'];
		}
		else {
			if ($profile == "author") {
				$post_id = get_the_ID();
				if ($post_id) {
					$user_id = get_post_field( 'post_author', $post_id );
				}
			}
			elseif ($profile == "current" && is_user_logged_in()) { // Only if current user is logged in
				$user_id = get_current_user_id();
			}
			elseif ($profile == "select_id") {
				$user = get_user_by( 'login', $profile_select_user );
				if ($user) {
					$user_id = $user->ID;
				}
			}
			elseif ($profile == "type_id") {
				$user_id = $profile_type_id;
			}

			if ($user_id) {
				$user = get_userdata( $user_id );

				if ($user) {
					$display = true;
					$user_avatar = get_avatar_url( $user_id );
					$user_name = $user->first_name . ' ' . $user->last_name;
					$user_username = $user->user_login;
					$user_description = get_the_author_meta( 'description', $user_id );
					$user_email = $user->user_email;
					$user_website = $user->user_website;
				}
			}
		}

		if ($display) {
			$name_level = $this->props['name_level'];
			$username_level = $this->props['username_level'];

			if ($template == 'card') {
				$avatar_size = $this->props['card_avatar_size'];

				$output = sprintf( '<div class="wpfd_profile_content wpfd_profile_content_card">
						%1$s
						%2$s
						%3$s
						%4$s
						%5$s
						%6$s
					</div>',
					($show_avatar && ! empty( $user_avatar ) ? '<img src="' . esc_html( $user_avatar ) . '" alt="' . esc_html__( 'User avatar', 'wpfd-divi-runway' ) . '" style="width:' . esc_html( $avatar_size ) . '%;height:' . esc_html( $avatar_size ) . '%;" />' : ''),
					($show_name && ! empty( $user_name ) ? '<' . esc_attr( $name_level ) . ' class="wpfd_profile_name">' . esc_html( $user_name ) . '</' . '.esc_attr($name_level).' . '>' : ''),
					($show_username && ! empty( $user_username ) ? '<' . esc_attr( $username_level ) . ' class="wpfd_profile_username">' . esc_html( $user_username ) . '</' . esc_attr( $username_level ) . '>' : ''),
					($show_description && ! empty( $user_description ) ? '<p class="wpfd_profile_description">' . esc_html( $user_description ) . '</p>' : ''),
					($show_email && ! empty( $user_email ) ? '<a href="mailto:' . esc_html( $user_email ) . '" class="wpfd_profile_email">' . esc_html( $user_email ) . '</a>' : ''),
					($show_website && ! empty( $user_website ) ? '<a href="' . esc_url( $user_website ) . '" class="wpfd_profile_website">' . esc_html( $user_website ) . '</a>' : '') );
				return $output;
			}
			elseif ($template == 'fullwidth') {
				$avatar_size = $this->props['fullwidth_avatar_size'];

				$output = sprintf( '<div class="wpfd_profile_content wpfd_profile_fullwidth_content">
						<div class="wpfd_profile_fullwidth_left" style="width:%7$s">
							%1$s
						</div>
						<div class="wpfd_profile_fullwidth_right" style="width:%8$s">
							%2$s
							%3$s
							%4$s
							%5$s
							%6$s
                        </div>
					</div>',
					($show_avatar && ! empty( $user_avatar ) ? '<img src="' . esc_html( $user_avatar ) . '" alt="' . esc_html__( 'User avatar', 'wpfd-divi-runway' ) . '" />' : ''),
					($show_name && ! empty( $user_name ) ? '<' . esc_attr( $name_level ) . ' class="wpfd_profile_name">' . esc_html( $user_name ) . '</' . '.esc_attr($name_level).' . '>' : ''),
					($show_username && ! empty( $user_username ) ? '<' . esc_attr( $username_level ) . ' class="wpfd_profile_username">' . esc_html( $user_username ) . '</' . esc_attr( $username_level ) . '>' : ''),
					($show_description && ! empty( $user_description ) ? '<p class="wpfd_profile_description">' . esc_html( $user_description ) . '</p>' : ''),
					($show_email && ! empty( $user_email ) ? '<a href="mailto:' . esc_html( $user_email ) . '" class="wpfd_profile_email">' . esc_html( $user_email ) . '</a>' : ''),
					($show_website && ! empty( $user_website ) ? '<a href="' . esc_url( $user_website ) . '" class="wpfd_profile_website">' . esc_html( $user_website ) . '</a>' : ''),
					esc_html( (int) $avatar_size ) . '%',
					esc_html( 100 - (int) $avatar_size ) . '%' );
				return $output;
			}
		}
	}

	private function get_wp_users() {
		$users_array = array(
			0 => esc_html__( 'Select a user', 'wprunway-for-divi' )
		);

		$users = get_users();

		foreach ( $users as $user ) {
			$first_name = get_user_meta( $user->ID, 'first_name', true );
			$last_name = get_user_meta( $user->ID, 'last_name', true );

			$display_name = '';
			if (! empty( $first_name ) || ! empty( $last_name )) {
				$display_name = trim( $first_name . ' ' . $last_name ) . ' ';
			}

			$users_array[$user->user_login] = $display_name . '(' . $user->user_login . ')';
		}

		return $users_array;
	}
}

new WPFD_Profile();
