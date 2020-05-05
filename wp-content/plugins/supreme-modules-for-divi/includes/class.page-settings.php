<?php
/**
 * WordPress settings API
 */
if ( ! class_exists( 'DSM_Settings' ) ) :
	class DSM_Settings {

		private $settings_api;

		function __construct() {
			$this->settings_api = new DSM_Settings_API();

			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}

		function admin_init() {

			// set the settings
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			// initialize settings
			$this->settings_api->admin_init();
		}

		function admin_menu() {
			add_menu_page( __( 'Divi Supreme', 'dsm-supreme-modules-for-divi' ), __( 'Divi Supreme', 'dsm-supreme-modules-for-divi' ), 'manage_options', 'divi_supreme_settings', array( $this, 'plugin_page' ), plugins_url( 'supreme-modules-for-divi/admin/img/icon-128x128.png' ), 99 );
			if ( $this->settings_api->get_option( 'dsm_use_header_footer', 'dsm_general' ) == 'on' ) {
				add_submenu_page( 'divi_supreme_settings', __( 'Divi Templates', 'dsm-supreme-modules-for-divi' ), __( 'Divi Templates', 'dsm-supreme-modules-for-divi' ), 'manage_options', 'edit.php?post_type=dsm_header_footer' );
			}
		}

		function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'dsm_general',
					'title' => __( 'Divi Supreme General Settings', 'dsm-supreme-modules-for-divi' ),
				),
				array(
					'id'    => 'dsm_settings_social_media',
					'title' => __( 'Social Media Settings', 'dsm-supreme-modules-for-divi' ),
				),
				array(
					'id'    => 'dsm_settings_misc',
					'title' => __( 'Misc', 'dsm-supreme-modules-for-divi' ),
				),
			);
			return $sections;
		}

		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		function get_settings_fields() {
			$settings_fields = array(
				'dsm_general'               => array(
					array(
						'name'  => 'dsm_section_subtitle',
						'class' => 'dsm-section-subtitle',
						'label' => __( '<h3>Divi Supreme Extensions</h3>', 'dsm-supreme-modules-for-divi' ),
						'type'  => 'html',
					),
					array(
						'name'    => 'dsm_use_scheduled_content',
						'class'   => 'dsm-settings-checkbox',
						'label'   => __( 'Enable Scheduled Content on Section & Row', 'dsm-supreme-modules-for-divi' ),
						'desc'    => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
					array(
						'name'    => 'dsm_use_header_footer',
						'class'   => 'dsm-settings-checkbox',
						'label'   => __( 'Enable Divi Templates', 'dsm-supreme-modules-for-divi' ),
						'desc'    => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
					array(
						'name'    => 'dsm_use_shortcode',
						'class'   => 'dsm-settings-checkbox',
						'label'   => __( 'Enable Divi Library Shortcodes', 'dsm-supreme-modules-for-divi' ),
						'desc'    => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
				),
				'dsm_settings_social_media' => array(
					array(
						'name'  => 'dsm_section_subtitle',
						'class' => 'dsm-section-subtitle',
						'label' => __( '<h3>Divi Supreme Social Media Settings</h3>', 'dsm-supreme-modules-for-divi' ),
						'type'  => 'html',
					),
					'dsm_facebook_app_id'    => array(
						'name'              => 'dsm_facebook_app_id',
						'label'             => __( 'Facebook APP ID', 'dsm-supreme-modules-for-divi' ),
						'desc'              => sprintf(
							__( 'Enter the Facebook App ID. You can go to <a href="%1$s">Facebook Developer</a> and click on Create New App to get one.', 'dsm-supreme-modules-for-divi' ),
							esc_url( 'https://developers.facebook.com/apps/' )
						),
						'default'           => ' ',
						'type'              => 'text',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'dsm_facebook_site_lang' => array(
						'name'    => 'dsm_facebook_site_lang',
						'label'   => __( 'Facebook Language', 'dsm-supreme-modules-for-divi' ),
						'desc'    => __( 'Check this box if you would like your Divi Facebook Modules to use your WordPress Site Language instead of the default English(US).', 'dsm-supreme-modules-for-divi' ),
						'type'    => 'checkbox',
						'default' => 'off',
					),
				),
				'dsm_settings_misc'         => array(
					'dsm_uninstall_on_delete'    => array(
						'name'  => 'dsm_uninstall_on_delete',
						'label' => __( 'Remove Data on Uninstall?', 'dsm-supreme-modules-for-divi' ),
						'desc'  => __( 'Check this box if you would like Divi Supreme to completely remove all of its data when the plugin is deleted.', 'dsm-supreme-modules-for-divi' ),
						'type'  => 'checkbox',
					),
					'dsm_allow_mime_json_upload' => array(
						'name'    => 'dsm_allow_mime_json_upload',
						'label'   => __( 'Allow JSON file upload', 'dsm-supreme-modules-for-divi' ),
						'desc'    => __( 'Check this box if you would like allow JSON file through WordPress Media Uploader.', 'dsm-supreme-modules-for-divi' ),
						'type'    => 'checkbox',
						'default' => 'on',
					),
				),
			);

			return $settings_fields;
		}

		function plugin_page() {
			echo '<div class="wrap">';

			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		function get_pages() {
			$pages         = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$pages_options[ $page->ID ] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}
endif;
new DSM_Settings();
