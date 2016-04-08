<?php 
	/*
	Template Name: Gallery
	*/
	get_header();
?>

			
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col16">
			
				<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				
				
				<article>
					
					<div class="content">
						
						
						<div class="heading"><?php echo get_the_title(); ?> </div>
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
</section>



<?php get_footer(); ?>


