function volver(dir){
    location.href=dir;
}

function limpiar(dir){
    location.href=dir;
   
}

function paginar(dir,opc){

    document.form.action=dir+"?pag="+opc
    document.form.submit()
		
}

function enviar_formulario(accion){
 
    var rs = confirm("¿Confirma que desea realizar la siguiente accion: ("+accion+")?")

    if(rs==true){   
        document.getElementById("accion").value=accion

        document.form.submit()
    }
    
}

function enviar_formulario_sa(accion){
 
 
        document.getElementById("accion").value=accion

        document.form.submit()
   
    
}


function elimina(id){
    
    document.getElementById('eliminar').value=id;    
    enviar_formulario('Eliminar');
}

//agrega usuarios a la lista en la aplicacion de transporte
function agregar_lista(datos,id,tipo){
    
   var rs=confirm("¿Desea agregar a la persona "+datos+" a la lista de solicitud?")
   
   if(rs==true){
       
       var lista=document.getElementById('tra_solicitudes_asistentes').value
       
           
       lista_persona = lista.split(",")
       
       largo_lista_persona = lista_persona.length
       
       for(var i=0;i<largo_lista_persona;i++){
           
           lista_persona_datos = lista_persona[i].split("-")

           if(lista_persona_datos[0]==id){
               
               alert("Esta persona ya se encuentra en la lista de solicitud")
               return;
           }
       }


       if(lista=='')
        lista = id+'-'+tipo
       
    
       else 
        lista = lista+','+id+'-'+tipo

       document.getElementById('tra_solicitudes_asistentes').value=lista;

       
       ajax('/Telesur/web/transporte.php/ajax/agregapersonalista','listado',lista,'cpi')
             
   }
}

//eliminar usuarios de la lista en la aplicacion de transporte
function elimina_lista(datos, id){
    
    var rs=confirm("¿Desea eliminar de la lista al usuario "+datos+"?")
    
    if(rs==false) return;
    
    lista_nueva = '';
    
    var lista=document.getElementById('tra_solicitudes_asistentes').value
    
    
    lista_persona = lista.split(",")
       
    largo_lista_persona = lista_persona.length
       
    for(var i=0;i<largo_lista_persona;i++){
           
         lista_persona_datos = lista_persona[i].split("-")

         if(lista_persona_datos[0]!=id){
             
             if(lista_nueva!='')
             lista_nueva = lista_nueva +","+ lista_persona_datos[0]+"-"+lista_persona_datos[1]
         
             else
             lista_nueva = lista_persona_datos[0]+"-"+lista_persona_datos[1]
         
         }
     }
    
    ajax('/Telesur/web/transporte.php/ajax/agregapersonalista','listado',lista_nueva,'cpi')
    alert("La persona "+datos+" se ha eliminado de la lista")
    document.getElementById('tra_solicitudes_asistentes').value=lista_nueva;
}

