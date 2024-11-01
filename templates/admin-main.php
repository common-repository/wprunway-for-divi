<div class="wrap">
	<h1><?php
	esc_html_e( 'WPRunway for Divi', 'wprunway-for-divi' );
	?></h1>
	<?php

	settings_errors();
	?>
	<form method="post" action="options.php">
		<div class="wpfd_admin_row">
			<div class="wpfd_admin_column_left">
				<!-- Tab links -->
					<div class="wpfd_admin_tab">
						<button class="wpfd_admin_tablinks wpfd_admin_defaulttablink" type="button" data-target="#wpfd_admin_tab_welcome">
							<?php

							esc_html_e( 'Welcome', 'wprunway-for-divi' );
							?>
						</button>
						<button class="wpfd_admin_tablinks" type="button" data-target="#wpfd_admin_tab_modules">
							<?php

							esc_html_e( 'Modules', 'wprunway-for-divi' );
							?>
						</button>
						<button class="wpfd_admin_tablinks" type="button" data-target="#wpfd_admin_tab_about">
							<?php

							esc_html_e( 'About', 'wprunway-for-divi' );
							?>
						</button>
					</div>
						
						<!-- Tab welcome -->
						<div id="wpfd_admin_tab_welcome" class="wpfd_admin_tabcontent">
							<h2><?php

							esc_html_e( 'Welcome', 'wprunway-for-divi' );
							?></h2>
							<?php
							if (! wpfd_divi_is_activated()) {
								echo wp_kses( 'Divi theme or plugin must be installed and active to use this plugin.', 'wprunway-for-divi' );
							}
							else {
								echo wp_kses( 'Divi theme or plugin detected.', 'wprunway-for-divi' );
							}
							?>
						</div>
						
						<!-- Tab modules -->
						<div id="wpfd_admin_tab_modules" class="wpfd_admin_tabcontent">
							<?php

							settings_fields( 'wpfd_settings_group' );
							?>
							<?php

							do_settings_sections( 'wpfd_modules_settings_section' );
							?>
							<?php

							esc_html_e( 'More to come...', 'wprunway-for-divi' );
							?>
						</div>
						
						<!-- Tab about -->
						<div id="wpfd_admin_tab_about" class="wpfd_admin_tabcontent">
							<h2><?php

							esc_html_e( 'About', 'wprunway-for-divi' );
							?></h2>
							<p><?php

							echo sprintf( '%1$s %2$s', esc_html__( "WPRunway for Divi version:", 'wprunway-for-divi' ), esc_attr( WPFD_PLUGIN_VERSION ) );
							?></p>
							<p><?php

							echo sprintf( '%1$s <a href="%2$s">%2$s</a>', esc_html__( "Plugin made by François Yerg:", 'wprunway-for-divi' ), "https://www.francoisyerg.net" );
							?>
							<p><?php

							echo sprintf( '%1$s <a href="%2$s">%2$s</a>', esc_html__( "For help and documentation:", 'wprunway-for-divi' ), esc_url( WPFD_PLUGIN_WEBSITE ) );
							?>
							<p><?php

							echo sprintf( '%1$s <a href="mailto:%2$s">%2$s</a>', esc_html__( "If you have any questions or to report a bug:", 'wprunway-for-divi' ), esc_attr( WPFD_PLUGIN_EMAIL ) );
							?>
						</div>
					</div><!-- .wpfd_admin_column_left -->
					<div class="wpfd_admin_column_right">
						<div class="wpfd_admin_box wpfd_admin_box_actions">
							<div class="wpfd_admin_box_title"><h2><?php

							esc_html_e( 'Actions', 'wprunway-for-divi' )?></h2></div>
							<?php

							submit_button( esc_html__( 'Save changes', 'wprunway-for-divi' ) );
							?>
						</div>
					</div><!-- .wpfd_admin_column_right -->
				</form>
			</div>
		</div>