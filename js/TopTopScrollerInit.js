/**
 * Created by carlos on 2/12/15.
 */

/*
* To Do :
*
 timeToScroll: 1000, //Time it takes to reach the top
 showFromTop: 10, // Amount of pixels it shows up when scrolled from top
 customClass: "", //Gives the node a custom class to it
 pixelsFromBottom: 10, //Pixels from the bottom to show it from
* */

$(document).ready(function(){
    console.log(parseInt(myJsParams.options.tts_width_option)+"px");
    var options = myJsParams.options; //Recieved From SimplePlugin.php
    TopTopScroller.init({
        text : options.tts_text_option,
        color: options.tts_color_option,
        bgColor : options.tts_bgColor_option,
        rightorleft : options.tts_leftOrRight_option,
        pixelsFromSide : parseInt(options.tts_pixelsFromSide_option),
        width: parseInt(options.tts_width_option),
        height: parseInt(options.tts_height_option),
        borderRad : parseInt(options.tts_borderRad_option)
    });
})


