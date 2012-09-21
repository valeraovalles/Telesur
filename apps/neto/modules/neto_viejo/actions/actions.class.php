<?php

/**
 * neto actions.
 *
 * @package    principal
 * @subpackage neto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class neto_viejoActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }

  public function executeProcesa(sfWebRequest $request)
  {
        $this->setLayout("layout_limpio");
      
  	$error=0; 	
  	
  	$this->datos=$request->getParameter("datos");

  	$this->ficha= $this->getUser()->getGuardUser()->getProfile()->getC();
    
  	if($this->datos['periodo']==-1) $error=1;
  	if($this->datos['proceso']==-1) $error=1;
  	if($this->datos['mes']==-1) $error=1;
  	if($this->datos['ano']==-1) $error=1;
  	
  	if($this->datos['proceso']==52){
  	  	 
  		if($this->datos['ano']==-1){
		  	$this->getUser()->setFlash('notice',sprintf('Debe seleccionar todas las opciones'));
		    $this->redirect('neto/index');
	  	}
  		
  	}
  	
  	else{
  		
  	  	if($error==1){
		  	$this->getUser()->setFlash('notice',sprintf('Debe seleccionar todas las opciones'));
		    $this->redirect('neto/index');
	  	}
  	}
  	
	  $this->codtra=$this->ficha;
	  $this->proceso= $this->datos['proceso'];
	  $this->periodo= $this->datos['periodo'];
	  $this->numper= $this->datos['mes'];
	  $this->ano=$this->datos['ano'];
	  $this->numper=$this->numper+$this->periodo;

  	//VALIDO SI HAY DATOS
  	
  	$DB_OCI = '(DESCRIPTION =
		(ADDRESS =
		(PROTOCOL = TCP)
		(HOST = 192.168.3.12)
		(PORT = 1521)
		)
		(CONNECT_DATA =
		(SERVER = DEDICATED)
		(SERVICE_NAME = SPI)
		)
		)';

		$USER_OCI = "consulta";
		$PASS_OCI = "consulta";
		$db = oci_connect($USER_OCI, $PASS_OCI, $DB_OCI);
	
		
		
		if($this->proceso=="01")
	  {
      $this->query="
      
     
		select nmm001.cedula, nmm001.fictra, nmm001.nombr1, nmm001.apell1, nmm001.sueld1, nmm001.fecing, 
		nmm024.tnom_tipnom, nmm024.cto_codcto, nmm024.moncto, nmm024.functo, nmm024.cancto, nmm024.suecal, 
		nmt027.descto, nmt004.descar, nmt019.desdep, nmt033.fecini,nmt033.fecfin
		
		from nmm001, nmm023, nmm024, nmt004, nmt019, nmt027,nmt033 
		 
		where 
		 
		 nmm001.fictra like '%".$this->codtra."%' and 
		 nmm001.fictra = nmm023.trab_fictra and 
		 nmm001.fictra = nmm024.trab_fictra and 
		 
		 nmm023.fpro_numper = ".$this->numper." and 
		 nmm024.fpro_numper = nmm023.fpro_numper and 
		 nmt033.numper = nmm023.fpro_numper and
		 
		 nmm023.fpro_anocal = ".$this->ano." and 
		 nmm024.fpro_anocal = nmm023.fpro_anocal and 
		 nmt033.anocal = nmm023.fpro_anocal and 
		 
		 nmt027.tnom_tipnom = nmm001.tnom_tipnom and
		 nmt033.tnom_tipnom = nmm001.tnom_tipnom and 
		 
		 nmt027.codcto = nmm024.cto_codcto and 
		 nmm024.functo<>3 and
		  
		 nmm001.cgo_carocu = nmt004.codcar and 
		 nmm001.dpto_coddep = nmt019.coddep and 
		 
		 nmm023.proc_tippro = 1 and 
		 nmm023.proc_tippro = nmm024.proc_tippro and
		 nmt033.proc_tippro =  nmm023.proc_tippro and		
		 
		 nmt033.fecpag <= '".date("d/m/Y")."'
		
		
		order by nmm024.cto_codcto";
      
     
	  }
	 else
	  {
      $select = "select c.fictra, a.tnom_tipnom, c.cedula, c.nombr1, c.apell1, ";
      $select = $select."a.cto_codcto, b.descto, f.fecini, f.fecfin, a.moncto, e.descar, ";
      $select = $select."d.desdep, a.functo, a.cancto, c.sueld1, c.fecing ";
      $from = "from nmm024 a, nmt027 b, nmm001 c, nmt019 d, nmt004 e, nmt033 f ";
      $where  = "where a.cto_codcto=b.codcto ";
      $where  = $where."and a.trab_fictra=c.fictra ";
      $where  = $where." and a.fpro_anocal=f.anocal "; 
	  $where  = $where."and a.fpro_numper=f.numper ";
      $where  = $where." and a.fpro_anocal=$this->ano ";
      $where  = $where."and a.tnom_tipnom=b.tnom_tipnom ";
      $where  = $where."and a.functo<>3 ";
      $where  = $where."and c.cgo_carocu=e.codcar ";
      $where  = $where."and c.dpto_coddep=d.coddep ";
      $where  = $where."and trim(a.trab_fictra)='".$this->codtra."' ";
      $where  = $where."and a.tnom_tipnom=f.tnom_tipnom ";
      $where  = $where."and a.proc_tippro=f.proc_tippro ";
      $where  = $where."and a.proc_tippro=52 ";
	  $where  = $where."and f.fecpag < sysdate ";
      $where  = $where."and a.cto_codcto<9000 ";
      $order="order by a.cto_codcto";
      $this->query=$select.$from.$where.$order;
	  }
	  
	  
  
    	$rs = oci_parse($db,$this->query);
		oci_execute($rs);
		$row = oci_fetch_array($rs, OCI_ASSOC); 
		
		//fecha ingreso
		$tnom_tipnom = $row['TNOM_TIPNOM'];
		
		if($tnom_tipnom==''){
			
			$this->getUser()->setFlash('notice',sprintf('No existe ningun registro para su selección'));
	    	$this->redirect('neto/index');
		
		}
		
  	
  }
  
  public function executeXxx(sfWebRequest $request)
  {
    
  }
}
