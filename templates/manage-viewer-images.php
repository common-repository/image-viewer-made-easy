<?php
    global $wivme_viewer_params;
    extract($wivme_viewer_params);

    // Get uploaded images for specific image viewer
    $viewer_images_str = get_post_meta( $post->ID , '_wivme_viewer_images', true );
    $viewer_images = explode(',', $viewer_images_str);

    $upload_dir = wp_upload_dir();
    $upload_dir_url = $upload_dir['baseurl']."/";
?>


<div id="wivme-viewer-images-panel" >
    <div id="wivme-viewer-images-panel-upload" ><?php _e('Add Images','wivme'); ?></div>
    <div id="wivme-viewer-images-panel-gallery" >
        <?php 

            foreach($viewer_images as $attach_id){
                if($attach_id != ''){
                    $image_icons = "<img class='wivme-viewer-edit' src='" . WIVME_PLUGIN_URL ."images/viewer-edit.png' />
                                    <img class='wivme-viewer-delete' src='" . WIVME_PLUGIN_URL . "images/viewer-delete.png' />";

                    $attachment = wp_get_attachment_metadata( $attach_id );
        ?>
                    <div class='wivme-viewer-images-panel-gallery-single'>
                        <img src="<?php echo $upload_dir_url.$attachment['file']; ?>" data-attchement-id='<?php echo $attach_id; ?>' class='wivme-viewer-preview-thumb' />
                        <div class='wivme-viewer-images-panel-gallery-icons'><?php echo $image_icons; ?></div>
                    </div>
                
        <?php
                }
            }
        ?>
    </div>
    <input type="hidden" name="wivme_viewer_uploaded_images" id="wivme_viewer_uploaded_images" value="<?php echo $viewer_images_str; ?>" />
    <div class='wivme-clear'></div>
</div>

<?php wp_nonce_field( 'wivme_image_viewer_settings', 'wivme_image_viewer_nonce' ); ?>