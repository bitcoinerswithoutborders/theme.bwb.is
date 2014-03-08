<?php

/* ********************************************** */
/* Add an options pannel for your Thematic Child Theme
/* ********************************************** */

// ---------- "Child Theme Options" menu STARTS HERE

add_action('admin_menu' , 'bwb_login_page_add_admin');

function bwb_login_page_add_admin() {
  add_submenu_page('themes.php', 'Login Page Options', 'Login Page Options', 'edit_themes', basename(__FILE__), 'bwb_login_page_admin');
}

global $bg;
function bwb_login_page_admin() {
  $bwb_login_theme_image = get_option('bwb_login_theme_image');
  $bwb_login_theme_logo_enabled = get_option('bwb_login_theme_logo_enabled');

  $bwb_login_theme_show_title = get_option('bwb_login_theme_show_title');
  $bwb_login_theme_show_tagline = get_option('bwb_login_theme_show_tagline');
  

  if ($_POST['options-submit']){
    $bwb_login_theme_logo_enabled = htmlspecialchars($_POST['bwb_login_theme_logo_enabled']);
    update_option('bwb_login_theme_logo_enabled', $bwb_login_theme_logo_enabled);
    
    $bwb_login_theme_show_title = htmlspecialchars($_POST['bwb_login_theme_show_title']);
    update_option('bwb_login_theme_show_title', $bwb_login_theme_show_title);

    $bwb_login_theme_show_tagline = htmlspecialchars($_POST['bwb_login_theme_show_tagline']);
    update_option('bwb_login_theme_show_tagline', $bwb_login_theme_show_tagline);


    $use_image_url = htmlspecialchars($_POST['use_image_url']);

    $file_name = $_FILES['logo_image']['name'];
    $temp_file = $_FILES['logo_image']['tmp_name'];
    $file_type = $_FILES['logo_image']['type'];
    
    if ($_POST['logo_image_url'] && $_POST['use_image_url']){
      $bwb_login_theme_image = $_POST['logo_image_url'];
      update_option('bwb_login_theme_image', $bwb_login_theme_image);
    }else if($file_type=="image/gif" || $file_type=="image/jpeg" || $file_type=="image/pjpeg" || $file_type=="image/png"){
      $length=filesize($temp_file);
      $fd = fopen($temp_file,'rb');
      $file_content=fread($fd, $length);
      fclose($fd);
      
      $wud = wp_upload_dir();
      
      
      if (file_exists($wud[path].'/'.strtolower($file_name))){
        unlink ($wud[path].'/'.strtolower($file_name));
      }
      
      $upload = wp_upload_bits( $file_name, '', $file_content);
    //  echo $upload['error'];

      $bwb_login_theme_image = $wud[url].'/'.strtolower($file_name);
      update_option('bwb_login_theme_image', $bwb_login_theme_image);
    }
    
    ?>
      <div class="updated"><p>Your new options have been successfully saved.</p></div>
    <?php

  }
  
  if($bwb_login_theme_logo_enabled) $logo_checked='checked="checked"';
  if($bwb_login_theme_show_title) $title_checked='checked="checked"';
  if($bwb_login_theme_show_tagline) $tagline_checked='checked="checked"';
  if($use_image_url) $urlchecked='checked="checked"';

  ?>
    <div class="cozmos-wrap">
      <div id="icon-themes" class="icon32"></div>
      <h2>Loginform Theme Options</h2>
      <form name="theform" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>">
        <table class="form-table">
          <tr>
            <td width="200">Use logo image:</td>
            <td><input type="checkbox" name="bwb_login_theme_logo_enabled" value="1" <?php echo $logo_checked; ?>/></td>
          </tr>
          <tr>
            <td width="200">Show Page Title:</td>
            <td><input type="checkbox" name="bwb_login_theme_show_title" value="1" <?php echo $title_checked; ?>/></td>
          </tr>
          <tr>
            <td width="200">Show Page Tagline:</td>
            <td><input type="checkbox" name="bwb_login_theme_show_tagline" value="1" <?php echo $tagline_checked; ?>/></td>
          </tr>
          <tr>
            <td>Current image:</td>
            <td><img src="<?php echo $bwb_login_theme_image; ?>" /></td>
          </tr>
          <tr>
            <td>Logo image to use (gif/jpeg/png):</td>
            <td><input type="file" name="bwb_login_theme_image"><br />(you must have writing permissions for your uploads directory)</td>
          </tr>
          <tr>
            <td width="200">Use logo image url instead of uploading a new file:</td>
            <td><input type="checkbox" name="use_image_url" value="1" <?php echo $urlchecked; ?>/></td>
          </tr>
          <tr>
            <td>If you already uploaded your image to your blog just input the complete url here</td>
            <td><input style="width:100%;" type="text" name="logo_image_url" value="<?php echo $bwb_login_theme_image?>" /></td>
          </tr>
        </table>
        <input type="hidden" name="options-submit" value="1" />
        <p class="submit"><input type="submit" name="submit" value="Save Options" /></p>
      </form>
    </div>
  <?php
}

// ---------- "Child Theme Options" menu ENDS HERE

?>
