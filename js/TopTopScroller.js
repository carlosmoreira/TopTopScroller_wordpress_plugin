var TopTopScroller = (function() {
	var config = {
			timeToScroll: 1000, //Time it takes to reach the top
			showFromTop: 10, // Amount of pixels it shows up when scrolled from top
			customClass: "", //Gives the node a custom class to it
			rightorleft: "right", //Side position on screen to show it from
			pixelsFromSide: 10, //Pixels from the side to show it from
			pixelsFromBottom: 10, //Pixels from the bottom to show it from
			text: "Top", //Text that appears on button
			width: "150", //Default width
			height: "50", //Default height
			bgColor : "#717171",
			color : "white",
			borderRad : "50"
		},

		init = function(keySet) {
			console.log('init called');
			config = $.extend({}, config, keySet);

			//Create the Dom object
			$('body').append("<div style='cursor:pointer; display:none; position: fixed;'  id='TopTopScroller'" + ((config.customClass !== "") ? "class='" + config.customClass + "'" : "") + " >" +

				"" + config.text + "</div>");

			$('#TopTopScroller').css({
				left: (config.rightorleft === "left") ? config.pixelsFromSide + "px" : null,
				right: (config.rightorleft === "right") ? config.pixelsFromSide + "px" : null,
				bottom: config.pixelsFromBottom + "px",
				width: config.width,
				height: config.height,
				color : config.color


			}).css("background-color", config.bgColor).
				css("border-radius", config.borderRad+"%").
				css("line-height", (config.height)+"px").
				css("text-align", "center")


			.click(function() {
				console.log("Clicked Top");
				$('html, body').animate({
					scrollTop: 0
				}, config.timeToScroll, function() {
					//console.log("done");
				});


			});

			//On Window Scroll
			$(window).scroll(function() {
				console.log("scrolling");
				if ($(window).scrollTop() > config.showFromTop) {
					console.log("More than 10");
					$('#TopTopScroller').fadeIn();
				} else {
					if ($('#TopTopScroller')) {
						$('#TopTopScroller').fadeOut(1000, function() {});
					}
				}
			});
			//End Window Scroll Top
		};
	return {
		init: init
	};
}());