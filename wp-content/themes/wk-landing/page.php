<?php get_header(); ?> 
<div id="content"> 
	<div id="inner-content" class="wrap clearfix"> 
		<div id="main" class="eightcol first clearfix" role="main"> 
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
			<article id="post-<?php the_ID(); ?>" 
			<?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting"> 
			<?php if(metabox_enabled('webinar_module')) : ?> 
			<a href="<?php get_meta('webinar_link'); ?>" target="_blank" id="webinar-module" class="row"> 
			<div> 
				<?php get_meta('webinar_line1'); ?> 
				<span class="link"><?php get_meta('webinar_cta'); ?></span> 
				<i class="icon-chevron-right"></i> 
			</div> 
			</a> 
			<?php endif; ?> 
			<?php if(metabox_enabled('podcast_module')) : ?> 
			
			<a href="<?php get_meta('podcast_link'); ?>" target="_blank" id="podcast-module" class="row"> 
			
				<div> <?php get_meta('podcast_line1'); ?> 
				<span class="link"><?php get_meta('podcast_cta'); ?></span> 
				<i class="icon-chevron-right"></i> 
				</div> 
			</a> 
			<?php endif; ?> 
			<div id="hero-book-module row"> 
				<div class='hero row border-bottom'> 
				<div class='row main-attraction'>
				<div class='col-md-2 col-lg-1'></div>
				<?php if(meta_set('video')) : ?> 
						<div class="col-xs-12 col-sm-6 col-md-4 video<?php if(!meta_set('video_title')) echo ' video-no-title'; ?>"> 
							<?php if(meta_set('video_title')) echo '<h2>' . get_meta('video_title', true) . '</h2>'; ?> 
							<?php echo apply_filters('the_content', '[embed]' . get_meta('video', true) . '[/embed]'); ?> 
						</div> 
						<?php endif; ?>
					</div>
					<header class="article-header row"> 
					<?php if(meta_set('cobrand_logo')) { 
						echo '<div class="logo-wrapper">'; 
						echo wp_get_attachment_image(get_meta('cobrand_logo_id', true), 'cobrand-logo'); 
						echo '</div>'; } ?> 
						<h1 class="page-title" itemprop="headline"><?php get_meta('headline'); ?></h1> 
						</h2> 
					</header> 
					<!-- end article header --> 
					<section class="entry-content hide" itemprop="articleBody"> 
					<?php if(meta_set('book_desc_intro')) : ?> 
						<div id="book-desc-intro"> 
							<?php echo wpautop(get_meta('book_desc_intro', true)); ?> 
						</div> 
						<?php endif; ?> 
						<div id="book-desc"> <?php echo wpautop(get_meta('book_desc', true)); ?> 
						</div> 
						<?php if(meta_set('image') && !meta_set('video')) : $img = wp_get_attachment_image_src(get_meta('image_id', true), 'full'); ?> 
						<div id="hero-image" style="width:<?php echo round($img[1]/2); ?>px;height:<?php echo round($img[2]/2); ?>px;"> 
							<?php echo wp_get_attachment_image(get_meta('image_id', true), 'full'); ?> 
						</div> 
						<?php endif; ?> 
						</section> <!-- end article section --> 
					</div> <!-- end #hero --> 
					
					<section class="book-module row border-bottom" id=""> 
					<!--begin book module-->
						<div class='col-xs-4 book-cover wk-book-img'>
							<?php echo wp_get_attachment_image(get_meta('book_image_id', true), 'book-main'); ?> 
						</div>
						<div class='col-xs-8 wk-tab-sub'>
							<ul class="nav nav-pills wk-tabs">
								<li><a href="#featured-sample-contents" data-toggle="tab">View Sample Contents</a></li>	
								<li class="active"><a href="#featured-book-details" data-toggle="tab">Book Details</a></li>
							</ul>
							<h2 class='featured-book-title'> <?php if(meta_set('book_edition')) { 
										echo '' . get_meta('book_title', true), ', '; 
										if(meta_set('title_edition_line_break') && get_meta('title_edition_line_break', true) === 'on') echo '<br />'; 
										get_meta('book_edition'); } else { echo '<em>' . get_meta('book_title', true), '</em>'; } ?> 
							</h2> 
							<div class='tab-content'>
								<div class='wk-book-details tab-pane active' id='featured-book-details'>
								<section class="entry-content" itemprop="articleBody"> 
									<?php if(meta_set('book_desc_intro')) : ?> 
									<div id="book-desc-intro"> 
										<?php echo wpautop(get_meta('book_desc_intro', true)); ?> 
										</div> 
									<?php endif; ?>
										<?php if(meta_set('image') && !meta_set('video')) : $img = wp_get_attachment_image_src(get_meta('image_id', true), 'full'); ?>
										
										<?php endif; ?> 
										</section>
									<p id="book-details"><span class='wk-price'> Price: $<?php $price = floatval(get_meta('price', true)); echo $price; ?> </span>
										<?php if(meta_set('discount_percent')) : $discount_percent = floatval(str_replace('%', '', get_meta('discount_percent', true))); $discount_price = round($price - ($price * ($discount_percent/100)), 2); ?> 
										<br /> 
										<span class='wk-discounted'>Discount Price: $<?php echo $discount_price; ?></span>
										<br /> 
										<span class='wk-you-save'>You Save: <?php echo $discount_percent; ?>% <?php endif; ?> </span>
									</p> 
									<?php learn_more_button(); ?> 
								</div>
								<div class='wk-sample-contents tab-pane' id='featured-sample-contents'>
								<?php $samples = get_meta('samples', true); 
										$i=0;
										
										foreach($samples as $sample) {
										if($i==1){ ?> 
											<div class="sample"> 
												<h3><?php echo $sample['name']; ?></h3> 
												<a href="<?php echo $sample['link']; ?>" target="_blank" class="sample-preview"> 
													<?php echo get_wk_img($sample['image']['id'], 'sample'); ?> 
													<div class='wk-buy-btn wk-sample'>View Contents</div>
												</a> 
											</div> <?php }$i++; } ?> 
									
								</div>
							</div>
							<div class='wk-sample-contents'>
							</div>
						</div>
						<div id="inner-book-module"> 
							
						</div> 
					</section> <!-- end article section --> 
				</div> 
				<!-- end #hero-book-module -->
				 
				<!-- Related Products --> 
			<div class='row border-bottom'> 
				<div class="pane related_products col-xs-12"> 
					<?php $subsections = get_meta('related_subsections', true);
						$related_books = get_meta('relateds', true); 
						$bookNum = 1; 
						if($related_books) : foreach($related_books as $bookID => $book) { 
						if($book['subsection'] != '') continue; 
						if($bookNum % 2 === 1) { 
							echo '<div class="book-row row clearfix">'; 
						} 
						print_book($book); 
							if($bookNum % 2 === 1) { 
								echo '</div>'; 
								$openRow = false; 
							} unset($related_books[$bookID]); 
							} 
							endif; 
							if($openRow) echo '</div>'; 
							foreach($subsections as $sub_num => $subsection) { 
							if(!$subsection['title'] && !$subsection['desc']) continue; $bookNum = 1; 
							echo '<div class="related_subsection">'; 
							if($subsection['title']); 
							if($subsection['desc']) echo '<p class="subsection-desc">' . $subsection['desc'] . '</p>'; 
							
							foreach($related_books as $bookID => $book) { 
								if($book['subsection'] != ($sub_num+1)) continue; if($bookNum % 2 === 1) { 
									echo '<div class="book-row row clearfix">';
								} print_book($book); 
								if($bookNum % 2 === 1) { 
									echo '</div>'; 
									$openRow = false; 
								} unset($related_books[$bookID]); 
							} 
							if($openRow) echo '</div>'; echo '</div>'; } ?> 
					</div> 
				</div>
				
			<?php $authorsMetas = array('meet_authors', 'author_spotlight'); 
				$aboutMetas = array('about_book', 'sample_content', 'reviews', 'customer_insight'); 
				$relatedMetas = array('related_products'); 
				$ebooksMetas = array('ebooks'); 
				$authorsEnabled = metabox_enabled('meet_authors') || metabox_enabled('author_spotlight'); 
				$aboutEnabled = metabox_enabled('about_book') || metabox_enabled('sample_content') || metabox_enabled('reviews') || metabox_enabled('customer_insight'); 
				$relatedEnabled = metabox_enabled('related_products'); 
				$ebooksEnabled = metabox_enabled('ebooks'); 
				$customTabsEnabled = metabox_enabled('custom1') || metabox_enabled('custom2') || metabox_enabled('custom3') || metabox_enabled('custom4') || metabox_enabled('custom5'); 
				if($authorsEnabled || $aboutEnabled || $relatedEnabled || $ebooksEnabled || $customTabsEnabled) : ?>
			
													 <?php endif; ?> 
													<footer class="article-footer"> 
														<a href="<?php echo ot_get_option( 'feedback_survey', 'http://www.surveymonkey.com/s/83KXKJK' ); ?>" class="feedback-button" target="_blank">
														<span>Give us your feedback</span>
														</a> 
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
												</section> <footer class="article-footer"> <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p> </footer> </article> <?php endif; ?> </div> <!-- end #main --> </div> <!-- end #inner-content --> </div> <!-- end #content --> <?php get_footer(); ?>
				