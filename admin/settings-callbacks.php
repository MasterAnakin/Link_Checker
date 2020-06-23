<?php // MyPlugin - Settings Callbacks

// disable direct file access
if (!defined('ABSPATH')) {

	exit;

}

// callback: login section
function myplugin_callback_section_login() {

	echo '<p>List all links and response codes.</p>';

}

function myplugin_callback_section_admin() {

	if (isset($_POST['test_button'])) {

		$run1 = new ScheduleActionForHeaderResponse;
		$eg_schedule_midnight_log = $run1->schedule_5_seconds_check();
		//eg_schedule_midnight_log();
	}

	if (isset($_POST['test_button_2'])) {

		//run_db_import();
		//unschedule_all_lc_actions();
		run_db_import();
	}

	if (isset($_POST['test_button_3'])) {

		//run_db_import();
		$run2 = new Run_Check_On_Demand;
		add_action('single_link_check2', array($run2, 'run_check'));
		$run2->GetSingleLinkId();
	}

}

function test_button_action() {
	echo "likoovcsopc";
}

// callback: text field
function myplugin_callback_field_text($args) {
/*
global $wpdb;
$rows = $wpdb->get_results("SELECT * FROM list_links");
foreach ($rows as $row) {
echo '
<tr>
<td>' . $row->single_link . '</td>
<td>' . $row->status_code . '</td>
<td>' . date('m/d/Y H:i:s', $row->timestamp) . '</td>
</tr>';}
 */
	global $wpdb;

	$links_count = $wpdb->get_var("SELECT COUNT(*) FROM list_links");

	$total = $links_count;
	$items_per_page = 5;
	$page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
	$offset = ($page * $items_per_page) - $items_per_page;
	$query = "SELECT * FROM list_links";
	$rows = $wpdb->get_results($query . " ORDER BY timestamp LIMIT ${offset}, ${items_per_page}");
	echo '<div class="table" style="display:table;">
  <div class="header" style="display:table-header-group;">
    <div class="cell" style="display:table-cell; width:25%;">Link</div>
    <div class="cell" style="display:table-cell; width:25%;">Status Code</div>
    <div class="cell" style="display:table-cell; width:25%;">Time Last Checked</div>
  </div>';
	foreach ($rows as $row) {
		$da_link = $row->single_link;
		$da_title = $row->status_code;
		$da_date = date('m/d/Y H:i:s', $row->timestamp);
		//$da_date = (null === (date('m/d/Y H:i:s', $row->timestamp))) ?: 'not checked yet';

		echo '

  <div class="rowGroup" style="display:table-row-group;">
    <div class="row" style="display:table-row;">
      <div class="cell" style="display:table-cell; width:60%;">' . $da_link . '</div>
      <div class="cell" style="display:table-cell; width:20%;">' . $da_title . '</div>
      <div class="cell" style="display:table-cell; width:20%;">' . $da_date . '</div>
    </div>
  </div>';

	}
	echo '</div>';
	echo "<div>";
	echo paginate_links(array(
		'base' => add_query_arg('cpage', '%#%'),
		'format' => '',
		'prev_text' => __('&laquo;'),
		'next_text' => __('&raquo;'),
		'total' => ceil($total / $items_per_page),
		'current' => $page,
	));
	echo "</div>";

}

/*
function test_function() {

global $wpdb;

$links_count = $wpdb->get_var("SELECT COUNT(*) FROM list_links");

$total = $links_count;
$post_per_page = 2;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset = ( $page * $post_per_page ) - $post_per_page;

$latestposts = $wpdb->get_results("SELECT * FROM list_links");

foreach ($latestposts as $row) {
$da_link = $row->single_link;
$da_title = $row->status_code;
$da_date = date('m/d/Y H:i:s', $row->timestamp);

echo '
<div class="ldapost">
<h2 class="lheader"><a href="'.$da_link.'">'.$da_title.'</a></h2>
<span class="ldate">'.$da_date.'</span>
</div>
';
}

echo '<div class="pagination">';
echo paginate_links( array(
'base' => add_query_arg( 'cpage', '%#%' ),
'format' => '',
'prev_text' => __('&laquo;'),
'next_text' => __('&raquo;'),
'total' => ceil($total / $post_per_page),
'current' => $page,
'type' => 'list'
));
echo '</div>';

 */