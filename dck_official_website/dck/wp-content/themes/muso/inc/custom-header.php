<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Muso
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses muso_header_style()
 */
function muso_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'muso_custom_header_args', array(
		'default-image'          => get_parent_theme_file_uri( '/assets/images/hero-image.jpg' ),
		'default-text-color'     => 'db0600',
		'width'                  => 1820,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'muso_header_style',
	) ) );
		
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/hero-image.jpg',
			'thumbnail_url' => '%s/assets/images/hero-image.jpg',
			'description'   => __( 'Default Header Image', 'muso' ),
		),
	) );
}
add_action( 'after_setup_theme', 'muso_custom_header_setup' );

if ( ! function_exists( 'muso_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see muso_custom_header_setup().
 */
function muso_header_style() {
	$header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
