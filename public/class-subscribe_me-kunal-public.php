<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://kunalsaha@wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Subscribe_me_Kunal
 * @subpackage Subscribe_me_Kunal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Subscribe_me_Kunal
 * @subpackage Subscribe_me_Kunal/public
 * @author     Kunal Saha <sahakunal1803@gmail.com>
 */
class Subscribe_me_Kunal_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Subscribe_me_Kunal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Subscribe_me_Kunal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/subscribe_me-kunal-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Subscribe_me_Kunal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Subscribe_me_Kunal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/subscribe_me-kunal-public.js', array( 'jquery' ), $this->version, false );

	}

	function call_shortcode()
	{
		add_shortcode('subscribe-me', array($this, 'subscribe_me__shortcode'));
	}

	function subscribe_me__shortcode()
	{
		// Code to generate the form HTML goes here
		$form_html = '<form class="subscribe-me-form" method="post">
                      <legend>Subscribe to Newsletter</legend>
					  <input type="hidden" name="action" value="subs_form">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email">
                      <br>
                      <input type="submit" name="submit" id="subscribe-button" value="Subscribe"/>
                  </form>';



		// Return the form HTML
		return $form_html;
	}

	// Save subscriber email to database
	function register_subscriber()
	{
		//To check input pattern 
		if (isset($_POST['email'])) {
			$email = sanitize_email($_POST['email']);
			$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

			if (preg_match($pattern, $email)) {
				if (isset($_POST['submit'])) {

					$my_sub_email = get_option('my_sub_email');

					if (!$my_sub_email) {
						$my_sub_email = array();
					}

					if (in_array($email, $my_sub_email)) {
						echo '<script>alert("You are already subscribed!");</script>';
					} else {
						$my_sub_email[] = $email;
						update_option('my_sub_email', $my_sub_email);

						// Display a success message
						echo '<script>alert("You have been subscribed Successfully!");</script>';
					}
				}
			} else {
				//For invalid email
				echo '<script>alert("Please Enter a valid email!");</script>';
			}
		}
	}

	function send_mail()
	{
		$to = implode(',', get_option('my_sub_email'));
		$subject = 'Successfully subscribed to ' . the_title() . ' newsletter';
		$summary = $this->get_daily_post_details();
		$message = 'You will get our daily feeds right into your inbox. Enjoy!!!';
		$message .= "\n\n";
		$message .= "Here are our Top latest Posts";
		$message .= "\n";

		foreach ($summary as $post_data) {
			$message .= 'Title: ' . $post_data['title'] . "\n";
			$message .= 'URL: ' . $post_data['url'] . "\n";
			$message .= "\n";
		}

		$headers = array(
			'From: dev-email@wpengine.local',
			'Content-Type: text/html; charset=UTF-8'
		);

		wp_mail($to, $subject, $message, $headers);
	}

	function get_daily_post_details()
	{
		//To send latest n posts 
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => get_option('no_of_posts'),
			'post_status' => 'publish'
		);

		$query = new WP_Query($args);
		$posts = $query->posts;
		$mail_list = array();

		foreach ($posts as $post) {
			$post_data = array(
				'title' => $post->post_title,
				'url' => get_permalink($post->ID),
			);
			array_push($mail_list, $post_data);
		}
		return $mail_list;
	}

	

}
