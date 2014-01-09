<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package sfu_theme
 */
 
if ( ! function_exists( 'sfu_theme_pagination' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */

function sfu_theme_pagination($pages = '', $range = 2)
{  
        $showitems = ($range * 2)+1;  
        
        global $paged;
        if(empty($paged)) $paged = 1;
        
        if($pages == ''){
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if(!$pages){
                        $pages = 1;
                }
        }   
        
        if(1 != $pages){
        echo '<ul class="pagination">';
        if($paged > 2 && $paged > $range+1){
                echo '<li class="arrow"><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';        
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&laquo;</a></li>';
        }
        if($paged > 1){
                echo '<li class="arrow"><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&lsaquo;</a></li>';        
        }
        
        for ($i=1; $i <= $pages; $i++){
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                        echo ($paged == $i)? '<li class="current"><a href="">'.$i.'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                }
        }
        
        if ($paged < $pages){
                echo '<li class="arrow"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&rsaquo;</a>';
        }
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages){
                echo '<li class="arrow"><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&raquo;</a></li>';
        }
         echo "</ul>\n";
        }
}
endif;

if ( ! function_exists( 'sfu_theme_paging_nav' ) ) :


if ( ! function_exists( 'sfu_img' ) ) :
/**
 * Custom image retriever.
 * Will automatically retrieve images from the theme images folder
 */ 
function sfu_img($imgName, $imgParam=''){
    if($imgParam == 'url'){
        $imgReturn = get_bloginfo('stylesheet_directory').'/images/'.$imgName;
    }elseif($imgParam){
        $imgReturn = '<img id="'.$imgParam.'" src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }else{
        $imgReturn = '<img src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }
    echo $imgReturn;
}
endif;

if ( ! function_exists( 'sfu_clear' ) ) :
/**
 * Custom clear fix.
 * What it says on the box
 */
function sfu_clear(){
    echo '<div class="sfu-clear" style="clear:both;"></div>';
}
endif;

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function sfu_theme_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'sfu_theme' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sfu_theme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sfu_theme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sfu_theme_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function sfu_theme_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'sfu_theme' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'sfu_theme' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'sfu_theme' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sfu_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function sfu_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'sfu_theme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'sfu_theme' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'sfu_theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'sfu_theme' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'sfu_theme' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sfu_theme' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for sfu_theme_comment()

if ( ! function_exists( 'sfu_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sfu_theme_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'sfu_theme' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function sfu_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so sfu_theme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sfu_theme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sfu_theme_categorized_blog.
 */
function sfu_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'sfu_theme_category_transient_flusher' );
add_action( 'save_post',     'sfu_theme_category_transient_flusher' );
