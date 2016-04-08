<?php
/**
 * Plugin Name: Saltwell Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the Plugin.
 * Version: 1.0
 * Author: Rob Brooks
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */
 


function add_race() {
   global $wpdb;
    $validate = $_POST['validate']; 
   $full_name = $_POST['FullName']; 
  
   print " <h2>Most Miles Competition</h2> <br><br>";
   
   $user_id = get_current_user_id();
						 
	if ($user_id == 0) {
		echo 'You are not logged in ';
		wp_login_form( $args ); 
							
		the_widget( 'FacebookAllLoginWidget', $instance, $args );
		echo "<br>";
	} else {
	
  // print " -------- Add Race ------------- <br><br>";
   
   //echo 'validate is ' . $validate . '<br>';
   
   $max_performance_id = $wpdb->get_var("select max(performance_id) from performance");
  // echo 'max performance id is  ' . $max_performance_id .'<br>';
	
   
   if ($validate=='true') {
	
	
	 $max_performance_id = $wpdb->get_var("select max(performance_id) from performance");
	
	$wpdb->insert( performance, array( 'performance_id' => $max_performance_id+1, 
	                                                      //'runner_id' => $_POST[FullName],
							      'runner_id' => $user_id,
							      'race_name' => $_POST[Event],
							      'race_date' => $_POST[Month],
							      'year' => 2015,
							      'distance' => $_POST[Distance]));

	//mysql_query("INSERT INTO performance (performance_id, runner_id, race_name, distance, race_date)
	//VALUES (100,100,'name','distance'", $wpdb);

	$validate = "false";

   
   
	}
   
   //echo "<form name='raceForm' id='raceForm' method='post' action='http://localhost:8080/saltwell_wordpress/most-miles/' target='_self'>";
   echo "<form name='raceForm' id='raceForm' method='post' action='http://www.saltwellharriers.org.uk/most-miles/' target='_self'>";
   
   /*
   echo "<label class='leftLabel'>Name</label><select name='FullName'>";
    $runners = $wpdb->get_results("SELECT * FROM wp_users");
    foreach($runners as $runner){
        //$runnerName = $runner->forename." ".$runner->surname;
	$runnerName = $runner->display_name;
        echo "<option value='$runner->ID'>$runnerName</option>";
	echo "<br>";
     }
     echo "</select><br>";
     */
   
   echo "
  
   <label class='leftLabel'>Month</label><select name='Month'>
  <option value='Jan'>January</option>
  <option value='Feb'>February</option>
  <option value='Mar'>March</option>
  <option value='Apr'>April</option>
  <option value='May'>May</option>
  <option value='Jun'>June</option>
  <option value='Jul'>July</option>
  <option value='Aug'>August</option>
  <option value='Sep'>September</option>
  <option value='Oct'>October</option>
  <option value='Nov'>November</option>
  <option value='Dec'>December</option>
</select> <br>
	
   <label class='leftLabel'>Event</label><input name='Event'  class='field required' value='' /><br>
   <label class='leftLabel'>Distance (in miles)</label><input name='Distance'  class='field number required' value='' /><br>
   
    <input type='hidden' name='validate' value='true'> 
   <input type='submit' value='Submit'>
	
	<br><br>
  </form>
  <script>
	$('#raceForm').validate();
</script>
   ";
   
     }
}
add_shortcode('add_race_form', 'add_race');


function get_runners() {
   global $wpdb;
   print " -------- Runner List ------------- <br><br>";
   $runners = $wpdb->get_results("SELECT * FROM wp_users");
   
   foreach($runners as $runner){
	echo $runner->display_name;
	echo "<br>";
   }   
}
add_shortcode('show_runners', 'get_runners');

function get_totals() {
   global $wpdb;
   
   
   $year=2015;


   $totals = $wpdb->get_results("select r.ID, r.display_name, (
select COALESCE(sum(p.distance),0) total
from wp_users r2,  performance p
where r2.ID = p.runner_id
and p.race_date='Jan'
and p.year=$year
and r2.ID=r.ID
) jan,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Feb'
and p2.year=$year
and r3.ID=r.ID
) feb,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Mar'
and p2.year=$year
and r3.ID=r.ID
) mar,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Apr'
and p2.year=$year
and r3.ID=r.ID
) apr,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='May'
and p2.year=$year
and r3.ID=r.ID
) may,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Jun'
and p2.year=$year
and r3.ID=r.ID
) jun,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Jul'
and p2.year=$year
and r3.ID=r.ID
) jul,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Aug'
and p2.year=$year
and r3.ID=r.ID
) aug,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Sep'
and p2.year=$year
and r3.ID=r.ID
) sep,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Oct'
and p2.year=$year
and r3.ID=r.ID
) oct,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Nov'
and p2.year=$year
and r3.ID=r.ID
) nov,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and p2.race_date='Dec'
and p2.year=$year
and r3.ID=r.ID
) decem,
(
select COALESCE(sum(p2.distance),0) total
from wp_users r3,  performance p2
where r3.ID = p2.runner_id
and r3.ID=r.ID
and p2.year=$year
) total
from wp_users r
order by total desc");
  

	  
	echo "  <div class='divTable'>
             <div class='headRow'>
                <div class='divNameCell' align='center'>Name</div>
                <div  class='divCell'>Jan</div>
                <div  class='divCell'>Feb</div>
		<div  class='divCell'>Mar</div>
		<div  class='divCell'>Apr</div>
		<div  class='divCell'>May</div>
		<div  class='divCell'>Jun</div>
		<div  class='divCell'>Jul</div>
		<div  class='divCell'>Aug</div>
		<div  class='divCell'>Sep</div>
		<div  class='divCell'>Oct</div>
		<div  class='divCell'>Nov</div>
		<div  class='divCell'>Dec</div>
		<div  class='divCell'>Total</div>
             </div>
			 ";
	foreach($totals as $total){
	/*
    echo "<div class='divRow'>
                <div class='divNameCell'>$total->forename $total->surname</div>
				<div class='divCell'>$total->jan</div>
				<div class='divCell'>$total->feb</div>
				<div class='divCell'>$total->mar</div>
				<div class='divCell'>$total->total</div>
           </div>
		   ";
	*/
	echo <<<EOL
		<input type="checkbox" class="button-settings name="ShowPerformance$total->ID" id="ShowPerformance$total->ID" onclick="showPerformanceSelect($total->ID)" onChange="showPerformanceSelect($total->ID)"/>
		<div><label for="ShowPerformance$total->ID">
		
		<div class='divRow'>
                <div class='divNameCell'>$total->display_name</div>
				<div class='divCell'>$total->jan</div>
				<div class='divCell'>$total->feb</div>
				<div class='divCell'>$total->mar</div>
				<div class='divCell'>$total->apr</div>
				<div class='divCell'>$total->may</div>
				<div class='divCell'>$total->jun</div>
				<div class='divCell'>$total->jul</div>
				<div class='divCell'>$total->aug</div>
				<div class='divCell'>$total->sep</div>
				<div class='divCell'>$total->oct</div>
				<div class='divCell'>$total->nov</div>
				<div class='divCell'>$total->decem</div>
				<div class='divCell'>$total->total</div>
           </div>
		   
		   
		</label></div>
		<div id="RaceDetails$total->ID" style="display:none;background:#FAE6E6">
EOL;
		
		
		echo "<div class='divPerformanceRow'>";
			$performances = $wpdb->get_results("select * from performance where runner_id=$total->ID and year=$year
			order by performance_id;
			");
			foreach($performances as $performance){
				echo "<div class='divRow'>
				<div class='divPerformanceNameCell'>$performance->race_name</div>
				<div class='divPerformanceCell'>$performance->distance</div>
				<div class='divPerformanceCell'>$performance->race_date</div>
				</div>
				
				";
			}
		echo "</div>";
		echo "</div>";
	  
   } 
   
   echo "</div>";
   echo "<br>";
   
}
add_shortcode('show_totals', 'get_totals');