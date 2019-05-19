<?php
add_role(
	'reviewSubm',
	__('Review submissions'),
	array(
		'read'                   => true, // true allows this capability
		'edit_posts'             => true,
		'manage_network_plugins' => false,
	)
);
/*
=======================
uses

[EventSubmission filter_by="past" per_page=3][/EventSubmission]
[EventSubmission filter_by="upcoming"  per_page=3 ][/EventSubmission]

 */
function EventSubmissionFunc($atts, $content = null) {
	global $wpdb, $paged, $max_num_pages;

	$table_name = $wpdb->prefix . 'submissions';

	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	//echo $paged;
	$post_per_page = $atts['per_page'] ? $atts['per_page'] : 2;

	$offset = ($paged - 1) * $post_per_page;

	/* Determine the total of results found to calculate the max_num_pages
	     for next_posts_link navigation */

	if ($atts['filter_by'] == '') {
		return '<div class="alert-danger"> please add attribute called (filter_by="past") or , (filter_by="upcoming")  to get data correctly </div> ';
	}

	if ($atts['filter_by'] == 'past') {

		$sqlTotal_past = $wpdb->get_var("SELECT count(*) FROM $table_name where event_start_date IS NOT null AND event_start_date < now() AND Approval = 1");
		$max_num_pages = ceil($sqlTotal_past / $post_per_page);

		$UserSubmissions = $wpdb->get_results("SELECT id,event_organizer,
			event_sponsor,
			event_title,
			event_start_date,
			event_duration,
			event_summary_type,
			event_related_report,
			event_audience_target,
			event_report_author,
			event_report_organization,
			event_report_title,
			event_report_abstract,
			event_website,
			event_keywords FROM $table_name where event_start_date IS NOT null AND event_start_date < now() AND Approval = 1 LIMIT {$offset} , {$post_per_page}; ");

	}

	if ($atts['filter_by'] == 'upcoming') {

		$sqlTotal_past = $wpdb->get_var("SELECT count(*) FROM $table_name where event_start_date IS NOT null AND event_start_date > now() AND Approval = 1");
		$max_num_pages = ceil($sqlTotal_past / $post_per_page);

		$UserSubmissions = $wpdb->get_results("SELECT id,event_organizer,
			event_sponsor,
			event_title,
			event_start_date,
			event_duration,
			event_summary_type,
			event_related_report,
			event_audience_target,
			event_report_author,
			event_report_organization,
			event_report_title,
			event_report_abstract,
			event_website,
			event_keywords FROM $table_name where event_start_date IS NOT null AND event_start_date > now() AND Approval = 1 LIMIT {$offset} , {$post_per_page};");

	}

	$output = '';

	$output .= '<table class="events_table">

			  <tr class="header">
			    <th>id</th>
			    <th>event_sponsor</th>
			    <th>event_title</th>
			    <th>event_related_report</th>
			    <th>event_start_date</th>
			    <th>event_duration</th>
			    <th>event_summary_type</th>
			    <th>event_audience_target</th>
			    <th>event_report_author</th>
			    <th>event_report_organization</th>
			    <th>event_report_title</th>
			    <th>event_report_abstract</th>
			    <th>event_website</th>
			    <th>event_keywords</th>


			  </tr>';

	foreach ($UserSubmissions as $Submission) {

		$Documents = $wpdb->get_results("SELECT * FROM wp_documents WHERE submission_id = $Submission->id ");

		$documents = "";

		foreach ($Documents as $doc) {

			$url         = $doc->name;
			$filterdName = pathinfo($url, PATHINFO_FILENAME); //file name without extension

			$documents .= "<li> <a href='{$doc->name}'> {$filterdName}</a> </li>";
		}

		$output .= "<tr>";
		$output .= "<td>$Submission->id</td>";
		$output .= "<td>$Submission->event_sponsor</td>";
		$output .= "<td>$Submission->event_title</td>";
		$output .= "<td> Submissions files <ul> $documents </ul> </td>";
		$output .= "<td>$Submission->event_start_date</td>";
		$output .= "<td>$Submission->event_duration</td>";
		$output .= "<td>$Submission->event_summary_type</td>";
		$output .= "<td>$Submission->event_audience_target</td>";
		$output .= "<td>$Submission->event_report_author</td>";
		$output .= "<td>$Submission->event_report_organization</td>";
		$output .= "<td>$Submission->event_report_title</td>";
		$output .= "<td>$Submission->event_report_abstract</td>";
		$output .= "<td>$Submission->event_website</td>";
		$output .= "<td>$Submission->event_keywords</td>";

		$output .= "</tr>";

	}

	$output .= '</table>';
	$big = 999999999; // need an unlikely integer
	$output .= paginate_links(array(
		'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format'  => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total'   => $max_num_pages,
	));
	$output .= '</div>';

	if ($atts['filter_by'] == 'past' || $atts['filter_by'] == 'upcoming') {
		return $output;
	} else {
		return 'please choose past or upcoming in filter_by not ' . $atts['filter_by'] . ' this ' . $atts['filter_by'] . ' not allowed';
	}

}

add_shortcode('EventSubmission', 'EventSubmissionFunc');

/*
=======================
uses

[TrainingSubmission filter_by="past" per_page=3][/TrainingSubmission]
[TrainingSubmission filter_by="upcoming"  per_page=3 ][/TrainingSubmission]

 */
function TrainingSubmissionFunc($atts, $content = null) {

	global $wpdb, $paged, $max_num_pages;

	$table_name = $wpdb->prefix . 'submissions';

	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	$post_per_page = $atts['per_page'] ? $atts['per_page'] : 2;

	$offset = ($paged - 1) * $post_per_page;

	if ($atts['filter_by'] == '') {
		return '<div class="alert-danger"> please add attribute called (filter_by="past") or , (filter_by="upcoming")  to get data correctly </div> ';
	}

	if ($atts['filter_by'] == 'past') {

		$sqlTotal_past = $wpdb->get_var("SELECT count(*) FROM $table_name where training_issued_date IS NOT null AND training_issued_date < now() AND Approval = 1");
		$max_num_pages = ceil($sqlTotal_past / $post_per_page);

		$UserSubmissions = $wpdb->get_results("SELECT id,training_organizer,
			training_title,
			training_provider,
			training_fee,
			training_type,
			training_duration,
			training_description,
			training_issued_date,
			training_website,
			training_keywords FROM $table_name where training_issued_date IS NOT null AND training_issued_date < now() AND Approval = 1 LIMIT {$offset} , {$post_per_page}; ");
	}

	if ($atts['filter_by'] == 'upcoming') {

		$sqlTotal_past = $wpdb->get_var("SELECT count(*) FROM $table_name where training_issued_date IS NOT null AND training_issued_date > now() AND Approval = 1");
		$max_num_pages = ceil($sqlTotal_past / $post_per_page);

		$UserSubmissions = $wpdb->get_results("SELECT id,training_organizer,
			training_title,
			training_provider,
			training_fee,
			training_type,
			training_duration,
			training_description,
			training_issued_date,
			training_website,
			training_keywords FROM $table_name where training_issued_date IS NOT null AND training_issued_date > now() AND Approval = 1 LIMIT {$offset} , {$post_per_page}; ");
	}

	$output = '';

	$output .= '<table class="events_table">';

	$output .= '<tr class="header">
			    <th>id</th>
			    <th>training_title</th>
			    <th>training_organizer</th>
			    <th>documents</th>
			    <th>training_provider</th>
			    <th>training_fee</th>
			    <th>training_type</th>
			    <th>training_duration</th>
			    <th>training_description</th>
			    <th>training_issued_date</th>
			    <th>training_website</th>
			    <th>training_keywords</th>
			  </tr>';

	foreach ($UserSubmissions as $Submission) {

		$Documents = $wpdb->get_results("SELECT * FROM wp_documents WHERE submission_id = $Submission->id ");

		$documents = "";

		foreach ($Documents as $doc) {

			$url         = $doc->name;
			$filterdName = pathinfo($url, PATHINFO_FILENAME); //file name without extension

			$documents .= "<li> <a href='{$doc->name}'> {$filterdName}</a> </li>";
		}

		$output .= "<tr>";
		$output .= "<td>$Submission->id</td>";
		$output .= "<td>$Submission->training_title</td>";
		$output .= "<td>$Submission->training_organizer</td>";
		$output .= "<td> Submissions files <ul> $documents </ul> </td>";
		$output .= "<td>$Submission->training_provider</td>";
		$output .= "<td>$Submission->training_fee</td>";
		$output .= "<td>$Submission->training_type</td>";
		$output .= "<td>$Submission->training_duration</td>";
		$output .= "<td>$Submission->training_description</td>";
		$output .= "<td>$Submission->training_issued_date</td>";
		$output .= "<td>$Submission->training_website</td>";
		$output .= "<td>$Submission->training_keywords</td>";

		$output .= "</tr>";

	}

	$output .= '</table>';
	$big = 999999999; // need an unlikely integer
	$output .= paginate_links(array(
		'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format'  => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total'   => $max_num_pages,
	));
	$output .= '</div>';

	return $output;

}

add_shortcode('TrainingSubmission', 'TrainingSubmissionFunc');

/*
=======================
uses

[count_events_training type="journal"][/count_events_training]

 */
function count_events_trainingFunc($atts, $content = null) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'submissions';
	$types      = ['journal', 'event', 'training'];
	if ($atts['type'] != '') {
		if (in_array($atts['type'], $types)) {

			$type = $atts['type'];

			$Count = $wpdb->get_results("SELECT * FROM $table_name where type = '$type' AND Approval = 1");

			return count($Count);

		} else {
			return "type is not exists , please choose type from this list only('journal','event','training')";
		}
	} else {

		return 'please assign type attrbute like [count_events_training type="journal" ][/count_events_training]';
	}

}

add_shortcode('count_events_training', 'count_events_trainingFunc');

/*
=======================
uses

[submssion_count_all][/submssion_count_all]

 */
function submssion_count_allFunc() {

	global $wpdb;
	$table_name = $wpdb->prefix . 'submissions';

	$Countjournal  = $wpdb->get_results("SELECT * FROM $table_name where type = 'journal' AND Approval = 1");
	$Countevent    = $wpdb->get_results("SELECT * FROM $table_name where type = 'event' AND Approval = 1");
	$Counttraining = $wpdb->get_results("SELECT * FROM $table_name where type = 'training' AND Approval = 1");
	$Countreports  = $wpdb->get_results("SELECT * FROM $table_name where type = 'reports' AND Approval = 1");

	$output = '<ul class="submissions">';

	$output .= "<li><span>" . count($Countjournal) . "</span> Journal article or conference pape Submissions</li>";
	$output .= "<li><span>" . count($Countevent) . "</span> Event or Campaign Submissions</li>";
	$output .= "<li><span>" . count($Counttraining) . "</span> Training Submissions</li>";
	$output .= "<li><span>" . count($Countreports) . "</span> Reports Submissions</li>";

	$output .= '</ul>';

	return $output;

}

add_shortcode('submssion_count_all', 'submssion_count_allFunc');

/*
=======================
uses

[LatestSubmssion type="event" limit=5][/LatestSubmssion]

 */
function LatestSubmssionFunc($atts) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'submissions';
	$type       = !empty($atts['type']) ? $atts['type'] : "event";
	$limit      = !empty($atts['limit']) ? $atts['limit'] : 5;
	$getLatest  = $wpdb->get_results(" SELECT * FROM $table_name WHERE Approval = 1 AND type = '$type' ORDER BY id DESC LIMIT $limit");

	$output = '<div class="container">';
	$output .= '<div class="row">';
	foreach ($getLatest as $key => $submssion) {
		$output .= '<div class="col col-lg-2">';
		$output .= 'the output just print the ids right now';
		$output .= $submssion->id;

		$output .= '</div>';
	}

	$output .= '</div>';
	$output .= '</div>';

	return $output;

}
add_shortcode('LatestSubmssion', 'LatestSubmssionFunc');

/*
=======================
uses

[SubmssionSlider type="event" limit=5][/SubmssionSlider]

 */
function SubmssionSliderFunc($atts) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'submissions';
	$type       = !empty($atts['type']) ? $atts['type'] : "event";
	$limit      = !empty($atts['limit']) ? $atts['limit'] : 5;
	$getLatest  = $wpdb->get_results(" SELECT * FROM $table_name WHERE Approval = 1 AND type = '$type' ORDER BY id DESC LIMIT $limit");

	$output = '<div class="container">';
	$output .= '<div class="row">';
	foreach ($getLatest as $key => $submssion) {
		$output .= '<div class="col col-lg-2">';
		$output .= 'the output just print the ids right now';
		$output .= $submssion->id;

		$output .= '</div>';
	}

	$output .= '</div>';
	$output .= '</div>';

	return $output;

}
add_shortcode('SubmssionSlider', 'SubmssionSliderFunc');

/* ---------------------------------------------------------------------------
 * override function in user registration plugin (my account)
 * ---------------------------------------------------------------------------
 */
if (!function_exists('user_registration_account_navigation')) {
	function user_registration_account_navigation() {

		do_action('user_registration_before_account_navigation');
		?>
<nav class="user-registration-MyAccount-navigation">
	<ul>
		<?php foreach (ur_get_account_menu_items_Override() as $endpoint => $label): ?>

			<li class="<?php echo ur_get_account_menu_item_classes($endpoint); ?>">

				<?php
if ($endpoint == 'my-submssion') {
			?>
					<a href="<?php echo esc_url(url('my-submssion')); ?>"><?php echo esc_html($label); ?></a>
					<?php
} else {
			?>
					<a href="<?php echo esc_url(ur_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
					<?php
}
		?>

			</li>
		<?php endforeach;?>
	</ul>
</nav>
<?php
do_action('user_registration_after_account_navigation');

	}
}

function ur_get_account_menu_items_Override() {
	$endpoints = array(
		'edit-profile'  => get_option('user_registration_myaccount_edit_profile_endpoint', 'edit-profile'),
		'edit-password' => get_option('user_registration_myaccount_change_password_endpoint', 'edit-password'),
		'my-submssion'  => url('my-submssion'),
		'user-logout'   => get_option('user_registration_logout_endpoint', 'user-logout'),

	);

	$items = array(
		'dashboard'     => __('Dashboard', 'user-registration'),
		'edit-profile'  => __('Profile Details', 'user-registration'),
		'edit-password' => __('Change Password', 'user-registration'),
		'my-submssion'  => __('My Submissions', 'user-registration'),
		'user-logout'   => __('Logout', 'user-registration'),
	);

	$user_id       = get_current_user_id();
	$form_id_array = get_user_meta($user_id, 'ur_form_id');
	$form_id       = 0;

	if (isset($form_id_array[0])) {
		$form_id = $form_id_array[0];
	}

	$profile = user_registration_form_data($user_id, $form_id);

	if (count($profile) < 1) {
		unset($items['edit-profile']);
	}

	// Remove missing endpoints.
	foreach ($endpoints as $endpoint_id => $endpoint) {
		if (empty($endpoint)) {
			unset($items[$endpoint_id]);
		}
	}

	return apply_filters('user_registration_account_menu_items', $items);
}