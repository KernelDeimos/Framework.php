function ajaxLoadDummyReturn() {

}
function ajaxLoad(page,location,func)
{
  func = typeof func !== 'undefined' ? func : (window.ajaxReturnFunc !== 'undefined' ? window.ajaxReturnFunc : ajaxLoadDummyReturn);
	//document.getElementById(location).innerHTML="<div class=\"center\"><h1>Loading...</h1></div>";
	var xmlhttp;
	if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
  	}

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById(location).innerHTML=xmlhttp.responseText;
      func();
    }
  }
xmlhttp.open('GET',page,true);
xmlhttp.send();
}