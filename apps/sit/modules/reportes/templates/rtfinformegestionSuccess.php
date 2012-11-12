<?php 
header("Content-Description: File Transfer");
header("Content-Type: text/rtf");
header("Content-Disposition: attachment; filename=informe.rtf");
?>
<style>
body{
    
    font-size: 12px;
}
.categoria{
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 10px;
    margin-top: 20px;
    background-color: #1C75B1;
    color:white;
    width: 100%;

}

.subcategoria{
    
    font-weight: bold;
    margin-left: 20px;
    margin-bottom: 10px;
    background-color: #E7EEF6;
    width: 100%;
}

.solicitud{
    padding-left: 20px;
    margin-bottom: 10px;
    
}

.solucion{
    padding-left: 55px;
    margin-bottom: 10px;
}
.titulo{
    font-weight: bold;
    font-size: 14px;
    margin-left:50px;
}

.negrita_solicitud{
    
    font-weight: bold;
}

.negrita_solucion{
    
    font-weight: bold;
    padding-left: 60px;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 

$html="<table>
        
                <tr>
                
                    <td><img src='http://10.10.0.149/Telesur/web/images/telesur_ig.jpg' width='100px'></td>
                    <td class=titulo valign=middle>DIRECCIÓN DE SISTEMAS INFORMÁTICOS<BR>INFORME DE GESTIÓN ".$desdehasta."<BR>UNIDAD DE ".strtoupper($unidad->getDescripcion())."</td>
                    
                </tr>
           </table><br>";


$html .= "<H3 style='font-size:14px;COLOR:RED;text-align:center'>COLOCAR LAS ACTIVIDADES ESPECIALES EN EL RENGLON DE ABAJO (BORRAR ESTA LINEA)</H3>";

$html .= "<div class='categoria' style='text-align: justify;'>ACTIVIDADES ESPECIALES</div><br><br>"; 


$cont=0;
//variables para graficos
$array=0;
$array_categorias='';
$array_cantidad='';
/////////////////////////
foreach ($categorias as $cat) {                            

    /////////////////////////////arrays para graficos///////////////////////////
    $gf=new Criteria();
                
    if($datos['desde']!='')
        $gf->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['desde']),Criteria::GREATER_EQUAL);
          
    if($datos['hasta']!='')
        $gf->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['hasta']),Criteria::LESS_EQUAL);

    //obtengo la cantidad de tickets de la misma categoria
    $gf->add(SitTicketsPeer::ID_CATEGORIA,$cat->getIdCategoria());
    $gf->add(SitTicketsPeer::ESTATUS,'c');
    $cantidad_cat=SitTicketsPeer::doCount($gf);
                   
    $array_cantidad[$array]=$cantidad_cat;
    $array_categorias[$array]= $cat->getDescripcion();
    $array++;
    ////////////////////////////////////////////////////////////////////////////   
                
    $html .= "<div class='categoria' style='text-align: justify;'>".ucfirst(strtolower($cat->getDescripcion()))." </div>"; 
            
    ///////////////////////////////obtengo subcategorias////////////////////////
        $a = new Criteria();
                
        if($datos['desde']!='')
            $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['desde']),Criteria::GREATER_EQUAL);
          
        if($datos['hasta']!='')
            $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['hasta']),Criteria::LESS_EQUAL);
                
        $a->add(SitTicketsPeer::ESTATUS,'c');
        $a->add(SitTicketsPeer::ID_CATEGORIA,$cat->getIdCategoria());
        $a->addJoin(SitSubcategoriasPeer::ID_SUBCATEGORIA,SitTicketsPeer::ID_SUBCATEGORIA);
        $a->addGroupByColumn("sit_subcategorias.id_subcategoria");                
        $a->addGroupByColumn("sit_subcategorias.descripcion"); 
        $a->addGroupByColumn("sit_subcategorias.id_categoria");
        $subcategorias= SitSubcategoriasPeer::doSelect($a);
    ///////////////////////////////////////////////////////////////////////////////
                
                foreach ($subcategorias as $subcat) {
                    
                    $html .= "<div class='subcategoria' style='text-align: justify;'>".ucfirst(strtolower($subcat->getDescripcion()))." </div>"; 
                    
                    $a = new Criteria();
                    
                    if($datos['desde']!='')
                        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['desde']),Criteria::GREATER_EQUAL);
          
                    if($datos['hasta']!='')
                        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['hasta']),Criteria::LESS_EQUAL);
       
                    $a->add(SitTicketsPeer::ID_CATEGORIA,$cat->getIdCategoria());
                    $a->add(SitTicketsPeer::ID_SUBCATEGORIA,$subcat->getIdSubcategoria());
                    $a->add(SitTicketsPeer::ESTATUS,'c');
                    $tickets = SitTicketsPeer::doSelect($a);
                    

                    foreach ($tickets as $tk) {
                        $cont++;
                        
                        $solicitud = str_replace("<","",$tk->getSolicitud());
                        $solicitud = str_replace(">","",$solicitud);
                        $solucion = str_replace("<","",$tk->getSolucion());
                        $solucion = str_replace(">","",$solucion);
                  
                        $html .= "<div class='solicitud' style='text-align: justify;'><span class='negrita_solicitud'>".$cont.".- <b>Solicitud:</b></span> ". $solicitud."</div><div class='solucion' style='text-align: justify;'><span class='negrita_solucion'><b>Solución:</b></span> ".$solucion." </div><br>";
                        
                    }                    
                }        
        }
  

////////////////////////////////////GRAFICO//////////////////////////////////////        
          require_once ("jpgraph/src/jpgraph.php");
          require_once ("jpgraph/src/jpgraph_pie.php");

          // Se define el array de valores y el array de la leyenda
          $datos = $array_cantidad;
          
          
          $leyenda = $array_categorias;

          //Se define el grafico
          $this->grafico = new PieGraph(450,300);

          //Definimos el titulo
          $this->grafico->title->Set("Informe de Gestion (".$unidad->getDescripcion().")");
          $this->grafico->title->SetFont(FF_FONT1,FS_BOLD);

          //Añadimos el titulo y la leyenda
          $this->p1 = new PiePlot($datos);
          $this->p1->SetLegends($leyenda);
          $this->p1->SetCenter(0.4);
          $this->grafico->Add($this->p1);
          $this->grafico->Stroke("images/graficos/informe_gestion_".  strtolower(str_replace(" ","_",$unidad->getDescripcion())).".jpg");
          
          $html .= "<br><br><div align='center'><img width='250px' src='http://10.10.0.149/Telesur/web/images/graficos/informe_gestion_".strtolower(str_replace(" ","_",$unidad->getDescripcion())).".jpg"."'></div>";
          

          $html .= "<br><br><div align='center' class='negrita_solicitud'>TICKETS ATENDIDOS: ".$cont."</div>";
        
          echo $html;
