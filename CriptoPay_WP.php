<?php
/*
Plugin Name: CriptoPay_Donaciones_WP
Plugin URI: https://cripto-pay.com/api
Description: Plugin para la integración de donaciones a las cuentas de cripto-pay.com
Author: CRIPTOPAY
Version: 0.1
Author URI: https://cripto-pay.com/api
*/

define("CP_DON_PLUGINPATH", realpath(dirname(__FILE__) ));
define("CP_DON_PLUGINBASENAME", plugin_dir_url( __FILE__ ));
define("CP_PLUGIN_URL",plugin_dir_url( __FILE__ ));

//register_activation_hook( __FILE__, array( 'CP_DON_core', 'Plugin_Activar' ) );
//register_deactivation_hook( __FILE__, array( 'CP_DON_core', 'Plugin_Desactivar' ) );

require_once(CP_DON_PLUGINPATH."/inc/CriptoPay_PHP/autoload.php");
require_once(CP_DON_PLUGINPATH."/inc/core.php");