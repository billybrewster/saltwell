<?php 
	/*
	Template Name: Members
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
				<div class="spacer">
			
				<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				
				
				<article>
					
					
					
					
<div  ng-app="myApp" class="panel panel-default">
<div class="panel-heading">
                    <h2 class="panel-title">Race List</h2>
                </div>
		
<div ng-controller="SpicyController">

 
 
 <?php 
							$user_id = get_current_user_id();
							if ($user_id == 0) {
							echo 'You are not logged in ';
							wp_login_form( $args ); 
							
							the_widget( 'FacebookAllLoginWidget', $instance, $args );
							
							echo '<fb:login-button scope="public_profile,email,user_groups,user_events" onlogin="checkLoginState();">
							</fb:login-button>';

							} else {
							    
							//echo 'You are logged in as user '.$user_id . '<br>';
							/*
							echo "
							<div>Value: {{myvalue}}</div>
							
							<p ng-hide='myvalue'>sdfsdfsdfsdfsd</p>
							
							<div><button id='mybutton' ng-click=showAlert()>Click me</button></div>
							
							";
							*/
							
							echo "<table class='table table-hover'>
								<thead>
								<tr>
								<th>Event Name</th>
								<th>Date</th>
								<th>Status</th>
							      </tr>
							    </thead>";
							
							global $wpdb;

							echo "<tr><td colspoan=3><b>Event's you are participating in </b></td></tr>";
							
							$active_rows = $wpdb->get_results("select e.id id, e.name name, e.date date
							from wp_events e, wp_users_events ue
							where e.id = ue.event_id
							and ue.user_id = $user_id;");
							
							$active_row_count=0;
							
							 foreach ($active_rows as $active_row){
							 
							 
								///////////////////////////////////////////////////////
								$event_rows = $wpdb->get_results("select u.display_name user_name
								from wp_users_events ue, wp_users u 
								where u.id = ue.user_id
								and ue.event_id=$active_row->id;");
								
								////////////////////////////////////////////////////////
								
								
								//echo "<tr><td><div ng-click='showEvent($active_row->id)'>" .$active_row->name . "</div></td>"; 
								echo "<tr><td><div ng-click='showAlert($active_row->id,$active_row_count)'>" .$active_row->name . "</div></td>"; 
								echo "<td>" . $active_row->date . "</td>"; 
								
								echo "  
								<td><button ng-click='leaveEvent($active_row->id,$user_id)'>
								    Leave
								</button></td></tr>
								
								<tr ng-show='eventidarray[$active_row_count]'><td>";
							
								 foreach ($event_rows as $event_row){
									echo  $event_row->user_name . "</br>";
									
								}
								
								echo "</td></tr>
								
								
								
								";
								$active_row_count=$active_row_count+1;
							}
							
							////////////////////////////////////////////////////////////////////////
							echo "<tr><td colspan=3><b>Event's you are not participating in </b></td></tr>";
							
							$active_rows2 = $wpdb->get_results("select e.id id, e.name name, e.date date 
								from wp_events e
								where id not in (select e.id
								from wp_events e, wp_users_events ue
								where e.id = ue.event_id
								and ue.user_id=$user_id)");
							
							$active_row_count2=0;
							 foreach ($active_rows2 as $active_row2){
							 
							 ///////////////////////////////////////////////////////
								$event_rows2 = $wpdb->get_results("select u.display_name user_name
								from wp_users_events ue, wp_users u 
								where u.id = ue.user_id
								and ue.event_id=$active_row2->id;");
								
								////////////////////////////////////////////////////////
								
								
								//echo "<tr><td>" . $active_row2->name . "</td>"; 
								echo "<tr><td><div ng-click='showEventNonAttending($active_row2->id,$active_row_count2)'>" .$active_row2->name . "</div></td>";
								
								
								echo "<td>" . $active_row2->date . "</td>";
								
								echo "  
                                <td><button ng-click='joinEvent($active_row2->id,$user_id)'>
                                    Join
                                </button></td></tr>
					
							<tr ng-show='eventidarraynoattend[$active_row_count2]'><td>";
							
								 foreach ($event_rows2 as $event_row2){
									echo  $event_row2->user_name . "</br>";
									
								}
								
								echo "</td></tr>";
								
							$active_row_count2=$active_row_count2+1;
							}
							echo "</tbody>
							</table>";
						} 
						?> 
	
						
						
</div>
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


