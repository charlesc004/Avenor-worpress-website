<?php
/** Add editorial sections once, preserving existing blocks and edits. @package Avenor */
defined( 'ABSPATH' ) || exit;

if ( get_option( 'avenor_experience_version' ) === '2' ) {
	return;
}

function avenor_experience_wrap_hero( array $blocks ): array {
	foreach ( $blocks as &$block ) {
		$class = $block['attrs']['className'] ?? '';
		if ( 'hero-visual' === $class ) {
			continue;
		}
		if ( 'core/image' === $block['blockName'] && 'hero-image' === $class ) {
			$markup = '<!-- wp:group {"className":"hero-visual"} --><div class="wp-block-group hero-visual">' . serialize_block( $block ) . avenor_seed_pattern( 'hero-note' ) . '</div><!-- /wp:group -->';
			$block  = parse_blocks( $markup )[0];
		} else {
			$block['innerBlocks'] = avenor_experience_wrap_hero( $block['innerBlocks'] );
		}
	}
	return $blocks;
}

$avenor_home = get_page_by_path( 'home' );
if ( $avenor_home ) {
	$avenor_content = $avenor_home->post_content;
	$avenor_blocks  = avenor_experience_wrap_hero( parse_blocks( $avenor_content ) );
	$avenor_output  = '';
	foreach ( $avenor_blocks as $avenor_block ) {
		$avenor_class = $avenor_block['attrs']['className'] ?? '';
		if ( 'contact-cta' === $avenor_class ) {
			foreach ( array( 'insights-preview', 'faq' ) as $avenor_name ) {
				if ( ! str_contains( $avenor_content, '"' . $avenor_name . ( 'faq' === $avenor_name ? '-layout' : '' ) ) ) {
					$avenor_output .= avenor_seed_pattern( $avenor_name );
				}
			}
		}
		$avenor_output .= serialize_block( $avenor_block );
		if ( str_contains( $avenor_class, 'avenor-width hero' ) && ! str_contains( $avenor_content, 'expertise-rail' ) ) {
			$avenor_output .= avenor_seed_pattern( 'expertise-rail' );
		}
		if ( str_contains( $avenor_class, 'section-rule' ) && ! str_contains( $avenor_content, 'engagement-section' ) ) {
			$avenor_output .= avenor_seed_pattern( 'engagement' );
		}
	}
	wp_update_post(
		array(
			'ID'           => $avenor_home->ID,
			'post_content' => $avenor_output,
		)
	);
}

$avenor_contact = get_page_by_path( 'contact' );
if ( $avenor_contact && ! str_contains( $avenor_contact->post_content, 'contact-next' ) ) {
	$avenor_blocks = parse_blocks( $avenor_contact->post_content );
	foreach ( $avenor_blocks as &$avenor_layout ) {
		foreach ( $avenor_layout['innerBlocks'] as &$avenor_column ) {
			if ( 'contact-intro' === ( $avenor_column['attrs']['className'] ?? '' ) ) {
				$avenor_column['innerBlocks'][] = parse_blocks( avenor_seed_pattern( 'contact-next' ) )[0];
				array_splice( $avenor_column['innerContent'], -1, 0, array( null ) );
			}
		}
		unset( $avenor_column );
	}
	unset( $avenor_layout );
	wp_update_post(
		array(
			'ID'           => $avenor_contact->ID,
			'post_content' => serialize_blocks( $avenor_blocks ),
		)
	);
}
update_option( 'avenor_experience_version', '2', false );
echo "AVENOR editorial improvements applied without replacing existing copy.\n";
