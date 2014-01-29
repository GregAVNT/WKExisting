<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

add_image_size( 'cobrand-logo', 108, 108 );
add_image_size( 'cobrand-logo-footer', 130, 130 );
add_image_size( 'book-main', 251, 9999 );			// "unlimited height"
add_image_size( 'bio-pic', 138, 172, true );
add_image_size( 'sample', 185, 296 );
add_image_size( 'insight', 215, 136, true );
add_image_size( 'related-book', 128, 205, true );
add_image_size( 'inkling', 257, 149 );
add_image_size( 'ebook', 125, 162, true );

// fixes retina.js bug: hidden images (ex: images in inactive tabs)
// are loaded with width/height attributes of 0
function get_wk_img($id, $size) {

	$img = wp_get_attachment_image_src($id, $size);

	$attr = array(
		'style'	=> "width:{$img[1]}px;height:{$img[2]}px;"
	);

	return wp_get_attachment_image($id, $size, false, $attr);

}


/************* OPTIONTREE *****************/

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
load_template( trailingslashit( get_template_directory() ) . 'library/theme-options.php' );


/************* POST FEATURES *****************/

function modify_post_features() {
	// remove main editor, custom fields since we're exclusively using meta boxes
	remove_post_type_support('page', 'custom-fields');
	remove_post_type_support('page', 'editor');
}
add_action('init', 'modify_post_features');

// remove posts editor
function remove_posts_menu() {
	remove_menu_page('edit.php');
}
add_action( 'admin_menu', 'remove_posts_menu' );


/************* METABOXES *****************/

define('PREMBOX', '_wk_');

function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'library/metabox/init.php';
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

require_once('library/metabox/metaboxes.php');

function metabox_enabled($id) {
	$enabled_metaboxes = get_post_meta(get_the_ID(), PREMBOX.'optional_sections', false);
	return in_array($id, $enabled_metaboxes);
}

function meta_set($key) {
	return (bool) get_post_meta(get_the_ID(), PREMBOX . $key, true);
}

function get_meta($key, $return = false) {
	$meta = get_post_meta(get_the_ID(), PREMBOX . $key, true);
	if($return)
		return $meta;
	else
		echo $meta;
}

// input: array of metaboxes, output: number of metaboxes from array that are enabled
function number_metas_enabled($metas) {
	$count = 0;
	foreach($metas as $meta) {
		if(metabox_enabled($meta))
			$count++;
	}
	return $count;
}

// is this array of authors empty?
function authors_empty($authors) {
	return !((bool) $authors[0]['name']);
}

function buy_now_button() {
	echo '<a href="' . get_meta('buy_now_link', true) . '" class="big-pink-button" target="_blank">Buy Now! <i class="icon-chevron-sign-right icon-large"></i></a>';
}


/************* REQUIRED METABOXES *****************/

// credit: http://wordpress.org/support/topic/admin_notices-on-save_post

add_action('save_post', 'required_warning'); // called before the redirect
add_action('admin_notices', 'add_plugin_notice'); // called after the redirect

function add_plugin_notice() {
	if (get_option('display_my_admin_message')) { // check whether to display the message
		update_option('display_my_admin_message', 0); // turn off the message
		?>
		<div class="error">
	        <p><strong>Warning: some required fields are incomplete.</strong> <?php echo get_option('my_admin_message'); ?></p>
	    </div>
    	<?php
	}
}

function required_warning() {

	// get the post ID
	if(isset($_GET['post']))
		$post_id = $_GET['post'];
	elseif(isset($_POST['post_ID']))
		$post_id = $_POST['post_ID'];

	// post not yet saved
	if(!isset($post_id))
		return;

	$metaboxes = wk_metaboxes(array());
	$meta = get_post_custom($post_id);

	// for each metabox
	$incompletes = array();

	foreach($metaboxes as $metabox) {

		if(!isset($metabox['wk_setting']))
			continue;

		$incomplete_fields = array();

		// if this metabox is required
		if($metabox['wk_setting'] === 'required') {

			$skip_list = array();

			// for each field
			foreach($metabox['fields'] as $field) {

				$wkSet = isset($field['wk_setting']);

				// skip this iteration if this field is in the "skip list"
				if(in_array($field['id'], $skip_list))
					continue;

				// if this field has an xor dependency, skip its dependency
				if($wkSet && $field['wk_setting'] === 'required_xor')
					$skip_list[] = PREMBOX . $field['required_xor'];

				// if that field does not have a value
				if(!isset($meta[$field['id']][0]) || (!isset($meta[$field['id']][0]) && !$meta[$field['id']][0]) ) {

					// for xor-dependent requires
					if($wkSet && $field['wk_setting'] === 'required_xor') {

						// if the dependency does not have a value
						if(!isset($meta[PREMBOX . $field['required_xor']][0]) || !$meta[PREMBOX . $field['required_xor']][0]) {

							// get the name of the xor dependency
							foreach($metabox['fields'] as $field2) {
								if($field2['id'] === PREMBOX . $field['required_xor']) {
									$xor_field = $field2['name'];
									break;
								}
							}

							$incomplete_fields[] = $field['name'] . ' or ' . $xor_field;

						}

					// if it is not optional (i.e. if it is required)
					} else if(!$wkSet || $field['wk_setting'] !== 'optional') {
						$incomplete_fields[] = $field['name'];
					}

				}

			}

			if(!empty($incomplete_fields)) {
				if(count($metabox['fields']) > 1)
					$incompletes[] = str_replace(' <em>(required)</em>', '', $metabox['title']) . ': ' . implode(', ', $incomplete_fields);
				else
					$incompletes[] = str_replace(' <em>(required)</em>', '', $metabox['title']);
			}

		}

		// if this metabox is optional
		elseif($metabox['wk_setting'] === 'optional') {

			// if this metabox has not been selected to be included, no reason to proceed
			if(!isset($meta[PREMBOX . 'optional_sections']) || !in_array($metabox['id'], $meta[PREMBOX . 'optional_sections']))
				continue;

			// for each field
			foreach($metabox['fields'] as $field) {

				// keep going for non-required fields
				if(!$wkSet || $field['wk_setting'] !== 'required')
					continue;

				// if that field does not have a value
				if(!isset($meta[$field['id']][0]) && !$meta[$field['id']][0])
					$incomplete_fields[] = $field['name'];

			}

			if(!empty($incomplete_fields))
				$incompletes[] = $metabox['title'] . ': ' . implode(', ', $incomplete_fields);

		}

		unset($incomplete_fields);

	}

	if(!empty($incompletes)) {

		// convert array of incompletes into an array of list items of incompletes
		foreach($incompletes as $key => $val)
			$incompletes[$key] = '<li>' . $val . '</li>';

		update_option('my_admin_message', '<ul>' . implode("\n", $incompletes) . '</ul>');
		update_option('display_my_admin_message', 1); // turn on the message

	}

}


/************* MODIFY TINYMCE *****************/

// remove unused items
// http://wordpress.org/support/topic/tinymce-formatting-options-remove-h1-h1-pre
function customformatTinyMCE($init) {

	$pane_wysiwygs = array('_wk_spotlight_content', '_wk_about_desc', '_wk_review', '_wk_insight1_content', '_wk_insight2_content', '_wk_insight3_content', '_wk_insight4_content');

	if(in_array($init['elements'], $pane_wysiwygs))
		$init['theme_advanced_blockformats'] = 'p,h3,h4';
	else
		$init['theme_advanced_blockformats'] = 'p,h2,h3,h4';

	$init['theme_advanced_disable'] = 'strikethrough,forecolor,justifyfull,blockquote,outdent,indent';

	return $init;

}
add_filter('tiny_mce_before_init', 'customformatTinyMCE');


/************* GRAVITY FORMS *****************/

// modify submit button
function form_submit_button($button, $form){
    return "<button class='green-button' id='gform_submit_button_{$form["id"]}'>Subscribe <i class='icon-chevron-sign-right'></i></button>";
}
add_filter("gform_submit_button", "form_submit_button", 10, 2);

// remove default AJAX spinner
function spinner_url($image_src, $form){
    return "";
}
add_filter("gform_ajax_spinner_url", "spinner_url", 10, 2);

// modify validation errors to include the word "error"
function custom_validation($result, $value, $form, $field){
    $result["message"] = "Error: " . $result["message"];
    return $result;
}
add_filter("gform_field_validation", "custom_validation", 10, 4);

// disable the "confirmation anchor" (prevent scrolling after form submit)
add_filter("gform_confirmation_anchor", create_function("","return false;"));

function submit_to_exacttarget($entry, $form) {

	$lid = get_post_meta(intval($entry["2"]), PREMBOX . 'et_lid', true);

	// if we don't have a list id, stop here
	if(!$lid) return;

	$email = $entry["1"];
	$source = "Landing Page: " . get_post_meta(intval($entry["2"]), PREMBOX . 'book_title', true);

	$etURL  = "http://cl.exct.net/subscribe.aspx?&SubAction=sub_add_update&MID=10496145";
	$etURL .= "&lid=" . urlencode($lid);
	$etURL .= "&Email+Address=" . urlencode($email);
	$etURL .= "&Source=" . urlencode($source);

	$etch = curl_init();
	curl_setopt($etch, CURLOPT_URL, $etURL);
	curl_setopt($etch, CURLOPT_RETURNTRANSFER, 1);
	$etresult = curl_exec($etch);
	curl_close($etch);

}
add_action("gform_after_submission_1", "submit_to_exacttarget", 10, 2);


/************* SHORTCODES *****************/

function the_year() {
    return date('Y');
}
add_shortcode('the-year', 'the_year');


/************* BOOKS *****************/

$bookNum = 1;

function print_book($book, $ebook = false) {
	global $bookNum; ?>

	<div class="related-book clearfix <?php echo $bookNum % 2 === 0 ? 'even' : 'odd'; ?>">

		<?php // BOOK IMAGE ?>
		<div class="book-cover">
			<?php if($book['link']) { ?><a href="<?php echo $book['link']; ?>" target="_blank"><?php } ?>

			<?php echo get_wk_img($book['image']['id'], $ebook ? 'ebook' : 'related-book'); ?>

			<?php if($ebook) echo '<div></div>'; ?>
			<?php if($book['link']) { ?></a><?php } ?>
			<?php if($book['bubble_text']) echo '<span>' . $book['bubble_text'] . '</span>'; ?>
		</div>

		<div class="book-info">

			<?php // BOOK TITLE ?>
			<?php if(isset($book['title_intro']) && $book['title_intro']) echo '<h3 class="title-intro">' . $book['title_intro'] . '</h3>'; ?>
			<?php if($book['link']) { ?><a href="<?php echo $book['link']; ?>" target="_blank"><?php } ?>
			<h3><?php echo $book['title'] ?><?php if($book['edition']) echo '<span>, '. $book['edition'] . '</span>'; ?></h3>
			<?php if(isset($book['subtitle']) && $book['subtitle']) echo '<h4>' . $book['subtitle'] . '</h4>'; ?>
			<?php if($book['link']) { ?></a><?php } ?>

			<?php // BOOK DETAILS ?>
			<?php if($book['isbn'] || $book['price'] || $book['sale_price']) {

				echo '<p>';

				if($book['isbn'])
					echo '<strong>ISBN:</strong> ' . $book['isbn'];

				if($book['price']) {
					$price = floatval($book['price']);
					echo '<br /><strong>Price:</strong> $' . $price;

					if(isset($book['discount_percent']) && $book['discount_percent']) {

						// get the percentage off, removing the % sign if the user decided that was a wise thing to include
						$discount_percent = floatval(str_replace('%', '', $book['discount_percent']));

						// get the discounted price
						// (rounded to 2 decimal places because that's how money works, despite what gas stations may think)
						$discount_price = round($price - ($price * ($discount_percent/100)), 2); ?>

						<br />
						<strong>Discount Price:</strong> $<?php echo $discount_price; ?><br />
						<strong>You Save:</strong> <?php echo $discount_percent; ?>%

					<?php }

				}

				echo '</p>';

			} ?>

			<?php // LEARN MORE ?>
			<?php if($book['link']) { ?>
				<a href="<?php echo $book['link']; ?>" class="pink-button" target="_blank">
				<?php echo $ebook ? 'Buy Now' : 'Learn More'; ?> <i class="icon-chevron-sign-right icon-large"></i>
				</a>
			<?php } ?>

		</div>

	</div>

	<?php $bookNum++;
}

?>