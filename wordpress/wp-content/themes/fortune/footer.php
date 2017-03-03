<!-- Footer -->
<?php $fortune_theme_options = fortune_theme_options();
$col = 12 / (int)$fortune_theme_options['footer_layout']; ?>
<footer class="footer" id="footer" role="contentinfo"><?php
if (is_active_sidebar('footer-widget')) {?>
  <div class="footer-widgets">
    <div class="container">
      <div class="row" role="complementary">
        <?php dynamic_sidebar('footer-widget'); ?>
      </div>
    </div>
  </div><?php
  } ?>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div id="f-copyright" class="col-sm-6 col-md-4"> <?php echo esc_attr($fortune_theme_options['footer_copyright'] . ' ' . $fortune_theme_options['developed_by_text']); ?>
                    <a href="<?php echo esc_url($fortune_theme_options['developed_by_link']); ?>"><?php echo esc_attr($fortune_theme_options['developed_by_link_text']); ?></a> </div>
		<?php	if ( has_nav_menu( 'social' ) ) {?>
        <div id="social_footer" class="col-sm-6 col-md-8">
          <div class="social-links-wrapper"> <span class="social-links-txt"><?php _e('Connect with us', 'fortune'); ?></span>
				<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'container'		=>false,
								'menu_class'     => 'social-links social-links__dark',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . fortune_get_icon( array( 'icon' => 'chain' ) ),
							) );
						?>
          </div>
        </div><?php
		}
		?>
      </div>
    </div>
  </div>
</footer>
<!-- Footer / End -->
</div>
<!-- Main / End -->
</div>
<?php wp_footer();?>
<script>
jQuery(document).ready(function(){
	jQuery("body").tooltip({ selector: '[data-toggle=tooltip]' });
});
</script>
</body>
</html>