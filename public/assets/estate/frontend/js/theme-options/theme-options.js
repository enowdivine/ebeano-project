// MAIN.JS
//--------------------------------------------------------------------------------------------------------------------------------
//This is main JS file that contains custom JS scipts and initialization used in this template*/
// -------------------------------------------------------------------------------------------------------------------------------
// 	- Template Name: Full State - Real State Template 
//	- Autor: Iwthemes
//	- Email: support@iwthemes.com
//	- Name File: theme-options.js
//	- Version 1.3 - Updated on 21 April 2014
//	- Website: http://www.iwthemes.com 
//	- Copyright: (C) 2014
// -------------------------------------------------------------------------------------------------------------------------------

  $(document).ready(function($) {

  	/* Selec your skin and layout Style */

	function interface(){

    // Skin value
    var skin = "red"; // yellow (default), red ,blue,purple,green, orange, purple, pink, cocoa, custom 

    // Boxed value
    var layout = "layout-wide"; // layout-wide (default), layout-boxed, layout-boxed-margin , layout-semiboxed

    //Only in boxed version 
    var bg = "none";  // none (default), bg1, bg2, bg3, bg4, bg5, bg6, bg7, bg8, bg9, bg10, bg11 

    // Theme Panel - disable panel options
    var themepanel = "1"; // 1 (default - enable), 0 ( disable)

    // $(".skin").attr("href", "css/skins/"+ skin + "/" + skin + ".css");
    // $(".logo_img").attr("src", "css/skins/" + "/" + skin + "/" + "logo.png");
    // $("#layout").addClass(layout);	
    // $("body").addClass(bg);   
    // $("#theme-options").css('opacity' , themepanel);
    return false;
  }

   interface();


	//=================================== Theme Options ====================================//

	$('.wide').click(function() {
		$('.boxed').removeClass('active');
		$('.boxed-margin').removeClass('active');
		$('.semiboxed').removeClass('active');
		$(this).addClass('active');
		$('.patterns').css('display' , 'none');
		$('#layout').removeClass('layout-semiboxed').removeClass('layout-boxed').removeClass('layout-boxed-margin').addClass('layout-wide');
	});
	$('.semiboxed').click(function() {
		$('.wide').removeClass('active');
		$('.boxed').removeClass('active');
		$('.boxed-margin').removeClass('active');
		$(this).addClass('active');
		$('.patterns').css('display' , 'block');
		$('#layout').removeClass('layout-wide').removeClass('layout-boxed').removeClass('layout-boxed-margin').addClass('layout-semiboxed');
	});
	$('.boxed').click(function() {
		$('.wide').removeClass('active');
		$('.boxed-margin').removeClass('active');
		$('.semiboxed').removeClass('active');
		$(this).addClass('active');
		$('.patterns').css('display' , 'block');
		$('#layout').removeClass('layout-semiboxed').removeClass('layout-boxed-margin').removeClass('layout-wide').addClass('layout-boxed');
	});
	$('.boxed-margin').click(function() {
		$('.boxed').removeClass('active');
		$('.wide').removeClass('active');
		$('.semiboxed').removeClass('active');
		$(this).addClass('active');
		$('.patterns').css('display' , 'block');
		$('#layout').removeClass('layout-semiboxed').removeClass('layout-wide').removeClass('layout-boxed').addClass('layout-boxed-margin');
	});

	//=================================== Skins Changer ====================================//

	google.setOnLoadCallback(function(){

	'use strict';

    // Color changer
    $(".red").click(function(){
    	$(".skin").attr("href", "css/skins/red/red.css");
    	$(".logo_img").attr("src", "css/skins/red/logo.png");
        return false;
   });
    
   $(".blue").click(function(){
        $(".skin").attr("href", "css/skins/blue/blue.css");
        $(".logo_img").attr("src", "css/skins/blue/logo.png");
        return false;
	});
    
	$(".yellow").click(function(){
         $(".skin").attr("href", "css/skins/yellow/yellow.css");
         $(".logo_img").attr("src", "css/skins/yellow/logo.png");
         return false;
  });

	$(".green").click(function(){
        $(".skin").attr("href", "css/skins/green/green.css");
        $(".logo_img").attr("src", "css/skins/green/logo.png");
        return false;
  });

  $(".orange").click(function(){
        $(".skin").attr("href", "css/skins/orange/orange.css");
        $(".logo_img").attr("src", "css/skins/orange/logo.png");
        return false;
  });

  $(".purple").click(function(){
       $(".skin").attr("href", "css/skins/purple/purple.css");
       $(".logo_img").attr("src", "css/skins/purple/logo.png");
       return false;
  });

 $(".pink").click(function(){
       $(".skin").attr("href", "css/skins/pink/pink.css");
       $(".logo_img").attr("src", "css/skins/pink/logo.png");
        return false;
 });

	$(".cocoa").click(function(){
        $(".skin").attr("href", "css/skins/cocoa/cocoa.css");
        $(".logo_img").attr("src", "css/skins/cocoa/logo.png");
        return false;
   });
 });

	//=================================== Background Options ====================================//
	
	$('#theme-options ul.backgrounds li').click(function(){
	var 	$bgSrc = $(this).css('background-image');
		if ($(this).attr('class') == 'bgnone')
			$bgSrc = "none";

		$('body').css('background-image',$bgSrc);
		$.cookie('background', $bgSrc);
		$.cookie('backgroundclass', $(this).attr('class').replace(' active',''));
		$(this).addClass('active').siblings().removeClass('active');
	});

	//=================================== Panel Options ====================================//

	$('.openclose').click(function(){
		if ($('#theme-options').css('left') == "-220px")
		{
			$left = "0px";
			$.cookie('displayoptions', "0");
		} else {
			$left = "-220px";
			$.cookie('displayoptions', "1");
		}
		$('#theme-options').animate({
			left: $left
		},{
			duration: 500			
		});

	});

	// $(function(){
		// $('#theme-options').fadeIn();
		// $bgSrc = $.cookie('background');
		// $('body').css('background-image',$bgSrc);

		// if ($.cookie('displayoptions') == "1")
		// {
			// $('#theme-options').css('left','-220px');
		// } else if ($.cookie('displayoptions') == "0") {
			// $('#theme-options').css('left','0');
		// } else {
			// $('#theme-options').delay(800).animate({
				// left: "-220px"
			// },{
				// duration: 500				
			// });
			// $.cookie('displayoptions', "1");
		// }
		// $('#theme-options ul.backgrounds').find('li.' + $.cookie('backgroundclass')).addClass('active');

	// });

});