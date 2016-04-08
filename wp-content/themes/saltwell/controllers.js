angular.module('contactApp', [])
.controller('ContactController', function ($scope, $http) {
    $scope.result = 'hidden'
    $scope.resultMessage;
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;
        if (contactform.$valid) {
            $http({
                method  : 'POST',
                url     : 'http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/membership-form.php',
                data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    $scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
                } else {
                    $scope.submitButtonDisabled = false;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-danger';
                }
            });
        } else {
            $scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Failed :( Please fill out all the fields.';
            $scope.result='bg-danger';
        }
    }
});


    
    
angular.module('merchandiseApp', [])
.controller('MerchandiseController', function ($scope, $http) {
    $scope.result = 'hidden'
    $scope.resultMessage;
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;
        if (contactform.$valid) {
            $http({
                method  : 'POST',
                url     : 'http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/merchandise-form.php',
                data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    $scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
                } else {
                    $scope.submitButtonDisabled = false;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-danger';
                }
            });
        } else {
            $scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Failed :( Please fill out all the fields.';
            $scope.result='bg-danger';
        }
    }
});


angular.module('raceApp', [])
.controller('RaceController', function ($scope, $http) {
    $scope.result = 'hidden'
    $scope.resultMessage;


    
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(raceform) {
        $scope.submitted = true;
	    
	$scope.spice = 'very';

    $scope.chiliSpicy = function() {
        $scope.spice = 'chili';
    };

    $scope.jalapenoSpicy = function() {
        $scope.spice = 'jalapeño';
    };
    
    
	
        //$scope.submitButtonDisabled = true;
	
	    if (raceform.$valid) {
            $http({
                method  : 'POST',
		url     : 'http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/race-form.php',
                //data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    //$scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
                } else {
                    //$scope.submitButtonDisabled = false;
                    //$scope.resultMessage = data.message;
		    $scope.resultMessage = "Updated";
                    $scope.result='bg-danger';
                }
            });
        } else {
            //$scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Failed :( Please fill out all the fields.';
            $scope.result='bg-danger';
        }
	
    }
});






angular.module('myApp', [])
.controller('SpicyController',  function($scope, $http) {
    $scope.spice = 'very';

   
    
    
	
	    
	    
	    
   
    
    $scope.joinEvent = function($eventid, $userid) {
        $scope.spice = $eventid;
	
            $http({
                method  : 'POST',
		url     : 'http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/race-form.php',
		data    : $.param({eventid: $eventid, userid: $userid}),  
                //data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    //$scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
		     
                } else {
                    //$scope.submitButtonDisabled = false;
                    //$scope.resultMessage = data.message;
		    $scope.resultMessage = "Updated";
                    $scope.result='bg-danger';
		     window.location.reload();
                }
            });

	
	
    };
    
    
    $scope.leaveEvent = function($eventid, $userid) {
        $scope.spice = $eventid;
	
            $http({
                method  : 'POST',
		url     : 'http://www.saltwellharriers.org.uk/wp-content/themes/saltwell/delete-from-event.php',
		data    : $.param({eventid: $eventid, userid: $userid}),  
                //data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    //$scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
		
                } else {
                    //$scope.submitButtonDisabled = false;
                    //$scope.resultMessage = data.message;
		    $scope.resultMessage = "Updated";
                    $scope.result='bg-danger';
		    window.location.reload();
                }
            });

	
	
    };

    
  //$scope.myvalue = true;
  $scope.eventidarray = [];
  $scope.eventidarraynoattend = [];

  $scope.showAlert = function($eventid,$event_record_count){
    console.log("In show event" + $eventid);
	  
   if ($scope.eventidarray[$event_record_count]==true) {
	    console.log("is true");
	    $scope.eventidarray[$event_record_count] = false; 
    } else {
	    console.log("is false");
	    $scope.eventidarray[$event_record_count] = true;  
    }
    
  };
  
   $scope.showEventNonAttending = function($eventid,$event_record_count){
    console.log("In show event non attending" + $eventid);
	  
   if ($scope.eventidarraynoattend[$event_record_count]==true) {
	    //console.log($scope.eventidarraynoattend[$event_record_count]  . "is true");
	    $scope.eventidarraynoattend[$event_record_count] = false; 
    } else {
	    //console.log($scope.eventidarraynoattend[$event_record_count]  . "is false");
	    $scope.eventidarraynoattend[$event_record_count] = true;  
    }
    
  };
  
  
  
  
  
  
    $scope.showEvent = function($eventid) {
	$scope.showEvent =false;
       console.log("In show event $event_id");
	
	    
	    
	/*
            $http({
                method  : 'POST',
		url     : 'http://localhost:8080/saltwell_wordpress/wp-content/themes/saltwell/delete-from-event.php',
		data    : $.param({eventid: $eventid, userid: $userid}),  
                //data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    //$scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
		
                } else {
                    //$scope.submitButtonDisabled = false;
                    //$scope.resultMessage = data.message;
		    $scope.resultMessage = "Updated";
                    $scope.result='bg-danger';
		    window.location.reload();
                }
            });

	*/
	
    };
    
    
    
    
    
    

    $scope.jalapenoSpicy = function() {
	//echo "refresh";
        $scope.spice = 'jalapeño';
	    // $state.go($state.current, {}, {reload: true});
		    window.location.reload();
    };
	    
	    
});


