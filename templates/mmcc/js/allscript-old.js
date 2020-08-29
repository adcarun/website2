// JavaScript Document
		jQuery(".bar").click(function() {
		  	jQuery(".bar").css("width","0%");
     	  	setTimeout(function(){ jQuery(".bar").css('width','100%'); },500)	
		});
		
		jQuery(".bar").mousedown(function(e){ 
			jQuery(".bar").css("width","0%");
     	  	setTimeout(function(){ jQuery(".bar").css('width','100%'); },500)
		});
		
		jQuery(".info-box .info-box-text").mCustomScrollbar({
			setHeight: 100
		});
		
		jQuery(".testimonialText").mCustomScrollbar({
			setHeight: 142
		});
		
		
var windowWidth = jQuery(window).width();
if(windowWidth > 991){
    jQuery('#admissionPanelCollapse').addClass('in');
}

/*$('.admissionLinkPanel').affix({
  offset: {
    top: 100,
    bottom: function () {
      return (this.bottom = $('.contactDetailsBox').outerHeight(true))
    }
  }
})*/

/*function stickySidebarAdmission(){
    var leftPanelHeight = $(".admissionLinkPanel").outerHeight();
    console.log(leftPanelHeight);
    $('.admissionLinkPanel').affix({
        offset: {
            top: $('.admissionLinkPanel').offset().top,
            bottom: function () {
              return (this.bottom = $('.contactDetailsBox').outerHeight(true) + $('footer').outerHeight(true))
            }
        }
    }).on('affix.bs.affix', function () { // before affix
        $(this).css({
            'width': $(this).outerWidth()  // variable widths
        });
    });
}*/
	
/*$('#nav').affix({
    offset: {     
      top: $('#nav').offset().top,
      bottom: ($('.footerContainer').outerHeight(true)) + 60
	  //bottom: ($('.footerContainer').outerHeight(true) + $('.application').outerHeight(true)) + 360
    }
});*/