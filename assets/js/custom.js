
/** Used Only For Touch Devices **/
( function( window ) {
	
	// for touch devices: add class cs-hover to the figures when touching the items
	if( Modernizr.touch ) {

		// classie.js https://github.com/desandro/classie/blob/master/classie.js
		// class helper functions from bonzo https://github.com/ded/bonzo

		function classReg( className ) {
			return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
		}

		// classList support for class management
		// altho to be fair, the api sucks because it won't accept multiple classes at once
		var hasClass, addClass, removeClass;

		if ( 'classList' in document.documentElement ) {
			hasClass = function( elem, c ) {
				return elem.classList.contains( c );
			};
			addClass = function( elem, c ) {
				elem.classList.add( c );
			};
			removeClass = function( elem, c ) {
				elem.classList.remove( c );
			};
		}
		else {
			hasClass = function( elem, c ) {
				return classReg( c ).test( elem.className );
			};
			addClass = function( elem, c ) {
				if ( !hasClass( elem, c ) ) {
						elem.className = elem.className + ' ' + c;
				}
			};
			removeClass = function( elem, c ) {
				elem.className = elem.className.replace( classReg( c ), ' ' );
			};
		}

		function toggleClass( elem, c ) {
			var fn = hasClass( elem, c ) ? removeClass : addClass;
			fn( elem, c );
		}

		var classie = {
			// full names
			hasClass: hasClass,
			addClass: addClass,
			removeClass: removeClass,
			toggleClass: toggleClass,
			// short names
			has: hasClass,
			add: addClass,
			remove: removeClass,
			toggle: toggleClass
		};

		// transport
		if ( typeof define === 'function' && define.amd ) {
			// AMD
			define( classie );
		} else {
			// browser global
			window.classie = classie;
		}

		[].slice.call( document.querySelectorAll( 'ul.grid > li > figure' ) ).forEach( function( el, i ) {
			el.querySelector( 'figcaption > a' ).addEventListener( 'touchstart', function(e) {
				e.stopPropagation();
			}, false );
			el.addEventListener( 'touchstart', function(e) {
				classie.toggle( this, 'cs-hover' );
			}, false );
		} );

	}

})( window );

/*
 * custom.js
 * Custom JS code required by the theme.
 */
 
function load_images(attr)
{
	jQuery('img').each(function()
	{
		if( jQuery(this).data(attr) )
			jQuery(this).attr('src', jQuery(this).data(attr));
	});
} 

jQuery( function($) {

	// Remove no-js class on page load
	$( 'html' ).removeClass( 'no-js' ).addClass( 'js-enabled' );

} );



var sb = 0;//submenu open/closed status
var sb_id; //id reference variable for submenu	
var navItem; 
var pageLoading = false;

// document.ready call
jQuery( document ).ready( function($) {
	
	$(".nav-menu li a").click(function () {
		if ( $(this).parent().hasClass("menu-item-type-custom") && $(this).attr('href') != '#' ) return true;
		
		if (pageLoading == false) {

			nav_item = $(this);

			//set previous and next link & page ids

			//var PrevLink = $('.nav-menu li a.active');
			$('.nav-menu li a.active').removeClass('active');
			$(this).addClass('active');
			
			//SUB MENU FUNCTIONS

			//CASE 1: submenu parent clicked, submenu present, none open

			if ($(this).parent().children('ul.sub-menu').length > 0  && sb == 0 ){
				//indicate that a submenu is open
				sb = 1;
				
				//set submenu reference
				sb_id = $(this).text();
	
				//animate submenu
				$(this).parent().children('ul.sub-menu').slideDown('normal', function (){
					//calculate new sidebar height
					//sideBarHeight();
				});
				
			//CASE 2: submenu parent clicked of open submenu clicked	
			} else if($(this).hasClass('mainmenu') && $(this).parent().children('ul.submenu').length > 0 && $(this).parent().children('ul.submenu').css("display") != "none"){
				//nothing just load the main page
			
			//CASE 3: new submenu parent clicked, submenu present, a submenu is already open
			} else if($(this).parent().children('ul.sub-menu').length > 0  && sb == 1 ){
				//hide previous submenu
				$(".nav-menu li a").each(function (i) {
					if ($(this).text() == sb_id) $(this).parent().children('ul.sub-menu').slideUp();
				});
				
				//animate current  submenu
				$(this).parent().children('ul.sub-menu').delay(500).slideDown('normal', function (){
					//calculate new sidebar height
					//sideBarHeight();
				});
				
				//set new submenu id reference
				sb_id = $(this).text();
				
			//CASE 4: main menu item clicked, no submenu present, hide all submenus	
			} else if ($(this).parent().parent().parent().find(".nav-menu").size() > 0 && $(this).parent().children('ul.sub-menu').length == 0) {
				//in the even a main menu w/ no submenu is clicked, hide any open submenu

				$('.nav-menu ul.sub-menu').slideUp('normal', function (){
					//calculate new sidebar height
					//sideBarHeight();
				});
				
				//all submenus now closed
				sb = 0
			}
			
			file = $(this).attr('href');
			
			$('#main').empty();
			$('#main').spin({ color: '#cccccc' });
			$('#main .spinner').css({top: "250px"});
			
			$.ajax({
				url: file,
			}).done(function(data) {
				
				$('#main').spin(false);
				
				$('#main').html(data).show('fade', function() {
					$("a[rel^='prettyPhoto[pp_gal]']").prettyPhoto({
						animation_speed: 'normal', /* fast/slow/normal */
						slideshow: 5000, /* false OR interval time in ms */
						autoplay_slideshow: false, /* true/false */
						opacity: 1, /* Value between 0 and 1 */
						show_title: false, /* true/false */
						allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						default_width: 500,
						default_height: 344,
						counter_separator_label: ' of ', /* The separator for the gallery counter 1 "of" 2 */
						theme: 'pp_default', /* pp_default / light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						callback: function(){}, /* Called when prettyPhoto is closed */
						ie6_fallback: true,
						markup: '<div class="pp_pic_holder"> \
												<div class="ppt">&nbsp;</div> \
												<div class="pp_content_container"> \
																<div class="pp_content"> \
																		<div class="pp_loaderIcon"></div> \
																		<div class="pp_fade"> \
																				<div class="pp_hoverContainer"> \
																						<a class="pp_next" href="#">next</a> \
																						<a class="pp_previous" href="#">previous</a> \
																						<a class="pp_back_gallery" href="#">back to gallery</a> \
																				</div> \
																				<div id="pp_full_res"></div> \
																				<div class="pp_details"> \
																						<div class="pp_nav"> \
																								<a href="#" class="pp_arrow_previous">Previous</a> \
																								<p class="currentTextHolder">0/0</p> \
																								<a href="#" class="pp_arrow_next">Next</a> \
																						</div> \
																						<p class="pp_description"></p> \
																						<a class="pp_close" href="#">Close</a> \
																				</div> \
																		</div> \
																</div> \
												</div> \
										</div> \
										<div class="pp_overlay"></div>',
						gallery_markup: '',
		
						image_markup: '<img id="fullResImage" src="{path}" />',
						flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
						quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
						iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
						inline_markup: '<div class="pp_inline">{content}</div>',
						custom_markup: '',
						social_tools: '' /* html or false to disable */	
					});
					$('#scrollbar1').tinyscrollbar();
				});
			});
	
			return false;
		}
		
		return false;
	});
	
	// Single post slideshow with Flexslider
	//$('#flexslider-post').flexslider();
	
	// Bxslider for homepage
	$('.slideshow .bxslider').bxSlider({
	  mode: 'fade',
	  captions: true,
	  pager: false,
	  captions: true,
	  auto:true,
	  autoHover: true,
	  pause:5000,
	  speed:4000
	});
																																	  
} )

/* Spinner wrapper for jQuery */
jQuery.fn.spin=function(a){this.each(function(){var c=jQuery(this),b=c.data();if(b.spinner){b.spinner.stop();delete b.spinner}if(a!==false){b.spinner=new Spinner(jQuery.extend({color:c.css("color")},a)).spin(this)}});return this};