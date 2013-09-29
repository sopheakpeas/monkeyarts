
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
	
	// Content scrollbar
	$('#scrollbar1').tinyscrollbar();
	
	//Portfolio
	load_images('src');
																																	  
} )