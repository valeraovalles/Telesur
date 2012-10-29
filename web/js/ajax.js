function ajax(url,div,datos,opc){
	
	var xmlHttp;
	try{
	xmlHttp=new XMLHttpRequest(); 
	}
	catch (e){
	try{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch (e){
	try{
	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch (e){
	alert("Tu explorador no soporta AJAX.");
	return false;
	}
	}
	}	
	var nocacheurl = url+"?datos="+datos+"&opc="+opc;
	
	xmlHttp.onreadystatechange=function(){
		
		//document.getElementById(div).innerHTML="<img src='/images/cargando.gif'>"
			
		
		if(xmlHttp.readyState==4){
                     /*
			var cadena=xmlHttp.responseText.split("::");
                        alert(cadena[1])
			if(cadena[1]=='envia')
				document.form.submit()
	
			else */
				document.getElementById(div).innerHTML=xmlHttp.responseText;	

			
		}	
		
	}
	xmlHttp.open("GET",nocacheurl,true);
	xmlHttp.send(null);

	

}


