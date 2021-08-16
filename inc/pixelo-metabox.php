<?php
/* Define the custom box */
 
add_action( 'add_meta_boxes', 'pixelo_metabox' );
add_action( 'save_post', 'pixelo_save_meta_box' );
 
/* Adds a box to the side column on the Post and Page edit screens */
function pixelo_metabox()
{

  $pixelo_metabox_name = __( 'Pixelo Settings', 'pixelo' );

  $pixelo_screens = ['closet'];
  foreach ($pixelo_screens as $pixelo_screen) {
    add_meta_box( 
        'pixelo_settings_metabox',
        $pixelo_metabox_name,
        'pixelo_metabox_callback_func',
        array('page', 'post'),
        'side'
    );
  }

}

function pixelo_metabox_callback_func( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'pixelo_settings_metabox_nonce', 'pixelo_metabox_nonce' );
 
  $pixelo_site_sidebar = get_post_meta( $post->ID, '_pixelo_sidebar_meta_kay', true );
  $pixelo_content_layout = get_post_meta( $post->ID, '_pixelo_content_meta_kay', true );
  $pixelo_site_post_title = get_post_meta( $post->ID, '_pixelo_title_meta_kay', true );


  /**
   * Sidebar Option
   */
  ?>
    
    <div class="pixelo-site-sidebar-layout-meta-wrap pixelo__base-control-field">
      <p class="post-attributes-label-wrapper" >
        <strong> <?php esc_html_e( 'Sidebar', 'pixelo' ); ?> </strong>
      </p>
      <select name="site-sidebar-layout" id="site-sidebar-layout">
        <option value="default" <?php selected( $pixelo_site_sidebar, 'default' ); ?> > <?php esc_html_e( 'Customizer Setting', 'pixelo' ); ?></option>
        <option value="left-sidebar" <?php selected( $pixelo_site_sidebar, 'left-sidebar' ); ?> > <?php esc_html_e( 'Left Sidebar', 'pixelo' ); ?></option>
        <option value="right-sidebar" <?php selected( $pixelo_site_sidebar, 'right-sidebar' ); ?> > <?php esc_html_e( 'Right Sidebar', 'pixelo' ); ?></option>
        <option value="no-sidebar" <?php selected( $pixelo_site_sidebar, 'no-sidebar' ); ?> > <?php esc_html_e( 'No Sidebar', 'pixelo' ); ?></option>
      </select>
    </div>

  <?php

  /**
   * Layout Option
   */
  ?>
    
    <div class="pixelo-site-content-layout-meta-wrap pixelo__base-control-field">
				<p class="post-attributes-label-wrapper" >
					<strong> <?php esc_html_e( 'Content Layout', 'pixelo' ); ?> </strong>
				</p>
				<select name="site-content-layout" id="site-content-layout">
					<option value="default" <?php selected( $pixelo_content_layout, 'default' ); ?> > <?php esc_html_e( 'Customizer Setting', 'pixelo' ); ?></option>
					<option value="boxed" <?php selected( $pixelo_content_layout, 'boxed' ); ?> > <?php esc_html_e( 'Boxed', 'pixelo' ); ?></option>
					<option value="full-width" <?php selected( $pixelo_content_layout, 'full-width' ); ?> > <?php esc_html_e( 'Full Width ', 'pixelo' ); ?></option>
				</select>
			</div>

  <?php

   /**
   * Disable Section
   */
  ?>
    <div class="pixelo-disable-section-meta-wrap pixelo__base-control-field">
				<p class="post-attributes-label-wrapper">
					<strong> <?php esc_html_e( 'Disable Sections', 'pixelo' ); ?> </strong>
				</p>
      <div class="site-post-title-option-wrap">
        <label for="site-post-title">
          <input type="checkbox" id="site-post-title" name="site-post-title" value="disabled" <?php checked( $pixelo_site_post_title, 'disabled' ); ?> />
          <?php esc_html_e( 'Disable Title', 'pixelo' ); ?>
        </label>
      </div>
    </div>
  <?php

}

function pixelo_save_meta_box( $post_id ) {

  // Bail if we're doing an auto save
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
  // if our nonce isn't there, or we can't verify it, bail
  if( !isset( $_POST['pixelo_metabox_nonce'] ) || !wp_verify_nonce( $_POST['pixelo_metabox_nonce'], 'pixelo_settings_metabox_nonce' ) ) return;
   
  // if our current user can't edit this post, bail
  if( !current_user_can( 'edit_post' ) ) return;
 
  // Sanitize the user input.
  $pixelo_sidebar_meta_kay = sanitize_text_field( $_POST['site-sidebar-layout'] );
  $pixelo_content_meta_kay = sanitize_text_field( $_POST['site-content-layout'] );
  $pixelo_title_meta_key = sanitize_text_field( $_POST['site-post-title'] );

  // Update the meta field.
  update_post_meta( $post_id, '_pixelo_sidebar_meta_kay', $pixelo_sidebar_meta_kay );
  update_post_meta( $post_id, '_pixelo_content_meta_kay', $pixelo_content_meta_kay );
  update_post_meta( $post_id, '_pixelo_title_meta_kay', $pixelo_title_meta_key );
    


}