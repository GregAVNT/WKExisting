<?php update_option('siteurl','localhost'); 
update_option('home','localhost'); 
require_once('library/bones.php'); 
require_once('library/admin.php'); 
add_image_size( 'cobrand-logo', 108, 108 ); 
add_image_size( 'cobrand-logo-footer', 130, 130 ); 
add_image_size( 'book-main', 251, 9999 ); 
add_image_size( 'bio-pic', 138, 172, true ); 
add_image_size( 'sample', 185, 296 ); 
add_image_size( 'insight', 215, 136, true ); 
add_image_size( 'related-book', 128, 205, true ); 
add_image_size( 'related-book-soft', 158, 205 ); 
add_image_size( 'inkling', 257, 149 ); 
add_image_size( 'ebook', 125, 162, true ); 


function theme_add_bootstrap() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/library/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_script('less-js', get_template_directory_uri().'/library/bootstrap/js/less.min.js');
    wp_enqueue_script('respond-js', get_template_directory_uri().'/library/bootstrap/js/respond.min.js');
    wp_enqueue_style( 'style-less', get_template_directory_uri() . '/library/bootstrap/css/styles.css' );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/library/bootstrap/js/bootstrap.min.js', array(), '3.0.0', true );
}
 
add_action( 'wp_enqueue_scripts', 'theme_add_bootstrap' );

function autoCompileLess() {

    // include lessc.inc
    require_once( get_template_directory().'/library/bootstrap/less/lessc.inc.php' );

    // input and output location
    $inputFile = get_template_directory().'/library/bootstrap/styles.less';
    $outputFile = get_template_directory().'/library/bootstrap/styles.css';

    // load the cache
    $cacheFile = $inputFile.".cache";

    if (file_exists($cacheFile)) {
        $cache = unserialize(file_get_contents($cacheFile));
    } else {
        $cache = $inputFile;
    }

    $less = new lessc;
    // create a new cache object, and compile
    $newCache = $less->cachedCompile($cache);

    // output a LESS file, and cache file only if it has been modified since last compile
    if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
        file_put_contents($cacheFile, serialize($newCache));
        file_put_contents($outputFile, $newCache['compiled']);
    }
}

if(is_admin()) {
    //add_action('init', 'autoCompileLess');
}

function get_wk_img($id, $size) { 
	$img = wp_get_attachment_image_src($id, $size); 
	$attr = array( 'style' => "width:{$img[1]}px;height:{$img[2]}px;" ); 
	return wp_get_attachment_image($id, $size, false, $attr); 
	} 
	
add_filter( 'ot_show_pages', '__return_false' ); 
add_filter( 'ot_show_new_layout', '__return_false' ); 
add_filter( 'ot_theme_mode', '__return_true' ); 
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' ); 
load_template( trailingslashit( get_template_directory() ) . 'library/theme-options.php' ); 

function modify_post_features() { 
	remove_post_type_support('page', 'custom-fields'); 
	remove_post_type_support('page', 'editor');
	 } 
	 
add_action('init', 'modify_post_features'); 

function remove_posts_menu() { 
	remove_menu_page('edit.php'); 
	} 
	
add_action( 'admin_menu', 'remove_posts_menu' ); 
define('PREMBOX', '_wk_'); 
function cmb_initialize_cmb_meta_boxes() { 
	if ( ! class_exists( 'cmb_Meta_Box' ) ) 
	require_once 'library/metabox/init.php'; 
	} 
	
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 ); 
require_once('library/metabox/metaboxes.php'); 

function metabox_enabled($id) { $enabled_metaboxes = get_post_meta(get_the_ID(), PREMBOX.'optional_sections', false); 
return in_array($id, $enabled_metaboxes); } 

function meta_set($key) { return (bool) get_post_meta(get_the_ID(), PREMBOX . $key, true); } 
function get_meta($key, $return = false) { $meta = get_post_meta(get_the_ID(), PREMBOX . $key, true); if($return) return $meta; else echo $meta; } 
function number_metas_enabled($metas) { $count = 0; foreach($metas as $meta) { if(metabox_enabled($meta)) $count++; } return $count; } 
function authors_empty($authors) { return !((bool) $authors[0]['name']); } 
function learn_more_button() { echo '<a href="' . get_meta('buy_now_link', true) . '" target="_blank"><div class="col-sm-6 col-md-3 wk-buy-btn wk-learn-more">Learn More</div></a>'; } 

add_action('save_post', 'required_warning'); 
add_action('admin_notices', 'add_plugin_notice'); 

function add_plugin_notice() { 
	if (get_option('display_my_admin_message')) { 
		update_option('display_my_admin_message', 0); 
?> 
		
<div class="error"> 
	<p><strong>Warning: some required fields are incomplete.</strong> 
<?php echo get_option('my_admin_message'); ?></p> 
</div> 
<?php } } 

function required_warning() { 
	if(isset($_GET['post'])) $post_id = $_GET['post']; 
	elseif(isset($_POST['post_ID'])) $post_id = $_POST['post_ID']; 
	if(!isset($post_id)) return; $metaboxes = wk_metaboxes(array()); 
	$meta = get_post_custom($post_id); 
	$incompletes = array(); 
	foreach($metaboxes as $metabox) { 
		if(!isset($metabox['wk_setting'])) continue; 
		$incomplete_fields = array(); 
		if($metabox['wk_setting'] === 'required') { 
			$skip_list = array(); 
			foreach($metabox['fields'] as $field) { 
				$wkSet = isset($field['wk_setting']); 
				if(in_array($field['id'], $skip_list)) continue; 
				if($wkSet && $field['wk_setting'] === 'required_xor') $skip_list[] = PREMBOX . $field['required_xor']; 
				if(!isset($meta[$field['id']][0]) || (!isset($meta[$field['id']][0]) && !$meta[$field['id']][0]) ) { if($wkSet && $field['wk_setting'] === 'required_xor') { if(!isset($meta[PREMBOX . $field['required_xor']][0]) || !$meta[PREMBOX . $field['required_xor']][0]) { foreach($metabox['fields'] as $field2) { if($field2['id'] === PREMBOX . $field['required_xor']) { $xor_field = $field2['name']; break; } } $incomplete_fields[] = $field['name'] . ' or ' . $xor_field; } } else if(!$wkSet || $field['wk_setting'] !== 'optional') { $incomplete_fields[] = $field['name']; } } } 
				if(!empty($incomplete_fields)) { 
				if(count($metabox['fields']) > 1) $incompletes[] = str_replace(' <em>(required)</em>', '', $metabox['title']) . ': ' . implode(', ', $incomplete_fields); else $incompletes[] = str_replace(' <em>(required)</em>', '', $metabox['title']); 
				} } 
				elseif($metabox['wk_setting'] === 'optional') { 
					if(!isset($meta[PREMBOX . 'optional_sections']) || !in_array($metabox['id'], $meta[PREMBOX . 'optional_sections'])) continue; 
					foreach($metabox['fields'] as $field) { if(!$wkSet || $field['wk_setting'] !== 'required') continue; if(!isset($meta[$field['id']][0]) && !$meta[$field['id']][0]) $incomplete_fields[] = $field['name']; } if(!empty($incomplete_fields)) $incompletes[] = $metabox['title'] . ': ' . implode(', ', $incomplete_fields); } unset($incomplete_fields); } if(!empty($incompletes)) { foreach($incompletes as $key => $val) $incompletes[$key] = '<li>' . $val . '</li>'; update_option('my_admin_message', '<ul>' . implode("\n", $incompletes) . '</ul>'); update_option('display_my_admin_message', 1); } } 
					
function customformatTinyMCE($init) { $pane_wysiwygs = array('_wk_spotlight_content', '_wk_about_desc', '_wk_review', '_wk_insight1_content', '_wk_insight2_content', '_wk_insight3_content', '_wk_insight4_content'); if(in_array($init['elements'], $pane_wysiwygs)) $init['theme_advanced_blockformats'] = 'p,h3,h4'; else $init['theme_advanced_blockformats'] = 'p,h2,h3,h4'; $init['theme_advanced_disable'] = 'strikethrough,forecolor,justifyfull,blockquote,outdent,indent'; return $init; } add_filter('tiny_mce_before_init', 'customformatTinyMCE'); 
function form_submit_button($button, $form){ return "<button class='green-button' id='gform_submit_button_{$form["id"]}'>Subscribe <i class='icon-chevron-sign-right'></i></button>"; } add_filter("gform_submit_button", "form_submit_button", 10, 2); 
function spinner_url($image_src, $form){ return ""; } 
function custom_validation($result, $value, $form, $field){ $result["message"] = "Error: " . $result["message"]; return $result; } add_filter("gform_field_validation", "custom_validation", 10, 4); add_filter("gform_confirmation_anchor", create_function("","return false;")); 
function submit_to_exacttarget($entry, $form) { $lid = get_post_meta(intval($entry["2"]), PREMBOX . 'et_lid', true); if(!$lid) return; $email = $entry["1"]; $source = "Landing Page: " . get_post_meta(intval($entry["2"]), PREMBOX . 'book_title', true); $etURL = "http://cl.exct.net/subscribe.aspx?&SubAction=sub_add_update&MID=10496145"; $etURL .= "&lid=" . urlencode($lid); $etURL .= "&Email+Address=" . urlencode($email); $etURL .= "&Source=" . urlencode($source); $etch = curl_init(); curl_setopt($etch, CURLOPT_URL, $etURL); curl_setopt($etch, CURLOPT_RETURNTRANSFER, 1); $etresult = curl_exec($etch); curl_close($etch); } add_action("gform_after_submission_1", "submit_to_exacttarget", 10, 2); 
function the_year() { return date('Y'); } add_shortcode('the-year', 'the_year'); $bookNum = 1; 

function print_book($book, $ebook = false) { ?> 
	
<div class="related-book row"> 
	<div class='row'>
		<div class="book-cover wk-book-img col-xs-4"> 
		<?php if($book['link']) { ?>
			<a href="<?php echo $book['link']; ?>" target="_blank"><?php } ?> 
		<?php echo get_wk_img($book['image']['id'], $ebook ? 'ebook' : 'related-book-soft'); ?> <?php if($ebook) echo '<div></div>'; ?> 
		<?php if($book['link']) { ?></a><?php } ?> 
		<?php if($book['bubble_text']) echo '<span>' . $book['bubble_text'] . '</span>'; ?> 
	</div> 
		<div class="book-info col-xs-8"> 
		<ul class='nav nav-pills wk-tabs'>
			<li class=''>
				<a href="#sample-contents-<?php echo $book['isbn'];?>" data-toggle="tab">View Sample Contents</a>
			</li>
			<li class='active'>
				<a href="#book-details-<?php echo $book['isbn'];?>" data-toggle="tab">Book Details</a>
			</li>
		</ul>
		<?php if(isset($book['title_intro']) && $book['title_intro']) echo '<h3 class="title-intro">' . $book['title_intro'] . '</h3>'; ?> 
		<?php if($book['link']) { ?>
			<a href="<?php echo $book['link']; ?>" target="_blank"><?php } ?> 
		<h3><?php echo $book['title'] ?><?php if($book['edition']) echo '<span>, '. $book['edition'] . '</span>'; ?></h3> 
		<?php if(isset($book['subtitle']) && $book['subtitle']) echo '<h4>' . $book['subtitle'] . '</h4>'; ?> 
		<?php if($book['link']) { ?></a><?php } ?> 
		<div class='tab-content'>
			<div class='wk-book-details tab-pane' id='sample-contents-<?php echo $book['isbn'];?>'>
			</div>
			<div class='wk-book-details tab-pane active'  id='book-details-<?php echo $book['isbn'];?>' >
				<?php if($book['isbn'] || $book['price'] || $book['sale_price']) { echo '<p>'; 
		if($book['isbn']) echo '<span class="wk-isbn">ISBN: ' . $book['isbn'].'</span>'; 
		if($book['price']) { 
			$price = floatval($book['price']); 
			echo '<br /><span class="wk-price">Price: $' . $price.'</span>'; 
			if(isset($book['discount_percent']) && $book['discount_percent']) { $discount_percent = floatval(str_replace('%', '', $book['discount_percent'])); 
			$discount_price = round($price - ($price * ($discount_percent/100)), 2); ?> 
			<br /> 
			<span class='wk-discounted'>Discount Price: $<?php echo $discount_price; ?></span>
			<br /> 
			<span class="wk-you-save">You Save: <?php echo $discount_percent; ?>% <?php } } echo '</span></p>'; } ?> 
		<?php if($book['link']) {?> 
			<a href="<?php echo $book['link']; ?>" target="_blank"> <div class="wk-buy-btn wk-learn-more col-sm-6 col-md-3">
			<?php echo $ebook ? 'Buy Now' : 'Learn More'; ?> 
			</div></a> <?php } ?> 
			</div>
		</div>
		</div> 
	</div>
	</div> 
	<?php $bookNum++; } ?>