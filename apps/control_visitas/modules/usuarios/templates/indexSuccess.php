<?php
/*
function marditasea($var){
    $variable=$var;
    $variable=str_replace("Ã³", "ó", $variable);
    $variable=str_replace("Ã©", "é", $variable);
    
     
     return $variable;
}
    
    $a=new ConexionDirecta();
    $a->mysql_60();    
    
    
    $query="select * from visitas, usuarios where visitas.cedula_visitante=usuarios.cedula order by visitas.id_visita ASC";
    $rs=mysql_query($query);

    $htmlx="
        <div>REPORTE DE VISITANTES</div><BR>
        <table class='tabla_list'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Fecha E.</th>
            <th>Hora E.</th>
            <th>Fecha S.</th>
            <th>Hora S.</th>
            <th>Contacto</th>
            <th>Observ.</th>
            <th>Foto</th>
        </tr>        
    ";
   
    while ($row=mysql_fetch_array($rs)){
        
        
        $htmlx .="
        <tr>
            <td>".marditasea($row['nombres'])."</td>
            <td>".marditasea($row['apellidos'])."</td>
            <td>".$row['cedula']."</td>
            <td>".$row['fecha_entrada']."</td>
            <td>".$row['hora_entrada']."</td>
            <td>".$row['fecha_salida']."</td>
            <td>".$row['hora_salida']."</td>
            <td>".marditasea($row['contacto'])."</td>
            <td>".marditasea($row['observaciones'])."</td>
            <td><img width='80px' src='http://192.168.3.60/ControlDeVisitantes/fotografias/".$row['cedula'].".jpg'></td>
        </tr>     
        ";

    }
    
    $htmlx .="</table>";
    

  //==============================================================
  //==============================================================
  //==============================================================

        include("../../Telesur/web/MPDF/mpdf.php");

        $mpdf=new mPDF('c'); 

        $mpdf->SetDisplayMode('fullpage');

        // LOAD a stylesheet
        $stylesheet = file_get_contents('css/crud.css');
        $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

        $mpdf->WriteHTML($htmlx);

        $mpdf->Output("reporte.pdf","D");
        
   //==============================================================
   //==============================================================
   //==============================================================
*/
?>