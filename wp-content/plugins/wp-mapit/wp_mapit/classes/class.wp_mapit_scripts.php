<?php

	if( ! class_exists( 'wp_mapit_scripts' ) ) {

		/**
		 * Class to manage the scripts and styles for WP MAPIT
		 */
		class wp_mapit_scripts
		{
			/**
		     * Add hooks and filters to enqueue scripts and styles needed for WP MAPIT
		     *
		     * @since 1.0
		     * @static
		     * @access public
		     */
			public static function init() {
				add_action( 'wp_enqueue_scripts', __CLASS__ . '::wp_enqueue_scripts' );
				add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_enqueue_scripts' );
			}

			/**
		     * Hook to add scripts and styles for WP MAPIT frontend
		     *
		     * @since 1.0
		     * @static
		     * @access public
		     */
			public static function wp_enqueue_scripts() {
				wp_enqueue_style( 'wp-mapit-leaflet-css', WP_MAPIT_URL . 'css/leaflet.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-responsive-popup-css', WP_MAPIT_URL . 'css/leaflet.responsive.popup.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-gesture-handling-css', WP_MAPIT_URL . 'css/leaflet-gesture-handling.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-fullscreen-css', WP_MAPIT_URL . 'css/leaflet.fullscreen.css' );
				wp_enqueue_style( 'wp-mapit-css', WP_MAPIT_URL . 'css/wp_mapit.css' );

				if( is_rtl() ) {
					wp_enqueue_style( 'wp-mapit-leaflet-responsive-popup-rtl-css', WP_MAPIT_URL . 'css/leaflet.responsive.popup.rtl.css' );
				}

				wp_enqueue_script( 'wp-mapit-leaflet-js', WP_MAPIT_URL . 'js/leaflet.js', array( 'jquery' ) );
				wp_enqueue_script( 'wp-mapit-leaflet-responsive-popup-js', WP_MAPIT_URL . 'js/leaflet.responsive.popup.js', array( 'jquery' ) );
				wp_enqueue_script( 'wp-mapit-leaflet-gesture-handling-js', WP_MAPIT_URL . 'js/leaflet-gesture-handling.js', array( 'jquery' ) );

				wp_enqueue_script( 'wp-mapit-leaflet-fullscreen-js', WP_MAPIT_URL . 'js/Leaflet.fullscreen.min.js', array( 'jquery' ) );

				wp_enqueue_script( 'wp-mapit-js', WP_MAPIT_URL . 'js/wp_mapit.js', array( 'jquery' ) );

				wp_localize_script( 'wp-mapit-js', 'wp_mapit', array( 
					'plugin_attribution' => '<strong>Developed by <a href="http://wp-mapit.phpwebdev.in">WP MAPIT</a></strong> | '
				) );

				wp_enqueue_script( 'wp-mapit-multipin-js', WP_MAPIT_URL . 'js/wp_mapit_multipin.js', array( 'jquery' ) );
			}

			/**
		     * Hook to add scripts and styles for WP MAPIT admin
		     *
		     * @since 1.0
		     * @static
		     * @access public
		     */
			public static function admin_enqueue_scripts() {
				wp_enqueue_media();

				wp_enqueue_style( 'wp-mapit-leaflet-css', WP_MAPIT_URL . 'css/leaflet.css' );
				wp_enqueue_style( 'wp-mapit-css', WP_MAPIT_URL . 'css/wp_mapit_admin.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-responsive-popup-css', WP_MAPIT_URL . 'css/leaflet.responsive.popup.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-gesture-handling-css', WP_MAPIT_URL . 'css/leaflet-gesture-handling.css' );
				wp_enqueue_style( 'wp-mapit-leaflet-fullscreen-css', WP_MAPIT_URL . 'css/leaflet.fullscreen.css' );

				if( is_rtl() ) {
					wp_enqueue_style( 'wp-mapit-leaflet-responsive-popup-rtl-css', WP_MAPIT_URL . 'css/leaflet.responsive.popup.rtl.css' );
				}

				wp_enqueue_script( 'wp-mapit-leaflet-js', WP_MAPIT_URL . 'js/leaflet.js', array( 'jquery' ) );
				wp_enqueue_script( 'wp-mapit-leaflet-responsive-popup-js', WP_MAPIT_URL . 'js/leaflet.responsive.popup.js', array( 'jquery' ) );
				wp_enqueue_script( 'wp-mapit-leaflet-gesture-handling-js', WP_MAPIT_URL . 'js/leaflet-gesture-handling.js', array( 'jquery' ) );

				wp_enqueue_script( 'wp-mapit-leaflet-fullscreen-js', WP_MAPIT_URL . 'js/Leaflet.fullscreen.min.js', array( 'jquery' ) );

				wp_enqueue_script( 'wp-mapit-admin-js', WP_MAPIT_URL . 'js/wp_mapit_admin.js', array( 'jquery' ) );

				wp_localize_script( 'wp-mapit-admin-js', 'wp_mapit', array( 
					'choose_image_text' => __( 'Choose Image', WP_MAPIT_TEXTDOMAIN ),
					'ajax_error_message' => __( 'Oops! Something went wrong. Please try again.', WP_MAPIT_TEXTDOMAIN ),
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'please_wait_text' => __( 'Please wait', WP_MAPIT_TEXTDOMAIN ),
					'search_text' => __( 'Search', WP_MAPIT_TEXTDOMAIN ),
					'plugin_attribution' => '<strong>Developed by <a href="http://wp-mapit.phpwebdev.in">WP MAPIT</a></strong> | '

				) );

				if( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'wp_mapit' ) {
					wp_enqueue_script( 'wp-mapit-admin-settings-js', WP_MAPIT_URL . 'js/wp_mapit_admin_settings.js', array( 'jquery' ) );
				}

				global $post;

				if( ! empty( $post->post_type ) && $post->post_type == 'wp_mapit_map' ) {
					wp_enqueue_script( 'wp-mapit-admin-multipin-js', WP_MAPIT_URL . 'js/wp_mapit_admin_multipin.js', array( 'jquery' ) );

					wp_localize_script( 'wp-mapit-admin-multipin-js', 'wp_mapit_multipin', array( 
						'search_map_text' => __( 'Search Map', WP_MAPIT_TEXTDOMAIN ),
						'latitude_text' => __( 'Latitude', WP_MAPIT_TEXTDOMAIN ),
						'longitude_text' => __( 'Longitude', WP_MAPIT_TEXTDOMAIN ),
						'marker_image_text' => __( 'Marker Image', WP_MAPIT_TEXTDOMAIN ),
						'choose_image_text' => __( 'Choose Image', WP_MAPIT_TEXTDOMAIN ),
						'remove_image_text' => __( 'Remove Image', WP_MAPIT_TEXTDOMAIN ),
						'marker_title_text' => __( 'Marker Title', WP_MAPIT_TEXTDOMAIN ),
						'marker_url_text' => __( 'Marker URL', WP_MAPIT_TEXTDOMAIN ),
						'marker_content_text' => __( 'Marker Content', WP_MAPIT_TEXTDOMAIN ),
						'map_text' => __( 'Map', WP_MAPIT_TEXTDOMAIN ),
						'remove_pin_text' => __( 'Remove Pin', WP_MAPIT_TEXTDOMAIN ),
						'remove_pin_confirm_text' => __( 'Are you sure you want to remove the pin?', WP_MAPIT_TEXTDOMAIN ),
					) );
				}
			}
		}

		/**
		 * Calling init function to activate hooks and filters.
		 */
		wp_mapit_scripts::init();
	}