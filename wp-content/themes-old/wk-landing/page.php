<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php // WEBINAR MODULE ?>
								<?php if(metabox_enabled('webinar_module')) : ?>
								<a href="<?php get_meta('webinar_link'); ?>" target="_blank" id="webinar-module" class="top-module">
									<div>
										<?php get_meta('webinar_line1'); ?>
										<span class="link"><?php get_meta('webinar_cta'); ?></span>
										<i class="icon-chevron-right"></i>
									</div>
								</a>
								<?php endif; ?>

								<?php // PODCAST MODULE ?>
								<?php if(metabox_enabled('podcast_module')) : ?>
								<a href="<?php get_meta('podcast_link'); ?>" target="_blank" id="podcast-module" class="top-module">
									<div>
										<?php get_meta('podcast_line1'); ?>
										<span class="link"><?php get_meta('podcast_cta'); ?></span>
										<i class="icon-chevron-right"></i>
									</div>
								</a>
								<?php endif; ?>

								<div id="hero-book-module">

								<div id="hero">

									<header class="article-header">

										<?php // COBRAND LOGO ?>
										<?php if(meta_set('cobrand_logo')) {
											echo '<div class="logo-wrapper">';
											echo wp_get_attachment_image(get_meta('cobrand_logo_id', true), 'cobrand-logo');
											echo '</div>';
										} ?>

										<h1 class="page-title" itemprop="headline"><?php get_meta('headline'); ?></h1>
										<h2><em><?php get_meta('book_title') ?></em><?php if(meta_set('book_edition')) { echo ', '; get_meta('book_edition'); } ?></h2>

									</header> <!-- end article header -->

									<section class="entry-content clearfix" itemprop="articleBody">

										<?php // BOOK DESCRIPTION INTRO ?>
										<?php if(meta_set('book_desc_intro')) : ?>
										<div id="book-desc-intro">
											<?php echo wpautop(get_meta('book_desc_intro', true)); ?>
										</div>
										<?php endif; ?>

										<?php // BOOK DESCRIPTION ?>
										<div id="book-desc">
											<?php echo wpautop(get_meta('book_desc', true)); ?>
										</div>

										<?php // VIDEO ?>
										<?php if(meta_set('video')) : ?>
											<div class="video<?php if(!meta_set('video_title')) echo ' video-no-title'; ?>">
												<?php if(meta_set('video_title')) echo '<h2>' . get_meta('video_title', true) . '</h2>'; ?>
												<?php echo apply_filters('the_content', '[embed]' . get_meta('video', true) . '[/embed]'); ?>
											</div>
										<?php endif; ?>

										<?php // IMAGE ?>
										<?php if(meta_set('image') && !meta_set('video')) :
											$img = wp_get_attachment_image_src(get_meta('image_id', true), 'full'); ?>
											<div id="hero-image" style="width:<?php echo round($img[1]/2); ?>px;height:<?php echo round($img[2]/2); ?>px;">
												<?php echo wp_get_attachment_image(get_meta('image_id', true), 'full'); ?>
											</div>
										<?php endif; ?>

									</section> <!-- end article section -->

								</div> <!-- end #hero -->

								<section class="entry-content clearfix" id="book-module">

									<div id="inner-book-module">

										<h2><em><?php get_meta('book_title') ?></em><?php if(meta_set('book_edition')) { echo ', '; get_meta('book_edition'); } ?></h2>

										<div class="image-wrapper">
										<?php echo wp_get_attachment_image(get_meta('book_image_id', true), 'book-main'); ?>
										</div>

										<p id="book-details">
											Price: $<?php $price = floatval(get_meta('price', true)); echo $price; ?>

											<?php
											if(meta_set('discount_percent')) :

												// get the percentage off, removing the % sign if the user decided that was a wise thing to include
												$discount_percent = floatval(str_replace('%', '', get_meta('discount_percent', true)));

												// get the discounted price
												// (rounded to 2 decimal places because that's how money works, despite what gas stations may think)
												$discount_price = round($price - ($price * ($discount_percent/100)), 2); ?>

												<br />
												Discount Price: $<?php echo $discount_price; ?><br />
												You Save: <?php echo $discount_percent; ?>%

											<?php endif; ?>
										</p>

										<?php buy_now_button(); ?>

									</div>

								</section> <!-- end article section -->

								</div> <!-- end #hero-book-module -->

								<?php // PRESS RELEASE MODULE ?>
								<?php if(metabox_enabled('press_release_module')) : ?>
								<div id="press-release" class="tan-box clearfix">
									<div><h3><?php echo ot_get_option( 'pr_text', "What's the buzz?"); ?></h3></div>
									<a href="<?php get_meta('pr_link') ?>" target="_blank"><?php echo ot_get_option( 'pr_link_text', 'Read our latest press release'); ?> <i class="icon-chevron-right"></i></a>
								</div>
								<?php endif; ?>

								<?php // EMAIL SIGN-UP ?>
								<div id="email-signup" class="tan-box<?php if(!metabox_enabled('press_release_module')) echo ' no-pr-module'; ?>">
									<h3><?php echo ot_get_option( 'email_signup_text', 'Sign up to receive discounts and special offers!'); ?></h3>

									<div id="email-signup-right" class="clearfix">

										<div id="signup-form-wrapper">
											<div id="spinner-wrapper"><div id="spinner"></div></div>
											<?php gravity_form(1, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=true); ?>
										</div>

										<div id="privacy-policy">
										<a href="<?php echo ot_get_option( 'privacy_policy_link', 'http://www.lww.com/webapp/wcs/stores/servlet/content_privacy_default_11851_-1_12551' ); ?>" target="_blank">
											LWW.com privacy policy
										</a>
										</div>

									</div>

								</div>


								<?php

								$authorsMetas = array('meet_authors', 'author_spotlight');
								$aboutMetas = array('about_book', 'sample_content', 'reviews', 'customer_insight');
								$relatedMetas = array('related_products');
								$ebooksMetas = array('ebooks');

								$authorsEnabled = metabox_enabled('meet_authors') || metabox_enabled('author_spotlight');
								$aboutEnabled = metabox_enabled('about_book') || metabox_enabled('sample_content') || metabox_enabled('reviews') || metabox_enabled('customer_insight');
								$relatedEnabled = metabox_enabled('related_products');
								$ebooksEnabled = metabox_enabled('ebooks');

								if($authorsEnabled || $aboutEnabled || $relatedEnabled || $ebooksEnabled) : ?>
								<section id="tabs" class="clearfix">

									<?php // TABS ?>
									<ul class="clearfix">
										<?php
										$tabCounter = 1;
										if($authorsEnabled)
											echo '<li><a href="#tab-' . $tabCounter . '" class="' , $tabCounter++ % 2 === 0 ? 'even' : 'odd' , '">Meet the Author(s)</a></li>';
										if($aboutEnabled)
											echo '<li><a href="#tab-' . $tabCounter . '" class="' , $tabCounter++ % 2 === 0 ? 'even' : 'odd' , '">About the Book</a></li>';
										if($relatedEnabled)
											echo '<li><a href="#tab-' . $tabCounter . '" class="' , $tabCounter++ % 2 === 0 ? 'even' : 'odd' , '">Related Products</a></li>';
										if($ebooksEnabled)
											echo '<li><a href="#tab-' . $tabCounter . '" class="' , $tabCounter++ % 2 === 0 ? 'even' : 'odd' , '">eBook Products</a></li>';
										?>
									</ul>

									<?php // PANELS
									$tabCounter = 1;

									// Meet the Author(s)
									if($authorsEnabled) { ?>
										<div id="tab-<?php echo $tabCounter; ?>" class="tabs2">
											<div class="inner-tab">

											<?php if(number_metas_enabled($authorsMetas) > 1) { ?>

											<div class="zoomer"></div>

											<div class="mobile-header">
												<select id="dropdown-<?php echo $tabCounter; ?>">
												<?php
												$tabCounter2 = 1;
												if(metabox_enabled('meet_authors'))
													echo '<option value="' . $tabCounter2++ . '">Meet the Author(s)</option>';
												if(metabox_enabled('author_spotlight'))
													echo '<option value="' . $tabCounter2++ . '">Author Spotlight</option>';
												?>
												</select>
											</div>

											<ul class="desktop-header">
												<?php
												$tabCounter2 = 1;
												if(metabox_enabled('meet_authors'))
													echo '<li><a href="#innerTab1-' . $tabCounter2++ . '"><span>Meet the Author(s)</span></a></li>';
												if(metabox_enabled('author_spotlight'))
													echo '<li><a href="#innerTab1-' . $tabCounter2++ . '"><span>Author Spotlight</span></a></li>';
												?>
											</ul>

											<?php } ?>

											<?php
											$tabCounter2 = 1;

											if(metabox_enabled('meet_authors')) { ?>

												<div id="innerTab1-<?php echo $tabCounter2++; ?>" class="pane meet_authors clearfix">

													<h2><?php get_meta('meet_author_title'); ?></h2>

													<?php
													function print_authors($authors) {
														if(!empty($authors)) {

															$descs_on = false;
															foreach($authors as $author) {
																if($author['desc']) {
																	$descs_on = true;
																	break;
																}
															}

															if($descs_on)
																echo '<div class="authors clearfix">';
															else
																echo '<div class="authors no-descs clearfix">';

															$authorCount = 1;
															foreach($authors as $key => $author) {

																// skip if author name does not exist
																if(!$author['name']) continue;

																// start row of authors
																if($descs_on && $authorCount % 2 === 1)
																	echo '<div class="author-row clearfix">';

																if($author['desc'])
																	echo '<div class="author ', $authorCount % 2 === 0 ? 'even' : 'odd' , '">';
																else
																	echo '<div class="author no-desc ', $authorCount % 2 === 0 ? 'even' : 'odd' , '">';

																// author image
																if($author['image']['id'] && $author['bio_link']) {
																	echo '<a href="' . $author['bio_link'] . '" class="author-pic" target="_blank">';
																	echo get_wk_img($author['image']['id'], 'bio-pic');
																	echo '</a>';
																} elseif($author['image']['id']) {
																	echo '<div class="author-pic">';
																	echo get_wk_img($author['image']['id'], 'bio-pic');
																	echo '</div>';
																}

																echo '<div class="author-details">';

																// author name
																echo '<h4>' . $author['name'] . '</h4>';

																// author description
																if($author['desc']) {
																	// allow dashes to represent a bulleted list
																	// by converting the dashes with line breaks into an HTML ul using the power of regex!
																	$desc = preg_replace("/\n-(\s)*(.*)/", "<li>$2</li>", $author['desc']);
																	$desc = preg_replace("/<li>(.*)<\/li>/", "<ul><li>$1</li></ul>", $desc);
																	echo wpautop($desc);
																}

																// author bio link
																if($author['bio_link']) {
																	echo '<a href="' . $author['bio_link'] . '" target="_blank" class="bio-link">';
																	echo 'Read bio <i class="icon-chevron-right"></i>';
																	echo '</a>';
																}

																echo '</div>'; // end .author-details
																echo '</div>'; // end .author

																if(($descs_on && $authorCount % 2 === 0) || !isset($authors[$key+1]))
																	echo '</div>'; // end .author-row

																$authorCount++;

															}

															echo '</div>';

														}
													}

													// AUTHORS
													$authors = get_meta('author', true);
													$associates = get_meta('associate_author', true);

													if(!authors_empty($authors)) {
														if(authors_empty($associates) && !authors_empty($authors) && count($authors) === 1) {
															echo '<div id="single-authors">';
															print_authors($authors);
															echo '</div>';
														} else {
															print_authors($authors);
														}
													}

													// ASSOCIATE AUTHORS
													if(!authors_empty($associates)) {
														echo '<div class="clearfix subtitle-lines"><h3>';
														if(meta_set('meet_author_subtitle')) get_meta('meet_author_subtitle'); else echo 'Associate Authors';
														echo '</h3><span></span></div>';
														print_authors($associates);
													}

													?>

													<?php if(meta_set('author_blogs')) { ?>
														<div id="author-blogs" class="gray-box<?php if(authors_empty($associates) && !authors_empty($authors) && count($authors) === 1) echo ' single-author' ?>">
															<h3>Author's Blog(s)</h3>
															<?php echo str_replace('<li>', '<li><i class="icon-chevron-right"></i>', wpautop(get_meta('author_blogs', true))); ?>
														</div>
													<?php } ?>

												</div>

											<?php }

											if(metabox_enabled('author_spotlight')) { ?>

												<div id="innerTab1-<?php echo $tabCounter2++; ?>" class="pane author_spotlight">

													<?php // SPOTLIGHT TITLE ?>
													<h2><?php get_meta('spotlight_title'); ?></h2>

													<?php // SPOTLIGHT CONTENT ?>
													<?php echo wpautop(get_meta('spotlight_content', true)); ?>

												</div>

											<?php } ?>

											</div>
										</div>
										<?php $tabCounter++;
									}

									// About the Book
									if($aboutEnabled) { ?>
										<div id="tab-<?php echo $tabCounter; ?>" class="tabs2">
											<div class="inner-tab">

											<?php if(number_metas_enabled($aboutMetas) > 1) { ?>

											<div class="zoomer"></div>

											<div class="mobile-header">
												<select id="dropdown-<?php echo $tabCounter; ?>">
												<?php
												$tabCounter2 = 1;
												if(metabox_enabled('about_book'))
													echo '<option value="' . $tabCounter2++ . '">About the Book</option>';
												if(metabox_enabled('sample_content'))
													echo '<option value="' . $tabCounter2++ . '">Sample Content</option>';
												if(metabox_enabled('reviews'))
													echo '<option value="' . $tabCounter2++ . '">Reviews</option>';
												if(metabox_enabled('customer_insight'))
													echo '<option value="' . $tabCounter2++ . '">Customer Insight</option>';
												?>
												</select>
											</div>

											<ul class="desktop-header clearfix">
												<?php
												$tabCounter2 = 1;
												if(metabox_enabled('about_book'))
													echo '<li><a href="#innerTab2-' . $tabCounter2++ . '"><span>About the Book</span></a></li>';
												if(metabox_enabled('sample_content'))
													echo '<li><a href="#innerTab2-' . $tabCounter2++ . '"><span>Sample Content</span></a></li>';
												if(metabox_enabled('reviews'))
													echo '<li><a href="#innerTab2-' . $tabCounter2++ . '"><span>Reviews</span></a></li>';
												if(metabox_enabled('customer_insight'))
													echo '<li><a href="#innerTab2-' . $tabCounter2++ . '"><span>Customer Insight</span></a></li>';
												?>
											</ul>

											<?php } ?>

											<?php
											$tabCounter2 = 1;

											if(metabox_enabled('about_book')) { ?>

												<div id="innerTab2-<?php echo $tabCounter2++; ?>" class="pane about_book clearfix">

													<div id="about-book-right">

														<?php // BOOK DETAILS ?>
														<div id="book-details2" class="gray-box">

															<h2><?php get_meta('details_title'); ?></h2>

															<h3>
																<em><?php get_meta('book_title') ?></em><?php if(meta_set('book_edition')) { echo ', '; get_meta('book_edition'); } ?>
															</h3>

															<ul>

																<?php
																if(meta_set('details_pub_date'))
																	echo '<li><h4>Pub Date:</h4> ' . get_meta('details_pub_date', true) . '</li>';

																if(meta_set('details_isbn'))
																	echo '<li><h4>ISBN:</h4> ' . get_meta('details_isbn', true) . '</li>';

																if($price)
																	echo '<li><h4>Price:</h4> $' . $price . '</li>';

																if(isset($discount_price))
																	echo '<li><h4>Sale Price:</h4> $' . $discount_price . '</li>';

																if(meta_set('details_pages'))
																	echo '<li><h4>Pages:</h4> ' . get_meta('details_pages', true) . '</li>';

																if(meta_set('details_illustrations'))
																	echo '<li><h4>Illustrations:</h4> ' . get_meta('details_illustrations', true) . '</li>';

																if(meta_set('details_format'))
																	echo '<li><h4>Format:</h4> ' . get_meta('details_format', true) . '</li>';
																?>

															</ul>

														</div>

														<?php // LATEST PRESS RELEASE ?>
														<?php if(metabox_enabled('press_release_module')) { ?>
														<a href="<?php get_meta('pr_link') ?>" target="_blank">
															<?php echo ot_get_option( 'pr_link_text', 'Read our latest press release'); ?> <i class="icon-chevron-right"></i>
														</a>
														<?php } ?>

													</div>

													<div id="about-book-left">

														<?php // ABOUT THE BOOK TITLE ?>
														<h2><?php get_meta('about_title'); ?></h2>

														<?php // ABOUT THE BOOK DESCRIPTIONS ?>
														<?php echo wpautop(get_meta('about_desc', true)); ?>

													</div>


												</div>

											<?php }

											if(metabox_enabled('sample_content')) { ?>

												<div id="innerTab2-<?php echo $tabCounter2++; ?>" class="pane sample_content clearfix">

													<?php // SAMPLES TITLE ?>
													<h2><?php get_meta('samples_title'); ?></h2>

													<?php // SAMPLES ?>
													<?php $samples = get_meta('samples', true);

													foreach($samples as $sample) { ?>

														<div class="sample">

															<h3><?php echo $sample['name']; ?></h3>

															<a href="<?php echo $sample['link']; ?>" target="_blank" class="sample-preview">
															<?php echo get_wk_img($sample['image']['id'], 'sample'); ?>
															</a>

															<a href="<?php echo $sample['link']; ?>" target="_blank">
																View <?php echo $sample['link_text'] ? $sample['link_text'] : $sample['name']; ?> <i class="icon-chevron-right"></i>
															</a>

														</div>

													<?php } ?>

												</div>

											<?php }

											if(metabox_enabled('reviews')) { ?>

												<div id="innerTab2-<?php echo $tabCounter2++; ?>" class="pane reviews">

													<?php // REVIEWS TITLE ?>
													<h2><?php get_meta('reviews_title'); ?></h2>

													<?php // ABOUT THE BOOK DESCRIPTIONS ?>
													<?php echo wpautop(get_meta('review', true)); ?>

													<?php // LINK TO FULL REVIEW ?>
													<?php if(meta_set('reviews_link')) { ?>
													<a href="<?php echo get_meta('reviews_link'); ?>" class="full-review" target="_blank">View full review <i class="icon-chevron-right"></i></a>
													<?php } ?>

												</div>

											<?php }

											if(metabox_enabled('customer_insight')) { ?>

												<div id="innerTab2-<?php echo $tabCounter2++; ?>" class="pane customer_insight clearfix">

													<?php // INSIGHT TITLE ?>
													<h2><?php get_meta('insight_title'); ?></h2>

													<?php $firstInsight = true; $wordsHeader = false; ?>
													<?php for($i = 1; $i < 5; $i++) { ?>

														<?php // skip empty (title-less) insights ?>
														<?php if(!meta_set('insight'.$i.'_title')) continue; ?>

														<div class="insight clearfix<?php if($firstInsight) { echo ' first-insight'; $firstInsight = false; } ?>">

														<div class="insight-img">
															<?php echo get_wk_img(get_meta('insight'.$i.'_image_id', true), 'insight'); ?>
															<span><?php get_meta('insight'.$i.'_caption'); ?></span>
														</div>

														<div class="insight-content">

															<h3><?php get_meta('insight'.$i.'_title'); ?></h3>

															<?php echo wpautop(get_meta('insight'.$i.'_content', true)); ?>

														</div>

														<?php if(meta_set('insight'.$i.'_words')) { ?>

															<div class="insight-word-wrapper">

																<?php if(!$wordsHeader) { ?>
																	<h4><?php get_meta('insight_words_header'); ?></h4>
																	<?php $wordsHeader = true; ?>
																<?php } ?>

																<div class="insight-words">
																	<?php echo nl2br(get_meta('insight'.$i.'_words', true)); ?>
																</div>

															</div>

														<?php } ?>

														</div>

													<?php } ?>

												</div>

											<?php } ?>

											</div>
										</div>
										<?php $tabCounter++;
									}

									// Related Products
									if($relatedEnabled) { ?>
										<div id="tab-<?php echo $tabCounter; ?>" class="tabs2">
											<div class="inner-tab">
											<div class="pane related_products clearfix">

											<?php // RELATED PRODUCTS TITLE ?>
											<h2><?php get_meta('related_title'); ?></h2>

											<?php // RELATED PRODUCTS SUBTITLE ?>
											<h3><?php get_meta('related_subtitle'); ?></h3>

											<?php
											$subsections = get_meta('related_subsections', true);
											$related_books = get_meta('relateds', true);
											$openRow = false;
											$bookNum = 1;

											// FIRST: all books NOT in any subsection

											foreach($related_books as $bookID => $book) {

												// skip books that have subsections for right now
												if($book['subsection'] != '') continue;

												if($bookNum % 2 === 1) {
													echo '<div class="book-row clearfix">';
													$openRow = true;
												}

												// print the book
												print_book($book);

												if($bookNum % 2 === 1) {
													echo '</div>';
													$openRow = false;
												}

												// make sure we don't print this book again
												unset($related_books[$bookID]);

											}

											if($openRow)
												echo '</div>';

											// NEXT: each subsection

											foreach($subsections as $sub_num => $subsection) {

												if(!$subsection['title'] && !$subsection['desc'])
													continue;

												$bookNum = 1;

												echo '<div class="related-subsection clearfix">';

												if($subsection['title'])
													echo '<h2>' . $subsection['title'] . '</h2>';

												if($subsection['desc'])
													echo '<p class="subsection-desc">' . $subsection['desc'] . '</p>';

												foreach($related_books as $bookID => $book) {

													// skip books not in this subsection
													if($book['subsection'] != ($sub_num+1)) continue;

													if($bookNum % 2 === 1) {
														echo '<div class="book-row clearfix">';
														$openRow = true;
													}

													// print the book
													print_book($book);

													if($bookNum % 2 === 1) {
														echo '</div>';
														$openRow = false;
													}

													// make sure we don't print this book again
													unset($related_books[$bookID]);

												}

												if($openRow)
													echo '</div>';

												echo '</div>';

											}

											?>

											</div>
											</div>
										</div>
										<?php $tabCounter++;
									}

									// eBook Products
									if($ebooksEnabled) { ?>
										<div id="tab-<?php echo $tabCounter++; ?>" class="tabs2">
											<div class="inner-tab">
											<div class="pane ebook_products clearfix">

											<div id="ebooks-header">

											<?php // EBOOKS TITLE ?>
											<h2><?php get_meta('ebooks_title'); ?></h2>

											<?php // EBOOKS DESCRIPTION ?>
											<?php echo wpautop(get_meta('ebooks_desc', true)); ?>

											</div>

											<div id="inkling-modules">

											<?php // INKLING VIDEO
											$inkling_vid = ot_get_option('inkling_video', '');
											if($inkling_vid) {
												echo '<div class="inkling-module">';
												echo '<h3>Preview Inkling</h3>';
												echo '<div class="inner-inkling-module video">';
												echo apply_filters('the_content', '[embed]' . $inkling_vid . '[/embed]');
												echo '</div></div>';
											}
											?>

											<?php // INKLING PICTURE ?>
											<div class="inkling-module">

												<h3>Powered by <span>Inkling</span></h3>

												<div class="inner-inkling-module">
												<?php echo get_wk_img(get_meta('powered_by_inkling_img_id', true), 'inkling'); ?>
												</div>

											</div>

											</div>

											<?php
											$subsections = get_meta('ebook_subsections', true);
											$ebooks = get_meta('related_ebooks', true);
											$bookNum = 1;

											// FIRST: all books NOT in any subsection

											foreach($ebooks as $bookID => $book) {

												// skip books that have subsections for right now
												if($book['subsection'] != '') continue;

												if($bookNum % 2 === 1) {
													echo '<div class="book-row clearfix">';
													$openRow = true;
												}

												// print the book
												print_book($book, true);

												if($bookNum % 2 === 1) {
													echo '</div>';
													$openRow = false;
												}

												// make sure we don't print this book again
												unset($ebooks[$bookID]);

											}

											if($openRow)
												echo '</div>';

											// NEXT: each subsection

											foreach($subsections as $sub_num => $subsection) {

												if(!$subsection['title'] && !$subsection['desc'])
													continue;

												$bookNum = 1;

												echo '<div class="related-subsection clearfix">';

												if($subsection['title'])
													echo '<h2>' . $subsection['title'] . '</h2>';

												if($subsection['desc'])
													echo '<p class="subsection-desc">' . $subsection['desc'] . '</p>';

												foreach($ebooks as $bookID => $book) {

													// skip books not in this subsection
													if($book['subsection'] != ($sub_num+1)) continue;

													if($bookNum % 2 === 1) {
														echo '<div class="book-row clearfix">';
														$openRow = true;
													}

													// print the book
													print_book($book, true);

													if($bookNum % 2 === 1) {
														echo '</div>';
														$openRow = false;
													}

													// make sure we don't print this book again
													unset($ebooks[$bookID]);

												}

												if($openRow)
													echo '</div>';

												echo '</div>';

											}

											?>

											</div>
											</div>
										</div>
										<?php $tabCounter++;
									} ?>

								</section>

								<div id="bottom-buy-now">
								<?php buy_now_button(); ?>
								</div>

								<?php endif; ?>

								<footer class="article-footer">

									<a href="<?php echo ot_get_option( 'feedback_survey', 'http://www.surveymonkey.com/s/83KXKJK' ); ?>" class="feedback-button" target="_blank"><span>Give us your feedback</span></a>

									<?php $linkedin = ot_get_option( 'linkedin', '' ); ?>

									<!-- AddThis Follow BEGIN -->
									<div class="addthis_toolbox addthis_32x32_style addthis_default_style<?php if($linkedin) echo ' with-linkedin'; ?>">
										<a class="addthis_button_facebook_follow" addthis:userid="<?php echo ot_get_option( 'facebook', 'LippincottWilliamsWilkins' ); ?>"><span></span></a>
										<a class="addthis_button_youtube_follow" addthis:userid="<?php echo ot_get_option( 'youtube', 'lippincottpublishing' ); ?>"><span></span></a>
										<a class="addthis_button_twitter_follow" addthis:userid="<?php echo ot_get_option( 'twitter', 'lippincott' ); ?>"><span></span></a>
										<?php if($linkedin) { ?><a class="addthis_button_linkedin_follow" addthis:userid="<?php echo $linkedin; ?>" addthis:usertype="company"><span></span></a><?php } ?>
									</div>
									<!-- AddThis Follow END -->

								</footer> <!-- end article footer -->

							</article> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>