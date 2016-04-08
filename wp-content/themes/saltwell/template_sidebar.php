<?php 
	/*
	Template Name: Sidebar
	*/
	get_header();
?>








			
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
				<div class="spacer">
			
				<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				
				
				<article>
					
					<div class="content">
						
						<?php 
							  while (have_posts()) : the_post();
								//get_template_part( 'content', 'page' );
                                 the_content();
                              endwhile;
                        ?>




					</div>
					
					
					
				</article>
				</div>
			</div>
			
			<div class="sidebar col05">
			<?php get_saltwell_sidebar(); ?>
			
			
			
		</div>
	</div>
</section>



<?php get_footer(); ?>

