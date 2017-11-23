function openGalleryBlock()
{
	document.getElementById('gBlock').style.display='block';
}

function closeGalleryBlock()
{
	document.getElementById('gBlock').style.display='none';
}
var currentIndex = 1;
showSlide(currentIndex);

function openSlide(x)
{
	currentIndex = x;
	showSlide(currentIndex);
}
function changeSlide(offset)
{
	currentIndex += offset;
	showSlide(currentIndex);
}

function showSlide(index)
{
	var slides = document.getElementsByClassName('slide');
	var i;
	if(index > slides.length) {currentIndex = 1}
	if(index < 1) {currentIndex = slides.length}
	for(i=0;i<slides.length;i++)
	{
		slides[i].style.display='none';
	}
	slides[currentIndex-1].style.display='block';
}

document.addEventListener('keydown',(event) =>
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
} ,false);

document.addEventListener('keyup',(event)=>
{
	const keyName = event.key
	if(keyName==='Escape')
	{
		closeGalleryBlock();
	}
	if(event.keyCode =='37')
	{
		moveLeft();
	}
	if(event.keyCode =='39')
	{
		moveRight();
	}
},false)

for (var i =0; i<document.images.length;i++)
{
	downloadingImage = new Image();
	downloadingImage.onload = function()
	{
		document.getElementById('load').src = this.src;
	}
	downloadingImage.src = document.images[i].src;
}




function moveLeft()
{
	
}
function moveRight()
{

}


