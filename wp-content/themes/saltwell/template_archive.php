<?php
/*
Template Name: Archives
*/
get_header(); ?>


<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
				
			
				
	
				<article>
					<!--
					<div class="heading">
						<h2><a href="#">Cross Country Training</a></h2>
						<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>
					</div>
					-->
					<div class="content">
					
					<?php
					
					
if ( is_main_query() ) {
    echo "MAIN QUERY";
}


						if ( is_search() ) {
			$context = 'search';
		}
		// Blog posts index
		else if ( is_home() ) {
			$context = 'blog';
		}
		// Category archive index
		else if ( is_category() ) {
			$context = 'category';
		}
		// Tag archive index
		else if ( is_tag() ) {
			$context = 'tag';
		}
		// Taxonomy archive index
		else if ( is_tax() ) {
			$context = 'taxonomy';
		}
		// Author archive index
		else if ( is_author() ) {
			$context = 'author';
		}
		// Date archive index
		else if ( is_date() ) {
			$context = 'date';
		}
		// Archive index
		else if ( is_archive() ) {
			$context = 'archive';
		}
		else {
			$context = 'archive';
		}
		echo "THE CONTEXT IS $context";
		
		?>
		
		
						
						<?php query_posts('cat=1');
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
				
				</div>
			
			<div class="sidebar col05">
			<?php get_sidebar(); ?>
			
			
			
		</div>
	</div>
</section>






<?php get_footer(); ?>