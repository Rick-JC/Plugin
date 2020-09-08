<?php
if ( ! defined( 'ABSPATH' ) ) {
    return;
}
add_filter( 'incompatible_sql_modes', function( $incompatible_modes ) {
    $incompatible_modes[] = 'ANSI';
    $incompatible_modes[] = 'ANSI_QUOTES';
    $incompatible_modes[] = 'ONLY_FULL_GROUP_BY';
    
    // if errors keep popping up try disabling strict!
    /*$incompatible_modes[] = 'STRICT_ALL_TABLES';
    $incompatible_modes[] = 'NO_ZERO_IN_DATE';
    $incompatible_modes[] = 'NO_ZERO_DATE';
    $incompatible_modes[] = 'ERROR_FOR_DIVISION_BY_ZERO';*/
    return $incompatible_modes;
} );
$GLOBALS['wpdb']->set_sql_mode();

if(!function_exists('is_ssl') || !is_ssl()) {
    foreach (['HTTP_CF_VISITOR', 'HTTP_X_FORWARDED_PROTO'] as $sKey) {
        if (isset($_SERVER[$sKey]) && (strpos($_SERVER[ $sKey ], 'https') !== false )) {
            $_SERVER['HTTPS'] = 'on';
            break;
        }
    }
}