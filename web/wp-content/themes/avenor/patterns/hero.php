<?php
/**
 * Title: Editorial homepage hero
 * Slug: avenor/hero
 * Categories: avenor
 * @package Avenor
 */
?>

<!-- wp:group {"className":"avenor-width hero"} -->
<div class="wp-block-group avenor-width hero">
<!-- wp:group {"className":"hero-top"} -->
<div class="wp-block-group hero-top">
<!-- wp:group {"className":""} -->
<div class="wp-block-group ">
<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Independent thinking. Meaningful progress.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Clarity in a<br/>complex <em>world.</em></h1>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"hero-description"} -->
<div class="wp-block-group hero-description">
<!-- wp:paragraph -->
<p>We bring strategy, design, and technology together to help ambitious businesses move forward. With purpose. With perspective.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/services/">Explore our expertise ↗</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/work/">Explore solutions ↗</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"hero-visual"} -->
<div class="wp-block-group hero-visual">
<!-- wp:image {"sizeSlug":"full","className":"hero-image"} -->
<figure class="wp-block-image size-full hero-image"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/architecture.jpg' ) ); ?>" alt="Light and shadow across a sculptural concrete building"/></figure>
<!-- /wp:image -->
<?php require get_theme_file_path( 'patterns/hero-note.php' ); ?></div>
<!-- /wp:group -->

<!-- wp:group {"className":"hero-caption"} -->
<div class="wp-block-group hero-caption">
<!-- wp:paragraph -->
<p>Strategy · Design · Technology</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Built around your next chapter <span>— With intent</span></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

