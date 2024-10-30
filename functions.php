<?php

/* Remove Preview button from Image Viewer Post Type */
function wivme_admin_css() {
    global $post_type;
    $post_types = array(
                        /* set post types */ 
                        WIVME_IMAGE_VIEWER_POST_TYPE,
                  );
    if(in_array($post_type, $post_types))
    	echo '<style type="text/css">#post-preview{display: none;}</style>';
}
add_action( 'admin_head-post-new.php', 'wivme_admin_css' );
add_action( 'admin_head-post.php', 'wivme_admin_css' );