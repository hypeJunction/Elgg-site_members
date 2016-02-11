<?php

if (elgg_is_active_plugin('user_sort')) {
	return;
}

echo elgg_view('members/sidebar', $vars);