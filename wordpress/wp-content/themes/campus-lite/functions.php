<?php
// $con = mysqli_connect('localhost','root','','schoolsite');
// if(!$con){
//     die('could not connect:'.mysqli_error());
// }else{
//     echo " successfull connection"; 
// }
/**
 * Campus functions and definitions
 *
 * @package Campus Lite
 */

if ( ! function_exists( 'campus_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function campus_lite_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'campus-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('campus-lite-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'campus-lite' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );
	add_editor_style( array( 'editor-style.css', campus_lite_font_url() ) );
}
endif; // campus_lite_setup
add_action( 'after_setup_theme', 'campus_lite_setup' );


function campus_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'campus-lite' ),
		'description'   => __( 'Appears on blog page sidebar', 'campus-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header left Top', 'campus-lite' ),
		'description'   => __( 'Appears left side of top bar.', 'campus-lite' ),
		'id'            => 'headtopleft',
		'before_widget' => '',
		'before_title'  => '<h3 class="header-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Right Top', 'campus-lite' ),
		'description'   => __( 'Appears right side of top bar.', 'campus-lite' ),
		'id'            => 'headtopright',
		'before_widget' => '',
		'before_title'  => '<h3 class="header-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'campus_lite_widgets_init' );

function campus_lite_font_url(){
	$font_url = '';

		/* Translators: If there are any character that are
		* not supported by PT Sans, translate this to off, do not
		* translate into your own language.
		*/
		$ptsans = _x('on', 'PT Sans font:on or off','campus-lite');
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on', 'Roboto font:on or off','campus-lite');
		
		/* Translators: If there are any character that are
		* not supported by Karla, translate this to off, do not
		* translate into your own language.
		*/
		$karla = _x('on', 'Karla font:on or off','campus-lite');
		
		/* Translators: If there are any character that are
		* not supported by Raleway, translate this to off, do not
		* translate into your own language.
		*/
		$raleway = _x('on', 'Raleway font:on or off','campus-lite');
		
		if('off' !== $ptsans || 'off' !==  $roboto || 'off' !== $karla || 'off' !== $raleway){
			$font_family = array();
			
			if('off' !== $ptsans){
				$font_family[] = 'PT Sans:300,400,600,700,800,900';
			}
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:400,700';
			}
			
			if('off' !== $karla){
				$font_family[] = 'karla:400,700,900';
			}
			
			if('off' !== $raleway){
				$font_family[] = 'Raleway:400,700';
			}
			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'https://fonts.googleapis.com/css');
		}
		
		return $font_url;
	}

	function campus_lite_scripts() {
		wp_enqueue_style( 'campus-lite-font', campus_lite_font_url(), array() );
		wp_enqueue_style( 'campus-lite-basic-style', get_stylesheet_uri() );
		wp_enqueue_style( 'campus-lite-editor-style', get_template_directory_uri().'/editor-style.css' );
		wp_enqueue_style( 'campus-lite-responsive-style', get_template_directory_uri().'/css/theme-responsive.css' );
		wp_enqueue_style( 'nivo-style', get_template_directory_uri().'/css/nivo-slider.css');
		wp_enqueue_script( 'nivo-slider-js', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
		wp_enqueue_script( 'campus-lite-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'campus_lite_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function campus_lite_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'campus_lite_front_page_template' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*
 * Load customize pro
 */
require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );


// URL DEFINES
define('campus_lite_pro_theme_url','https://flythemes.net/wordpress-themes/campus-education-wordpress-theme/');
define('campus_lite_site_url','https://flythemes.net/');

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


		$qy= "INSERT INTO wp_posts (pinged, post_title , post_content, post_date, post_name, post_mime_type,post_type, post_status) 
		VALUES ('$pinged','$nm','$em','$dt','$name','$mt','sln_booking', 'Pending')";		
		if ($con->query($qy) === TRUE) {
			$abc =mysqli_insert_id($con);

			echo "ID:".$abc."Name:".$nm."Mobile_No.".$mt."Email".$em."Date-Time".$dt."Event_name".$name ;
		} 
		else {
			echo "Error: " . $qy . "<br>" . $con->error;
		}
	}
}
// add_action( 'after_setup_theme', 'custom_booking' );
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


// ***************************************display booked event API***************************************************
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
	// $ID = $_GET['ID']; //ID
	// var_dump($ID);

	// var_dump($pinged);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "schoolsite";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT id, post_title , post_content, post_date, post_name, post_mime_type, post_status FROM wp_posts WHERE pinged = $pinged";
	$result = mysqli_query($conn, $sql);
	$respnose = []; 


	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			// $sql = "SELECT ID, post_date, post_content, post_title, post_excerpt, to_ping FROM wp_posts WHERE pinged = $pinged";
			// echo "Name: "  . $row["post_title"].  "\n". 
			// // "ID: "  . $row["ID"].  "\n".
			// "Email: "  . $row["post_content"].  "\n". 
			// "Date:"   . $row["post_date"]. "\n".
			// "Service: "  . $row["post_excerpt"].  "\n". 
			// "Mobile:". $row["to_ping"]."\n" ;
			// $json_response = json_encode($row);
			// echo $json_response
			// exit();
			array_push($respnose,$row);
		}
		echo json_encode($respnose);
		exit();
	}
	else 
	{
		echo "This User is not valid to see his bookings"; 
	}
	mysqli_close($conn);
}


// *****************************************Edit API**********************************************************
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

	var_dump($_put);
	$json_array[] = $_PUT;
	$json = json_encode($json_array);
	echo $json;

	$sql = mysqli_query($conn,"UPDATE wp_posts SET
		post_title='".$_PUT['post_title']."', post_content='".$_PUT['post_content']."',post_mime_type='".$_PUT['post_mime_type']."',post_name='".$_PUT['post_name']."',post_date='".$_PUT['post_date']."',eve_time='".$_PUT['eve_time']."',address='".$_PUT['address']."' WHERE ID= $ID");


	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} 

	else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();
}


// *****************************************Delete API**********************************************************
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
	$ID = $_GET['ID'];

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
}



// ************************************signup api ************************************************************

add_action( 'rest_api_init', 'signup');

function signup() {
	register_rest_route(
		'custom-plugin', '/newuser/',
		array(
			'methods'  => 'POST',
			'callback' => 'signupdata',
		)
	);
}
function signupdata($request){

	$un = $_POST['user_login'];
	$up = $_POST['user_pass'];
	 // $md = md5($up);
	$user_pass = wp_hash_password($up);
	$ue = $_POST['user_email'];
	$nk = $_POST['user_nicename'];
	$d= date("Y-m-d h:i:sa");

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
	$qy = "INSERT into wp_users (user_login, user_pass, user_email, user_nicename, display_name, user_registered) 
	VALUES ('$un','$user_pass','$ue', '$nk', '$nk','$d')";

	if (mysqli_query($conn, $qy)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $qy . "<br>" . mysqli_error($conn);
	}

}

// **************************************************FORGOT PASSWORD API ***************************************************

add_action( 'rest_api_init', 'register_api_hooks_forgotpass' );

function register_api_hooks_forgotpass() {
	register_rest_route(
		'custom-plugin', '/forgot/',
		array(
			'methods'  => 'PUT',
			'callback' => 'pass',
		)
	);
}
function pass(){

	$user_email = $_GET['user_email'];
	// $user_pass = $_POST['user_pass'];
	$up = $_POST['user_pass'];
	 // $md = md5($up);
	$user_pass = wp_hash_password($up);

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

	parse_str( file_get_contents("php://input"), $_PUT );
	// print_r($_PUT);

	$sql=mysqli_query($conn, "UPDATE wp_users SET user_pass='$user_pass' WHERE  user_email = '$user_email'");

	if($sql==true){ 
		echo "Records was updated successfully.";

	} else{ 
		echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
	}
}


//////////////////////////////////////////*confirm button*//////////////////////////////////////////

add_action( 'rest_api_init', 'register_api_hooks_confirm' );

function register_api_hooks_confirm() {
	register_rest_route(
		'custom-plugin', '/confirm/',
		array(
			'methods'  => 'PUT',
			'callback' => 'confirm_btn',
		)
	);
}

function confirm_btn(){
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

	$sql = mysqli_query($conn, "UPDATE wp_posts SET post_status = 'sln-b-confirmed' WHERE ID = '$ID' " );

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	$conn->close();
}

//////////////////////////////////////////*canceled button*//////////////////////////////////////////
add_action( 'rest_api_init', 'register_api_hooks_canceled' );

function register_api_hooks_canceled() {
	register_rest_route(
		'custom-plugin', '/canceled/',
		array(
			'methods'  => 'PUT',
			'callback' => 'canceled_btn',
		)
	);
}

function canceled_btn(){
	$ID = $_GET['ID'];
	// var_dump($ID);

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

	// $json_array[] = $_PUT;
	// $json = json_encode($json_array);
	// echo $json;

	$sql = mysqli_query($conn, "UPDATE wp_posts SET post_status = 'sln-b-canceled' WHERE ID = '$ID' " );

	// if ($conn->query($sql) === TRUE) {
	// 	echo "Record updated successfully";
	// } else {
	// 	echo "Error updating record: " . $conn->error;
	// }
	$conn->close();
}