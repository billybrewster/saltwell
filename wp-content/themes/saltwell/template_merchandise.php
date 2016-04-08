<?php 
	/*
	Template Name: Merchandise
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
						
					
						


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/hoody_front.jpg" alt="First slide">
          <div class="container">
            <!-- <div class="carousel-caption">
              <p>Saltwell Hoodie</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">See more</a></p>
            </div>
	    -->
          </div>
        </div>
        <div class="item">
          <img src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/Nil_Desperandum_flat.jpg" alt="Second slide">
          <div class="container">
            <!-- <div class="carousel-caption">
              <p>Saltwell 'Nil Desperandum' training shirt £10</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">See more</a></p>
            </div>
	    -->
          </div>
        </div>
        <div class="item">
          <img src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/buff.jpg" alt="Third slide">
          <div class="container">
            <!-- <div class="carousel-caption">
              <p>Saltwell branded Buff</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">See more</a></p>
            </div> -->
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/Nil_Desperandum_flat.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>'Nil Desperandum' training shirt &pound;10</h2>
          <p>Only XS and XL available at the moment. However, we will be
replenishing later this year so if you would like one just get in touch
with what size you would prefer and we'll get back to you once we have
them in stock..</p>
          <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div><!-- /.col-lg-4 -->
	 <div class="col-lg-4">
          <img class="img-circle" src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/buff.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Saltwell branded Buff </h2>
          <p>only &pound;5 each</p>
          <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/images/merch/hoody_front.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Hoodie &pound;23</h2>
          <p>Embroidered club badge on the left chest and SALTWELL HARRIERS
printed across the back.
For an extra &pound;3 you can have your initials
printed on the right sleeve.</p>
          <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div><!-- /.col-lg-4 -->
       
      </div><!-- /.row -->
      
      <p>Coming soon...  SPECIAL EDITION 125th anniversary running shirt!</p>
      <br>
      
      
      <div ng-app="merchandiseApp" class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Send order enquiry</h2>
                </div>
                <div ng-controller="MerchandiseController" class="panel-body">
                    <form ng-submit="submit(merchform)" name="merchform" method="post" action="" class="form-horizontal" role="form">
		    
                        
			
			<div class="form-group" ng-class="{ 'has-error': merchform.inputName.$invalid && submitted }">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputName" type="text" class="form-control" id="inputName" name="inputName" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error': merchform.inputEmail.$invalid && submitted }">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputEmail" type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Your Email" required>
                            </div>
                        </div>
			
		     <div class="form-group" ng-class="{ 'has-error': merchform.inputHomeTel.$invalid && submitted }">
                            <label for="inputMobileTel" class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputMobileTel" type="number" class="form-control" id="inputMobileTel" name="inputMobileTel" placeholder="Your Mobile Number">
                            </div>
                        </div>
		
		     <div class="form-group" ng-class="{ 'has-error': merchform.inputMessage.$invalid && submitted }">
                            <label for="inputMessage" class="col-lg-2 control-label">Message</label>
                            <div class="col-lg-10">
                                <textarea ng-model="formData.inputMessage" class="form-control" rows="4" id="inputMessage" name="inputMessage" placeholder="Type your query or message here..." required></textarea>
                            </div>
                        </div>
			
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-default" ng-disabled="submitButtonDisabled">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    <p ng-class="result" style="padding: 15px; margin: 0;">{{ resultMessage }}</p>
                </div>
            </div>
	    
	    
	    
	    


      <!-- START THE FEATURETTES -->
	<!-- 
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">
	-->
      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->

        


    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    
    
    
						
						
						
						

					</div>
					
				</article>
			</div>
	</div>
</section>



<?php get_footer(); ?>


