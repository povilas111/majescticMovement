<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Fruitful theme
 * @since Fruitful theme 1.0
 */
?>
				</div>
			</div>
		</div><!-- .page-container-->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div id="footer-widget1">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-4">
						<div id="footer-widget2">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-4">
						<div id="footer-widget3">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				
				<div class="sixteen columns">
					<div class="site-info">
						<?php fruitful_get_footer_text(); ?>
					</div><!-- .site-info -->
					<?php if (!fruitful_is_social_header()) { 	
							   fruitful_get_socials_icon(); 
						  } 
					?>
				</div>
			</div>
			<div id="back-top">
				<a rel="nofollow" href="#top" title="Back to top">&uarr;</a>
			</div>
		</footer><!-- #colophon .site-footer -->
	<!--WordPress Development by Fruitful Code-->
<?php wp_footer(); ?>
</body>
</html>