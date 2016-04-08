//alert('111111111111111111');





function showFacebookSelect(counter) {
	//alert(counter);
	if (jQuery('#ShowFacebook'+counter).attr('checked') == 'checked') {
		jQuery('#fbComments'+counter).slideDown('slow');
		//alert('checked');
		//jQuery("#GiftAidCheck").addClass('required'); 
	 }
	 else {
		 jQuery('#fbComments'+counter).hide();
		//alert('not checked 121.55');
 		//jQuery("#GiftAidCHeck").removeClass('required'); 
		//  jQuery("#OrderDescription").val("Donation");

	 }
}

function showPerformanceSelect(counter) {
	//alert(counter);
	if (jQuery('#ShowPerformance'+counter).attr('checked') == 'checked') {
		jQuery('#RaceDetails'+counter).slideDown('slow');
		//alert('checked');
		//jQuery("#GiftAidCheck").addClass('required'); 
	 }
	 else {
		 jQuery('#RaceDetails'+counter).hide();
		//alert('not checked 121.55');
 		//jQuery("#GiftAidCHeck").removeClass('required'); 
		//  jQuery("#OrderDescription").val("Donation");

	 }
}

