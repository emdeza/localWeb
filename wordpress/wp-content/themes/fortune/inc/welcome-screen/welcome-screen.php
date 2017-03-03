<?php
/**
 * Welcome Screen Class
 */
  if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Fortune_welcome')) {
class Fortune_welcome {
	
	public $admin_notices = array();
	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {
		
		// Display admin notices
		add_action('admin_notices', array($this, 'adminNotices'), 99);

		// Check for dismissed admin notices.
		add_action('admin_init', array($this, 'dismissAdminNotice'), 9);
		
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'Fortune_lite_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'Fortune_lite_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'Fortune_lite_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'Fortune_lite_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'Fortune_lite_welcome', array( $this, 'Fortune_lite_welcome_getting_started' ), 10 );
		
		add_action( 'Fortune_lite_welcome', array( $this, 'Fortune_lite_welcome_changelog' ), 50 );				
		}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_welcome_register_menu() {
		add_theme_page( 'About fortune', 'About Fortune', 'activate_plugins', 'fortune-welcome', array( $this, 'Fortune_lite_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'Fortune_lite_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Fortune Theme! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'fortune' ), '<a href="' . esc_url( admin_url( 'themes.php?page=fortune-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=fortune-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with fortune', 'fortune' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function Fortune_lite_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_fortune-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'fortune-welcome-screen-css', get_template_directory_uri() . '/inc/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'fortune-welcome-screen-js', get_template_directory_uri() . '/inc/welcome-screen/js/welcome.js', array('jquery') );

			global $Fortune_required_actions;

			$nr_actions_required = 0;

			wp_localize_script( 'fortune-welcome-screen-js', 'fortuneLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','fortune' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function Fortune_lite_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'fortune-lite-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'fortune-lite-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $Fortune_required_actions;

		$nr_actions_required = 0;

		wp_localize_script( 'fortune-lite-welcome-screen-customizer-js', 'fortuneLiteWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=fortune-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','fortune'),
		) );
	}

	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="fortune-lite-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','fortune'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','fortune'); ?></a></li>
		</ul>

		<div class="fortune-lite-tab-content">

			<?php
			/**
			 * @hooked Fortune_lite_welcome_getting_started - 10
			 * @hooked Fortune_lite_welcome_actions_required - 20
			 * @hooked Fortune_lite_welcome_changelog - 50
			 * @hooked Fortune_lite_welcome_free_pro - 60
			 */
			do_action( 'Fortune_lite_welcome' ); ?>

		</div>
		<?php
	}
	
	public function adminNotices(){
            global $current_user, $pagenow;
			$notices = $this->admin_notices;
            // Check for an active admin notice array
            if (!empty($notices)) {

                // Enum admin notices
                foreach ($notices as $notice) {
                    $add_style = '';
                    if (strpos($notice['type'], 'webhunt-message') != false) {
                        $add_style = 'style="border-left: 4px solid ' . $notice['color'] . '!important;"';
                    }

                    if (true == $notice['dismiss']) {

                        // Get user ID
                        $userid = $current_user->ID;

                        if (!get_user_meta($userid, 'ignore_' . $notice['id'])) {

                            // Check if we are on admin.php.  If we are, we have
                            // to get the current page slug and tab, so we can
                            // feed it back to Wordpress.  Why>  admin.php cannot
                            // be accessed without the page parameter.  We add the
                            // tab to return the user to the last panel they were
                            // on.
                            $pageName = '';
                            $curTab = '';
                            if ($pagenow == 'admin.php' || $pagenow == 'themes.php') {

                                // Get the current page.  To avoid errors, we'll set
                                $pageName = empty($_GET['page']) ? '&amp;page=kyma-welcome' : '&amp;page=' . $_GET['page'];

                                // Ditto for the current tab.
                                $curTab = empty($_GET['tab']) ? '&amp;tab=0' : '&amp;tab=' . $_GET['tab'];
                            }

                            // Print the notice with the dismiss link
                            echo '<div ' . $add_style . ' class="' . $notice['type'] . '"><p>' . $notice['msg'] . '&nbsp;&nbsp;<a href="?dismiss=true&amp;id=' . $notice['id'] . $pageName . $curTab . '">' . __('Dismiss', 'fortune') . '</a>.</p></div>';
                        }
                    } else {

                        // Standard notice
                        echo '<div ' . $add_style . ' class="' . $notice['type'] . '"><p>' . $notice['msg'] . '</a>.</p></div>';
                    }
                }

                // Clear the admin notice array
                $this->admin_notices = array();
            }
        }

        /**
         * dismissAdminNotice - Updates user meta to store dismiss notice preference
         * @access      public
         * @return      void
         */
        public function dismissAdminNotice()
        {
            global $current_user;

            // Verify the dismiss and id parameters are present.
            if (isset($_GET['dismiss']) && isset($_GET['id'])) {
                if ('true' == $_GET['dismiss'] || 'false' == $_GET['dismiss']) {

                    // Get the user id
                    $userid = $current_user->ID;

                    // Get the notice id
                    $id = $_GET['id'];
                    $val = $_GET['dismiss'];

                    // Add the dismiss request to the user meta.
                    update_user_meta($userid, 'ignore_' . $id, $val);
                }
            }
        }

	/**
	 * Getting started
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Changelog
	 * @since 1.8.2.4
	 */
	public function Fortune_lite_welcome_changelog() {
		require_once( get_template_directory() . '/inc/welcome-screen/sections/changelog.php' );
	}

}

$GLOBALS['Fortune_welcome'] = new Fortune_welcome();
}
?>