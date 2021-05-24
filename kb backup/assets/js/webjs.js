(function($) {
  "use strict";
$(document).ready(function() {
	var slider_testi 	= $('#testio');
	var slider_job 		= $('#jobs-slider');
	var slider_recom 	= $('#recommended-job');
	var counter			= $('.count .num');	
	var mselect 		= $('#select2');
	var tagpicker		= $("#tagPicker");
	var jobtype			= $("#job-type");
	var location		= $("#location");
	var skills			= $("#skills");
	var choices			= $('.select2-choices');
	var choice			= $('.select2-choice');
	var inputfiles		= $('.inputfile');
	var header			= $("#header");
	var rem_img			= $('#removeimg')
	var imgupld			= $('.image_uplaod ');
	var fname			= $('.filename');
	
	
  slider_testi.owlCarousel({ 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
      
 
  });
   slider_job.owlCarousel({ 
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      pagination : false,
      singleItem:true,
	  navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
   });
  slider_recom.owlCarousel({ 
      items : 6, //10 items above 1000px browser width
      itemsDesktop : [1600,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [1200,3], // betweem 900px and 601px
      itemsTablet: [786,1], //2 items between 600 and 0
      itemsMobile : false ,// itemsMobile disabled - inherit from itemsTablet option
	  autoPlay : 3000 ,
	  pagination : false
  });
  
  /*///////////Counters///////////////////*/
 	counter.counterUp({
		delay: 20,
		time: 2000
	});
	/*////Multiple Select//////*/
	mselect.select2();
	tagpicker.select2({	
		closeOnSelect:false		
	});
	jobtype.select2({	
		closeOnSelect:false		
	});
	location.select2({
		closeOnSelect:false		
	});
	skills.select2({	
		closeOnSelect:false		
	});
	choices.append('<i class="fa fa-angle-down" aria-hidden="true"></i>');
   	choice.append('<i class="fa fa-angle-down" aria-hidden="true"></i>');
	
	/*///Textarea//*/
	

/*/////////////Windows Scrolling /////////////*/
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop();
		 //console.log(scroll);
		if (scroll >= 50) {
			//console.log('a');
			header.addClass("fixed-header");
			
		} else {
			//console.log('a');
			header.removeClass("fixed-header");
		}
	});


/*//////////////Image Uplaod/////////////*/
	inputfiles.on('change', function() {
		  var path = $(this).val();
		  //$('.upload span').html(filename);
		  console.log(path);
	});
	rem_img.on('click', function() {
		event.preventDefault();
		imgupld.css('display','none');
		fname.html('<i class="fa fa-file-image-o" aria-hidden="true"></i>Browse image ');	
		
	});

});


;( function ( document, window, index ) {
	var inputs = document.querySelectorAll( '.inputfile' );
	
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			 var reader = new FileReader();
		  
			if( this.files && this.files.length > 1 ) {
				//fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
				
			}else {
				fileName = e.target.value.split( '\\' ).pop();
				
			}if( fileName ) {
				label.querySelector( '.filename' ).innerHTML = fileName;
				$('.image_uplaod ').css('display','block');
				
				
				
			}else {
				label.innerHTML = labelVal;
			}
		});

		// Firefox bug fix
		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});
}( document, window, 0 ));

/*//////////////////*/
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
          };

            reader.readAsDataURL(input.files[0]);
        }
}

})(jQuery);

/*///////Companies list////////*/



var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e43e8c3a89cda5a188587c6/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();



$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back2Top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});


