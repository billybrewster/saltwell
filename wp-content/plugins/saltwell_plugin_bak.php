<?php
/**
 * Plugin Name: Saltwell Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the Plugin.
 * Version: 1.0
 * Author: Rob Brooks
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: A "Slug" license name e.g. GPL2
 */
 
 /*
 function randomPhilosopher() {
global $wpdb;
$randomFact = $wpdb->get_row("SELECT * FROM wp_philosophy_philosopher, ARRAY_N);

$NumRows = count($randomFact);
$RandNum = rand(0, $NumRows);

print $randomFact[$RandNum]->philosopher;
print $randomFact[$RandNum]->about;
}
*/


function get_runners() {
   global $wpdb;
   print " -------- Runner List ------------- <br><br>";
   $runners = $wpdb->get_results("SELECT * FROM runners");
   
   foreach($runners as $runner){
	echo $runner->forename." ".$runner->surname;
	echo "<br>";
   }   
}
add_shortcode('show_runners', 'get_runners');

function get_totals() {
   global $wpdb;
   print " -------- Totals ------------- <br><br>";
   
   


   $totals = $wpdb->get_results("select r.runner_id, r.forename, r.surname, (
select COALESCE(sum(p.distance),0) total
from runners r2,  performance p
where r2.runner_id = p.runner_id
and p.race_date='Jan'
and r2.runner_id=r.runner_id
) jan,
(
select COALESCE(sum(p2.distance),0) total
from runners r3,  performance p2
where r3.runner_id = p2.runner_id
and p2.race_date='Feb'
and r3.runner_id=r.runner_id
) feb,
(
select COALESCE(sum(p2.distance),0) total
from runners r3,  performance p2
where r3.runner_id = p2.runner_id
and p2.race_date='Mar'
and r3.runner_id=r.runner_id
) mar,
(
select COALESCE(sum(p2.distance),0) total
from runners r3,  performance p2
where r3.runner_id = p2.runner_id
and r3.runner_id=r.runner_id
) total
from runners r
order by total desc");
  

	  
	echo "  <div class='divTable'>
             <div class='headRow'>
                <div class='divNameCell' align='center'>Name</div>
                <div  class='divCell'>Jan</div>
                <div  class='divCell'>Feb</div>
				<div  class='divCell'>Mar</div>
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
		<input type="checkbox" class="button-settings name="ShowPerformance$total->runner_id" id="ShowPerformance$total->runner_id" onclick="showPerformanceSelect($total->runner_id)" onChange="showPerformanceSelect($total->runner_id)"/>
		<div><label for="ShowPerformance$total->runner_id">
		
		<div class='divRow'>
                <div class='divNameCell'>$total->forename $total->surname</div>
				<div class='divCell'>$total->jan</div>
				<div class='divCell'>$total->feb</div>
				<div class='divCell'>$total->mar</div>
				<div class='divCell'>$total->total</div>
           </div>
		   
		   
		</label></div>
		<div id="RaceDetails$total->runner_id" style="display:none;background:#FAE6E6">
EOL;
		
		
		echo "<div class='divPerformanceRow'>";
			$performances = $wpdb->get_results("select * from performance where runner_id=$total->runner_id
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
   
	  
	  

}
add_shortcode('show_totals', 'get_totals');