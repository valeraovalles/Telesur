<?php
$html="<table>
        home/jhoan/www/
                <tr>
                
                    <td>".$img_telesur = image_tag("telesur.jpeg",array('size' => '150x130'))."</td>
                    <td class=titulo valign=middle>DIRECCIÓN DE SISTEMAS INFORMÁTICOS<BR>INFORME DE GESTIÓN ".$desdehasta."<BR>UNIDAD DE ".strtoupper($unidad->getDescripcion())."</td>
                    
                </tr>
           </table><br>";
    


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
    
    if($datos['id_usuario']!='')
        $gf->addAnd(SitTicketsUsuariosPeer::ID_USUARIO,$datos['id_usuario']);
       

    //obtengo la cantidad de tickets de la misma categoria
    $gf->addjoin(SitTicketsUsuariosPeer::ID_TICKET,  SitTicketsPeer::ID_TICKET);
    $gf->add(SitTicketsPeer::ID_CATEGORIA,$cat->getIdCategoria());
    $gf->add(SitTicketsPeer::ESTATUS,'c');
    $cantidad_cat=SitTicketsPeer::doCount($gf);
                   
    $array_cantidad[$array]=$cantidad_cat;
    $array_categorias[$array]= $cat->getDescripcion();
    $array++;
    ////////////////////////////////////////////////////////////////////////////   
                
    $html .= "<div class='categoria'>".ucfirst(strtolower($cat->getDescripcion()))."</div>"; 
            
    ///////////////////////////////obtengo subcategorias////////////////////////
        $a = new Criteria();
                
        if($datos['desde']!='')
            $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['desde']),Criteria::GREATER_EQUAL);
          
        if($datos['hasta']!='')
            $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['hasta']),Criteria::LESS_EQUAL);
        
        if($datos['id_usuario']!='')
        $a->addAnd(SitTicketsUsuariosPeer::ID_USUARIO,$datos['id_usuario']);

                
        $a->addjoin(SitTicketsUsuariosPeer::ID_TICKET,  SitTicketsPeer::ID_TICKET);
        $a->add(SitTicketsPeer::ESTATUS,'c');
        $a->add(SitTicketsPeer::ID_CATEGORIA,$cat->getIdCategoria());
        $a->addJoin(SitSubcategoriasPeer::ID_SUBCATEGORIA,SitTicketsPeer::ID_SUBCATEGORIA);
        $a->addGroupByColumn("sit_subcategorias.id_subcategoria");                
        $a->addGroupByColumn("sit_subcategorias.descripcion"); 
        $a->addGroupByColumn("sit_subcategorias.id_categoria");
        $subcategorias= SitSubcategoriasPeer::doSelect($a);
    ///////////////////////////////////////////////////////////////////////////////
                
                foreach ($subcategorias as $subcat) {
                    
                    $html .= "<div class='subcategoria'>".ucfirst(strtolower($subcat->getDescripcion()))."</div>"; 
                    
                    $a = new Criteria();
                    
                    if($datos['desde']!='')
                        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['desde']),Criteria::GREATER_EQUAL);
          
                    if($datos['hasta']!='')
                        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$funciones->voltea_fecha($datos['hasta']),Criteria::LESS_EQUAL);
                    
                    if($datos['id_usuario']!='')
                        $a->addAnd(SitTicketsUsuariosPeer::ID_USUARIO,$datos['id_usuario']);

       
                    $a->addjoin(SitTicketsUsuariosPeer::ID_TICKET,  SitTicketsPeer::ID_TICKET);
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
                  
                        $html .= "<div class='solicitud'><span class='negrita_solicitud'>".$cont.".- Solicitud:</span> ". ucfirst(strtolower($solicitud))."</div><div class='solucion'><span class='negrita_solucion'>Solución:</span> ".ucfirst(strtolower($solucion))." </div><br>";
                        
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
          $this->grafico = new PieGraph(800,500);

          //Definimos el titulo
          $this->grafico->title->Set("Informe de Gestion (".$unidad->getDescripcion().")");
          $this->grafico->title->SetFont(FF_FONT1,FS_BOLD);

          //Añadimos el titulo y la leyenda
          $this->p1 = new PiePlot($datos);
          $this->p1->SetLegends($leyenda);
          $this->p1->SetCenter(0.4);
          $this->grafico->Add($this->p1);
          $this->grafico->Stroke("images/graficos/informe_gestion_".  strtolower(str_replace(" ","_",$unidad->getDescripcion())).".jpg");
          
          $html .= "<br><br><div align='center'><img src='".image_path("graficos/informe_gestion_".strtolower(str_replace(" ","_",$unidad->getDescripcion())).".jpg")."'></div>";
          

          $html .= "<br><br><div align='center' class='negrita_solicitud'>TICKETS ATENDIDOS: ".$cont."</div>";
        
          //echo $html;
          //echo $array_cat;
        
        //==============================================================
        //==============================================================
        //==============================================================

        include("../../Telesur/web/MPDF/mpdf.php");

        $mpdf=new mPDF('','', 0, '', 0, 0, 0, 0, 0, 0, 'L');

        $mpdf->SetDisplayMode('fullpage');

        // LOAD a stylesheet
        $stylesheet = file_get_contents('css/pdf_informe_gestion.css');
        $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

        $mpdf->WriteHTML($html);

        $mpdf->Output("informe_gestion_".strtolower(str_replace(" ","_",$unidad->getDescripcion())).".pdf","D");


        //==============================================================
        //==============================================================
        //==============================================================


?>



