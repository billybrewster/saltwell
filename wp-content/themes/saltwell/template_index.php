<?php 
	/*
	Template Name: Index
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
					<div class="heading">
					<!-- <?php bloginfo('template_url'); ?>  -->
					
						<h2><a href="#">2013 Saltwell 10k Road Race</a></h2>
						<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>
					</div>
					<div class="content">
						<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/thumb1.jpg"/>
						<p>The Ronnie Walker Saltwell 10K Saturday<br>
							21st December 2013, 11.30am - England’s Oldest Road Race<br><br>
							Please complete the form below and send with entry fee to:<br>

            Phil James, 

            8 Birkdale Close, Usworth, 

            Washington NE37 1PQ

                     Closing date: Monday 16th December 2013 Entry limit 400

          <a href="documents/10KENTRY13(1).pdf" target="_blank">Download form HERE &gt;&gt;&gt; </a><br><br>
		  
		  Online entry available is also available at the <a href="https://www.runbritain.com/entries/EnterRace.aspx?evid=7abf0cc95c6c&erid=7cb90bc95c67">Run Britain Website</a>

							</p>
					</div>
					<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>
				</article>
				<article>
					<div class="heading">
						<h2><a href="#">Ian Hodgson Mountain Relay</a></h2>
						<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>
					</div>
					<div class="content">
						<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/thumb2.jpg"/>
						<p>The 2013 relay will be on Sunday 6th October. We have the instructions and list of teams. Captains, please download a declaration form and hand it in before 08:45 on race day.</p>
					</div>
					<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>
				</article>
				<article>
					<div class="heading">
						<h2><a href="#">Cross Country Training</a></h2>
						<p class="info">>>> Posted by Admin - 01/01/2012 - 0 Comments</p>
					</div>
					<div class="content">
						<!-- <img src="images/thumb3.jpg"/> -->
						<p>This Saturday morning --- Cross Country training at 09.30 am at Wrekenton.<br>

							Throughout the winter there will be XC training every Saturday on the field behind behind the CooP in Wrekenton starting at 09.30 am for 45 minutes. The training will only be on when there is no XC race that day.<br>

							Everyone is welcome and training is organised for all abilities. Bring your children along if you want.<br>

							Plenty of parking in the Coop car park.<br>
							As an incentive I'll treat everyone who turns up to a coffee at the Chapel coffee morning straight after training!!<br>

							Regards, Keith<br>
							</p>
					</div>
					<div class="footer">
						<p class="more"><a class="button" href="#">Read more >></a></p>
					</div>
				</article>
			</div>
			
			<div class="sidebar col05">
			<!--
				<section>
				    
					<div class="heading">Twitter</div>
					<div class="content">
						<ul class="list">
						<li><a href="#">Post1</a></li>
						<li><a href="#">Post2</a></li>
						<li><a href="#">Post3</a></li>
						<li><a href="#">Post4</a></li>
						<li><a href="#">Post5</a></li>
					</ul>
					</div>
					
					

				</section>
				-->
				<section>
					<div class="heading">Facebook</div> 
					
					<div class="facebook_content"> 
					<!--
					<!--
					<ul class="list">
						<li><a href="#">Post1</a></li>
						<li><a href="#">Post2</a></li>
						<li><a href="#">Post3</a></li>
						<li><a href="#">Post4</a></li>
						<li><a href="#">Post5</a></li>
					</ul>
					-->
					<!--
					<iframe src="http://www.facebook.com/plugins/likebox.php?id=214595641941425&amp;width=320&amp;connections=5&amp;stream=true&amp;header=true&amp;height=400" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:400px;" allowTransparency="true"></iframe>
					-->
					
					
					
					<?php
					$limit = 5;
 
$group_id = '517414261687949';
$url1 = 'https://graph.facebook.com/'.$group_id;
$des = json_decode(file_get_contents($url1));
 
 
echo '<pre>';
//print_r($des);
echo '</pre>';
 
 
$url2 = "https://graph.facebook.com/{$group_id}/feed/?access_token=222601031087438|fEa02JzC7jP_JuopFqXTtBdz1rM";
$data = json_decode(file_get_contents($url2));

//print_r($data);

?>


<div>
 <div>
 
 <!-- 
 <a href='http://www.facebook.com/home.php?sk=group_<?php echo $group_id; ?>&ap=1'>
<?php echo $des->name?></a>
 <div style="width:100%; margin: 5px">
 <?php echo $des->description?>
 </div>
 </div>
 
 -->
 
 <?php
 $counter = 0;
  
 foreach($data->data as $d) {
 if($counter==$limit)
 break;
 ?>
 
 
 <div>
 <div>
 <a href="http://facebook.com/profile.php?id=<?php echo $d->from->id?>">
    <img border="0" alt="<?=$d->from->name?>" src="https://graph.facebook.com/<?php echo $d->from->id?>/picture"/>
 </a>
 </div>
 <div>
 <span style="font-weight:bold"><a href="http://facebook.com/profile.php?id=<?php echo $d->from->id?>">
<?php echo $d->from->name?></a></span><br/>
 
 <?php echo $d->message?>
  <br/>
 <span style="color: #999999;">on <?php echo date('F j, Y H:i',strtotime($d->created_time))?></span> 
 <br/>
 
 </div>
 </div>
  <br/>
 <?php
 $counter++;
 }
 ?>
</div>



					</div> 
				</section>
				<section>
				<div class="heading">Forthcoming Races</div>
				<div class="content">
				
				<?php 	$rss = new DOMDocument();
						$rss->load('http://www.northeastraces.com/next.rss');
						$feed = array();
						
						
foreach ($rss->getElementsByTagName('item') as $node) {
	$item = array ( 
		'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
		'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		'timestamp' => strtotime(substr(($node->getElementsByTagName('title')->item(0)->nodeValue),0,10)),
		'racedate' => date('l F d, Y', strtotime(substr(($node->getElementsByTagName('title')->item(0)->nodeValue),0,10))),
		'racename' => substr(($node->getElementsByTagName('title')->item(0)->nodeValue), 11, ($node->getElementsByTagName('title')->item(0)->nodeValue)),
		);
	array_push($feed, $item);
}

$newarray = array();

foreach ($feed as $key => $row)
{
    $newarray[$key] = $row['timestamp'];
}

array_multisort($newarray, SORT_ASC, $feed);

$limit = 10;
for($x=0;$x<$limit;$x++) {
	$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
	$link = $feed[$x]['link'];
	$description = $feed[$x]['desc'];
	$pubdate = date('l F d, Y', strtotime($feed[$x]['date']));
	//$racedate = substr($title,0,10);
	//$newDate = date("d-m-Y", strtotime($originalDate));
	//$race2date = date('l F d, Y', strtotime(substr($title,0,10)));
	$racedate = $feed[$x]['racedate'];
	//$racename = substr($title,11,strlen($title));
	$racename = $feed[$x]['racename'];
	$timestamp = $feed[$x]['timestamp'];
	
	echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$racename.'</a></strong><br />';
	echo '<p>'.$racedate.'</p>';
	//echo '<p>'.$racename.'</p>';
	//echo '<p>'.$timestamp.'</p>';
	// echo '<small><em>Posted on '.$date.'</em></small></p>';
	// echo '<p>'.$description.'</p>';
}







				?>
					<!-- 
					<div class="heading">Forthcoming Races</div>
					<div class="content">
						<ul class="list">
							<li><a href="#">Bridlington Half Marathon</a></li>
							<li><a href="#">Ennerdale Trail Run</a></li>
							<li><a href="#">Gibside Fruit Bowl Trail Race</a></li>
							<li><a href="#">Resolution Run (Holyrood)</a></li>
							<li><a href="#">Yorkshire Marathon</a></li>
						</ul>
					</div>
					-->
					</div>
				</section>
				<section>
					<div class="heading">Training Tools</div>
					<div class="content">
						<section>
							<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/thumb4.jpg"/>
							<h4><a href="#">Fell Running</a></h4>
							<p>Saltwell Harriers club is actively involved in fell and cross country running, entering teams for both men and women. This section of our new site will soon contain a wide range of fell running related information for club members and other runners. Use our contact page if you need any further information from us.</p>
						</section>
						<section>
							<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/thumb5.jpg"/>
							<h4><a href="#">Marathon Training</a></h4>
							<p>Many club members are looking to run their first marathon in 2012 and those of us who already have will no doubt be looking at others, perhaps even considering ultra running. The resources below are a small selection of useful links to help you along. Running a very long way takes time, please take the time to prepare well and no doubt you will enjoy the journey</p>
						</section>
						<section>
							<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/thumb6.jpg"/>
							<h4><a href="#">Cross Country</a></h4>
							<p>Well folks, you had a little taster a few weeks ago at the Farringdon Relays but the Cross Country season is about to kick off in earnest on Saturday, 28th September 2013.
The first fixture of the season is the Sherman Cup & Davison Shield.
.</p>
						</section>
					</div>
				</section>
			</div>
			
		</div>
	</div>
</section>

<?php get_footer(); ?>


