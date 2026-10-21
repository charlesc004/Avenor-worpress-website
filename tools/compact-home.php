<?php
/** Shorten the homepage once while retaining reusable patterns and inner pages. @package Avenor */
defined( 'ABSPATH' ) || exit;

if ( get_option( 'avenor_compact_home_version' ) ) {
	return;
}

function avenor_home_has_class( array $block, array $classes ): bool {
	if ( array_intersect( $classes, preg_split( '/\s+/', $block['attrs']['className'] ?? '' ) ) ) {
		return true;
	}
	foreach ( $block['innerBlocks'] as $child ) {
		if ( avenor_home_has_class( $child, $classes ) ) {
			return true;
		}
	}
	return false;
}

function avenor_home_reduce_collections( array $block ): array {
	if ( 'avenor/services-grid' === $block['blockName'] ) {
		$block['attrs']['count'] = 3;
	}
	if ( 'core/query' === $block['blockName'] && 'post' === ( $block['attrs']['query']['postType'] ?? '' ) ) {
		$block['attrs']['query']['perPage'] = 2;
	}
	if ( 'core/post-template' === $block['blockName'] ) {
		$block['attrs']['layout']['columnCount'] = 2;
	}
	$block['innerBlocks'] = array_map( 'avenor_home_reduce_collections', $block['innerBlocks'] );
	return $block;
}

$avenor_home = get_page_by_path( 'home' );
if ( ! $avenor_home ) {
	return;
}
$avenor_kept      = array();
$avenor_portfolio = null;
foreach ( parse_blocks( $avenor_home->post_content ) as $avenor_block ) {
	if ( avenor_home_has_class( $avenor_block, array( 'portfolio-section' ) ) ) {
		$avenor_portfolio = $avenor_block;
		continue;
	}
	if ( avenor_home_has_class( $avenor_block, array( 'editorial-split', 'process-grid', 'engagement-section', 'delivery-standards', 'industries-section', 'platform-foundations', 'team-section', 'testimonials-section' ) ) || has_block( 'avenor/case-studies-grid', serialize_block( $avenor_block ) ) ) {
		continue;
	}
	$avenor_kept[] = avenor_home_reduce_collections( $avenor_block );
}
$avenor_output = '';
foreach ( $avenor_kept as $avenor_block ) {
	if ( $avenor_portfolio && avenor_home_has_class( $avenor_block, array( 'insights-preview', 'faq-layout', 'contact-cta' ) ) ) {
		$avenor_output   .= serialize_block( $avenor_portfolio );
		$avenor_portfolio = null;
	}
	$avenor_output .= serialize_block( $avenor_block );
}
if ( $avenor_portfolio ) {
	$avenor_output .= serialize_block( $avenor_portfolio );
}
$avenor_updated = wp_update_post(
	array(
		'ID'           => $avenor_home->ID,
		'post_content' => $avenor_output,
	),
	true
);
if ( is_wp_error( $avenor_updated ) ) {
	throw new RuntimeException( $avenor_updated->get_error_message() );
}
update_option( 'avenor_compact_home_version', '1', false );
echo "AVENOR homepage compacted. Inner pages preserved.\n";
