<?php
  /* ********************************************** */
  /* Add an options pannel for your Thematic Child Theme
  /* ********************************************** */

  // ---------- "Child Theme Options" menu STARTS HERE

  add_action('admin_menu' , 'bwb_theme_admin_page');

  function bwb_theme_admin_page() {
    add_submenu_page('themes.php', 'BwB Theme Options', 'BwB Theme Options', 'edit_themes', basename(__FILE__), 'bwb_theme_admin');
  }

  global $bg;
  function bwb_theme_admin() {
    $bwb_theme_image = get_option('bwb_theme_image');
    $enabled = get_option('bwb_theme_logo_enabled');
    $use_image_url = false;

    $bwb_theme_logo_title = get_option('bwb_theme_logo_title');
    $bwb_theme_logo_alt = get_option('bwb_theme_logo_alt');

    $bwb_theme_page_title = get_option('bwb_theme_page_title');
    $bwb_theme_page_title_link = get_option('bwb_theme_page_title_link');

    $bwb_theme_page_tagline = get_option('bwb_theme_page_tagline');
    $bwb_theme_page_tagline_link = get_option('bwb_theme_page_tagline_link');

    if ( isset($_POST['options-submit']) ){
      $enabled = htmlspecialchars($_POST['enabled']);
      update_option('bwb_theme_logo_enabled', $enabled);

      $bwb_theme_logo_alt = htmlspecialchars($_POST['logo_alt']);
      update_option('bwb_theme_logo_alt', $bwb_theme_logo_alt);

      $bwb_theme_logo_title = htmlspecialchars($_POST['logo_title']);
      update_option('bwb_theme_logo_title', $bwb_theme_logo_title);

      $bwb_theme_page_title = htmlspecialchars($_POST['page_title']);
      update_option('bwb_theme_page_title', $bwb_theme_page_title);

      $bwb_theme_page_title_link = htmlspecialchars($_POST['page_title_link']);
      update_option('bwb_theme_page_title_link', $bwb_theme_page_title_link);

      $bwb_theme_page_tagline = htmlspecialchars($_POST['page_tagline']);
      update_option('bwb_theme_page_tagline', $bwb_theme_page_tagline);

      $bwb_theme_page_tagline_link = htmlspecialchars($_POST['page_tagline_link']);
      update_option('bwb_theme_page_tagline_link', $bwb_theme_page_tagline_link);

      $use_image_url = htmlspecialchars($_POST['use_image_url']);
      
      $file_name = $_FILES['logo_image']['name'];
      $temp_file = $_FILES['logo_image']['tmp_name'];
      $file_type = $_FILES['logo_image']['type'];
      
      if ($_POST['logo_image_url'] && $_POST['use_image_url']){
        $bwb_theme_image = $_POST['logo_image_url'];
        update_option('bwb_theme_image', $bwb_theme_image);
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

        $bwb_theme_image = $wud[url].'/'.strtolower($file_name);
        update_option('bwb_theme_image', $bwb_theme_image);
      }
      
      ?>
        <div class="updated"><p>Your new options have been successfully saved.</p></div>
      <?php

    }
    
    $checked = $enabled ? 'checked="checked"' : '';
    $urlchecked = $use_image_url ? 'checked="checked"' : '';

    ?>
      <div class="cozmos-wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>Child Theme Options</h2>
        <form name="theform" method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);?>">
          <table class="form-table">
            <tr>
              <td width="200">Use logo image instead of blog title and description:</td>
              <td><input type="checkbox" name="enabled" value="1" <?php echo $checked; ?>/></td>
            </tr>
            <tr>
              <td>Current image:</td>
              <td><img src="<?php echo $bwb_theme_image; ?>" /></td>
            </tr>
            <tr>
              <td>Logo image to use (gif/jpeg/png):</td>
              <td><input type="file" name="logo_image"><br />(you must have writing permissions for your uploads directory)</td>
            </tr>
            <tr>
              <td width="200">Use logo image url instead of uploading a new file:</td>
              <td><input type="checkbox" name="use_image_url" value="1" <?php echo $urlchecked; ?>/></td>
            </tr>
            <tr>
              <td>If you already uploaded your image to your blog just input the complete url here</td>
              <td><input style="width:100%;" type="text" name="logo_image_url" value="<?php echo $bwb_theme_image?>" /></td>
            </tr>
            <tr>
              <td>Logo Alt text to use(if none is input bloginfo('name') is used):</td>
              <td><input type="text" name="logo_alt" value="<?php echo $bwb_theme_logo_alt ?>"></td>
            </tr>
            <tr>
              <td>Logo Title to use (if none is input alt text above is used):</td>
              <td><input type="text" name="logo_title" value="<?php echo $bwb_theme_logo_title ?>"></td>
            </tr>
            <tr>
              <td>Page Title (if none is input nothing is shown):</td>
              <td><input type="text" name="page_title" value="<?php echo $bwb_theme_page_title ?>"></td>
            </tr>
            <tr>
              <td>Page Title Link (if none is input nothing is linked to):</td>
              <td><input type="text" name="page_title_link" value="<?php echo $bwb_theme_page_title_link ?>"></td>
            </tr>
            <tr>
              <td>Logo Tagline to use (if none is input its not shown):</td>
              <td><input type="text" name="page_tagline" value="<?php echo $bwb_theme_page_tagline ?>"></td>
            </tr>
            <tr>
              <td>Logo Tagline link (if none is input no link is added):</td>
              <td><input type="text" name="page_tagline_link" value="<?php echo $bwb_theme_page_tagline_link ?>"></td>
            </tr>

          </table>
          <input type="hidden" name="options-submit" value="1" />
          <p class="submit"><input type="submit" name="submit" value="Save Options" /></p>
        </form>
      </div>
    <?php
  }

  // ---------- "Child Theme Options" menu ENDS HERE
