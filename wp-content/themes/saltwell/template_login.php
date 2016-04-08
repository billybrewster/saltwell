<?php 
  /*
  Template Name: Login
  */
  get_header();
?>

<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script>
var p1 = "success";

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      console.log ( 'logged in' );
      
      
     // Get additional perms
     /*
      FB.login(function (response) {
  //res contains authResponse, i.e. the user is logged in.
  }, { scope : 'public_profile,email,user_groups,user_events'} });
*/
      console.log(response.authResponse.accessToken);
      testAPI(response.authResponse.accessToken);
      
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      console.log ( 'not authorized' );
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      console.log ( 'not logged in' );
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      document.write('gggg');
      console.log('ggggg');
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '887419204666910',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.4' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
    console.log('RESPONSE');
    console.log(response);
    
    console.log("ACCESS TOKEN");
   // p1 = response.authResponse.accessToken;
    console.log(response.authResponse.accessToken);
     console.log(response.authResponse.expiresIn);
      console.log(response.authResponse.signedRequest);
       console.log(response.authResponse.userID);
       console.log("APP ID ");
       console.log(FB.appId);
  }
    statusChangeCallback(response);
  });




  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI(accessToken) {
    console.log('Welcome!  Fetching your information.... ');
    console.log(accessToken);
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!' + response.id ;
      createLoginForm(accessToken, response.id);
    });
   
  }
  
function createLoginForm(accessToken, userId) {
    console.log('Welcome!  Fetching your information..XXX.. ');
    console.log(accessToken);
    document.getElementById('loginForm').innerHTML ='<form name="myWebForm" action="http://www.saltwellharriers.org.uk/setsession/" method="post"><input type="hidden" name="accessToken" value='+accessToken+'/><input type="hidden" name="userId" value='+userId+'/><input type="submit" value=" " /></form>';
     document.myWebForm.submit();



    
  }

</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,user_groups,user_events" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>



<div id="loginForm">
</div>

</body>
</html>



<?php get_footer(); ?>


