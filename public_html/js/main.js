var counter = 0;
$(function() {
	counter++;
	if (counter < 2) {
	$(".add-lect").click(function(){
		$(".block-lect").clone().prependTo(".droppable-lect");
		$("add-button-lect").appendTo(".droppable-lect");
    });
	}
	$(".add-video").click(function(){
		$(".block-video").clone().prependTo(".droppable-video");
		$("add-button-video").appendTo(".droppable-video");
    });
    $(".add-audio").click(function(){
		$(".block-audio").clone().prependTo(".droppable-audio");
		$("add-button-audio").appendTo(".droppable-audio");
    });
	$(".add-pract").click(function(){
		$(".block-pract").clone().prependTo(".droppable-pract");
		$("add-button-pract").appendTo(".droppable-pract");
    });
});




addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
var clonedNode = document.getElementsByClassName("table-row").cloneNode(true);
 
document.querySelector("body").appendChild(clonedNode);
