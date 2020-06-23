<?php
// disable direct file access
if (!defined('ABSPATH')) {

	exit;
}

class ScheduleActionForHeaderResponse {

/**
 * Schedule an action with the hook 'eg_midnight_log' to run at midnight each day
 * so that our callback is run then.
 */

	public function schedule_5_seconds_check() {
		if (false === as_next_scheduled_action('schedule_5_seconds')) {
			as_schedule_recurring_action(strtotime('now'), 5, 'schedule_5_seconds');
		}
	}

	public function unschedule_all_lc_actions() {
		as_unschedule_all_actions('schedule_5_seconds');
	}

}

function run_action_data() {

	get_results_2();
}
add_action('schedule_5_seconds', 'run_action_data');

/*
// disable direct file access
if (!defined('ABSPATH')) {

exit;
}

class ScheduleActionForHeaderResponse {

public function eg_schedule_midnight_log() {
if (false === as_next_scheduled_action('eg_midnight_log_7')) {
as_schedule_recurring_action(strtotime('now'), 5, 'eg_midnight_log_7');
}
}

public function unschedule_all_lc_actions() {
as_unschedule_all_actions('eg_midnight_log_7');
}

}

function eg_log_action_data() {

get_results_2();
}
add_action('eg_midnight_log_7', 'eg_log_action_data');

 */