<?php

/**
 * gestionar actions.
 *
 * @package    Telesur
 * @subpackage gestionar
 * @author     Your name here
 */
class gestionarActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $a=new Criteria();
    $a->addDescendingOrderByColumn("id_licencia");
    $this->LcLicenciass = LcLicenciasPeer::doSelect($a);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LcLicenciasForm();

    $idu=$this->getUser()->getGuardUser()->getId();
    $this->form->setDatos($idu);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LcLicenciasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($LcLicencias = LcLicenciasPeer::retrieveByPk($request->getParameter('id_licencia')), sprintf('Object LcLicencias does not exist (%s).', $request->getParameter('id_licencia')));
    $this->form = new LcLicenciasForm($LcLicencias);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($LcLicencias = LcLicenciasPeer::retrieveByPk($request->getParameter('id_licencia')), sprintf('Object LcLicencias does not exist (%s).', $request->getParameter('id_licencia')));
    $this->form = new LcLicenciasForm($LcLicencias);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($LcLicencias = LcLicenciasPeer::retrieveByPk($request->getParameter('id_licencia')), sprintf('Object LcLicencias does not exist (%s).', $request->getParameter('id_licencia')));
    $LcLicencias->delete();

    $this->redirect('gestionar/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $LcLicencias = $form->save();

      $this->redirect('gestionar/edit?id_licencia='.$LcLicencias->getIdLicencia());
    }
  }
  
public function executeConsultar(sfWebRequest $request)
  {
  	$id_licencia=$this->getRequestParameter('idl');
  	
  	$a=new Criteria();
  	$a->add(LcLicenciasPeer::ID_LICENCIA,$id_licencia);
  	$a->addJoin(SfGuardUserProfilePeer::USER_ID,LcLicenciasPeer::ID_RESPONSABLE);
  	$a->addJoin(TsurCargosPeer::ID_CARGO,SfGuardUserProfilePeer::ID_CARGO);
  	$a->addJoin(TsurDependenciasPeer::ID_DEPENDENCIA,SfGuardUserProfilePeer::ID_DEPENDENCIA);
  	
  	$this->licencias=LcLicenciasPeer::doSelect($a);
  	$this->usuario=sfGuardUserPeer::doSelect($a);
  	$this->perfil=SfGuardUserProfilePeer::doSelect($a);
  	$this->cargo=TsurCargosPeer::doSelect($a);
  	$this->departamento=TsurDependenciasPeer::doSelect($a);

  	
  }
  
  public function executeLicenciasvencidas(sfWebRequest $request)
  {  
    $this->licencias_vencidas='';
    $this->dias_vencidos='';
    $this->responsable='';
 	
    $a=new Criteria();
    $a->addJoin(LcLicenciasPeer::ID_RESPONSABLE, SfGuardUserProfilePeer::USER_ID);
    $licencias=LcLicenciasPeer::doSelect($a);
    $perfil=SfGuardUserProfilePeer::doSelect($a);
    
    $c=0;$s=0;
    foreach ($licencias as $l) {
    	
    	$fecha_vencimiento = explode("-",$l->getFechaVencimiento("d-m-Y"));

        $f=new funciones;
    	$dias=$f->dias_fechas($fecha_vencimiento);
    	
    	$responsable=$perfil[$s]->getNombre1().' '.$perfil[$s]->getApellido1();
    	
    	    	
    	if($dias<=90){
    	
    		$this->licencias_vencidas[$c]=$l;
    		$this->dias_vencidos[$c]=$dias;
    		$this->responsable[$c]= ucwords($responsable);
    		
    		$c++;
    	} 

    	$s++;
     }  
          
     if($this->licencias_vencidas!=''){

     
     	$c=0; $envia=0; $enviax=0; $nombres=''; $cuerpo='';
     	foreach ($this->licencias_vencidas as $lvc) {
     		
     		$a=new Criteria();
     		$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     		$bandera=LcLicenciasPeer::doSelect($a);
     		
     		if($lvc->getTipo()=="s")
     			$t="Servicio";
     			
     		else if($lvc->getTipo()=="l")
     			$t="Licencia";

     		if($this->dias_vencidos[$c]>=75 && $this->dias_vencidos[$c]<=90 && $bandera[0]->getBanderaCorreo()!=1){
     		   			
     			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,1);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="90";
	     	
		     	$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";	     	  			
		
     		}

     	    else if($this->dias_vencidos[$c]>=60 && $this->dias_vencidos[$c]<=74 && $bandera[0]->getBanderaCorreo()!=2){
     			
     			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,2);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="75";
     			
     			$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->respponsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
 			
     		}
     		
     	    else if($this->dias_vencidos[$c]>=45 && $this->dias_vencidos[$c]<=59 && $bandera[0]->getBanderaCorreo()!=3){

      			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,3);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="60";
     			
     			$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
     			
     		}
     		
     	    else if($this->dias_vencidos[$c]>=30 && $this->dias_vencidos[$c]<=44 && $bandera[0]->getBanderaCorreo()!=4){
     			
     			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,4);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="45";
     			
     			$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
     			
     		}
     		
     	    else if($this->dias_vencidos[$c]>=15 && $this->dias_vencidos[$c]<=29 && $bandera[0]->getBanderaCorreo()!=5){
     			
     			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,5);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="30";
     			
     			$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
     			
     		}
     		
     	    else if($this->dias_vencidos[$c]>0 && $this->dias_vencidos[$c]<=14 && $bandera[0]->getBanderaCorreo()!=6){
     			
     			$a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,6);
     			LcLicenciasPeer::doUpdate($a);
     			$envia=1; $d="15";
     			
     			$nombres .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
     			
     		}
     		
     	   else if($this->dias_vencidos[$c]<0 && $bandera[0]->getBanderaCorreo()!=7){

                        $a=new Criteria();
     			$a->add(LcLicenciasPeer::ID_LICENCIA,$lvc->getIdLicencia());
     			$a->add(LcLicenciasPeer::BANDERA_CORREO,7);
     			LcLicenciasPeer::doUpdate($a);
     			$enviax=2; $dx=$this->dias_vencidos[$c] * -1;
     			
     			$nombresx .="<tr bgcolor='white'>
		     					<td>".$lvc->getNombreLicencia()."</td>
		     					<td align=center>".$lvc->getFechaCompra("d-m-Y")."</td>
		     					<td align=center>".$lvc->getFechaVencimiento("d-m-Y")."</td>
		     					<td>".$lvc->getDescripcion()."</td>
		     					<td>".$this->responsable[$c]."</td>
		     					<td>".$t."</td>
		     				</tr>
		     	";
     			
     		}
     		
     		if($envia==1){
     			


     		$inicio="<div align=center><table style='font-size:12px;' width=850px border=0 bgcolor='gray' cellpadding=5>
	     				<tr bgcolor='white'>
	     					<td colspan=6 align=center style='font-weight:bold'>LICENCIAS &Oacute; SERVICIOS A MENOS DE ".$d." D&Iacute;AS DE SU FECHA DE EXPIRACI&Oacute;N</td>  					
	     						
	     				</tr>
	     						
	     				<tr align=center style='font-weight:bold' bgcolor='white'>
	     					<td width='225px'>Nombre</td>
	     					<td width='100px'>Fecha Compra</td>
	     					<td width='100px'>Fecha Vencimiento</td>
	     					<td width='350px'>Descripci&oacute;n</td>
	     					<td width='125px'>Responsable</td>
	     					<td width='50px'>Tipo</td>
	     				</tr>
	     	";
     		$fin="</table><div><br><br><div style='font-size:10px'>Los per&iacute;odos de env&iacute;o de correo son entre los 90,75,60,45,30 y 15 d&iacute;as</div>"; 
     		
     		$cuerpo=$inicio.$nombres.$fin;
                
     		}
     		
     	    if($enviax==2){

     		$iniciox="<div align=center><table style='font-size:12px;' width=850px border=0 bgcolor='gray' cellpadding=5>
	     				<tr bgcolor='white'>
	     					<td colspan=6 align=center style='font-weight:bold'>LICENCIAS &Oacute; SERVICIOS VENCIDOS</td>  					
	     						
	     				</tr>
	     						
	     				<tr align=center style='font-weight:bold' bgcolor='white'>
	     					<td width='225px'>Nombre</td>
	     					<td width='100px'>Fecha Compra</td>
	     					<td width='100px'>Fecha Vencimiento</td>
	     					<td width='350px'>Descripci&oacute;n</td>
	     					<td width='125px'>Responsable</td>
	     					<td width='50px'>Tipo</td>
	     				</tr>
	     	";
     		$finx="</table><div><br><br><div style='font-size:10px'>Los per&iacute;odos de env&iacute;o de correo son entre los 90,75,60,45,30 y 15 d&iacute;as</div>"; 
     		
     		$cuerpo2=$iniciox.$nombresx.$finx;
     		}
     		$c++;     		
     	} 
 
     }
     
     		    $email1="jvalera@telesurtv.net";
		    /*$email2="slozada@telesurtv.net";
		    $email3="mmarquez@telesurtv.net";
		    $email4="hplaza@telesurtv.net";
		    $email5="dfreitez@telesurtv.net";
		    $email6="ceuzcategui@telesurtv.net";
		    $email7="plataforma@telesurtv.net";
                    $email8="iquiroz@telesurtv.net";
                    $email9="promero@telesurtv.net";
                    $email10="ssubero@telesurtv.net";*/
                    
      	if($envia==1){
 
            $f->correo(utf8_decode($cuerpo), array($email1), 'Licencias por vencer', 'Licencias <jvalera@telesurtv.net>');
            //$f->correo(utf8_decode($cuerpo), array($email1), 'Licencias por vencer', 'Licencias <jvalera@telesurtv.net>');
     	}
     	
        if($enviax==2){
     		$f->correo(utf8_decode($cuerpo2), array($email1,$email2,$email3,$email4,$email5,$email6,$email7,$email8,$email9,$email10), 'Licencias vencidas', 'Licencias <jvalera@telesurtv.net>');
     	}
        
  }

        
 
}
