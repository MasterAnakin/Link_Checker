<?php

// disable direct file access
if (!defined('ABSPATH')) {

	exit;
}

class CountCheck {

	public function links_total_count() {

		global $wpdb;
		$links_count = $wpdb->get_var("SELECT COUNT(*) FROM list_links");

		return $links_count;

	}

	public function set_the_count() {

		$count_total = $this->links_total_count();

		if (!get_option('links_count_position')) {
			add_option('links_count_position', 1);
		}

		$ik = get_option('links_count_position');

		if ($ik > $count_total) {
			update_option('links_count_position', 1);
			return false;
		} else {
			update_option('links_count_position', $ik + 1);
			return true;
		}

	}
	public function check_the_count() {
		if ($this->set_the_count() === true) {
			echo "true";
		} else {
			$ll = new ScheduleActionForHeaderResponse;
			$ll->unschedule_all_lc_actions();
			echo "false";
		}
	}
}

//add_shortcode('shutdown', 'tamara');
//$k = (get_option('links_count_position'));
//echo "<br />" . $k;
/*
function tamara() {
$lol = new CountCheck;
if ($lol->check_the_count() === true) {
echo "true";
} else {
echo "false";
}

$k = (get_option('links_count_position'));
echo "<br />" . $k;
}
 */

/*
if (check_the_count() === false) {
unschedule_all_lc_actions();
}
 */

/*
if (!get_option('links_count_total')) {
add_option('links_count_total', links_count();
} else {
update_option('links_arr', links_count_total);
}
 */
