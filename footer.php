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
        function parseUri (str) {
            var o   = parseUri.options,
                m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
                uri = {},
                i   = 14;

            while (i--) uri[o.key[i]] = m[i] || "";

            uri[o.q.name] = {};
            uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
                if ($1) uri[o.q.name][$1] = $2;
            });

            return uri;
        };

        parseUri.options = {
            strictMode: false,
            key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
            q:   {
                name:   "queryKey",
                parser: /(?:^|&)([^&=]*)=?([^&]*)/g
            },
            parser: {
                strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
            }
        };

        $('script').each(function() {
            var find = 'respond',
                parent_url = window.location.pathname;
                src = $(this).attr('src');

            if(typeof src !== 'undefined' && src.indexOf(find) != -1) {
                var url = parseUri(src),
                    main = parseUri('<?php //bloginfo('wpurl'); ?>'),
                    replace = src.replace(url.host, main.host);

                console.log(url);
                $(this).attr('src', replace);

                var link1 = $('#respond-proxy').attr('href');
                var link1ok = link1.replace(main.host, url.host);
                var link2 = $('#respond-redirect').attr('href');
                var link2ok = link2.replace(url.host, main.host);

                $('#respond-proxy').attr('href', link1ok);
                $('#respond-redirect').attr('href', link2ok);
            }
        });
        $(document).foundation('topbar', {
            custom_back_text: true,
            back_text: "<?php _e('Back', 'sfu_theme'); ?>",
            scrolltop: false,
            mobile_show_parent_link: true,
        });
    });
</script>

</body>
</html>