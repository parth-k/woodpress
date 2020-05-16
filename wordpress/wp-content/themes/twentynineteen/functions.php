<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'twentynineteen' ) : null,
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'twentynineteen' ) : null,
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '20181214', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '20181231', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



// *********************************************login api******************************************
add_action( 'rest_api_init', 'register_api_hooks' );

function register_api_hooks() {
	register_rest_route(
		'custom-plugin', '/login/',
		array(
			'methods'  => 'GET',
			'callback' => 'login',
		)
	);
}

function login($request){
	session_start();
	$creds['user_login'] = $request["username"];
	$creds['user_password'] =  $request["password"];
	// $creds['remember'] = true;
	$_SESSION['se_login'] = $creds['user_login'];
	$_SESSION['se_password'] = $creds['user_password'];
  // $creds['remember'] = true;

  // echo $_SESSION['se_login'];
  // echo $_SESSION['se_password'];

	$user=wp_signon($creds,false);
	if ( is_wp_error($user) )
		echo $user->get_error_message();

	return $user;
}

// add_action( 'after_setup_theme', 'custom_login' );s

function add_cors_http_header(){
	header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');

add_filter('allowed_http_origins', 'add_allowed_origins');

function add_allowed_origins($origins) {
	$origins[] = 'https://www.yourdomain.com/';
	return $origins;
}




 // *********************************************booking event api******************************************

add_action( 'rest_api_init', 'register_api_hooks_booking' );
function register_api_hooks_booking() {
	register_rest_route(
		'custom-plugin', '/event/',
		array(
			'methods'  => 'POST',
			'callback' => 'Event_booking',
		)
	);
}
function Event_booking($request){
	$nm=$_POST['post_title'];//username
	$mt=$_POST['post_mime_type'];//user mobile number
	$em=$_POST['post_content'];//user email address
	$dt=$_POST['post_date'];//event date
	$name=$_POST['post_name'];// event name
	$pinged = $_POST['pinged'];
  // echo $userID;


	if($nm == "" || !preg_match("/^[a-z]+$/", $nm) || $mt == "" || !preg_match("/^[0-9]{10}$/", $mt) || $em == "" || 
		!preg_match("/^[a-zA-Z0-9.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $em) || $dt == "")
	{
		$required = "BAD Request";
		http_response_code(400);
		echo $required;
		exit;
  // echo "All Fields Are Reqiuired";
	}
	else{

		$con = mysqli_connect('localhost','root','','schoolsite');


		$qy= "INSERT INTO wp_posts (pinged, post_title , post_content, post_date, post_name, post_mime_type) 
		VALUES ('$pinged','$nm','$em','$dt','$name','$mt')";		
		if ($con->query($qy) === TRUE) {
			$abc =mysqli_insert_id($con);

			echo "ID:".$abc;
		} 
		else {
			echo "Error: " . $qy . "<br>" . $con->error;
		}
	}
}

 // *********************************************logout api******************************************

add_action( 'rest_api_init', 'logoutfn' );

function logoutfn() {
	register_rest_route(
		'custom-plugin', '/logout/',
		array(
			'methods'  => 'GET',
			'callback' => 'logout')
	);
}
function logout(){
	// echo "logout user";
	session_destroy();
}


 // *********************************************display booked event api******************************************

add_action( 'rest_api_init', 'Book_event' );

function Book_event() {
	register_rest_route(
		'custom-plugin', '/bevent/',
		array(
			'methods'  => 'GET',
			'callback' => 'bevent')
	);
}


function bevent($request){
	$pinged = $_GET['pinged'];
	// var_dump($request);
	$json = $request->get_headers();
	 // echo "<h1>parth</h1>";
	 // echo "<br>";

	 $user_req_email = '';
	 foreach ($json as $key => $feature) 
	 {
	 	if ($key == 'auth') {
	 		$user_email = $feature[0];

	 	}
	 }
	 if ($user_email) {
	 	// echo $user_email;
	 	exit();
	 }

    // echo $userID;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "schoolsite";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT id , post_title , post_content , post_name , post_date, post_mime_type FROM wp_posts WHERE pinged = $pinged";
	$result = mysqli_query($conn, $sql);
	$respnose = []; 

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			array_push($respnose,$row);
		} 
		echo json_encode($respnose);
		exit();
	}else 
	{
            // echo "This User is not valid to see his bookings"; 
	} 
}

 // *********************************************EDIT api******************************************

add_action( 'rest_api_init', 'register_api_hooks_update' );

function register_api_hooks_update() {
	register_rest_route(
		'custom-plugin', '/update/',
		array(
			'methods'  => 'PUT',
			'callback' => 'record',
		)
	);
}
function record(){
	$ID = $_GET['ID'];
	var_dump($ID);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "schoolsite";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	parse_str(file_get_contents('php://input'),$_PUT);
    // print_r($_PUT);

	$json_array[] = $_PUT;
	$json = json_encode($json_array);
	echo $json;

	$sql = mysqli_query($conn, "UPDATE wp_posts SET
		post_title='".$_PUT['post_title']."', post_content='".$_PUT['post_content']."',post_mime_type='".$_PUT['post_mime_type']."',post_date='".$_PUT['post_date']."',post_name='".$_PUT['post_name']."'WHERE id = $ID" );

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	$conn->close();
}

 // *********************************************DELETE api******************************************

add_action( 'rest_api_init', 'register_api_hooks_delete' );

function register_api_hooks_delete() {
	register_rest_route(
		'custom-plugin', '/delete/',
		array(
			'methods'  => 'DELETE',
			'callback' => 'deletedata',
		)
	);
}

function deletedata(){
	$ID = $_GET['ID']; //ID

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "schoolsite";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


	$query=mysqli_query($conn, "DELETE FROM wp_posts WHERE ID = '$ID' ");

	if($query==true){ 
		echo "Records was delete successfully.";

	} else{ 
		echo "ERROR:Records is not delete . " . $mysqli->error;
	} 
	// echo json_encode($query);
    // return $data;
}
 // *********************************************new user login api******************************************

add_action( 'rest_api_init', 'register_api_hooks_newuser' );
function register_api_hooks_newuser() {
	register_rest_route(
		'custom-plugin', '/newuser/',
		array(
			'methods'  => 'POST',
			'callback' => 'newuser',
		)
	);
}
function newuser($request){
	$un=$_POST['user_login'];//username
	$pass=$_POST['user_pass'];//user pass
	 $md = wp_hash_password($pass);
	$email=$_POST['user_email'];//user email address
	$nk = $_POST['user_nicename'];//user nicename
	$dt= date("Y-m-d h:i:sa");

	$con = mysqli_connect('localhost','root','','schoolsite');


	$qy= "INSERT INTO wp_users (user_login , user_pass , user_email , user_nicename ,  user_registered, display_name) 
	 VALUES ('$un', '$md' , '$email' , '$nk' , '$dt' , '$nk')";		
	 if ($con->query($qy) === TRUE) {
		 $abc =mysqli_insert_id($con);
		echo "new user create successfully";
		// 	echo "ID:".$abc;
	} 
	else {
		echo "Error: " . $qy . "<br>" . $con->error;
	}
}
 // *********************************************forgot password api******************************************
add_action( 'rest_api_init', 'register_api_hooks_forgotpass' );

function register_api_hooks_forgotpass() {
    register_rest_route(
        'custom-plugin', '/forgot/',
        array(
            'methods'  => 'PUT',
            'callback' => 'password',
        )
    );
}

function password(){
    $ID = $_GET['user_email'];
    var_dump($ID);
    $up = $_POST['user_pass'];
    // $md = md5($up);
    $user_pass = wp_hash_password("$up");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "schoolsite";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    parse_str(file_get_contents('php://input'),$_PUT);
    // print_r($_PUT);

    //
    $json_array[] = $_PUT;
    $json = json_encode($json_array);
    echo $json;
    $sql = mysqli_query($conn, "UPDATE wp_users SET user_pass='$user_pass' WHERE user_email = '$ID' " );

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}