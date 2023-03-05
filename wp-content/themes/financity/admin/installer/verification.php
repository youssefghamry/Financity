<?php

	define('FINANCITY_ITEM_ID', 20757434);
	define('FINANCITY_PURCHASE_VERFIY_URL', 'https://goodlayers.com/licenses/wp-json/verify/purchase_code'); 
	define('FINANCITY_PLUGIN_VERSION_URL', 'https://goodlayers.com/licenses/wp-json/version/plugin');
	define('FINANCITY_PLUGIN_UPDATE_URL', 'https://goodlayers.com/licenses/wp-content/plugins/goodlayers-verification/download/');
	
	// define('FINANCITY_PURCHASE_VERFIY_URL', 'http://localhost/financity/wp-json/verify/purchase_code'); 
	// define('FINANCITY_PLUGIN_VERSION_URL', 'http://localhost/financity/wp-json/version/plugin'); 
	// define('FINANCITY_PLUGIN_UPDATE_URL', 'http://localhost/Gdl%20Theme/plugins/goodlayers-verification/download/');

	if( !function_exists('financity_is_purchase_verified') ){
		function financity_is_purchase_verified(){
			$purchase_code = financity_get_purchase_code();
			return empty($purchase_code)? false: true;
		}
	}
	if( !function_exists('financity_get_purchase_code') ){
		function financity_get_purchase_code(){
			return get_option('envato_purchase_code_' . FINANCITY_ITEM_ID, '');
		}
	}
	if( !function_exists('financity_get_download_url') ){
		function financity_get_download_url($file){
			$download_key = get_option('financity_download_key', '');
			$purchase_code = financity_get_purchase_code();
			if( empty($download_key) ) return false;

			return add_query_arg(array(
				'purchase_code' => $purchase_code,
				'download_key' => $download_key,
				'file' => $file
			), FINANCITY_PLUGIN_UPDATE_URL);
		}
	}

	# delete_option('envato_purchase_code_' . FINANCITY_ITEM_ID);
	# delete_option('financity_download_key');
	if( !function_exists('financity_verify_purchase') ){
		function financity_verify_purchase($purchase_code, $register){
			$response = wp_remote_post(FINANCITY_PURCHASE_VERFIY_URL, array(
				'body' => array(
					'register' => $register,
					'item_id' => FINANCITY_ITEM_ID,
					'website' => get_site_url(),
					'purchase_code' => $purchase_code
				)
			));

			if( is_wp_error($response) || wp_remote_retrieve_response_code($response) != 200 ){
				throw new Exception(wp_remote_retrieve_response_message($response));
			}

			$data = json_decode(wp_remote_retrieve_body($response), true);
			if( $data['status'] == 'success' ){
				update_option('envato_purchase_code_' . FINANCITY_ITEM_ID, $purchase_code);
				update_option('financity_download_key', $data['download_key']);
				return true;
			}else{
				update_option('envato_purchase_code_' . FINANCITY_ITEM_ID, '');
				update_option('financity_download_key', '');

				if( !empty($data['message']) ){
					throw new Exception($data['message']);
				}else{
					throw new Exception(esc_html__('Unknown Error', 'financity'));
				}
				
			}

		} // financity_verify_purchase
	}

	// delete_option('financity_daily_schedule');
	// delete_option('financity-plugins-version');
	add_action('init', 'financity_admin_schedule');
	if( !function_exists('financity_admin_schedule') ){
		function financity_admin_schedule(){
			if( !is_admin() ) return;

			$current_date = date('Y-m-d');
			$daily_schedule = get_option('financity_daily_schedule', '');
			if( $daily_schedule != $current_date ){
				update_option('financity_daily_schedule', $current_date);
				do_action('financity_daily_schedule');
			}
		}
	}

	# update version from server
	add_action('financity_daily_schedule', 'financity_plugin_version_update');
	if( !function_exists('financity_plugin_version_update') ){
		function financity_plugin_version_update(){
			$response = wp_remote_get(FINANCITY_PLUGIN_VERSION_URL);

			if( !is_wp_error($response) && !empty($response['body']) ){
				update_option('financity-plugins-version', json_decode($response['body'], true));
			}
		}
	}