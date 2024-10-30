<?php

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'getting_started';

$title = sprintf( __( 'Welcome to Image Viewer Made Easy %s', 'wivme' ), WIVME_VERSION ) ;
$desc = __( 'Thank you for choosing Image Viewer Made Easy.','wivme');
$desc .= "<a href='http://goo.gl/YRxI0X' target='_blank'>".__('Visit Plugin Home Page','wivme')."</a>";

?>

<div class="wrap about-wrap">
	<h1><?php echo $title; ?></h1>
	<div class="about-text">
		<?php echo $desc; ?>
	</div>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php echo ($tab == 'getting_started') ? 'nav-tab-active' : '' ; ?>" href="<?php echo admin_url( 'admin.php?page=wivme-help&tab=getting_started' ) ?>">
			<?php _e( 'Getting Started', 'wivme' ); ?>
		</a>
		<a class="nav-tab <?php echo ($tab == 'support_docs') ? 'nav-tab-active' : '' ; ?>" href="<?php echo admin_url( 'admin.php?page=wivme-help&tab=support_docs' ) ?>">
			<?php _e( 'Documentation and Support', 'wivme' ); ?>
		</a>
		<a class="nav-tab <?php echo ($tab == 'wpexpert_plugins') ? 'nav-tab-active' : '' ; ?>" href="<?php echo admin_url( 'admin.php?page=wivme-help&tab=wpexpert_plugins' ) ?>">
			<?php _e( 'Plugins by WP Expert Developer', 'wivme' ); ?>
		</a>
		
	</h2>

	<?php if($tab == 'getting_started'){ ?> 
	<div class="wpexpert-help-tab">
		<div class="feature-section">

			
			<h2><?php _e( 'Creating Image Viewers', 'wivme' );?></h2>

			<p><?php _e( 'First, you have to go to <strong>Add New</strong> menu item of <strong>Image Viewers</strong> in WordPress left menu. ', 'wivme' ); ?></p>

			<div class="wpexpert-help-screenshot">
				<img src="http://www.wpexpertdeveloper.com/wp-content/uploads/2015/12/Add-New-Image-Viewer.png" />
			</div>


			<h4><?php _e( 'Adding Images and Configuring Settings', 'wivme' );?></h4>
			<p><?php _e( 'You can click on the Add Images area to upload images to your Image Viewers. Then use the meta box under the title to
			configure the settings according to your preference.', 'wivme' );?></p>

			<div class="wpexpert-help-screenshot">
				<img src="http://www.wpexpertdeveloper.com/wp-content/uploads/2015/12/Image_Viewer_uploaded_Images.png" class="wpexpert-help-screenshot"/>
			</div>

			<p><?php _e( 'Finally, copy the shortcode from the right side meta box and add it to a post/page to view the image viewer in action.', 'wivme' );?></p>

			<h4><?php _e( 'Demos', 'wivme' );?></h4>
			<p>
				<ul class="wpexpert-help-list">
					<li><a target="_blank" href="http://www.wpexpertdeveloper.com/image-viewer-complete-features-modal-view/"><?php _e('Image Viewer – Complete Features with Modal View','wivme'); ?></a></li>
					<li><a target="_blank" href="http://www.wpexpertdeveloper.com/image-viewer-complete-features-inline-view/"><?php _e('Image Viewer – Complete Features with Inline View','wivme'); ?></a></li>
					<li><a target="_blank" href="http://www.wpexpertdeveloper.com/image-viewer-without-navigation-panel/"><?php _e('Image Viewer without Navigation Panel','wivme'); ?></a></li>
				

				</ul>
			</p>

			<p><?php _e( 'More details available at .', 'wivme' );?><a href="http://goo.gl/YRxI0X"><?php _e('Plugin Home Page','wivme'); ?></a></p>


			
		</div>
		
	</div>
	<?php } ?>

	<?php if($tab == 'support_docs'){ ?>
	<div class="wpexpert-help-tab">

		<div class="feature-section">
			<h2><?php _e( 'Documentation', 'wivme' );?></h2>

			<p>
				<?php _e( 'Complete documentation for this plugin is available at ', 'wivme' ); ?>
				<a target="_blank" href="http://goo.gl/YRxI0X">WP Expert Developer</a>.
			</p>

			<h2><?php _e( 'Support', 'wivme' );?></h2>

			<h4><?php _e( 'Free Support', 'wivme' );?></h4>
			<p><?php _e('You can get free support fot this plugin at '); ?>
				<a target="_blank" href="https://wordpress.org/support/plugin/image-viewer-made-easy"><?php _e('wordpress.org','wivme');?></a>.
			</p>


		</div>
	</div>
	<?php } ?>

	<?php if($tab == 'wpexpert_plugins'){ ?>
	<div class="wpexpert-help-tab">

		<div class="feature-section">

			<h2><?php _e('Explore WP Expert Developer Plugins'); ?></h2>

			<div class="wpexpert-plugins-panel">
				<?php
					global $wivme,$wpexpert_plugins_data;
					$plugins_json = wp_remote_get( 'http://www.wpexpertdeveloper.com/plugins.json');  
	        
			        if ( ! is_wp_error( $plugins_json ) ) {

			            $plugins = json_decode( wp_remote_retrieve_body($plugins_json) );
			            $plugins = $plugins->featured;

			            
			        }else{
			        	$plugins = array();
			        }

		        	$wpexpert_plugins_data['plugins'] = $plugins;
        
			        ob_start();
			        $wivme->template_loader->get_template_part('plugins-feed');
			        $display = ob_get_clean();
			        echo $display;
		        ?>
				
			</div>
		</div>
	</div>
	<?php } ?>

</div>
