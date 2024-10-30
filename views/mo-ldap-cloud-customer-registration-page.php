<?php
/**
 * Display customer registration page.
 *
 * @package miniOrange_LDAP_AD_Cloud_Integration
 * @subpackage Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

update_option( 'mo_ldap_new_registration', 'true' );
$current_wp_user = wp_get_current_user();

?>


<div class="mo_ldap_cloud_account_box">
	<div>
	<div class="mo_ldap_cloud_account_box_container" >
		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'default' ), $request_uri ) ); ?>" class="mo_ldap_cloud_view_faq_page_anchor mo_cloud_ldap_back_btn mo_ldap_cloud_plugin_config_back_btn mo_ldap_cloud_unset_link_affect"><span><img src="<?php echo esc_url( MO_LDAP_CLOUD_IMAGES . 'back.svg' ); ?>" height="10px" width="15px"></span> Plugin Config</a>
	</div>
	<div class="mo_ldap_cloud_registration_info">
		<div>
			<img src="<?php echo esc_url( MO_LDAP_CLOUD_IMAGES . 'registration.svg' ); ?>" width="70%">
		</div>
		<div class="mo_ldap_cloud_popup_page_para mo_ldap_cloud_register_container">Why should I register?</div>
		<div class="mo_ldap_cloud_registration_para">
			You should register so that in case you need help, we can help you with step by step
			instructions. We support all known directory systems like Active Directory, OpenLDAP, JumpCloud etc.
			<strong>You will also need a miniOrange account to upgrade to the premium version of the plugins.</strong> We do not store any information except the email that you will use to register with us.
		</div>
	</div>
  </div>

	<div class="mo_ldap_cloud_register_box">
		<div class="mo_ldap_cloud_popup_page_para mo_ldap_cloud_registration_heading">Register with miniOrange</div>
		<div>
			<form name="mo_ldap_registration_page" id="mo_ldap_registration_page" method="post" action="">
				<?php
				 wp_nonce_field( 'mo_ldap_cloud_register_nonce' );
				$server_name = ! empty( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
				?>
				<input type="hidden" name="option" value="mo_ldap_cloud_register_customer"/>
				<div class="mo_ldap_cloud_inline_fields">
					<div class="trial_page_input_email mo_ldap_cloud_user_report_toggle_container" >
						<label class="mo_ldap_cloud_label mo_ldap_input_label_text" for="mo_ldap_cloud_company">Website/Company</label>
						<input class="mo_ldap_cloud_customer_registration_attr_input mo_ldap_cloud_email_pop_up_input_field" id="mo_ldap_cloud_company" type="text" name="company" required placeholder="Company Name" value="<?php echo isset( $_SERVER['SERVER_NAME'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) ) : ''; ?>"/>
					</div>
					<div class="trial_page_input_email mo_ldap_cloud_user_report_toggle_container">
						<label class="mo_ldap_cloud_label mo_ldap_input_label_text" for="mo_ldap_cloud_register_phone">Telephone Number</label>
						<input  class="mo_ldap_cloud_customer_registration_attr mo_ldap_cloud_email_pop_up_input_field" type="text" name="register_phone" id="mo_ldap_cloud_register_phone" placeholder="Enter your phone number" value="<?php echo esc_attr( get_option( 'mo_ldap_admin_phone' ) ); ?>"/>
					</div>
				</div>
				<div class="trial_page_input_email">
					<label class="mo_ldap_cloud_label mo_ldap_input_label_text" for="mo_ldap_cloud_register_email">Email</label>
					<input id="mo_ldap_cloud_register_email" class="mo_ldap_cloud_customer_registration_attr_input mo_ldap_cloud_email_pop_up_input_field" type="email" name="email" required placeholder="person@example.com" value="<?php echo esc_attr( $current_wp_user->user_email ); ?>"/>
				</div>
				<div class="trial_page_input_email">
					<label class="mo_ldap_cloud_label mo_ldap_input_label_text" for="mo_ldap_cloud_register_password">Password</label>
					<input id="mo_ldap_cloud_register_password" class="mo_ldap_cloud_customer_registration_attr_input mo_ldap_cloud_email_pop_up_input_field" required type="password" name="password" placeholder="Choose your password (Min. length 6)" minlength="6" pattern="^[(\w)*(!@#$.%^&*-_)*]+$" title="Minimum 6 characters should be present. Maximum 15 characters should be present. Only following symbols (!@#.$%^&*) should be present."/>
				</div>
				<div class="trial_page_input_email">
					<label class="mo_ldap_cloud_label mo_ldap_input_label_text" for="mo_ldap_cloud_register_confirmpassword">Confirm Password</label>
					<input id="mo_ldap_cloud_register_confirmpassword" class="mo_ldap_cloud_customer_registration_attr_input mo_ldap_cloud_email_pop_up_input_field" required type="password" name="confirmPassword" placeholder="Choose your password (Min. length 6)" minlength="6" pattern="^[(\w)*(!@#$.%^&*-_)*]+$" title="Minimum 6 characters should be present. Maximum 15 characters should be present. Only following symbols (!@#.$%^&*) should be present."/>
				</div>
				<div class="mo_ldap_cloud_trial_page_input_description">
					<p class="mo_ldap_cloud_label mo_ldap_input_label_text">Use case</p>
					<textarea cols="40" rows="5" name="usecase" placeholder="Write about your usecase." class="mo_ldap_cloud_customer_registration_attr_input_txt_area mo_ldap_cloud_email_pop_up_input_field mo_ldap_cloud_trial_page_input_email_text_tem"></textarea>
				</div>
				<div class="mo_ldap_cloud_reg_form_bottom_container">
					<input type="submit" name="submit" value="Register" class="mo_ldap_cloud_reg_button mo_ldap_cloud_save_user_mapping mo_ldap_cloud_save_user_mapping_temp"/>
					<span>Trouble in registering account? click <a class="mo_ldap_cloud_reg_from_anchor" href="https://www.miniorange.com/businessfreetrial" target="_blank">here</a> for more info.</span>
					<hr style="width:80%"><br>
					<strong class="mo_ldap_cloud_reg_goto_login_page" >Already have an account? <a class="mo_ldap_cloud_goto_login_anchor" id="mo_ldap_cloud_goto_login">Login</a></strong>
				</div>
			</form>
		</div>
		<form name="f1" method="post" action="" id="mo_ldap_cloud_goto_login_form">
			<?php wp_nonce_field( 'mo_ldap_cloud_goto_login_nonce' ); ?>
			<input type="hidden" name="option" value="mo_ldap_cloud_goto_login"/>
		</form>
	</div>
	<script>
	jQuery('#mo_ldap_cloud_goto_login').click(function () {
		jQuery('#mo_ldap_cloud_goto_login_form').submit();
	});
</script>

</div>

