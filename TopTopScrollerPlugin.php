<?php
/*
Plugin Name: TopTopScroller
Description: Add a back to the top button to your site.
Version: 1.0
Author: Carlos Moreira
Author URI: http://therealcarlos.com
License: GPLv2
*/

/**
 * Class TopTopOptions
 */
define('WP_DEBUG', true);
Class TopTopOptions{

    public $options;

    function __construct(){

        $this->options['tts_plugin_options'] =  get_option('tts_plugin_options');
        $this->register_settings_and_fields();
    }

    public static function add_menu_page(){
        add_options_page('TopTopScroller Settings', 'TopTopScroller', 'manage_options', 'toptopscroller-settings', array('TopTopOptions', 'display_options_page') );
    }

    public function getOptions(){
        return $this->options;
    }

    public function display_options_page(){
        ?>
        <div class="wrap">
            <?php get_screen_icon(); ?>
            <h2>TopTopScroller Options</h2>
            <form action="options.php" method="post">
                <?php
                    settings_fields('tts_plugin_options');
                    do_settings_sections(__FILE__);
                ?>
                <p class="submit">
                    <input class="button-primary" type="submit" name="submit" value="Save Changes"/>
                </p>
            </form>

            <div id="tts_preiview"  >
                <div id="tts_example" style="text-align:center; width:50px; height:50px; border-radius:50%; background-color:black; color:white; line-height:50px"
                     data-bind="text : option_text,
                     style : {color: option_color,
                     background: option_bgColor,
                     width: option_width()+'px',
                     height: option_height()+'px',
                     borderRadius: option_borderRad,
                     lineHeight: option_height()+'px' }"
                    >
                    Top
                </div>
            </div>
        </div>
        <?php
    }

    public function register_settings_and_fields(){


        $this->options = get_option('tts_plugin_options');

        register_setting('tts_plugin_options', 'tts_plugin_options', array($this,'tts_validate_options')); //3rd param is optional callback

        add_settings_section('tts_position_section', 'Position Settings', array($this, 'tts_position_section_cb')  , __FILE__ );
        add_settings_section('tts_style_section', 'Style Settings', array($this, 'tts_style_section_cb')  , __FILE__ );

        /*
         * Style Settings
         * */
        add_settings_field('tts_text_option', 'Text', array($this , 'tts_banner_heading_setting'), __FILE__, 'tts_style_section');
        add_settings_field('tts_color_option', 'Color', array($this , 'tts_color_input'), __FILE__, 'tts_style_section');
        add_settings_field('tts_bgColor_option', 'Background Color', array($this , 'tts_bgColor_input'), __FILE__, 'tts_style_section');
        add_settings_field('tts_width_option', 'Height (px)', array($this , 'tts_width_input'), __FILE__, 'tts_style_section');
        add_settings_field('tts_height_option', 'Width (px)', array($this , 'tts_height_input'), __FILE__, 'tts_style_section');
        add_settings_field('tts_borderRad_option', 'Border Radius', array($this , 'tts_borderRad_input'), __FILE__, 'tts_style_section');

        /*
         * Position Settings
         * */


        add_settings_field('tts_leftOrRight_option', 'Side Location', array($this , 'tts_leftOrRigh_input'), __FILE__, 'tts_position_section');
        add_settings_field('tts_pixelsFromSide_option', 'Pixels From Side', array($this , 'tts_pixelsFromSide_input'), __FILE__, 'tts_position_section');

        add_action('admin_footer', function(){
            ?>
            <script>
                $(document).ready(function(){
                    var ttsViewModel = function(){
                        this.option_text  = ko.observable("<?php echo $this->options["tts_text_option"]; ?>");
                        this.option_color = ko.observable("<?php echo $this->options["tts_color_option"]; ?>");
                        this.option_bgColor = ko.observable("<?php echo $this->options["tts_bgColor_option"]; ?>");
                        this.option_width = ko.observable("<?php echo $this->options["tts_width_option"]; ?>");
                        this.option_height = ko.observable("<?php echo $this->options["tts_height_option"]; ?>");
                        this.option_borderRad = ko.observable("<?php echo $this->options["tts_borderRad_option"]; ?>");

                    }

                    ko.applyBindings(new ttsViewModel());
                });
            </script>
        <?php
        });


    }

    public function register_js_files(){

    }

    /**
     * Validate each of the setttings fields
     * @param $input
     * @return mixed
     */
    public function tts_validate_options($input){
        return $input;
    }

    public function tts_position_section_cb(){

    }
    public  function tts_style_section_cb(){

    }


    /*
     * Inputs
     *
     * */
    public function tts_leftOrRigh_input(){
        ?>
        <select name='tts_plugin_options[tts_leftOrRight_option]'>
            <option <?php echo  ($this->options["tts_leftOrRight_option"] == "right") ? 'selected' : '' ?> value="right">Right</option>
            <option <?php echo  ($this->options["tts_leftOrRight_option"] == "left") ? 'selected' : '' ?> value="left">Left</option>
        </select>
        <?php
    }


    public function tts_borderRad_input(){
        echo "<input data-bind=\"value : option_borderRad, valueUpdate: 'afterkeydown'\" type='text'  name='tts_plugin_options[tts_borderRad_option]' value='".$this->options["tts_borderRad_option"]."'>";
    }
    public function tts_width_input(){
        echo "<input data-bind=\"value : option_width, valueUpdate: 'afterkeydown'\" type='text'  name='tts_plugin_options[tts_width_option]' value='".$this->options["tts_width_option"]."'>";
    }
    public function tts_height_input(){
        echo "<input data-bind=\"value : option_height, valueUpdate: 'afterkeydown'\" type='text' name='tts_plugin_options[tts_height_option]' value='".$this->options["tts_height_option"]."'>";
    }
    public function tts_pixelsFromSide_input(){
        echo "<input type='text' name='tts_plugin_options[tts_pixelsFromSide_option]' value='".$this->options["tts_pixelsFromSide_option"]."'>";
    }
    public function tts_bgColor_input(){
        echo "<input data-bind=\"value : option_bgColor, valueUpdate: 'blur'\" id='tts_bgColor' type='text' name='tts_plugin_options[tts_bgColor_option]' value='".$this->options["tts_bgColor_option"]."'>";
    }
    public function tts_banner_heading_setting(){
        //echo "<input id='test' data-bind='value : option_text' value='test'>";
        echo "<input data-bind=\"value : option_text, valueUpdate: 'afterkeydown'\"  type='text' name='tts_plugin_options[tts_text_option]' value='".$this->options["tts_text_option"]."'>";
    }
    public function tts_color_input(){
        echo "<input data-bind=\"value : option_color, valueUpdate: 'blur'\" id='tts_color' type='text' name='tts_plugin_options[tts_color_option]' value='".$this->options["tts_color_option"]."'>";
    }


}




add_action('admin_menu', function(){
    TopTopOptions::add_menu_page();
});
add_action('admin_init', function(){

    new TopTopOptions();
    add_action( 'admin_enqueue_scripts', function($hook){
        if($hook == "settings_page_toptopscroller-settings"){
            wp_enqueue_script( 'colorpickerjs', plugin_dir_url( __FILE__ ) . 'admin/libs/colorpicker/js/colorpicker.js' );
            wp_enqueue_script( 'colorpickereye', plugin_dir_url( __FILE__ ) . 'admin/libs/colorpicker/js/eye.js' );
            wp_enqueue_script( 'colorpickerutils', plugin_dir_url( __FILE__ ) . 'admin/libs/colorpicker/js/utils.js' );
            //wp_enqueue_script( 'colorpickerlayout', plugin_dir_url( __FILE__ ) . 'TopTopScroller/admin/libs/colorpicker/js/layout.js' );
            wp_enqueue_script( 'colorpickerinitjs', plugin_dir_url( __FILE__ ) . 'admin/js/tts_admin.js' );
            wp_enqueue_script( 'knockoutjs', plugin_dir_url( __FILE__ ) . 'admin/libs/knockoutjs/knockout-3.3.0.js');

            wp_register_style( 'colorpickercss', plugin_dir_url(__FILE__) . 'admin/libs/colorpicker/css/colorpicker.css', false, '1.0.0' );
            wp_enqueue_style( 'colorpickercss' );

        }
    });




});

add_action( 'wp_enqueue_scripts', function(){

    wp_enqueue_script(
        'custom-script',
        plugin_dir_url(__FILE__) . 'js/TopTopScroller.js',
        array( 'jquery' )
    );
    wp_enqueue_script(
        'custom-script2',
        plugin_dir_url(__FILE__) . 'js/TopTopScrollerInit.js'
    );
    wp_localize_script('custom-script2', 'myJsParams', array('options'=> get_option('tts_plugin_options')));
} );


