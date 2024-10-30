<?php
/**
 * Display authentication logs page.
 *
 * @package miniOrange_LDAP_AD_Cloud_Integration
 * @subpackage Views
 */

use MO_LDAP_CLOUD\Utils\Mo_LDAP_Cloud_Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mo_ldap_small_layout">
	<h2 class="mo_ldap_left">User Report</h2>
	<div class="mo_ldap_cloud_user_report_toggle" >
		<div class="mo_ldap_cloud_user_report_toggle_container">
			<form name="f" id="user_report_form" method="post" action="">
				<?php wp_nonce_field( 'cloud_user_report_logs' ); ?>
				<input type="hidden" name="option" value="cloud_user_report_logs" />
				<input class="toggle_button" type="checkbox" id="mo_ldap_cloud_user_report_log" name="mo_ldap_cloud_user_report_log" value="1" <?php checked( esc_attr( strcasecmp( get_option( 'mo_ldap_cloud_local_user_report_log' ), '1' ) === 0 ) ); ?> /><label class="toggle_button_label" for="mo_ldap_cloud_user_report_log"></label><span class="mo_ldap_cloud_toggle_label"><b>Log Authentication Requests </b></span>
			</form><br>
		</div>
		<?php
		$log_user_reporting = get_option( 'mo_ldap_cloud_local_user_report_log' );
		$user_logs_empty    = Mo_LDAP_Cloud_Utils::mo_ldap_is_user_logs_empty();

		if ( strcasecmp( $log_user_reporting, '1' ) === 0 && ! $user_logs_empty ) {
			global $wpdb;
			$wp_user_report_data_cache = wp_cache_get( 'mo_ldap_cloud_user_report_data_cache' );
			if ( $wp_user_report_data_cache ) {
				$log_reports = $wp_user_report_data_cache;
			} else {
				$log_reports = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}cloud_user_report" ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.DirectQuery -- Fetching data from a custom table.
				wp_cache_set( 'mo_ldap_cloud_user_report_data_cache', $log_reports );
			}
			?>

			<script type="text/javascript">
				var result_object = <?php echo wp_json_encode( $log_reports ); ?>;
			</script>
			<div class="mo_ldap_cloud_user_report_button_container" >
				<form method="post" action="" name="mo_ldap_cloud_authentication_report" class="mo_ldap_cloud_user_export_button">
					<?php wp_nonce_field( 'mo_ldap_cloud_authentication_report' ); ?>
					<input type="hidden" name="option" value="mo_ldap_cloud_authentication_report"/>
					<input type="button" class="mo_ldap_cloud_save_user_mapping"  onclick="document.forms['mo_ldap_cloud_authentication_report'].submit();" value= "Export Report" />
				</form>
				<form method="post" action="" name="mo_ldap_cloud_clear_authentication_report">
					<?php wp_nonce_field( 'mo_ldap_cloud_clear_authentication_report' ); ?>
					<input type="hidden" name="option" value="mo_ldap_cloud_clear_authentication_report"/>
					<input type="button" class="mo_ldap_cloud_save_user_mapping"  onclick="document.forms['mo_ldap_cloud_clear_authentication_report'].submit();" value= "Clear Logs" />
					<br>
				</form>
			</div>
		</div>
		<br><br>
		<div>
			<label for="statusFilter">Filter by Status:</label>
			<select id="statusFilter" class="form-control status-dropdown">
				<option value="">All</option>
				<option value="success">SUCCESS</option>
				<option value="error, INVALID_CREDENTIALS, TEST_CONNECTION_ERROR, WP_ERROR, OPENSSL_ERROR, LOGIN_ERROR, LICENSE_EXPIRED">ERROR</option>
			</select>
			<table id="mo_ldap_cloud_auth_reports" class="display">
				<thead class="mo_ldap__cloud_user_report_table_header">
					<tr>
						<th>Sr No.</th>
						<th>Username</th>
						<th>Timestamp</th>
						<th>Status</th>
						<th>Additional Information</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$index = 1;
					foreach ( $log_reports as $log ) {
						?>
						
						<tr>
							<td><?php echo esc_html( $directory_server_value ); ?></td>
							<td><?php echo esc_html( $log->user_name ); ?></td>
							<td><?php echo esc_html( $log->time ); ?></td>
							<td>
							<?php
							if ( 'SUCCESS' === $log->ldap_status ) {
								?>
								<div class="mo_ldap_cloud_log_status mo_ldap_cloud_log_status_success">
									<img src="<?php echo esc_url( MO_LDAP_CLOUD_IMAGES . 'success.png' ); ?>" height="20px" width="20px">
								<?php echo esc_html( $log->ldap_status ); ?>
								</div>
								<?php
							} else {
								?>
								<div class="mo_ldap_cloud_log_status mo_ldap_cloud_log_status_error">
									<img src="<?php echo esc_url( MO_LDAP_CLOUD_IMAGES . 'round-error.png' ); ?>" height="20px" width="20px">
								<?php echo esc_html( $log->ldap_status ); ?>
								</div>
								<?php
							}
							?>
							</td>		
							<td><?php echo wp_kses( $log->ldap_error, MO_LDAP_CLOUD_ESC_ALLOWED ); ?></td>
						</tr>
						<?php
						$index++;
					}
					?>
				</tbody>
			</table>
			</div>			
			<?php
		} else {
			echo '</div> <br> No audit logs are available currently. <br><br>';
		}
		?>
	</div>
	<script>

		<?php
		if ( ! $is_customer_registered ) {
			?>
			jQuery( document ).ready(function() {
				jQuery("#user_report_form :input").prop("disabled", true);
			});
			<?php
		}
		?>

		jQuery('#mo_ldap_cloud_user_report_log').change(function() {
			jQuery('#user_report_form').submit();
		});
		jQuery('#mo_ldap_cloud_keep_user_report_log').change(function() {
			jQuery('#keep_user_report_form_on_uinstall').submit();
		});

	</script>
</div>
</div>
