<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
			
			<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>
				
				
				
				<article>
					
					<div class="content">
						
						
						<?php
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
						?>
					
						<?php  // query_posts('cat=1');
						
						
							  while (have_posts()) : the_post();
								//get_template_part( 'content', 'page' );
                                 //the_content();s
								
								the_title( '<div class="heading"><h2>', '</h2></div>' );
									$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
									foreach( $images as $imageID => $imagePost )
									echo wp_get_attachment_image($imageID, 'thumbnail', false);
	
								the_excerpt('Read on...');
								echo("<div class='clear'></div><br>");
                              endwhile;
                        ?>


					</div>
					<!--
					<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>
					-->
					
				</article>
				

				<!--
				<p class="more">
					<a class="button" <a href="<?php bloginfo('wpurl'); ?>/post-archive">
					Older Posts
					</a>
				</p>
				-->
	
				
				
				
			</div>
			
			<div class="sidebar col05">
			<?php get_sidebar(); ?>
			
			
			
		</div>
	</div>
</section>


<?php get_footer(); ?>
