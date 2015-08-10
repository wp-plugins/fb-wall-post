<?php
global $wpdb;
//sanitize all post values
$add_opt_submit= sanitize_text_field( $_POST['add_opt_submit'] );
$netgo_facebook_app_id= sanitize_text_field( $_POST['netgo_facebook_app_id'] );
$netgo_facebook_secret_key= sanitize_text_field( $_POST['netgo_facebook_secret_key'] );
$netgo_facebook_page_id= sanitize_text_field( $_POST['netgo_facebook_page_id'] );
$saved= sanitize_text_field( $_POST['saved'] );

if($add_opt_submit!='') { 
    if(isset($netgo_facebook_app_id) ) {
		update_option('netgo_facebook_app_id', $netgo_facebook_app_id);
    }
	if(isset($netgo_facebook_secret_key) ) {
		update_option('netgo_facebook_secret_key', $netgo_facebook_secret_key);
    }
	if(isset($netgo_facebook_page_id) ) {
		update_option('netgo_facebook_page_id', $netgo_facebook_page_id);
    }
	
	if(isset($netgo_facebook_enable_jquery) ) {
		update_option('netgo_facebook_enable_jquery', $netgo_facebook_enable_jquery);
    }
	if($saved==true) {
		
		$message='saved';
	} 
}
?>
  <?php
        if ( $message == 'saved' ) {
		echo ' <div class="added-success"><p><strong>Settings Saved.</strong></p></div>';
		}
   ?>
   
    <div class="wrap netgo-facebook-post-setting">
        <form method="post" id="settingForm" action="">
		<h2><?php _e('Facebook Wall Post Setting','');?></h2>
		<table class="form-table">
		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="netgo_facebook_app_id"><?php _e('Facebook App Id','');?></label>
			</th>
			<td><input type="text" name="netgo_facebook_app_id" size="50" value="<?php echo get_option('netgo_facebook_app_id'); ?>" />
		
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="netgo_facebook_secret_key"><?php _e('Facebook Secret Key','');?></label>
			</th>
			<td><input type="text" name="netgo_facebook_secret_key" size="50" value="<?php echo get_option('netgo_facebook_secret_key'); ?>" />
			
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="netgo_facebook_page_id"><?php _e('Facebook Page Id','');?></label>
			</th>
			<td><input type="text" name="netgo_facebook_page_id" size="50" value="<?php echo get_option('netgo_facebook_page_id'); ?>" />
		
			</td>
		</tr>
		
		
		</table>
		
        <p class="submit">
		<input type="hidden" name="saved"  value="saved"/>
        <input type="submit" name="add_opt_submit" class="button-primary" value="Save Changes" />
		  <?php if(function_exists('wp_nonce_field')) wp_nonce_field('add_opt_submit', 'add_opt_submit'); ?>
        </p>
       </form>
      
    </div>

