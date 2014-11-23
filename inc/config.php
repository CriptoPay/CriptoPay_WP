<?php

define("CURRENTURL", top_current_page());
define("CP_DONACIONES_TEXTDOMAIN", "CriptoPay_Donaciones_WP");
define("CP_TEXTDOMAIN","criptopay");
define("SETTINGSURL", top_settings_url());

// Settings Array
$CP_Donaciones_top_settings = array(
	'name' 	=> "Donaciones Crpto-Pay.com",
	'slug' 	=> "Bitcoin & Altcoin Donaciones",
);

function top_current_page(){
	$pageURL = 'http';
	if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if (@$_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= @$_SERVER["SERVER_NAME"].":".@$_SERVER["SERVER_PORT"].@$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= @$_SERVER["SERVER_NAME"].@$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function top_settings_url(){
	$pageURL = admin_url('admin.php?page=CriptoPay_Donaciones_WP');
	return str_replace(":80","",$pageURL);
}