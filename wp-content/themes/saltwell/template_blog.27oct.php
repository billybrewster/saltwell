<?php 
	/*
	Template Name: Blog
	*/
	get_header();
?>







<!--------------Navigation--------------->
<!--
<nav>
	<ul>
		<li><a href="#">Home</a></li>
		<li><a href="#">About</a></li>
		<li><a href="#">Membership</a></li>
		<li><a href="#">Training Diary</a></li>
		<li><a href="#">Club Contacts</a></li>
		<li><a href="#">Gallery</a></li>
		<li><a href="#">Merchandise</a></li>
	</ul>
</nav>
-->
			
<!--------------Content--------------->
<section id="content">
	<div class="zerogrid">
		<div class="row block">
			<div class="main-content col11">
			
				<div class="rslides_container">
					<ul class="rslides" id="slider">
						<li><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/1.jpg"/></li>
						<li><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/2.jpg"/></li>
						<li><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/3.jpg"/></li>
						<li><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/4.jpg"/></li>
					</ul>
				</div>
				
				
				<article>
					<!--
					<div class="heading">
						<h2><a href="#">Cross Country Training</a></h2>
						<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>
					</div>
					-->
					<div class="content">
						
						
						
						<?php query_posts('cat=1');
							  while (have_posts()) : the_post();
								//get_template_part( 'content', 'page' );
                                 //the_content();s
								echo "<div class='post'>";
								the_title( '<div class="heading"><h2>', '</h2></div>' );
									$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
									
									//echo wp_get_attachment_image(array_values($images)[1], 'thumbnail', false);
									
									//echo array_values($images)[1] ;
									
									
									$count=0;
									
									foreach( $images as $imageID => $imagePost ) {
										if($count==0) {
											echo wp_get_attachment_image($imageID, 'thumbnail', false);
										}
										$count++;
									}
									
	
								the_excerpt('Read on...');
								echo "</div>";
								
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
				

		
				<p class="more">
					<a class="button" <a href="<?php bloginfo('wpurl'); ?>/category/news/">
					Older Posts
					</a>
				</p>
		
	
				
				
				
			</div>
			
			<div class="sidebar col05">
			<?php get_saltwell_sidebar(); ?>
			
			
			
		</div>
	</div>
</section>



<?php get_footer(); ?>


