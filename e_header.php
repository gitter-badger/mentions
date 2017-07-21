<?php
if ( ! defined('e107_INIT')) {
	exit;
}
if (USER_AREA && USER) {

	$libPref = e107::getPlugPref('mentions', 'use_global_path');

	if ($libPref) {
		echo '<!-- Debug: Mentions - Global Libs Loaded or NOT? :-\ why? -->';
		e107::library('load', 'jQuery.Caret.js');
		e107::library('load', 'jQuery.At.js');
	} else {
		e107::css('mentions', 'js/jquery.atwho.css');
		e107::js('mentions', 'js/jquery.caret.js', 'jquery');
		e107::js('mentions', 'js/jquery.atwho.js', 'jquery');
	}

	$pluginPath = e_PLUGIN_ABS . 'mentions/';

	$mentionsSettings = ['path'     => $pluginPath,
	                     'At.js'    => ['minLen' => 1, 'maxLen' => 15],
	                     'Caret.js' => []];

	e107::js('footer', '{e_PLUGIN}mentions/js/mentions.js', 'jquery');
	e107::js('settings', ['mentions' => $mentionsSettings]);
}