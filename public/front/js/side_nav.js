    
function openOffcanvas() {
    
	
  
	      document.getElementById("myOffcanvas").style.marginRight= "250px";
		   document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";
}
function openNav3() {
    document.getElementById("myCanvasNav").style.width = "100%";
    document.getElementById("myCanvasNav").style.opacity = "0.9";  
 
}

 
function closeOffcanvas() {
 
 
		  document.getElementById("myOffcanvas").style.marginRight= "0%";
	          document.getElementById("myOffcanvas").style.right="-245px";
		   document.getElementById("myOffcanvas").style.transition="all 0.4s ease-in-out 0s";
	
    document.body.style.backgroundColor = "white";
    document.getElementById("myCanvasNav").style.width = "0%";
    document.getElementById("myCanvasNav").style.opacity = "0"; 
 
}
 
 
 