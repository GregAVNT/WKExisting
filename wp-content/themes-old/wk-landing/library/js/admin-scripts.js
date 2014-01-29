/*
WK Landing Scripts (admin area)
Author: FulcrumTech, LLC
*/

// JSHint globals
/* global tinyMCE */

jQuery(document).ready(function($) {

	// do not run any of these scripts anywhere except when editing a post (and especially not inside Plupload!)
	if(!$('body').hasClass('post-php') && !$('body').hasClass('post-new-php')) {
		return;
	}

	// Make the right sidebar Public box "sticky"
	// http://stackoverflow.com/questions/5273453/using-jquery-to-keep-scrolling-object-within-visible-window

	// check where the #submitdiv is
	var offset = $('#submitdiv').offset();

	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop(); // check the visible top of the browser

		// add 48 pixels to account height from the top at which the sidebar sticks
		if(offset.top < (scrollTop + 37)) {
			$('#submitdiv').addClass('dynamic-fixed');
		} else {
			$('#submitdiv').removeClass('dynamic-fixed');
		}
	});

	// on page load, hide the optional fields that are unchecked
	$('#optional_sections ul input').each(function() {
		var field_container = $('#' + $(this).val());
		if(!this.checked) {
			field_container.css('display', 'none');
		}
	});

	// when an optional field is checked/unchecked, show or hide it appropriately
	$('#optional_sections ul input').change(function() {
		var field_container = $('#' + $(this).val());
		if(this.checked) {
			field_container.slideDown();
		} else {
			field_container.slideUp();
		}
	});

	// character counter

	// on page load, create character counters that display "0/max characters"
	$('#normal-sortables textarea, #normal-sortables input[type=text]').each(function() {

		// if this field has a description and a character count
		if($(this).next().hasClass('cmb_metabox_description')) {

			// fetch the maximum allowed characters from the DOM
			var maxCharsWrapper = $(this).next().children('span.maxChars')[0];
			if(maxCharsWrapper) {
				var maxChars = maxCharsWrapper.innerText;
				$(this).next().append('<span class="charCount">' + $(this).val().length + '/' + maxChars + ' characters</span>');
			}

		}

	});

	// while user types, adjust the character count (if applicable)
	$('#normal-sortables textarea, #normal-sortables input[type=text]').keyup(function() {

		// if this field has a description
		if($(this).next().hasClass('cmb_metabox_description')) {

			// if this field's description has a character counter
			var charCount = $(this).next().children('span.charCount')[0];
			if(charCount) {

				// fetch the maximum allowed characters from the DOM
				var maxChars = $(this).next().children('span.maxChars')[0].innerText;

				// fetch the current character count, build complete message
				var newCharCount = $(this).val().length + "/" + maxChars + ' characters';

				// if there are more than the allowed characters, wrap in div.charOverflow
				if($(this).val().length > parseInt(maxChars, 10)) {
					charCount.innerHTML = '<span class="charOverflow">' + newCharCount + '</span>';
				} else {
					charCount.innerHTML = newCharCount;
				}

			}
		}

	});

	// add a field
	$('#normal-sortables input.addField').click(function(e) {
		e.preventDefault();

		var sortableWrapper = $(this).prev('.sortable');
		var lastField = sortableWrapper.find('.infinity_wrapper').last();

		// get the count of the next element, increment the hidden counter input field
		var currCountInput = $(this).parent().find('input.infinity_count');
		var currCount = currCountInput.val();
		currCountInput.val(++currCount);

		var thisFieldId = currCountInput.attr('name').replace("count", "");

		var newField = lastField.clone();

		// erase values in all fields
		newField.find('input[type=text], input[type=hidden]').attr('value', '');
		newField.find('textarea').empty();

		// deselect all options
		newField.find('option:selected').removeAttr('selected');

		// remove image preview stuff
		newField.find('.cmb_media_status').empty();

		// replace field counter with incremented number
		var searchTerm1 = thisFieldId + "_" + (--currCount) + "_";
		var searchTerm2 = thisFieldId + "\\[" + currCount + "\\]";
		newField = newField.wrap('<p/>').parent().html().replace(new RegExp(searchTerm1, "g"), thisFieldId + "_" + (++currCount) + "_");
		newField = newField.replace(new RegExp(searchTerm2, "g"), thisFieldId + "[" + currCount + "]");

		sortableWrapper.append(newField);

	});

	/*	Problem: modifying the text fields will delete their values if not saved in the value attribute
		Solution: grab the values of each text field and plop it directly into the HTML of that field
		(This is a little "hacky," I know. Couldn't think of a better solution, though!) */
	(function( $ ) {
		$.fn.saveValues = function() {
			$(this).each(function() {
				$(this).attr('value', $(this).val());
			});
		};
	})( jQuery );

	// remove a field
	$('#normal-sortables').on('click', 'input.removeField', function(e) {
		e.preventDefault();

		// if this is the only remaining field, we can't remove it
		if($(this).parents('.sortable').find('.infinity_wrapper').length === 1) {
			alert("You cannot delete the only element in this section. If you want to exclude this section from this landing page, simply leave these fields blank.");
			return;
		}

		var confirmed = confirm("Are you sure you want to delete this?");
		if(confirmed) {

			// decrement the element counter
			var currCountInput = $(this).parent().parent().parent().find('input.infinity_count');
			var currCount = currCountInput.val();
			currCountInput.val(--currCount);

			// decrement the following elements' indices
			var wrapperClass = '.infinity_wrapper';
			var wrapper = $(this).parent(wrapperClass);
			var nextElement = wrapper.next(wrapperClass);

			// get the index of the item to be deleted by seeing how many items are before this item/
			// the current index will become the next index
			var nextIndex = 0;
			var prevWrapper = wrapper.prev(wrapperClass);
			while(prevWrapper.length) {
				nextIndex++;
				prevWrapper = prevWrapper.prev(wrapperClass);
			}

			var replacer;
			while(nextElement.length) { // while there is a next element...
				replacer = nextElement.clone();

				replacer.find('input[type=text]').saveValues();

				// replace all instances of the old index with the decremented index
				replacer = replacer.html().replace(new RegExp("\\[" + (++nextIndex) + "\\]", "g"), "[" + (nextIndex-1) + "]");
				replacer = replacer.replace(new RegExp("_" + nextIndex + "_", "g"), "_" + (nextIndex-1) + "_");
				nextElement.html(replacer);

				// get the next element
				nextElement = nextElement.next(wrapperClass);
			}

			// animate the removal of this element from the DOM
			$(this).parents(wrapperClass).slideUp(400, function() {
				$(this).remove();
			});

		}
	});

	// make the infinity elements sortable
	$('.cmb_metabox .sortable').sortable({

		axis: 'y',
		cancel: 'input, select, textarea, iframe body',
		cursor: 'move',

		// when the order of the elements has been updated, we need to update all of the elements' indices
		update: function(event, ui) {
			var index = 0;
			var replacer;
			// iterate through the child elements
			$(this).children('.infinity_wrapper').each(function() {

				replacer = $(this);

				replacer.find('input[type=text]').saveValues();

				// in addition to saving the values of the text field, we need to save the values of the <select>s
				replacer.find('select option:selected').attr('selected', 'selected');

				replacer = replacer.html().replace(new RegExp("\\[[0-9]+?\\]", "g"), "[" + index + "]");
				replacer = replacer.replace(new RegExp("_[0-9]+?_", "g"), "_" + index + "_");
				$(this).html(replacer);
				++index;

			});
		}

	});

	// to remove an image, we also need to delete the hidden data
	$('#normal-sortables').on('click', 'a.cmb_remove_file_button', function() {
		var wrapper = $(this).parents('.wk-infinity-field');
		wrapper.find('input[type=hidden]').val('');
	});

	// Disable sorting of meta boxes
	// http://wordpress.stackexchange.com/questions/2474/disable-dragging-of-meta-boxes

    $('.meta-box-sortables').sortable({
        disabled: true
    });

    $('.postbox .hndle').css('cursor', 'default');

});