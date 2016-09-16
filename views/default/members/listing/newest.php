<?php

$params = $vars;

$params['show_search'] = true;
$params['show_sort'] = false;

$params['sort'] = 'time_created::desc';

echo elgg_view('lists/users', $params);