<?php
/** Reverse native menu order once, keeping visual and keyboard order aligned. @package Avenor */
defined( 'ABSPATH' ) || exit;

if ( get_option( 'avenor_navigation_order_version' ) ) {
	return;
}
$avenor_menu = get_page_by_path( 'avenor-main', OBJECT, 'wp_navigation' );
if ( ! $avenor_menu ) {
	return;
}
$avenor_result = wp_update_post(
	array(
		'ID'           => $avenor_menu->ID,
		'post_content' => serialize_blocks( array_reverse( parse_blocks( $avenor_menu->post_content ) ) ),
	),
	true
);
if ( is_wp_error( $avenor_result ) ) {
	throw new RuntimeException( $avenor_result->get_error_message() );
}
update_option( 'avenor_navigation_order_version', '1', false );
