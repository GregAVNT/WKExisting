/*
WK Landing Scripts
Author: FulcrumTech, LLC
*/

// JSHint globals
/* global Modernizr, conditionizr */

// add Browser Awareness Day, jQuery UI (for tabs), ddSlick drop-down, FitVids, spin.js (and its jQuery plugin), iOS orientation fix, Placeholders.js
// @codekit-prepend 'libs/browser-awareness.js', 'libs/jquery-ui-1.10.3.custom.js', 'libs/jquery.ddslick.js', 'libs/jquery.fitvids.js', 'libs/spin.js', 'libs/jquery.spin.js'
// @codekit-append 'libs/ios-orientationchange-fix.js', 'libs/placeholders.js'

// IE8 polyfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop === 'float') { prop = 'styleFloat'; }
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    };
}


// Conditionizr
// http://conditionizr.com/
conditionizr({ ie9 : { scripts: false, styles: false, classes: true, customScript: false } });


// as the page loads, call these scripts
jQuery(document).ready(function($) {

	// some variables
	var currViewport = 1;
	var vertScrollPos = 0;

	// FitVids (for responsive video sizes)
	// https://github.com/davatron5000/FitVids.js
	$(".video").fitVids();

	// Add placeholder for email address field
	// Placeholder polyfill: http://jamesallardice.github.io/Placeholders.js/
	$("html").attr('data-placeholder-focus', 'false');
	$("input[type=email]").attr('placeholder', 'Email address');

	// something is weird in < IE9 that fills in the value as "Email address" by default
	// whatever, this will delete that nonsense
	if($('html').hasClass('lt-ie9')) { $("input[type=email]").attr('value', ''); }

	// Email sign-up AJAX spinner
	// Uses spin.js: http://fgnass.github.io/spin.js/

	// add the spinner when the user clicks the submit button
	$('.gform_wrapper').on('click', 'button', function() {
		$("#spinner").spin({
			lines: 11, // The number of lines to draw
			length: 4, // The length of each line
			width: 2, // The line thickness
			radius: 5, // The radius of the inner circle
			corners: 1, // Corner roundness (0..1)
			rotate: 0, // The rotation offset
			direction: 1, // 1: clockwise, -1: counterclockwise
			color: '#000', // #rgb or #rrggbb
			speed: 1, // Rounds per second
			trail: 60, // Afterglow percentage
			shadow: false, // Whether to render a shadow
			hwaccel: false, // Whether to use hardware acceleration
			className: 'spinner', // The CSS class to assign to the spinner
			zIndex: 2e9, // The z-index (defaults to 2000000000)
			top: 'auto', // Top position relative to parent in px
			left: 'auto' // Left position relative to parent in px
		});
	});

	// remove the spinner when the AJAX has loaded
	$(document).on('gform_post_render', function() {
		$('#spinner').spin(false);

		// adjust height of Press Release box to match new height of email box
		if ($(window).width() >= 768) {
			var oldPRHeight = $('#press-release').height();
			var newPRHeight = $('#email-signup').height() + 4;
			$('#press-release').height(newPRHeight);
			$('#press-release a').css('marginTop', (newPRHeight - oldPRHeight)/2);
		}
	});

	// get URL parameters: http://codereview.stackexchange.com/questions/9574/faster-and-cleaner-way-to-parse-parameters-from-url-in-javascript-jquery
    function getUrlVars() {
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}

	// set active tab based off of URL parameter "tab"
	var selectedTab = $('.' + getUrlVars().tab);
	var activeTab = 0;
	var mainActiveTab = 0;
	if(selectedTab) {

		// find active (secondary) tab
		var currTab = selectedTab;
		while(currTab.prev().hasClass('pane')) {
			activeTab++;
			currTab = currTab.prev();
		}

		// set selected tab as selected option in mobile drop-down menu
		selectedTab.parents('.inner-tab').find('.mobile-header select option:nth-child(' + (activeTab+1) + ')').attr('selected', 'selected');

		// set main active tab
		currTab = selectedTab.parents('.tabs2');
		while(currTab.prev().hasClass('tabs2')) {
			mainActiveTab++;
			currTab = currTab.prev();
		}

	} else {
		var selectedTabCandidate = $('#tab-1 .desktop-header .pane').first();
		if(selectedTabCandidate.length) {
			selectedTab = selectedTabCandidate;
		}
	}

	// initialize the zoomer's position
	function zoomerInit() {
		$('.zoomer').each(function() {

			// calculate zoomer position under first inner tab
			var zoomerPos = $(this).parent('.inner-tab').find('.desktop-header li:first-child a').width() / 2;
			zoomerPos -= 16;

			// only add style if the zoomerPos is greater than 0 (should be always)
			// and if the zoomer currently has no position already applied to it
			if(zoomerPos > 0 && $(this).css('left') === 'auto' || $(this).css('left') === '0px') {
				$(this).css('left', zoomerPos+'px');
			}

		});
	}
	zoomerInit();

	// change zoomer position
	$(".desktop-header a").click(function() {
		var zoomerPos = 0;
		var currId = $(this).attr('id');

		// calculate current zoomer position
		// iterate through each tab, adding its width, until we reach the current tab where we add half its width and then break
		$(this).parents('.desktop-header').find('a').each(function() {
			if($(this).attr('id') === currId) {
				zoomerPos += $(this).width() / 2;
				return false;
			}
			zoomerPos += $(this).width();
		});
		zoomerPos -= 16;

		// animate position change (using jQuery UI's easeinQuad easing)
		$(this).parents('.inner-tab').find('.zoomer').animate({ left: zoomerPos+'px' }, 400, 'easeInQuad');
	});

    // add some CSS classes
    $("#book-desc-intro p:last-child").addClass('last-child');
    $("#book-desc p:last-child").addClass('last-child');

    // for browsers that don't support CSS calc()
	function fixCustomerInsight() {
		if(!Modernizr.csscalc) {
			var insightWidth = $('.customer_insight').width();
			$('.insight-content').width(insightWidth - 507);
		}
	}

	function responsiveScripts(resizing) {

		// resets before calculations
		$('.top-module').css("paddingLeft", "").css("textAlign", "");
		$('#tabs > ul li a').css("width", "");

		// set subtitle lines widths
		$(".subtitle-lines span").each(function() {
			var parentWidth = $(this).parent().width();
			var h3Width = $(this).prev().width();
			$(this).width(parentWidth - h3Width - 8);
		});

		// calculate clears for sample content
		if($(".pane.sample_content").length) {

			var samplesWidth = $(".pane.sample_content").width();
			var sampleWidth = 250;
			var samplesPerRow = Math.floor(samplesWidth/sampleWidth);

			var sampleCount = 0;
			$('.pane.sample_content .sample').each(function() {
				if(sampleCount > 0 && sampleCount % samplesPerRow === 0) {
					$(this).addClass('sample-clear');
				} else if($(this).hasClass('sample-clear')) {
					$(this).removeClass('sample-clear');
				}
				sampleCount++;
			});

		}

		// getting viewport width
		var responsive_viewport = $(window).width();

		// if is below 481px
		if (responsive_viewport < 768) {

			// add 2px of horizontal space between each tab
			$('#tabs > ul li a').css("width", $('#tabs > ul li a').width() - 1);

			// sort of janky "fix" for annoying iOS rotation problem
			$("body").scrollLeft(0);

			// set current viewport as mobile
			currViewport = 0;

		}

		// if is above or equal to 768px
		if (responsive_viewport >= 768) {

			// set Webinar Module and Podcast Module to align left to each other
			if($('#webinar-module').length && $('#podcast-module').length) {

				// get the width of the container element (both modules always have the same width)
				var containerWidth = $('#webinar-module').width();

				// find the widest module
				var webinarWidth = $('#webinar-module div').width();
				var podcastWidth = $('#podcast-module div').width();
				var largestWidth = 0;
				if(webinarWidth > podcastWidth) {
					largestWidth = webinarWidth;
				} else {
					largestWidth = podcastWidth;
				}

				// find correct left padding for the two modules (adjust for padding-left of 37px)
				var paddingLeft = (containerWidth/2) - (largestWidth/2) - 18.5;

				// add calculated padding-left, disable text-align:center
				$('.top-module').css("paddingLeft", paddingLeft).css("textAlign", "left");

			}

			// position the hero image
			var heroImage = $('#hero-image');
			if(heroImage.length) {

				if(resizing) {

					var heroHeight = $('#hero').height();
					var bookModHeight = $('#book-module').height();
					if(bookModHeight > heroHeight) {
						heroImage.css('bottom', 472 - bookModHeight + heroHeight);
					} else {
						heroImage.css('bottom', '');
					}

				} else {

					var timesRun = 0;
					var heroInterval = setInterval(function() {
						timesRun++;
						if(timesRun === 5) { clearInterval(heroInterval); }
						var heroHeight = $('#hero').height();
						var bookModHeight = $('#book-module').height();
						if(bookModHeight > heroHeight) {
							heroImage.css('bottom', 472 - bookModHeight + heroHeight);
						} else {
							heroImage.css('bottom', '');
						}
					}, 500);

				}

			}

			fixCustomerInsight();

			if(responsive_viewport === 768) {
				$('body').addClass('ipad-portrait');
			} else {
				$('body').removeClass('ipad-portrait');
			}

			// when switching from mobile back to desktop, initialize zoomer
			if(currViewport === 0) { zoomerInit(); }

			// set margin for eBooks
			if($('.pane.ebook_products > .related-book').length > 1) {

				var inklingHeight = $('.pane.ebook_products #inkling-modules').height() + 40;
				var ebooksHeaderHeight = $('.pane.ebook_products #ebooks-header').height();

				if(inklingHeight > ebooksHeaderHeight) {
					var extraMargin = inklingHeight - ebooksHeaderHeight;
					$('.pane.ebook_products > .related-book').first().css('marginTop', extraMargin);
				} else {
					$('.pane.ebook_products > .related-book').first().css('marginTop', '');
				}

			}

			// set current viewport as desktop
			currViewport = 1;

		}

	}

	// run responsive scripts on load and on window resize
	responsiveScripts();
	$(window).resize(function() {
		responsiveScripts(true);
	});

	// Tabs!
	// built using jQuery UI: http://jqueryui.com/tabs/

	var iosTimeout;

	// slightly different settings for desktop and mobile
	// also, only load tabs if there are tabs to load!
	if($("#tabs").length && currViewport === 1) {

		$("#tabs").tabs({
			show: {
				effect: "blind", duration: 600, easing: 'easeInCubic'
			},
			hide: {
				effect: "blind", duration: 600, easing: 'easeOutCubic'
			},
			// prevent screen jump (http://stackoverflow.com/questions/243794/jquery-ui-tabs-causing-screen-to-jump)
			beforeActivate: function(event, ui) {
				$(this).css('height', $(this).height()).css('overflow', 'hidden');
			},
			activate: function(event, ui) {

				zoomerInit();

				// animate this transition - bring the rest of the page up/down to meet the bottom of the newly visible tab
				// http://stackoverflow.com/questions/5003220/javascript-jquery-animate-to-auto-height
				var curHeight = $(this).height();
				var autoHeight = $(this).css('height', 'auto').height();
				$(this).height(curHeight).animate({
					height: autoHeight,
					overflow: 'visible'
				}, 500, 'swing', function() {
					$(this).height(''); // necessary in case of a window resize
				});

			},
			active: mainActiveTab
		});

		$('.desktop-header').parents('.tabs2').tabs({
			show: {
				effect: "fade", duration: 400,
			},
			hide: {
				effect: "fade", duration: 400
			},
			// prevent screen jump (http://stackoverflow.com/questions/243794/jquery-ui-tabs-causing-screen-to-jump)
			beforeActivate: function(event, ui) {
				$(this).css('height', $(this).height()).css('overflow', 'hidden');
			},
			activate: function(event, ui) {

				// animate this transition - bring the rest of the page up/down to meet the bottom of the newly visible tab
				// http://stackoverflow.com/questions/5003220/javascript-jquery-animate-to-auto-height
				var curHeight = $(this).height();
				var autoHeight = $(this).css('height', 'auto').height();
				$(this).height(curHeight).animate({
					height: autoHeight,
					overflow: 'visible'
				}, 400, 'swing', function() {
					$(this).height(''); // necessary in case of a window resize
				});

				// fix for customer insight tab
				fixCustomerInsight();

			},
			active: activeTab
		});

	} else if($("#tabs").length) {

		$("#tabs").tabs({
			show: {
				effect: "blind", duration: 600, easing: 'easeInCubic'
			},
			hide: {
				effect: "blind", duration: 600, easing: 'easeOutCubic'
			},
			beforeActivate: function(event, ui) {

				// iOS is being a pain
				document.ontouchmove = function(e){ e.preventDefault(); };

				vertScrollPos = $(window).scrollTop();
				iosTimeout = setInterval(function() {
					$(window).scrollTop(vertScrollPos);
				}, 10);

			},
			activate: function(event, ui) {
				clearInterval(iosTimeout);
				document.ontouchmove = function(e){};
			},
			active: mainActiveTab
		});

		$('.desktop-header').parents('.tabs2').tabs({
			show: {
				effect: "fade", duration: 400,
			},
			hide: {
				effect: "fade", duration: 400
			},
			beforeActivate: function(event, ui) {

				// iOS is being a pain
				document.ontouchmove = function(e){ e.preventDefault(); };

				vertScrollPos = $(window).scrollTop();
				iosTimeout = setInterval(function() {
					$(window).scrollTop(vertScrollPos);
				}, 10);

			},
			activate: function(event, ui) {
				clearInterval(iosTimeout);
				document.ontouchmove = function(e){};
			},
			active: activeTab
		});

	}

	// ddSlick dropdown menus
	// http://designwithpc.com/Plugins/ddSlick
	// (This plugin was super buggy, so I patched it using my best judgement and some suggestions by other users on GitHub.)

    $(".mobile-header select").each(function(){
        $(this).ddslick({
            showSelectedHTML: false,
            width: 200,
			embedCSS : false,
			onSelected: function(data) {
				var tabId = parseInt(data.original[0].id.replace("dropdown-", ""), 10);
				$('div #tab-' + tabId).tabs( "option", "active", data.selectedIndex );
			}
        });
    });

	// set zoomer by clicking on the active tab
    if(selectedTab.length) { selectedTab.parents('.inner-tab').find('#' + selectedTab.attr('aria-labelledby')).click(); }

	// IE 7 fixes
	// mostly just fixing box-sizing problems

	if($('html').hasClass('lt-ie8')) {

		$('.video').width($('.video').width() - 50);

		var articleHeaderWidth = $('.article-header').width();
		if( ((articleHeaderWidth * 0.34) - 20) > 108 ) {
			$('.logo-wrapper').width(108);
		} else {
			$('.logo-wrapper').width(((articleHeaderWidth * 0.34) - 20));
		}

	}

	// "Fixing" iOS bug: the page scrolls up to the top for no reason whatsoever sometimes

	if($(window).width() < 768) {

		var timeout;

		$('#email-signup input').focus(function() {

			var emailPos = $('#email-signup').offset().top - ($(window).height() * 0.07);
			timeout = setInterval(function() {
				$(window).scrollTop(emailPos);
			}, 10);

			document.ontouchmove = function(e){ e.preventDefault(); };

		});

		$(window).resize(function() {

			clearInterval(timeout);
			document.ontouchmove = function(e){};

			if($('#email-signup input:focus').length) {

				var emailPos = $('#email-signup').offset().top - ($(window).height() * 0.07);
				timeout = setInterval(function() {
					$(window).scrollTop(emailPos);
				}, 10);

				document.ontouchmove = function(e){ e.preventDefault(); };

			}

		});

		$('#email-signup input, .gform_footer button').blur(function() {
			clearInterval(timeout);
			document.ontouchmove = function(e){};
		});

		$('.dd-selected').click(function() {
			vertScrollPos = $(window).scrollTop();
			window.setTimeout(function() {
				$(window).scrollTop(vertScrollPos);
			}, 50);
		});

	}

}); /* end of as page load scripts */