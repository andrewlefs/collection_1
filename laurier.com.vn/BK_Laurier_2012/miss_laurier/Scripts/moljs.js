// JavaScript Document

function hoverchangebg(hoverid,position)
{
	$(hoverid).css( {backgroundPosition: "0 0"} )
	.mouseover(function(){
		$(this).css( {backgroundPosition: position} )
		})
	.mouseout(function(){
		$(this).css( {backgroundPosition: "0 0"} )
		});
}