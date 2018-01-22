    		

    		</main> <!-- end of main content -->
		</div> <!--end of page div-->
    <footer class="footer">
    	<div class="container">
    		<div class="footer-info">
    			<?php
					// checks for custom logo and gets logo if exists
					if(function_exists('the_custom_logo')) {
						the_custom_logo();
					} 
				?>
    			<h3>
    				<p class="footer-heading" ><?php echo esc_html(get_theme_mod('footer_text'));?></p>
    				<a class="footer-email" href="mailto:<?php echo esc_url(get_theme_mod('footer_email'));?>"><?php echo esc_html(get_theme_mod('footer_email'));?></a>
    			</h3>

					<?php
					/* Check if a menu exists at the social-footer location and if so get the social links menu for the footer */
					if(has_nav_menu('social-footer')) {
						echo '<nav class="social-footer">';
							wp_nav_menu( 
								array( 
									'theme_location' => 'social-footer', 
									'menu_class' => 'social-links', 
									'before' => '<div class="social-link-item">', 
									'after' => '</div>',
									'walker' => new Bukaba_Social_links_Walker()
									) 
							);
						echo '</nav>';
					}
					?>
    		</div>
    	</div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>