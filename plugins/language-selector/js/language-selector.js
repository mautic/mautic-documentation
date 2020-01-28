/*!
 * Language Selector JS plugin
 * Copyright 2017 Clement G., Inc.
 * Licensed under MIT
 */

var dropdownmenu={
	animspeed: 200, 			//reveal animation speed (in milliseconds)
	showhidedelay: [150, 150], 	//delay before menu appears and disappears when mouse rolls over it, in milliseconds

	//***** NO NEED TO EDIT BEYOND HERE
	builtdropdownids: [], 		//ids of dropdown already built (to prevent repeated building of same dropdown)
	stubboxenable: false,

	showbox:function($, $dropdown){
		this.stubboxenable = false;
		clearTimeout($dropdown.data('timers').hidetimer);
		$dropdown.data('timers').showtimer=setTimeout(function(){$dropdown.show(dropdownmenu.animspeed)}, this.showhidedelay[0])
	},

	hidebox:function($, $dropdown){
		if(this.stubboxenable === false) {
			clearTimeout($dropdown.data('timers').showtimer);
			$dropdown.data('timers').hidetimer=setTimeout(function(){$dropdown.hide(100)}, this.showhidedelay[1]) //hide dropdown plus all of its sub ULs
		}
	},

	stubbox:function($, $dropdown){
		this.stubboxenable = true;
		clearTimeout($dropdown.data('timers').hidetimer);
		$dropdown.data('timers').showtimer=setTimeout(function(){$dropdown.show(dropdownmenu.animspeed)}, this.showhidedelay[0])
	},


	builddropdown:function($, $menu, $target){
		$menu.css({display:'none'}).addClass('jqdropdown');
		$menu.bind('mouseenter', function(){
			clearTimeout($menu.data('timers').hidetimer)
		});
		$menu.bind('mouseleave', function(){ //hide menu when mouse moves out of it
			dropdownmenu.hidebox($, $menu)
		});
		$menu.data('dimensions', {w:$menu.outerWidth(), h:$menu.outerHeight()}); //remember main menu's dimensions
		$menu.data('timers', {});
		this.builtdropdownids.push($menu.get(0).id) //remember id of dropdown that was just built
	},



	init:function($, $target, $dropdown){
		if (this.builtdropdownids.length === 0){ //only bind click event to document once
			$(document).bind("click", function(e){
				if (e.button === 0){ //hide all dropdown (and their sub ULs) when left mouse button is clicked
					$('.jqdropdown').find('ul').addBack().hide()
				}
			})
		}
		if (jQuery.inArray($dropdown.get(0).id, this.builtdropdownids) === -1) //if this dropdown hasn't been built yet
			this.builddropdown($, $dropdown, $target);
		if ($target.parents().filter('ul.jqdropdown').length>0) //if $target matches an element within the dropdown markup, don't bind ondropdown to that element
			return;
		$target.bind("mouseenter", function(e){
			dropdownmenu.showbox($, $dropdown)
		});
		$target.bind("mouseleave", function(e){
			dropdownmenu.hidebox($, $dropdown)
		});
		$target.bind("click", function(e){
			dropdownmenu.stubbox($, $dropdown)
		})
	}
};

//By default, add dropdown to anchor links with attribute "data-dropdown"
jQuery(document).ready(function($){

  jQuery.fn.adddropdown=function(dropdownid){
    var $=jQuery;
    return this.each(function(){ //return jQuery obj
      var $target=$(this);
      var $dropdownId = $('#'+dropdownid);
      if ($dropdownId.length === 1) //check dropdown is defined
        dropdownmenu.init($, $target, $dropdownId)
    })
  };

	var $anchors=$('*[data-dropdown]');
	$anchors.each(function(){
		$(this).adddropdown(this.getAttribute('data-dropdown'))
	})
});
