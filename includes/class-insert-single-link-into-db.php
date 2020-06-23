<?php

// disable direct file access
if (!defined('ABSPATH')) {

	exit;

}

class InsertSingleLinkIntoDB {

	public function __construct($page_link_single) {
		$this->page_link_single = $page_link_single;
	}

//insert single link based on the array_order option - key
	public function insert_single_link() {

		$single_link = $this->page_link_single;

		///$single_link = $page_link_single;

		global $wpdb;

		$sql = "INSERT INTO list_links (single_link) SELECT * FROM (SELECT %s) AS tmp WHERE NOT EXISTS ( SELECT single_link FROM list_links WHERE single_link = %s ) LIMIT 1";

		$sql = $wpdb->prepare($sql, $single_link, $single_link);

		$result = $wpdb->query($sql);

	}

}

function run_db_import() {

	$new_insert = new GetAllLinksFromSite;
	$links_arr = $new_insert->get_all_links();

	foreach ($links_arr as $page_link_single) {

		$milos = new InsertSingleLinkIntoDB($page_link_single);
		$milos->insert_single_link();
	}
}

function schedule_next_day_link_check() {
	if (false === as_next_scheduled_action('get_new_links_4am')) {
		as_schedule_recurring_action(strtotime('tomorrow 4am'), DAY_IN_SECONDS, 'get_new_links_4am');
	}
}

function run_check_data() {

	run_db_import();
}
add_action('get_new_links_4am', 'run_check_data');
//schedule_next_day_link_check();
//$run22 = new InsertSingleLinkIntoDB;
//$run22->schedule_next_day_link_check();

add_shortcode('shutdown', 'schedule_next_day_link_check');
