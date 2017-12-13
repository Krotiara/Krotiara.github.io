var startHref = '';
var currentIndex = 1;
var images = new Array();
document.getElementsByClassName('helpMe')[0].onclick = function()
	{
		openHelp();
	}
window.onload=function(){
	startHref = location.href;
	if(startHref.indexOf('#') != -1)
	{
		var index = startHref.indexOf('#');
		currentIndex = parseInt(startHref.substring(index+1,startHref.length));
		openGalleryBlock();
		openSlide(currentIndex,true);
	}
	else
	{
		history.pushState('changeSlide',null,startHref);
	}

		
}

if(readCookie('background'))
{
	var backURL = readCookie('background');
	document.body.style.background = backURL;
	document.body.style.backgroundSize = "100% 100%";
	document.getElementsByClassName('galleryBlock')[0].style.background = backURL;
	document.getElementsByClassName('galleryBlock')[0].style.backgroundSize = "100% 100%";
	
}
else
{

}

if(readCookie('StartImage'))
{
	var indexImg = readCookie('StartImage');
	var slides = document.getElementsByClassName('slide');
	var miniSlides = document.getElementsByClassName('thumb');
	var startImageSRC = slides[0].getElementsByClassName('1')[0].src;
	var startMiniSrc = miniSlides[0].getElementsByClassName('mini')[0].src;
	slides[0].getElementsByClassName('1')[0].src = slides[indexImg].getElementsByClassName('1')[0].src;
	slides[indexImg].getElementsByClassName('1')[0].src = startImageSRC;
	miniSlides[0].getElementsByClassName('mini')[0].src = miniSlides[indexImg].getElementsByClassName('mini')[0].src
	miniSlides[indexImg].getElementsByClassName('mini')[0].src = startMiniSrc;
}
else
{

}

	

function openGalleryBlock()
{
	var slides = document.getElementsByClassName('slide');
	for(i=0;i<slides.length;i++)
	{
		slides[i].style.display='none';
		slides[i].getElementsByClassName('photoNumber')[0].style.display='none';
		slides[i].getElementsByClassName('1')[0].style.display='none';
	}
	document.getElementById('gBlock').style.display='block';

}


function openHelp()
{
	var help = document.getElementById('help');
	help.style.display = 'block';
}

function closeHelp()
{
	var help = document.getElementById('help');
	help.style.display = 'none';
}

function closeGalleryBlock(flag)
{
	document.getElementById('gBlock').style.display='none';
	if (flag)
	{
		startHref = location.href;
		if(startHref.indexOf('#') != -1)
		{
			var index = startHref.indexOf('#');
			startHref = startHref.substring(0,index);
		}
	
		history.pushState('changeSlide',null,startHref);
	}
	
}

function openSlide(x,flag)
{
	currentIndex = x;
	showSlide(currentIndex,flag);
}
function changeSlide(offset)
{
	currentIndex += offset;
	showSlide(currentIndex,true);
}

function showSlide(index,flag)
{
	//var startHref = location.href;
	var slides = document.getElementsByClassName('slide');
	var i;
	if(index > slides.length) {currentIndex = 1}
	if(index < 1) {currentIndex = slides.length}
	for(i=0;i<slides.length;i++)
	{
		slides[i].style.display='none';
		slides[i].getElementsByClassName('photoNumber')[0].style.display='none';
		slides[i].getElementsByClassName('1')[0].style.display='none';

	}
	var path = '#' + (slides[currentIndex-1].id).toString();
	slides[currentIndex-1].style.display='block';
	slides[currentIndex-1].getElementsByClassName('photoNumber')[0].style.display='block';
	slides[currentIndex-1].getElementsByClassName('1')[0].style.display='block';
	if (flag)
	{
		history.pushState('changeSlide',null,path)
	}
	if (currentIndex == slides.length)
	{
		preload(slides,0);
	}
	else
	{
		preload(slides,currentIndex);
	}
}

function preload(slides,index)
{
	var image = new Image();
	image.src = slides[index].getElementsByClassName('1')[0].src;
	images.push(image);
}

document.addEventListener('keydown',function(event)
{
	const keyName = event.Key
	if(event.ctrlKey)
	{
		if(event.keyCode == '37')
		{
			changeSlide(-1);	
		}
		else if(event.keyCode == '39')
		{
			changeSlide(1);
		}
	}
	if(event.keyCode == '112' || event.keyCode == '63236-47') //Safari
	{
		event.preventDefault();
		openHelp();
	}
	if(event.keyCode =='27')
	{
		closeHelp();
	}
} ,false);

document.addEventListener('keyup',function(event)
{
	const keyName = event.key
	if(keyName==='Escape')
	{
		closeGalleryBlock(true);
	}
	
},false)

window.onhelp =function() {
    return false;
}



function SetStartImg()
{
	var slides = document.getElementsByClassName('slide');
	var miniSlides = document.getElementsByClassName('thumb');
	var i;
	for(i=0;i<slides.length;i++)
	{
		if(slides[i].getElementsByClassName('1')[0].style.display === 'block')
		{
			var startImageSRC = slides[0].getElementsByClassName('1')[0].src;
			var startMiniSrc = miniSlides[0].getElementsByClassName('mini')[0].src;
			 
			slides[0].getElementsByClassName('1')[0].src = slides[i].getElementsByClassName('1')[0].src;
			slides[i].getElementsByClassName('1')[0].src = startImageSRC;
			miniSlides[0].getElementsByClassName('mini')[0].src = miniSlides[i].getElementsByClassName('mini')[0].src
			miniSlides[i].getElementsByClassName('mini')[0].src = startMiniSrc;
			createCookie('StartImage',i,1);
			//currentIndex = 1;
			//showSlide(currentIndex);
			
			break;
		}
	}
	
}
function SetImgToBack()
{
	var slides = document.getElementsByClassName('slide');
	var i;
	var currentImage='';
	for(i=0;i<slides.length;i++)
	{
		if(slides[i].getElementsByClassName('1')[0].style.display === 'block')
		{
			var currentImage = slides[i].getElementsByClassName('1')[0].src;

		}

	}
	var url = "url(\'"+ currentImage +"\')";
	document.body.style.background = url +'no-repeat center';
	document.body.style.backgroundSize = "100% 100%";
	document.getElementsByClassName('galleryBlock')[0].style.background = url + 'no-repeat center';
	document.getElementsByClassName('galleryBlock')[0].style.backgroundSize = "100% 100%";
	createCookie('background',url,1);
}

function SetReview()
{
}

function createCookie(name,value,days)
{
	if(days)
	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = ", expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie =  name+"="+value+expires+", path=/";
}

function readCookie(name)
{
	var nameEQ = name + "=";
	var ca = document.cookie.split(',');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
	}



function eraseCookie(name) {
createCookie(name,"",-1);
}

window.onpopstate = function(event)
{
	
	var currentHref = event.currentTarget.location.href;
	if(currentHref.indexOf('#') != -1)
	{
		var index = currentHref.indexOf('#');
		currentIndex = parseInt(currentHref.substring(index+1,currentHref.length));
		openGalleryBlock();
		openSlide(currentIndex,false);
	}
	else
	{
		closeGalleryBlock(false);
	}

}
