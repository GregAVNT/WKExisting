<footer class="footer" role="contentinfo"> 
	<div id="inner-footer" class="wrap clearfix"> 
		<p class="source-org copyright">
			<?php echo do_shortcode(ot_get_option( 'copyright', '' )); ?>
		</p> 
		<?php if(!is_404()) : ?> <?php if(meta_set('cobrand_logo')) { echo wp_get_attachment_image(get_meta('cobrand_logo_id', true), 'cobrand-logo-footer'); } ?> 
		<?php if(metabox_enabled('footer')) { echo '<p id="cobrand-disclaimer">'; get_meta('cobrand_disclaimer'); echo '</p>'; } ?> 
		<?php endif; ?> 
	</div> <!-- end #inner-footer --> 
</footer> <!-- end footer --> 

<!-- end #container --> <!-- all js scripts are loaded in library/bones.php --> <?php wp_footer(); ?> </body> </html> <!-- end page. what a ride! -->