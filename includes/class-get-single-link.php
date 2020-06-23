<?php

// disable direct file access
if (!defined('ABSPATH')) {

	exit;
}

class GetSingleLink {

	public function do_not_return_if_checked_in_last_x_time() {
		$x_time = 86400;
		$timestamp = time() - $x_time;
		//$timestamp = time();
		return $timestamp;

	}

	public function get_single_link_from_db() {

		global $wpdb;

		$timestamp = $this->do_not_return_if_checked_in_last_x_time();

		$sql = "SELECT single_link FROM list_links WHERE timestamp < %s LIMIT 1";
		//$sql = "SELECT single_link FROM list_links ORDER By timestamp ASC LIMIT 1";
		$sql = $wpdb->prepare($sql, $timestamp);
		//$sql = $wpdb->prepare($sql);
		$result = $wpdb->get_row($sql);

		$single_link_from_db = isset($result->single_link) ? $result->single_link : 'NULL';

		return $single_link_from_db;

	}

	public function get_single_link_from_db_if_exists() {
		$single_link_from_db = $this->get_single_link_from_db();

		if ($single_link_from_db == 'NULL') {
			return false;
		} else {
			return $single_link_from_db;
		}
	}

}