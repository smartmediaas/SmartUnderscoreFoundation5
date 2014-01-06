<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package sfu_theme
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer small-12 columns" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'sfu_theme_credits' ); ?>
			<?php _e('Built on WordPress by', 'sfu_theme'); ?> <a href="http://smartmedia.no/" title="Smart Media" target="_blank">Smart Media AS</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
    jQuery(document).ready(function($){
        $(document).foundation('topbar', {
            custom_back_text: true,
            back_text: "<?php _e('Back', 'sfu_theme'); ?>",
            scrolltop: false,
            mobile_show_parent_link: false,
        });
    });
</script>

</body>
</html>