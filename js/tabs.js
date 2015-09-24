window.onload=function() {

  // get tab container
  	var container = document.getElementById("tabContainer");
		var tabcon = document.getElementById("tabscontent");
		//alert(tabcon.childNodes.item(1));
    
    var navitem = document.getElementById("tabHeader_1");
		
    
    var ident = navitem.id.split("_")[1];
//alert(ident);
    navitem.parentNode.setAttribute("data-current",ident);
    
    navitem.setAttribute("class","tabActiveHeader");

   
   	var pages = tabcon.getElementsByTagName("span");
	for (var i = 0; i < pages.length; i++) {
		if(pages.item(i).id==="tabpage_"+ident){
			pages.item(i).style.display="block";
		}
	};

    
    var tabs = container.getElementsByTagName("li");
    for (var i = 0; i < tabs.length; i++) {
      tabs[i].onclick=displayPage;
    }
}

// on click of one of tabs
function displayPage() {
  var current = this.parentNode.getAttribute("data-current");
    
    
  document.getElementById("tabHeader_" + current).removeAttribute("class");
    document.getElementById("tabpage_" + current).style.display="none";
    
 

  var ident = this.id.split("_")[1];

  this.setAttribute("class","tabActiveHeader");
 document.getElementById("tabpage_" + ident).style.display="inline";
    
  this.parentNode.setAttribute("data-current",ident);
}