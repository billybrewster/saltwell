<?php 
	/*
	Template Name: Membership
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


					
						
						
						
						
						

	   
            <div  ng-app="contactApp" class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Membership Form</h2>
                </div>
                <div ng-controller="ContactController" class="panel-body">
                    <form ng-submit="submit(contactform)" name="contactform" method="post" action="" class="form-horizontal" role="form">
		    
                        <div class="form-group" ng-class="{ 'has-error': contactform.inputTitle.$invalid && submitted }">
                            <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputTitle" value="Mr"  type="radio" id="inputTitle" name="inputTitle"  required>Mr</input>
			   <input ng-model="formData.inputTitle" value="Mrs" type="radio"  id="inputTitle" name="inputTitle"  required>Mrs</input>
			   <input ng-model="formData.inputTitle" value="Ms" type="radio"  id="inputTitle" name="inputTitle"  required>Ms</input>
			   <input ng-model="formData.inputTitle" value="Miss" type="radio"  id="inputTitle" name="inputTitle"  required>Miss</input>
			     
			     
			     
                            </div>
                        </div>
			
			<div class="form-group" ng-class="{ 'has-error': contactform.inputName.$invalid && submitted }">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputName" type="text" class="form-control" id="inputName" name="inputName" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="form-group" ng-class="{ 'has-error': contactform.inputEmail.$invalid && submitted }">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputEmail" type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Your Email" required>
                            </div>
                        </div>
			
		    <div class="form-group" ng-class="{ 'has-error': contactform.inputHomeTel.$invalid && submitted }">
                            <label for="inputHomeTel" class="col-lg-2 control-label">Telephone</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputHomeTel" type="number" class="form-control" id="inputHomeTel" name="inputHomeTel" placeholder="Your Home Telephone Number">
                            </div>
                        </div>
			
		     <div class="form-group" ng-class="{ 'has-error': contactform.inputHomeTel.$invalid && submitted }">
                            <label for="inputMobileTel" class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputMobileTel" type="number" class="form-control" id="inputMobileTel" name="inputMobileTel" placeholder="Your Mobile Number">
                            </div>
                        </div>
                        
                        <div class="form-group" ng-class="{ 'has-error': contactform.inputMessage.$invalid && submitted }">
                            <label for="inputAddress" class="col-lg-2 control-label">Address</label>
                            <div class="col-lg-10">
                                <textarea ng-model="formData.inputAddress" class="form-control" rows="4" id="inputAddress" name="inputAddress" placeholder="Your address..." required></textarea>
                            </div>
                        </div>
			
		    <div class="form-group" ng-class="{ 'has-error': contactform.inputPostCode.$invalid && submitted }">
                            <label for="inputPostCode" class="col-lg-2 control-label">Postcode</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputPostCode" type="text" class="form-control" id="inputPostCode" name="inputPostCode" placeholder="Your Postcode" required>
                            </div>
                        </div>
			
		     <div class="form-group" ng-class="{ 'has-error': contactform.inputPostCode.$invalid && submitted }">
                            <label for="inputDOB" class="col-lg-2 control-label">DOB</label>
                            <div class="col-lg-10">
                                <input ng-model="formData.inputDOB" type="date" class="form-control" id="inputDOB" name="inputDOB" placeholder="Your Date of Birth" required>
                            </div>
                        </div>
		
		
		     <div class="form-group" ng-class="{ 'has-error': contactform.inputMessage.$invalid && submitted }">
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


