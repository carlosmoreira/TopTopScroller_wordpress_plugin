/**
 * Created by carlos on 2/14/15.
 */

$(document).ready(function(){
    var tts_bgColor = $('#tts_bgColor'),
        tts_color = $('#tts_color');


    tts_bgColor.css('background-color',  tts_bgColor.val());
    tts_color.css('background-color',  tts_color.val());

    $('#tts_bgColor,#tts_color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).val("#"+hex);
            $(el).css('background-color', "#"+hex);
            $(el).ColorPickerHide();
            $('#tts_color, #tts_bgColor').trigger('blur');
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor(this.value);
            $(this).ColorP
        }
    })

});
