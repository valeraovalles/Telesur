<?php

/**
 * archivos actions.
 *
 * @package    Telesur
 * @subpackage archivos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class archivosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }
  
  public function executeTxt(sfWebRequest $request)
  {


      $this->fecha_escaleta='';
      $f=new funciones;
      if ($request->isMethod('post'))
      {                 

        if($request->getParameter('enviomanual')==''){
          return;
        }

          $this->fecha_escaleta = $request->getParameter('fecha');    
          
          $link = mssql_connect('192.168.70.7', 'sa', '') or die("Could not connect !");
          $selected = mssql_select_db("creatv_data", $link);

        
          $query="
            select 
                    * 
            from 
                    [creatv_data].[dbo].[Escaleta] e, [creatv_data].[dbo].[Evento] ev, [creatv_data].[dbo].[Contenido] c, [creatv_data].[dbo].[Produccion] p
            where 
                    ev.IdEscaleta=e.IdEscaleta and 
                    p.IdProduccio = ev.IdProduccio and 
                    c.IdPrograma = p.IdPrograma and
                    EV.Observacio = 'N' and
                    EV.Separador = 'N' and
                    e.Data_Emissio='".$f->voltea_fecha($this->fecha_escaleta)."' and 
                    IdCanal=10

            order by EV.OrderNum ASC
           ";

          $result = mssql_query($query);
          $row = mssql_fetch_array($result);
          if(empty($row)){          
          $this->getUser()->setFlash('sms',sprintf("No existe data para esta fecha"));          
          $this->redirect("archivos/txt");   
          }
          else{
              //$this->getUser()->setFlash('sms',sprintf("Playlist generado en el servidor local"));
          }
                

      }
          
  }
  
}
