const burgerMenu=document.getElementById("burger");
const navbarMenu=document.getElementById("menu");
burgerMenu.addEventListener("click",function(){
	navbarMenu.classList.toggle("active");
	burgerMenu.classList.toggle("active");
});

$(document).ready(function(){
	$("#seachbar-close").click(function(){
		$(".globle-searchbar").slideToggle();
	});

	$("#seachbar-show").click(function(){
		$(".globle-searchbar").slideToggle();
	});

	$(window).scroll(function(){
		if($(this).scrollTop()>100){
			$('#scroll').fadeIn();
		}else{
			$('#scroll').fadeOut();
		}
	});

	$('#scroll').click(function(){
		$("html, body").animate({scrollTop:0},600);return false;
	});
});

jQuery(document).ready(function(){
	jQuery("#reply-btn").click(function(){
		jQuery(".reply-comment-hide").toggle();
	});
});

$("#menu-toggle").click(function(e){
	e.preventDefault();$("#snippet_main").toggleClass("toggled");
});

function reloadMe(){
	window.location.reload();
}

function getInterval(){
	var lowerBound=310;
	var upperBound=1010;
	var randNum=Math.floor((upperBound-lowerBound+1)*Math.random()+lowerBound)*1000;return randNum;
}
var interval=getInterval();
var srcInterval=setInterval("reloadMe()",interval);

// function detectAdBlock(){
// 	let adBlockEnabled=false
// 	const googleAdUrl='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
// 	$.getScript(googleAdUrl).done(function(script,textStatus){}).fail(function(jqxhr,settings,exception){});
// }
// function blockerModal(){
// 	$('.main-wrap').css('-webkit-filter','blur(4px)');$('.main-wrap').css('-moz-filter','blur(4px)');$('.main-wrap').css('-ms-filter','blur(4px)');$('.main-wrap').css('filter','blur(4px)');
// 	var myModal=new bootstrap.Modal(document.getElementById('disable-modal'),{keyboard:false})
// 	myModal.show()
// }
// detectAdBlock();

function returnBrowser(){
	var sBrowser,sUsrAg=navigator.userAgent;
	if(sUsrAg.indexOf("Firefox")>-1){
		sBrowser="Firefox";
	}else if(sUsrAg.indexOf("SamsungBrowser")>-1){
		sBrowser="Samsung Browser";
	}else if(sUsrAg.indexOf("Opera")>-1||sUsrAg.indexOf("OPR")>-1){
		sBrowser="Opera";
	}else if(sUsrAg.indexOf("Trident")>-1){
		sBrowser="Internet Explorer";
	}else if(sUsrAg.indexOf("Edge")>-1){
		sBrowser="Microsoft Edge";
	}else if(sUsrAg.indexOf("Chrome")>-1){
		sBrowser="Chrome";
	}else if(sUsrAg.indexOf("Safari")>-1){
		sBrowser="Safari";
	}else{
		sBrowser="Unknown";
	}
	return sBrowser;
}
var tZone=Intl.DateTimeFormat().resolvedOptions().timeZone;