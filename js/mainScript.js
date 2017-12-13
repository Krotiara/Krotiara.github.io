
document.getElementsByClassName('reviewNav')[0].onclick = function()
	{
		openReviewWindow();
	}

function openReviewWindow()
{
	var review = document.getElementById('review');
	review.style.display = 'block';
}

function closeReviewWindow()
{
	var review = document.getElementById('review');
	review.style.display = 'none';
}
