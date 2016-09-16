<?php

$params = $vars;

$params['show_sort'] = false;
$params['show_search'] = true;

$params['sort'] = 'friend_count::desc';

echo elgg_view('lists/users', $params);