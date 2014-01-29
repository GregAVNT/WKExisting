<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'sidebar'       => ''
    ),
    'sections'        => array(
      array(
        'id'          => 'constant_content',
        'title'       => 'Static Content'
      ),
      array(
        'id'          => 'social_media',
        'title'       => 'Social Media'
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => 'http://facebook.com/',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_media',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => 'http://twitter.com/',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_media',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => 'http://youtube.com/user/',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_media',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkedin',
        'label'       => 'LinkedIn',
        'desc'        => 'http://linkedin.com/company/',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_media',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_link',
        'label'       => 'Header Logo Link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pr_text',
        'label'       => 'Press Release Text',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pr_link_text',
        'label'       => 'Press Release Link Text',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'email_signup_text',
        'label'       => 'Email Sign Up Text',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'privacy_policy_link',
        'label'       => 'LWW.com Privacy Policy Link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'inkling_video',
        'label'       => 'Inkling Video',
        'desc'        => 'Link to video on YouTube. URL should begin with <strong>http://www.youtube.com/watch?</strong>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'feedback_survey',
        'label'       => 'Feedback Survey Link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'copyright',
        'label'       => 'Copyright Statement',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'constant_content',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings );
  }

}