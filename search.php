<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package sfu_theme
 */

get_header(); ?>

	<section id="primary" class="content-area row">
		<main id="main" class="site-main medium-8 columns" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'sfu_theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php sfu_theme_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</section><!-- #primary -->

<?php get_footer(); ?>
