<?php 

$blogpages = $wp_query->max_num_pages;
$blogpaged = get_query_var('paged');
$range = 2;
$showitems = ( $range * 2 ) + 1;
$post_pagination = savona_options( 'blog_page_post_pagination' );

if ( empty( $blogpaged ) ) {
	$blogpaged = 1;
}

if ( ! $blogpages ) {
	$blogpages = 1;
}

if ( $blogpages == 1 ) {
	return;
}

// Check for WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
	if ( is_shop() ) {
		$post_pagination = 'numeric';
	}
}

?>

<nav class="blog-pagination clear-fix <?php echo esc_attr( $post_pagination ); ?>" data-max-pages="<?php echo esc_attr( $wp_query->max_num_pages ); ?>" data-loading="<?php esc_attr_e( 'Loading...', 'savona' ); ?>" >

<?php

// Numeric Pagination
if ( $post_pagination === 'numeric' ) {

	//  Previous Page
	if ( $blogpaged > 1 ) {
		echo '<a href="'. esc_url( get_pagenum_link( $blogpaged - 1 ) ) .'" class="numeric-prev-page" ><i class="fa fa-long-arrow-left"></i></a>';
	}
	
	// Pagination
	for ( $i = 1; $i <= $blogpages; $i++ ) {
		if ( 1 != $blogpages &&( !( $i >= $blogpaged + $range + 1 || $i <= $blogpaged - $range - 1 ) || $blogpages <= $showitems ) ) {
			if ( $blogpaged == $i ) {
				echo '<span class="numeric-current-page">'. ent2ncr($i) .'</span>';
			} else {
				echo '<a href="'. esc_url( get_pagenum_link( ent2ncr($i) ) ). '">'. ent2ncr($i) .'</a>';
			}
		}
	}

	// Next Page
	if ( $blogpaged < $blogpages ) {
		echo '<a href="'. esc_url( get_pagenum_link( $blogpaged + 1 ) ).'" class="numeric-next-page" ><i class="fa fa-long-arrow-right"></i></a>';
	}

// Default Pagination
} elseif ( $post_pagination === 'default' ) {

	if ( get_next_posts_link() ) {
		echo '<div class="previous-page">';
			next_posts_link( '<i class="fa fa-long-arrow-left"></i>&nbsp;'.esc_html__( 'Older Posts', 'savona' ) );
		echo '</div>';
	}
	
	if ( get_previous_posts_link() ) {
		echo '<div class="next-page">';
			previous_posts_link( esc_html__( 'Newer Posts', 'savona' ).'&nbsp;<i class="fa fa-long-arrow-right"></i>' );
		echo '</div>';
	}

// Load More / Infinite Scroll
} else {
	next_posts_link( esc_html__( 'Load More', 'savona' ) );
}

?>

</nav>