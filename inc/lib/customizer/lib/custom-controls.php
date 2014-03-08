<?php

//require_once in  ../customizer.php

//classes have to be defined IN this function because of namespacing
  class WP_Customize_Checkbox_Array_Control extends WP_Customize_Control {
    public $type = 'checkbox-array';

    public function render_content() {
       if ( empty( $this->choices ) ) :
        return;
      endif;
      ?>
      <label><?php echo esc_html( $this->label ); ?></label>

      <select <?php echo $this->link() ?>>
          <option selected="selected" value="false"><?php _e('No Item selected', 'BWB')?><br>
      <?php foreach ($this->choices as $choice) : ?>
          <option value="<?= esc_html($choice) ?>"><?= esc_html($choice) ?><br>
      <?php endforeach; ?>
      </select>
      <?php
    }
  }

  class WP_Customize_Number_Control extends WP_Customize_Control {
    public $type = 'number';

    public function render_content() {
      $name = '_number-' . $this->id;

?>
      <span class="customize-control-title"><?= esc_html( $this->label ); ?></span>
      <input type="number" value="<?= esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
      <br>
<?php
    }
  }


  class WP_Customize_Radio_Control extends WP_Customize_Control {
    public $type = 'radio-extended';

    public function render_content() {
      if ( empty( $this->choices ) ) :
        return;
      endif;

      $name = '_customize-radio-' . $this->id;

      ?>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <?php

      foreach ( $this->choices as $value => $label ) :
        ?>
        <label>
          <input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
          <?php echo esc_html( $label ); ?><br/>
        </label>
        <?php
      endforeach;
    }
  }


/**
 * Customize RGBA Control Class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 3.4.0
 */
class WP_Customize_RGBA_Control extends WP_Customize_Control {

  /**
   * Enqueue control related scripts/styles.
   *
   * @since 3.4.0
   */
  public function enqueue() {
    //~ wp_enqueue_style( 'farbtastic' );
    //~ wp_enqueue_script( 'farbtastic' );
    //~ wp_enqueue_script( 'BWB-rgba-color-picker', get_template_directory_uri() . '/inc/lib/customizer/js/color-picker.js', array( 'farbtastic', 'jquery' ) );
  }

  /**
   * Render the control's content.
   *
   * @since 3.4.0
   */
  
  public function render_content() {
      ?>
        <label>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
        </label>
        <?php
    // The input's value gets set by JS. Don't fill it.
    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <div class="customize-control-content">
        <form><input type="text" <?= $default_attr ?> value="<?= $this_default ?>" /></form>

        <div class="colorpicker"></div>
      </div>
    </label>
    <?php
  }
}

  class WP_Customize_Slider_Control extends WP_Customize_Control {
    public $type = 'slider';

    public function render_content() {
      $name = '_slider-' . $this->id;

?>
      <span class="customize-control-title"><?= esc_html( $this->label ); ?></span>
      <input type="range" value="<?= esc_attr( $this->value() ); ?>" min="<?= esc_attr($this->choices['min']) ?>" max="<?= esc_attr ($this->choices['max']) ?>" <?php $this->link(); ?> />
      <input type="number" value="<?= esc_attr( $this->value() ); ?>" min="<?= esc_attr($this->choices['min']) ?>" max="<?= esc_attr ($this->choices['max']) ?>" <?php $this->link(); ?> />
      <br>
<?php
    }
  }

?>
