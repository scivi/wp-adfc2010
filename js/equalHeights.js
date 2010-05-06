$(document).ready(function(){
	$(".rubricTeaser").each(function(index) {
		var leftCol = $(this).find(".leftCol").height();
		var rightCol = $(this).find(".rightCol").height();
		if (rightCol > leftCol)	{
			$(this).find(".leftCol").height(rightCol);
		}
	});
});