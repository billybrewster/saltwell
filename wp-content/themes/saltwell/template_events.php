<?php 
	/*
	Template Name: Events
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

						<?php get_fb_events() ; ?>

					</div>
					
					
					
				</article>
				</div>
			</div>
			
			<div class="sidebar col05">
			<?php get_saltwell_sidebar(); ?>
			
			
			
		</div>
	</div>
</section>

<?php
echo "Events <br>";



get_footer();
?>