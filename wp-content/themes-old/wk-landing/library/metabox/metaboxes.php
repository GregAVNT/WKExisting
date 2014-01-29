<?php

// Meta Boxes
// https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress

function wk_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'webinar_module',
		'title'      => 'Webinar Module',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Line 1',
				'id'   => PREMBOX . 'webinar_line1',
				'type' => 'text'
			),
			array(
				'name' => 'Call to Action',
				'id'   => PREMBOX . 'webinar_cta',
				'type' => 'text'
			),
			array(
				'name' => 'Link',
				'id'   => PREMBOX . 'webinar_link',
				'type' => 'text'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'podcast_module',
		'title'      => 'Podcast Module',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Line 1',
				'id'   => PREMBOX . 'podcast_line1',
				'type' => 'text'
			),
			array(
				'name' => 'Call to Action',
				'id'   => PREMBOX . 'podcast_cta',
				'type' => 'text'
			),
			array(
				'name' => 'Link',
				'id'   => PREMBOX . 'podcast_link',
				'type' => 'text'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'hero',
		'title'      => 'Hero <em>(required)</em>',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'required',
		'fields' => array(
			array(
				'name' => 'Headline',
				'id'   => PREMBOX . 'headline',
				'type' => 'text',
				'desc' => '<span class="maxChars">54</span>'
			),
			array(
				'name' => 'Book Title',
				'id'   => PREMBOX . 'book_title',
				'type' => 'text'
			),
			array(
				'name' => 'Book Edition',
				'id'   => PREMBOX . 'book_edition',
				'type' => 'text',
				'wk_setting' => 'optional'
			),
			array(
				'name' => 'Cobrand Logo',
				'desc' => 'Optional. Appears in upper-right. Upload an image with a minimum width of 260px for retina support.',
				'id'   => PREMBOX . 'cobrand_logo',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
				'wk_setting' => 'optional'
			),
			array(
				'name' => 'Book Description Intro',
				'id'   => PREMBOX . 'book_desc_intro',
				'type' => 'wysiwyg',
				'wk_setting' => 'optional',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 15
				)
			),
			array(
				'name' => 'Book Description',
				'id'   => PREMBOX . 'book_desc',
				'type' => 'wysiwyg',
				'wk_setting' => 'optional',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 15
				)
			),
			array(
				'name' => 'Video Title',
				'id'   => PREMBOX . 'video_title',
				'type' => 'text',
				'wk_setting' => 'optional'
			),
			array(
				'name' => 'Video',
				'desc' => 'Link to video on YouTube. URL should begin with <strong>http://www.youtube.com/watch?</strong>',
				'id'   => PREMBOX . 'video',
				'type' => 'text',
				'wk_setting' => 'required_xor',
				'required_xor' => 'image',
			),
			array(
				'name' => 'Image',
				'desc' => 'Include only an image <strong>or</strong> a video. If both are included, the landing page will <strong>only</strong> show the video.',
				'id'   => PREMBOX . 'image',
				'type' => 'file',
				'desc' => 'Remember to upload at double the actual size for retina support.',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' )
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'book_module',
		'title'      => 'Book Module <em>(required)</em>',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'required',
		'fields' => array(
			array(
				'name' => 'Image',
				'id'   => PREMBOX . 'book_image',
				'desc' => 'Upload an image with a minimum width of 502px for retina support.',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' )
			),
			array(
				'name' => 'Price',
				'id'   => PREMBOX . 'price',
				'type' => 'money'
			),
			array(
				'name' => 'Discount Percentage',
				'id'   => PREMBOX . 'discount_percent',
				'type' => 'text_small',
				'wk_setting' => 'optional'
			),
			array(
				'name' => 'Buy Now Link',
				'id'   => PREMBOX . 'buy_now_link',
				'type' => 'text'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'press_release_module',
		'title'      => 'Press Release Module',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Press Release Link',
				'id'   => PREMBOX . 'pr_link',
				'type' => 'text',
				'wk_setting' => 'required'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'email_signup_module',
		'title'      => 'Email Sign-up Module <em>(required)</em>',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'required',
		'fields' => array(
			array(
				'name' => 'ExactTarget List ID',
				'id'   => PREMBOX . 'et_lid',
				'type' => 'text_small',
				'desc' => 'Enter the numeric list ID from ExactTarget for the submitted email addresses to be posted to. You can find this value by signing into ExactTarget, navigating to "My Lists," checking the box next to the desired list, then clicking the "Properties" button at the top. The list ID is under the column labeled "ID."'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'meet_authors',
		'title'      => 'Meet the Authors - Meet the Authors',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'meet_author_title',
				'type' => 'text',
				'std'  => 'Meet the Authors',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Authors/Editors',
				'id'   => PREMBOX . 'author',
				'type' => 'wk_infinity',
				'add_button' => 'Add Author/Editor'
			),
			array(
				'name' => 'Associate Authors/Editors Subtitle',
				'id'   => PREMBOX . 'meet_author_subtitle',
				'type' => 'text',
				'desc' => 'Required if there are any associate authors/editors.'
			),
			array(
				'name' => 'Associate Authors/Editors',
				'id'   => PREMBOX . 'associate_author',
				'type' => 'wk_infinity',
				'add_button' => 'Add Associate Author/Editor'
			),
			array(
				'name' => "Author's Blog(s)",
				'id'   => PREMBOX . 'author_blogs',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 8
				)
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'author_spotlight',
		'title'      => 'Meet the Authors - Author Spotlight',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'spotlight_title',
				'type' => 'text',
				'std'  => 'Author Spotlight',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Video',
				'desc' => 'Link to video on YouTube. URL should begin with <strong>http://www.youtube.com/watch?</strong>',
				'id'   => PREMBOX . 'spotlight_video',
				'type' => 'text'
			),
			array(
				'name' => 'Spotlight Content',
				'id'   => PREMBOX . 'spotlight_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'about_book',
		'title'      => 'About the Book - About the Book',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'about_title',
				'type' => 'text',
				'std'  => 'Description:',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Description',
				'id'   => PREMBOX . 'about_desc',
				'type' => 'wysiwyg',
				'wk_setting' => 'required',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			),
			array(
				'name' => 'Book Details',
				'type' => 'title',
				'id' => PREMBOX . 'book_details_title',
			),
			array(
				'name' => 'Title',
				'id'   => PREMBOX . 'details_title',
				'type' => 'text',
				'std'  => 'Book Details',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Pub Date',
				'id'   => PREMBOX . 'details_pub_date',
				'type' => 'text_small',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'ISBN',
				'id'   => PREMBOX . 'details_isbn',
				'type' => 'text',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Pages',
				'id'   => PREMBOX . 'details_pages',
				'type' => 'text_small',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Illustrations',
				'id'   => PREMBOX . 'details_illustrations',
				'type' => 'text_small',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Format',
				'id'   => PREMBOX . 'details_format',
				'type' => 'text_small',
				'wk_setting' => 'required'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'sample_content',
		'title'      => 'About the Book - Sample Content',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'samples_title',
				'type' => 'text',
				'std'  => 'Sample Content',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Samples',
				'id'   => PREMBOX . 'samples',
				'type' => 'wk_infinity',
				'add_button' => 'Add Sample'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'reviews',
		'title'      => 'About the Book - Reviews',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'reviews_title',
				'type' => 'text',
				'std'  => 'Reviews',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Link to Full Review',
				'id'   => PREMBOX . 'reviews_link',
				'type' => 'text'
			),
			array(
				'name' => 'Review',
				'id'   => PREMBOX . 'review',
				'type' => 'wysiwyg',
				'wk_setting' => 'required',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'customer_insight',
		'title'      => 'About the Book - Customer Insight',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'insight_title',
				'type' => 'text',
				'std'  => 'Customer Insight',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Word Associations Header',
				'id'   => PREMBOX . 'insight_words_header',
				'type' => 'text',
				'std'  => 'Top of mind word associations:',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Insight 1',
				'type' => 'title',
				'id' => PREMBOX . 'insight1'
			),
			array(
				'name' => 'Title',
				'id'   => PREMBOX . 'insight1_title',
				'type' => 'text',
			),
			array(
				'name' => 'Image',
				'desc' => 'Upload an image with a minimum size of 430px x 272px for retina support.',
				'id'   => PREMBOX . 'insight1_image',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
			),
			array(
				'name' => 'Image Caption',
				'id'   => PREMBOX . 'insight1_caption',
				'type' => 'text',
			),
			array(
				'name' => 'Content',
				'id'   => PREMBOX . 'insight1_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			),
			array(
				'name' => 'Word List',
				'id'   => PREMBOX . 'insight1_words',
				'type' => 'textarea'
			),
			array(
				'name' => 'Insight 2',
				'type' => 'title',
				'id' => PREMBOX . 'insight2'
			),
			array(
				'name' => 'Title',
				'id'   => PREMBOX . 'insight2_title',
				'type' => 'text',
			),
			array(
				'name' => 'Image',
				'desc' => 'Upload an image with a minimum size of 430px x 272px for retina support.',
				'id'   => PREMBOX . 'insight2_image',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
			),
			array(
				'name' => 'Image Caption',
				'id'   => PREMBOX . 'insight2_caption',
				'type' => 'text',
			),
			array(
				'name' => 'Content',
				'id'   => PREMBOX . 'insight2_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			),
			array(
				'name' => 'Word List',
				'id'   => PREMBOX . 'insight2_words',
				'type' => 'textarea'
			),
			array(
				'name' => 'Insight 3',
				'type' => 'title',
				'id' => PREMBOX . 'insight3'
			),
			array(
				'name' => 'Title',
				'id'   => PREMBOX . 'insight3_title',
				'type' => 'text',
			),
			array(
				'name' => 'Image',
				'desc' => 'Upload an image with a minimum size of 430px x 272px for retina support.',
				'id'   => PREMBOX . 'insight3_image',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
			),
			array(
				'name' => 'Image Caption',
				'id'   => PREMBOX . 'insight3_caption',
				'type' => 'text',
			),
			array(
				'name' => 'Content',
				'id'   => PREMBOX . 'insight3_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 30
				)
			),
			array(
				'name' => 'Word List',
				'id'   => PREMBOX . 'insight3_words',
				'type' => 'textarea'
			),
			array(
				'name' => 'Insight 4',
				'type' => 'title',
				'id' => PREMBOX . 'insight4'
			),
			array(
				'name' => 'Title',
				'id'   => PREMBOX . 'insight4_title',
				'type' => 'text',
			),
			array(
				'name' => 'Image',
				'desc' => 'Upload an image with a minimum size of 430px x 272px for retina support.',
				'id'   => PREMBOX . 'insight4_image',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
			),
			array(
				'name' => 'Image Caption',
				'id'   => PREMBOX . 'insight4_caption',
				'type' => 'text',
			),
			array(
				'name' => 'Content',
				'id'   => PREMBOX . 'insight4_content',
				'type' => 'wysiwyg',
				'options' => array(
					'media_buttons' => false,
					'textarea_rows' => 20
				)
			),
			array(
				'name' => 'Word List',
				'id'   => PREMBOX . 'insight4_words',
				'type' => 'textarea'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'related_products',
		'title'      => 'Related Products',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'related_title',
				'type' => 'text',
				'std'  => 'Related Products',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'Tab Subtitle',
				'id'   => PREMBOX . 'related_subtitle',
				'type' => 'text',
			),
			array(
				'name' => 'Subsections',
				'id'   => PREMBOX . 'related_subsections',
				'type' => 'wk_infinity',
				'add_button' => 'Add Subsection'
			),
			array(
				'name' => 'Related Books',
				'id'   => PREMBOX . 'relateds',
				'type' => 'wk_infinity',
				'add_button' => 'Add Related Book'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'ebooks',
		'title'      => 'eBook Products',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Tab Title',
				'id'   => PREMBOX . 'ebooks_title',
				'type' => 'text',
				'std'  => 'eBook Products',
				'wk_setting' => 'required'
			),
			array(
				'name' => 'eBook Description',
				'id'   => PREMBOX . 'ebooks_desc',
				'type' => 'textarea_small'
			),
			array(
				'name' => '"Powered by Inkling" image',
				'id'   => PREMBOX . 'powered_by_inkling_img',
				'desc' => 'Upload an image with a minimum size of 514px x 298px for retina support.',
				'type' => 'file',
				'save_id' => true, // save ID using true
				'allow'   => array( 'attachment' ),
			),
			array(
				'name' => 'Subsections',
				'id'   => PREMBOX . 'ebook_subsections',
				'type' => 'wk_infinity',
				'add_button' => 'Add Subsection'
			),
			array(
				'name' => 'eBooks',
				'id'   => PREMBOX . 'related_ebooks',
				'type' => 'wk_infinity',
				'add_button' => 'Add eBook'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'footer',
		'title'      => 'Footer - Cobrand Disclaimer',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'wk_setting' => 'optional',
		'fields' => array(
			array(
				'name' => 'Cobrand Disclaimer',
				'id'   => PREMBOX . 'cobrand_disclaimer',
				'type' => 'textarea_small'
			)
		)
	);

	// get a list of all optional sections
	$optional_sections = array();
	foreach($meta_boxes as $metabox) {
		if($metabox['wk_setting'] === 'optional')
			$optional_sections[$metabox['id']] = $metabox['title'];
	}

	$meta_boxes[] = array(
		'id'         => 'optional_sections',
		'title'      => 'Toggle Optional Sections',
		'pages'      => array( 'page' ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Enable/Disable Fields',
				'id'   => PREMBOX . 'optional_sections',
				'type' => 'multicheck',
				'options' => $optional_sections
			)
		)
	);

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'wk_metaboxes' );


function create_money_text_field($field, $meta) {
	echo '$ <input class="cmb_text_small" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
}
add_action( 'cmb_render_money', 'create_money_text_field', 10, 2 );


function render_wk_infinity_field($field, $meta) {

	if(!$meta || empty($meta))
		$count = 1;
	else
		$count = count($meta);

	echo '<input type="hidden" class="infinity_count" name="count' . $field['id'] . '" value="', $count - 1, '" />';

	echo '<div class="sortable">';
	for($i = 0; $i < $count; ++$i)
		print_infinity_field($meta, $field, $i);
	echo '</div>';

	if(isset($field['add_button']))
		echo '<input type="button" class="button-primary addField" value="' . $field['add_button'] . '" />';
	else
		echo '<input type="button" class="button-primary addField" value="Add ' . $field['name'] .'" />';

}
add_filter('cmb_render_wk_infinity', 'render_wk_infinity_field', 10, 2);


function print_infinity_field(&$meta = NULL, &$field = NULL, $i = 1) {

	if($meta && isset($meta[$i]['name']))
		$name = $meta[$i]['name'];
	else
		$name = NULL;

	echo '<div class="infinity_wrapper clearfix">';
	echo '<input type="button" class="button removeField" />';

	switch($field['name']) {

		case "Authors/Editors":
			get_field("text", $meta[$i], $field, $i, 'name', 'Name');
			get_field("textarea", $meta[$i], $field, $i, 'desc', 'Description', 'Use dashes and newlines to make a bulleted list.');
			get_field("text", $meta[$i], $field, $i, 'bio_link', 'Link to Bio');
			get_field("image", $meta[$i], $field, $i, 'img', false, 'Upload an image with a minimum size of 276px x 344px for retina support.');
			break;

		case "Associate Authors/Editors":
			get_field("text", $meta[$i], $field, $i, 'name', 'Name');
			get_field("textarea", $meta[$i], $field, $i, 'desc', 'Description', 'Use dashes and newlines to make a bulleted list.');
			get_field("text", $meta[$i], $field, $i, 'bio_link', 'Link to Bio');
			get_field("image", $meta[$i], $field, $i, 'img', false, 'Upload an image with a minimum size of 276px x 344px for retina support.');
			break;

		case "Samples":
			get_field("text", $meta[$i], $field, $i, 'name', 'Name');
			get_field("text", $meta[$i], $field, $i, 'link_text', 'Name in Link', 'Optional. Defaults to name (value entered in above field).');
			get_field("text", $meta[$i], $field, $i, 'link', 'Link', 'You can upload PDFs by clicking on Media in the left sidebar. To get the URL of an uploaded file, "edit" the uploaded PDF and the file URL is in a box on the right.');
			get_field("image", $meta[$i], $field, $i, 'img', false, 'Upload an image with a minimum width of 370px for retina support. Do not include a border around the image; it will be added automatically.');
			break;

		case "Subsections":
			get_field("text", $meta[$i], $field, $i, 'title', 'Title');
			get_field("textarea", $meta[$i], $field, $i, 'desc', 'Description');
			break;

		case "Related Books":
			get_field("text", $meta[$i], $field, $i, 'title', 'Title');
			get_field("text", $meta[$i], $field, $i, 'edition', 'Edition');
			get_field("text", $meta[$i], $field, $i, 'title_intro', 'Title Intro');
			get_field("text", $meta[$i], $field, $i, 'subtitle', 'Subtitle');
			get_field("text", $meta[$i], $field, $i, 'subsection', 'Subsection Number', 'Optional. Enter the number that corresponds to the order of the subsection in the Subsections section above. For example, if the corresponding subsection is listed second above, type 2 in this field.', true);
			get_field("text", $meta[$i], $field, $i, 'isbn', 'ISBN');
			get_field("text", $meta[$i], $field, $i, 'price', 'Price', '', true, true);
			get_field("text", $meta[$i], $field, $i, 'discount_percent', 'Discount Percentage', '', true);
			get_field("text", $meta[$i], $field, $i, 'link', 'Learn More Link');
			get_field("text", $meta[$i], $field, $i, 'bubble_text', 'Bubble Text', 'Optional. Appears in pink bubble on bottom-right corner of textbook cover image.<span class="maxChars">24</span>');
			get_field("image", $meta[$i], $field, $i, 'img', false, 'Upload an image with a minimum size of 256px x 410px for retina support.');
			break;

		case "eBooks":
			get_field("text", $meta[$i], $field, $i, 'title', 'Title');
			get_field("text", $meta[$i], $field, $i, 'edition', 'Edition');
			get_field("text", $meta[$i], $field, $i, 'subsection', 'Subsection Number', 'Optional. Enter the number that corresponds to the order of the subsection in the Subsections section above. For example, if the corresponding subsection is listed second above, type 2 in this field.', true);
			get_field("text", $meta[$i], $field, $i, 'isbn', 'ISBN');
			get_field("text", $meta[$i], $field, $i, 'price', 'Price', '', true, true);
			get_field("text", $meta[$i], $field, $i, 'link', 'Buy Now Link');
			get_field("text", $meta[$i], $field, $i, 'bubble_text', 'Bubble Text');
			get_field("image", $meta[$i], $field, $i, 'img', false, 'Upload an image with a minimum size of 250px x 324px for retina support.');
			break;

	}

	echo '</div>';

}

function get_field($type, $meta, $field, $i, $id, $name = false, $desc = '', $small = false, $money = false) {

	echo '<div class="wk-infinity-field">';

	if($name)
		echo '<label>', $name, ':</label>';

	switch($type) {

		case "text":
			if($money)
				echo "$ ";
			echo '<input ', $small ? 'class="cmb_text_small" ' : '' , 'type="text" name="', $field['id'].'['.$i.']['.$id.']" id="', $field['id'].'['.$i.']['.$id.']" value="', isset($meta[$id]) ? $meta[$id] : $field['std'], '" />','<p class="cmb_metabox_description">', $desc, '</p>';
			break;

		case "image":

			if($meta && isset($meta['image']['url']) && $meta['image']['url'])
				$image_url = $meta['image']['url'];
			else
				$image_url = "";

			if($meta && isset($meta['image']['id']))
				$image_id = $meta['image']['id'];
			else
				$image_id = "";

			$input_type_url = "hidden";
			echo '<input class="cmb_upload_file" type="' . $input_type_url . '" size="45" id="', $field['id'], "_{$i}_image_url" , '" name="', $field['id'], "[{$i}][image][url]", '" value="', $image_url, '" />';
			echo '<input class="cmb_upload_button button" type="button" value="Upload Image" />';
			echo '<p class="cmb_metabox_description">', $desc, '</p>';
			echo '<input class="cmb_upload_file_id" type="hidden" id="', $field['id'], "_{$i}_image_id", '" name="', $field['id'], "[{$i}][image][id]", '" value="', $image_id, '" />';
			echo '<div id="', $id, '_status" class="cmb_media_status">';
				if ( isset($image_url) && $image_url) {
					$check_image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_url );
					if ( $check_image ) {
						echo '<div class="img_status">';
						echo '<img src="', $image_url, '" alt="" />';
						echo '<a href="#" class="cmb_remove_file_button" rel="', $field['id'], '">Remove Image</a>';
						echo '</div>';
					}
				}
			echo '</div>';

			break;

		case "textarea":
			echo '<div class="clearfix">';
			echo '<textarea name="' . $field['id'].'['.$i.']['.$id.']" id="' . $field['id'].'['.$i.']['.$id.']" cols="60" rows="5">', isset($meta[$id]) ? $meta[$id] : '' , '</textarea>','<p class="cmb_metabox_description">', $desc, '</p>';
			echo '</div>';
			break;

		case "checkbox":
			echo '<input type="checkbox" name="', $field['id'].'['.$i.']['.$id.']', '" id="', $field['id'].'['.$i.']['.$id.']', '"', isset($meta[$id]) ? ' checked="checked"' : '', ' />';
			echo '<span class="cmb_metabox_description" style="display:block;">', $desc, '</span>';
			break;

	}

	echo '</div>';

}

?>