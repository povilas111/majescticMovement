     <hr>

   

    </div> <!-- /container -->
	  
	  <footer class="footer-top">
		  <div class="container">
			    <div class="pull-left"><span>
		<?php echo get_theme_mod('text_setting', 'tekstas'); ?>
				</span></div>
				<div class="pull-right">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?>
					<?php endif; ?>
				</div>
		   </div>
		</div>  
      </footer>
	</div> <!-- /wrapper -->
    <?php wp_footer(); ?>

  </body>
</html>