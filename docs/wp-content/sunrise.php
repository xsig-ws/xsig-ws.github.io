<?php
/** 
 * Allow nested folder paths in WordPress Multisite with subdirectories
 * Updated from http://maisonbisson.com/post/14052/wordpress-hacks-nested-paths-for-wpmu-blogs/ to account for latest WordPress code
 * .htaccess rules also need to be changed to:

RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]

# add a trailing slash to /wp-admin
RewriteRule ^([[_0-9a-zA-Z-]+/]*)?wp-admin$ $1wp-admin/ [R=301,L]

RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^ - [L]
RewriteRule ^([[_0-9a-zA-Z-]+/]*)?(wp-(content|admin|includes)/.*) $2 [L]
RewriteRule ^([[_0-9a-zA-Z-]+/]*)?(.*\.php)$ $2 [L]
RewriteRule . index.php [L]
 */
 
if ( defined( 'DOMAIN_CURRENT_SITE' ) && defined( 'PATH_CURRENT_SITE' ) ) {

  $current_site = new stdClass;
  $current_site->id = defined( 'SITE_ID_CURRENT_SITE' ) ? SITE_ID_CURRENT_SITE : 1;
  $current_site->domain = $domain = DOMAIN_CURRENT_SITE;
  $current_site->path = $path = PATH_CURRENT_SITE;
  if ( defined( 'BLOG_ID_CURRENT_SITE' ) ) {
  	$current_site->blog_id = BLOG_ID_CURRENT_SITE;
  } elseif ( defined( 'BLOGID_CURRENT_SITE' ) ) { // deprecated.
  	$current_site->blog_id = BLOGID_CURRENT_SITE;
  }
  
  
  $url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
  
  $patharray = ( array ) explode( '/', trim( $url, '/' ) );
  $pathsearch = '';
  $blogsearch = '';
  
  if ( count( $patharray ) ) {
    foreach( $patharray as $pathpart ) {
      $pathsearch .= '/' . $pathpart;
      $blogsearch .= $wpdb->prepare( " OR (domain = %s AND path = %s) ", $domain, $pathsearch . '/' );
    }
  }
  
  $current_blog = $wpdb->get_row( $wpdb->prepare( "SELECT *, LENGTH( path ) as pathlen FROM $wpdb->blogs WHERE domain = %s AND path = '/'", $domain ) . $blogsearch . 'ORDER BY pathlen DESC LIMIT 1' );
  
  $blog_id = $current_blog->blog_id;
  $public = $current_blog->public;
  $site_id = $current_blog->site_id;
  
  $current_site = _ss_get_current_site_name( $current_site );

}

function _ss_get_current_site_name( $current_site ) {
  global $wpdb;
  $current_site->site_name = wp_cache_get( $current_site->id . ':current_site_name', "site-options" );
  if ( !$current_site->site_name ) {
    $current_site->site_name = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $wpdb->sitemeta WHERE site_id = %d AND meta_key = 'site_name'", $current_site->id ) );
  
    if ( $current_site->site_name == null ) {
      $current_site->site_name = ucfirst( $current_site->domain );
    }
  
    wp_cache_set( $current_site->id . ':current_site_name', $current_site->site_name, 'site-options' );
  }
  return $current_site;
}
