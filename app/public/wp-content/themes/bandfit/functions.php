<?php
/**
 * bandfit functions and definitions
 *
 * @package bandfit
 */

if (!function_exists( 'bandfit_setup')){

  function bandfit_setup() {

      add_theme_support('title-tag');
      add_theme_support('post-thumbnails');
      add_theme_support('editor-styles');
      set_post_thumbnail_size( 300, 300, true );
  }
}
add_action( 'after_setup_theme', 'bandfit_setup' );

add_editor_style('css/editor.css');

##################################################################
# WIDGETS
##################################################################


##################################################################
# BLOCKS
##################################################################


##################################################################
# POSTTYPES
##################################################################

##################################################################
# SCRIPTS
##################################################################

function bandfit_scripts() {
  wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css', true );
  wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', true );
  wp_enqueue_style( 'master', get_stylesheet_directory_uri().'/css/master.css?v=1.0.0', true );
  wp_enqueue_style( 'fonts', 'https://use.typekit.net/zfm7mha.css', true );

  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-block-style' );
  
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'master', get_stylesheet_directory_uri().'/js/master.js?v=1.0.0', true );
  wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js', array(), '5.0.0' , false);
  wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1' , false);
  /* COLOR PICK */
  wp_enqueue_script( 'vibrant', 'https://cdnjs.cloudflare.com/ajax/libs/vibrant.js/1.0.0/Vibrant.min.js', true);

  wp_deregister_script('jquery-ui-datepicker');
  wp_deregister_script( 'wp-embed' );

}
add_action( 'wp_enqueue_scripts', 'bandfit_scripts' );


##################################################################
# FUNCTIONS
##################################################################
/* SAVE CUSTOM FIELD DATA TO WP USER PROFILES */

/**
*  @param $user
*  @author Webkul
*/

add_action( 'edit_user_profile', 'wk_custom_user_profile_fields' );

$user = wp_get_current_user();

function wk_custom_user_profile_fields( $user )
{
    echo '<h3 class="heading">Custom Field Data</h3>'; 
    
    ?>
    
    <table class="form-table">
  <tr>
      <th><label for="profielfoto">Profielfoto</label></th>
      <td><input readonly type="text" class="input-text form-control" name="profielfoto" id="profielfoto" value=<?php the_field('profiel_profielfoto', $user); ?> />
      </td>

  </tr>
  <tr>
        <th><label for="hoofdinstrument">Hoofdinstrument</label></th>
        <td><input readonly type="text" class="input-text form-control" name="hoofdinstrument" id="hoofdinstrument" value=<?php the_field('profiel_hoofdinstrument', $user); ?>  />
        </td>

  </tr>
  <tr>
      <th><label for="instrumenten-overige">Overige instrument(en)</label></th>
      <?php 
      $rows = get_field('profiel_instrumentenoverige', $user);
      if( $rows ) {
          foreach( $rows as $row ) {
            echo '<td><input readonly type="text" class="input-text form-control" name="instrumenten-overige" id="instrumenten-overige" value=' . $row['profiel_instrument'] . '>';
            echo '</td>';
          }
      }
      ?>
  </tr>
  <tr>
        <th><label for="performancegeluid">Performancegeluid</label></th>
        <td><input readonly type="text" class="input-text form-control" name="performancegeluid" id="performancegeluid" value=<?php the_field('profiel_performancegeluid', $user); ?>  />
        </td>

  </tr>
  <tr>
        <th><label for="stad">Stad</label></th>
        <td><input readonly type="text" class="input-text form-control" name="woonplaats" id="stad" value=<?php the_field('profiel_stad', $user); ?>  />
        </td>
  </tr>
  <tr>
        <th><label for="provincie">Provincie</label></th>
        <td><input readonly type="text" class="input-text form-control" name="provincie" id="provincie" value=<?php the_field('profiel_provincie', $user); ?>  />
        </td>
  </tr>
    </table>
    
    <?php
}

?>

<?php

add_action( 'show_user_profile', 'wk_custom_user_profile_fields' );

?>

<?php

add_action( 'edit_user_profile_update', 'wk_save_custom_user_profile_fields' );

/**
*   @param User Id $user_id
*/
function wk_save_custom_user_profile_fields( $user_id )
{
    
    $custom_data = $_POST['profielfoto'] . $_POST['hoofdinstrument'] . $_POST['instrumenten-overige'] . $_POST['performancegeluid'] . $_POST['stad'] . $_POST['provincie'];
    update_user_meta( $user_id, 'profielfoto', 'hoofdinstrument', 'instrumenten-overige', 'performancegeluid', 'stad', 'provincie', $custom_data );

}


/* EIGEN FUNCTIE DIE PERSOON TOEVOEGT AAN NETWERK */
/**
*  @param $user
*  @param $gewensteUser 
*/

add_action( 'edit_user_profile', 'wk_custom_user_profile_fields_voegtoe_netwerk' );

$user = wp_get_current_user();

function wk_custom_user_profile_fields_voegtoe_netwerk($user)
{
    echo '<h3 class="heading">Netwerk</h3>'; 
    
    ?>
    
    <table class="form-table">
  <tr>
        <th><label for="personen-netwerk">Personen Netwerk</label></th>
        <td><input readonly type="text" class="input-text form-control" name="personen-netwerk" id="personen-netwerk" value='' />
        </td>

  </tr>
    </table>
    
    <?php
}

?>

<?php

add_action( 'show_user_profile', 'wk_custom_user_profile_fields_voegtoe_netwerk' );

?>

<?php

add_action( 'edit_user_profile_update', 'wk_save_custom_user_profile_fields_voegtoe_netwerk');

/**
*   @param User Id $user_id   
*/

function wk_save_custom_user_profile_fields_voegtoe_netwerk($user_id, $gewensteUser)
{
    add_user_meta( $user_id, 'personen-netwerk', $gewensteUser);
}

/* EIGEN FUNCTIE DIE PERSOON TOEVOEGT AAN BAND */
/**
*  @param $user
*  @param $gewensteUser 
*/

add_action( 'edit_user_profile', 'wk_custom_user_profile_fields_voegtoe_band' );

$user = wp_get_current_user();

function wk_custom_user_profile_fields_voegtoe_band($user)
{
    echo '<h3 class="heading">Band</h3>'; 
    
    ?>
    
    <table class="form-table">
  <tr>
        <th><label for="personen-band">Personen Band</label></th>
        <td><input readonly type="text" class="input-text form-control" name="personen-band" id="personen-band" value='' />
        </td>

  </tr>
    </table>
    
    <?php
}

?>

<?php

add_action( 'show_user_profile', 'wk_custom_user_profile_fields_voegtoe_band' );

?>

<?php

add_action( 'edit_user_profile_update', 'wk_save_custom_user_profile_fields_voegtoe_band');

/**
*   @param User Id $user_id   
*/

function wk_save_custom_user_profile_fields_voegtoe_band($user_id, $gewensteUser)
{
    add_user_meta( $user_id, 'personen-band', $gewensteUser);
}


/* CUSTOM LOGIN */
function wpb_login_logo() { ?>
<style type="text/css">

  html{
    height: auto !important;
  }

  .login{
    background-color: #3B27BA;
  }

  #login{
    background-color: white;
    margin-top: 8% !important;
    margin-bottom: 8% !important;
    padding-bottom: 8% !important;
    border-radius: 20px;
  }

  #login h1 a, .login h1 a {
    background-image: url(/wp-content/themes/bandfit/img/bandfit-logo-slogan.png);
    height: 200px; width: 200px;
    background-size: 200px 200px;
    background-repeat: no-repeat;
    padding-bottom: 10px; 
  }

  .login form{
    border: 0 !important;
    padding: 0 24px 34px !important;
  }

  .wp-hide-pw{
    color: #E847AE !important;
  }

  .message{
    border-left: 4px solid #E847AE !important;
  }


  #loginform{
    border: 0;
  }

  .login form{
    box-shadow: none !important;
  }

  #login input{
    border-radius: 10px;
  }

  #login label{
    font-family: hero-new, sans-serif;
    font-weight: 400;
    font-style: normal;
    text-align: center;
  }

  #loginform label:nth-child(1){
    width: 100%;
    text-align: center;
  }

  #login #wp-submit{
    display: block;
    width: 100%;
    background-color: #13CA91;
    border: 0;
    margin-top: 16px;
  }

  .login #nav{
    margin: 0 !important;
  }

  .login #nav{
    text-align: center;
  }

  .login #nav a{
    text-decoration: underline !important;
    color: #E847AE !important;
  }x

  #backtoblog{
    text-align: center;
  }

  #backtoblog a{
    text-decoration: underline !important;
    color: #E847AE !important;    
  }

  .forgetmenot{
    width: 100%;
    text-align: center;
  }

  #rememberme{
    border-radius: 0 !important;
  }
</style> <?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );


/* CUSTOM USER PAGES BIJ USER REGISTRATION */
add_action( 'user_register', function ( $user_id ) {
       $user_pagina = array(
            'post_title'    => 'User ' . $user_id,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'page-templates/user-template.php'
            );
       wp_insert_post( $band_user_pagina);
}); 

add_action( 'user_register', function ( $user_id ) {
        $band_pagina = array(
            'post_title'    => 'Band user ' . $user_id,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'page_template' => 'page-templates/band-template.php'
            );
            // Insert the post into the database
    wp_insert_post( $band_pagina);
}); 



