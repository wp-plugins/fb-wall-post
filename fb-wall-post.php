<?php
/*
Plugin Name: FB Wall Post
Plugin URI: http://www.netattingo.com/
Description: This plugin helps to display latest feeds of your Facebook page on the site.
Author: NetAttingo Technologies
Version: 1.0.0
Author URI: http://www.netattingo.com/
*/

define('WP_DEBUG',true);
define('REGISTRATION_DIR', plugin_dir_path(__FILE__));
define('REGISTRATION_URL', plugin_dir_url(__FILE__));
define('REGISTRATION_PAGE_DIR', plugin_dir_path(__FILE__).'pages/');
define('REGISTRATION_INCLUDE_URL', plugin_dir_url(__FILE__).'includes/');

//Include menu and assign page
function fwp_plugin_menu() {
    $icon = REGISTRATION_URL. 'includes/icon.png';
	add_menu_page("FB Wall Post", "FB Wall Post", "administrator", "fb-page-setting", "fwp_plugin_pages", $icon ,30);
	add_submenu_page("fb-page-setting", "About Us", "About Us", "administrator", "about-us", "fwp_plugin_pages");
}
add_action("admin_menu", "fwp_plugin_menu");

function fwp_plugin_pages() {

   $itm = REGISTRATION_PAGE_DIR.$_GET["page"].'.php';
   include($itm);
}

//Include css and jquery
function fwp_js_css_add_init() {
    wp_enqueue_style("fwp_css_and_js", plugins_url('includes/front-style.css',__FILE__ )); 
	wp_register_script( 'fwp_css_and_js', plugins_url('includes/fbpagepost.js',__FILE__ ));
	wp_enqueue_script('fwp_css_and_js');
}
add_action( 'wp_enqueue_scripts', 'fwp_js_css_add_init' );


//add admin css
function fwp_admin_css() {
  wp_register_style('admin_css', plugins_url('includes/admin-style.css',__FILE__ ));
  wp_enqueue_style('admin_css');
}
add_action( 'admin_init','fwp_admin_css');


//Netgo Shortcode  list view
add_shortcode( 'facebook-feed-list', 'fwp_shortcode_function_list_view' );
function fwp_shortcode_function_list_view( $atts ) {
	
	require_once "includes/fb/facebook.php"; //include facebook library
	$config = array();
    $config['appId'] = get_option('netgo_facebook_app_id'); //Facebook App Id
	$config['secret'] =  get_option('netgo_facebook_secret_key'); //Facebook Secret Key
    $pageid =  get_option('netgo_facebook_page_id'); //Facebook Page Id
	 
	$config['fileUpload'] = true; 
	$facebook = new Facebook($config);
	//trigger exception in a "try" block
	try { 
	$pagefeed = $facebook->api("/" . $pageid . "/posts?fields=attachments,id,object_id,message,description,full_picture,source,created_time");
	 if(!empty($pagefeed))
		{
		  $flag=1;
		?>
		<ul id="fbfeed" class="fb-feed-list-view">
			   <?php
				   foreach($pagefeed['data'] as $post):
												
				?>
					 <li  id="<?php echo $flag; ?><?php echo ($flag%4); ?>">
						 <div class="product_box">
							  <div class="img_box">
							   <a target="_blank" href="<?php echo $post['attachments']['data'][0]['url']; ?>">
							  <img alt="" src="<?php   echo  $post['full_picture']; ?>">
							  </a>
							  </div>
							 <div class="content"> 
								 <div class="contant_box1"> <?php   echo  $post['message']; ?></div>
								 <div class="date_box"><?php echo date("d/M/Y H:i", (strtotime($post['created_time']))) ?>  </div>
							 </div>
						 </div>
					</li>
					<?php
					$flag++;
				  endforeach;  
		 ?>
		 </ul>  
		 
			 
		 <?php
		 }else
		  {
		 ?>
		 <div class="nopost"><h3>No Post Found!</h3></div> 
		 <?php
		 }
	}
	catch(Exception $e) {
	  echo '<b>Message:</b> Invalid "Facebook App Id" ,"Facebook Secret Key" or "Facebook Page Id" ';
	}
	
	?>
	<?php	
}

//Netgo Shortcode  grid view
add_shortcode( 'facebook-feed-grid', 'fwp_shortcode_function_grid_view' );
function fwp_shortcode_function_grid_view( $atts ) {
	
	require_once "includes/fb/facebook.php"; //include facebook library
	$config = array();
    $config['appId'] = get_option('netgo_facebook_app_id'); //Facebook App Id
	$config['secret'] =  get_option('netgo_facebook_secret_key'); //Facebook Secret Key
    $pageid =  get_option('netgo_facebook_page_id'); //Facebook Page Id
	 
	$config['fileUpload'] = true; 
	$facebook = new Facebook($config);
	//trigger exception in a "try" block
	try {
    $pagefeed = $facebook->api("/" . $pageid . "/posts?fields=attachments,id,object_id,message,description,full_picture,source,created_time");
	if(!empty($pagefeed))
		{
		  $flag=1;
		?>
		<ul id="fbfeed" class="fb-feed-grid-view">
			   <?php
				   foreach($pagefeed['data'] as $post):
												
				?>
					 <li  id="<?php echo $flag; ?><?php echo ($flag%4); ?>">
						 <div class="product_box">
							  <div class="img_box">
							   <a target="_blank" href="<?php echo $post['attachments']['data'][0]['url']; ?>">
							  <img alt="" src="<?php   echo  $post['full_picture']; ?>">
							  </a>
							  </div>
							 <div class="content"> 
								 <div class="contant_box1"> <?php   echo  $post['message']; ?></div>
								 <div class="date_box"><?php echo date("d/M/Y H:i", (strtotime($post['created_time']))) ?>  </div>
							 </div>
						 </div>
					</li>
					<?php
					$flag++;
				  endforeach;  
		 ?>
		 </ul> 
		 <div style="clear:both;"></div>
		<script>
			jQuery(document).ready(function(){
			  setview(1);
			});
		</script>
         		 
		 <?php
		 }else
		  {
		 ?>
		 <div class="nopost"><h3>No Post Found!</h3></div> 
		 <?php
		 }	
	}
    //catch exception
	catch(Exception $e) {
	  echo '<b>Message: </b> Invalid "Facebook App Id" ,"Facebook Secret Key" or "Facebook Page Id"';
	}
	?>
	
	<?php		
}

?>