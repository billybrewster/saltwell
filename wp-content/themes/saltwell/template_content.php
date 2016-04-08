<?php 
	/*
	Template Name: Content
	*/
	get_header();
?>


			
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col16">
			
				<article>
					
					<div class="content">
						
					
						<?php 
							  while (have_posts()) : the_post();
                                the_content();
                              endwhile;
                        ?>

					</div>
					
				</article>
			</div>
	</div>
</section>



<?php get_footer(); ?>


