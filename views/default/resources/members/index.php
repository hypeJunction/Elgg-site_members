<?php

$page = elgg_extract('page', $vars);
if (!$page || in_array($page, array('newest', 'alpha', 'popular', 'online'))) {
	$page = 'all';
}

if (elgg_view_exists("resources/members/$page")) {
	echo elgg_view_resource("resources/members/$page", $vars);
	return;
}

$title = elgg_echo("members:title:{$page}");

$content = elgg_view('lists/members', array(
	'filter_context' => $page,
		));
if (!$content) {
	forward('', '404');
}

if (elgg_is_xhr()) {
	echo $content;
	return;
}

$filter = elgg_view('filters/members', array(
	'filter_context' => $page,
		));

$params = array(
	'content' => $content,
	'title' => $title,
	'filter' => $filter,
	'sidebar' => elgg_view('sidebars/members', array(
		'filter_context' => $page,
	)),
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
