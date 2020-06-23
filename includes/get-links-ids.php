<?php

class Run_Check_On_Demand {

	public function get_arr_of_links_ids() {
		global $wpdb;
		$get_ids = "SELECT id FROM list_links";
		$test1 = $wpdb->get_results($get_ids, ARRAY_A);
		return $test1;
	}

	public function GetSingleLinkId() {

		$links_ids_arr = $this->get_arr_of_links_ids();

		if (!empty($links_ids_arr)) {
			foreach ($links_ids_arr as $single_link_id) {
				$single_link_clean = $single_link_id['id'];
				as_schedule_single_action(time(), 'single_link_check3', [
					'single_link_id' => ($single_link_clean)]);
				//echo "<br />" . $single_link_clean;
			}

		}

	}

	public function get_the_single_link_based_on_id($single_link_clean) {

		global $wpdb;

		$get_link = "SELECT single_link FROM list_links WHERE id = $single_link_clean";
		$test1 = $wpdb->get_row($get_link);
		$my_link = $test1->single_link;
		return $my_link;
	}

	public function run_check($single_link_clean) {
		//echo "<br />" . $single_link_clean;

		//update_option($single_link_clean, $single_link_clean);
		$my_link = $this->get_the_single_link_based_on_id($single_link_clean);

		$new_url_1 = new CheckHeadersResponse($my_link);
		$new_url_1->get_header_response();
		$new_url_1->insert_header_reesponse();

	}

}

$run2 = new Run_Check_On_Demand;
add_action('single_link_check3', array($run2, 'run_check'));
//add_shortcode('milos1', array($run2, 'GetSingleLinkId'));
