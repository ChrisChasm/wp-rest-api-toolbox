<?php

require_once getcwd() . '/vendor/autoload.php';

global $_tests_dir;
$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/rest-api-toolbox.php';
	require '/tmp/wordpress/wp-content/plugins/rest-api/plugin.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';
require dirname( dirname( __FILE__ ) ) . '/tests/base-test.php';

global $wp_rest_server;
if ( ! is_object( $wp_rest_server ) ) {
	$wp_rest_server_class = apply_filters( 'wp_rest_server_class', 'WP_REST_Server' );
	$wp_rest_server = new $wp_rest_server_class;
	do_action( 'rest_api_init', $wp_rest_server );
}
