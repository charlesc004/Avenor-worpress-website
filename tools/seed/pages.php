<?php
/** Initial business content step. @package Avenor */
defined( 'ABSPATH' ) || exit;

if ( ! post_type_exists( 'avenor_service' ) ) {
	throw new RuntimeException( 'Activate avenor-core before seeding.' );
}
$avenor_home = '';
foreach ( array( 'hero', 'services-overview', 'editorial-split', 'featured-work', 'process-section', 'delivery-standards', 'industries', 'platform-foundations', 'contact-cta' ) as $avenor_pattern ) {
	$avenor_home .= avenor_seed_pattern( $avenor_pattern );
}
$avenor_front  = avenor_seed_record( 'page', 'home', 'Home', $avenor_home, 'Independent digital strategy, thoughtful design, and dependable technology for ambitious businesses.' );
$avenor_posts  = avenor_seed_record( 'page', 'insights', 'Insights', '', 'Ideas and practical perspectives on digital business.' );
$avenor_about  = avenor_seed_group( avenor_seed_p( 'Independent minds. Shared purpose.' ) . avenor_seed_h( 'Progress starts with perspective.', 1 ) . avenor_seed_p( 'AVENOR is an independent digital consulting practice built on a simple belief: the best digital work starts with understanding people. We bring strategy, design, and technology into the same conversation.' ), 'avenor-width page-intro' );
$avenor_about .= avenor_seed_pattern( 'editorial-split' );
$avenor_about .= avenor_seed_group( avenor_seed_h( 'Curiosity. Candor. Care.' ) . avenor_seed_p( 'We ask before we assume. We speak clearly, especially when the answers are difficult. And we care about the small decisions that make a lasting difference.' ) . avenor_seed_h( 'A shared way of working' ) . avenor_seed_p( 'Small, focused teams work directly with the people making decisions. Our role is to make complex choices clearer and leave your team better equipped for the next chapter.' ) );
$avenor_about .= avenor_seed_pattern( 'practice' ) . avenor_seed_pattern( 'process-section' ) . avenor_seed_pattern( 'contact-cta' );
avenor_seed_record( 'page', 'about', 'About', $avenor_about, 'Explore the principles, capabilities, and working approach behind AVENOR.' );
$avenor_contact = avenor_seed_group( avenor_seed_group( avenor_seed_p( 'A conversation, not a commitment.' ) . avenor_seed_h( 'What’s your next chapter?', 1 ) . avenor_seed_p( 'Tell us what you’re thinking. A new idea, a complex challenge, or a direction you’re still finding — we’d like to hear it.' ) . '<!-- wp:avenor/business-profile /-->', 'contact-intro' ) . '<!-- wp:avenor/contact-form /-->', 'avenor-width contact-layout' );
avenor_seed_record( 'page', 'contact', 'Contact', $avenor_contact, 'Start a conversation about your next digital challenge.' );
$avenor_privacy    = avenor_seed_group( avenor_seed_h( 'Privacy, in plain language.', 1 ) . avenor_seed_p( 'This notice explains how AVENOR handles information submitted through this website. Please do not include sensitive or confidential information in an initial inquiry.' ) . avenor_seed_h( 'Information we collect' ) . avenor_seed_p( 'The form stores your name, email, optional company and service, message, acknowledgment time, workflow status, and notification delivery flag. Only administrators have inquiry capabilities by default. Your network address is hashed with a site secret for temporary abuse controls, rather than saved on your inquiry.' ) . avenor_seed_h( 'Retention and deletion' ) . avenor_seed_p( 'Default inquiry retention is 365 days, configurable by the administrator. Daily WordPress scheduled tasks permanently delete up to 100 expired inquiries per run. Administrators can delete inquiries earlier. WordPress personal-data export and erasure tools include inquiries matched by email. Backups have separate retention policies.' ) . avenor_seed_h( 'Notifications and your choices' ) . avenor_seed_p( 'An email notification contains an administration link rather than your message. Delivery depends on mail configuration. Contact the site administrator at hello@example.test to discuss access, correction, or deletion. Use the contact form to request access, correction, or deletion of your information.' ), 'avenor-width article-shell' );
$avenor_privacy_id = avenor_seed_record( 'page', 'privacy', 'Privacy', $avenor_privacy );
if ( ! get_option( 'wp_page_for_privacy_policy' ) ) {
	update_option( 'wp_page_for_privacy_policy', $avenor_privacy_id );
}
