<?php

/**
 * generar actions.
 *
 * @package    Telesur
 * @subpackage generar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class generarActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form= new NetoformularioForm();  
      
    if ($request->isMethod('post'))        
    {        
        $datos = $request->getParameter('datos_form'); 
        
        $this->form->setDatos($datos);
        
        $this->form->bind($datos);
        
        if ($this->form->isValid()){ 
            $this->forward("generar","procesar"); 
        }
    }
  }
  
  public function executeProcesar(sfWebRequest $request)
  {

        $this->montos='';
        $datos = $request->getParameter('datos_form'); 
       
        $conexion = new ConexionDirecta();
        $postgresql_sigefirrhh=$conexion->postgresql_sigefirrhh();

        $query="
            
            SELECT  max(g.nombre) as gruponomina, max(g.periodicidad) as periodicidad,
                max(d.nombre) as tipopersonal, max(d.cod_tipo_personal) as codtno,
                max(tr.fecha_ingreso) as ingresoorganismo, b.codigo_nomina as codrac, max(b.estatus) as estatus,
                max(b.forma_pago) as formapago, max(b.cuenta_nomina) as cuenta_nomina,
                max(e.cedula) as codtra, e.primer_nombre as primer_nombre, e.segundo_nombre as segundo_nombre,
                e.primer_apellido as primer_apellido, e.segundo_apellido as segundo_apellido,
                k.cod_cargo as codigocargo, k.descripcion_cargo as cargo,
                j.cod_dependencia as codcen, j.nombre as nombreunidad, 
                c.cod_concepto as codcon, c.descripcion as  descon, a.id_historico_quincena as id_contador,
                a.unidades as unidades, a.monto_asigna as asigna, a.monto_deduce as deduce,
                a.documento_soporte as documento, k.grado as grado, fp.cod_frecuencia_pago as frecon

            FROM historicoquincena a,   historiconomina b, trabajador tr,concepto c, tipoPersonal d, 
            personal e, conceptoTipoPersonal f, grupoNomina g, 
            dependencia j, cargo k, frecuenciaTipoPersonal ftp, frecuenciaPago fp

            WHERE 
            a.anio                            =  ".$datos['ano']."
            AND a.mes                         =  ".$datos['mes']."
            AND a.semana_quincena             =  ".$datos['periodo']."
            AND e.cedula			=  ".$this->getUser()->getGuardUser()->getProfile()->getCedula()."
            AND a.numero_nomina 		=  0
            AND g.id_grupo_nomina            	=  a.id_grupo_nomina
            AND d.id_tipo_personal             =  a.id_tipo_personal
            AND b.id_tipo_personal            =  d.id_tipo_personal
            AND b.id_trabajador      		=  a.id_trabajador
            AND a.id_historico_nomina=b.id_historico_nomina
            AND b.id_trabajador=tr.id_trabajador
            AND e.id_personal		     	=  tr.id_personal
            AND j.id_dependencia         	=  b.id_dependencia
            AND k.id_cargo             	=  b.id_cargo
            AND f.id_concepto_tipo_personal	=  a.id_concepto_tipo_personal
            AND c.id_concepto                 =  f.id_concepto
            AND a.id_frecuencia_tipo_personal = ftp.id_frecuencia_tipo_personal
            AND ftp.id_frecuencia_pago  = fp.id_frecuencia_pago
            and c.cod_concepto <> '5000'

                group by d.cod_tipo_personal,b.codigo_nomina,e.cedula, e.primer_nombre, e.segundo_nombre,
                e.primer_apellido, e.segundo_apellido,k.cod_cargo, k.descripcion_cargo,
                j.cod_dependencia, j.nombre, c.cod_concepto, c.descripcion, a.id_historico_quincena,
                a.unidades, a.monto_asigna, a.monto_deduce,a.documento_soporte, k.grado, fp.cod_frecuencia_pago

                order by  d.cod_tipo_personal, j.cod_dependencia,b.codigo_nomina, e.cedula, c.cod_concepto
                
        ";

        $rs = pg_query($postgresql_sigefirrhh, $query);
        
        $cont=0;
        while($row = pg_fetch_array($rs)){

            //tipo de nomina
            $tipo_nomina= ucfirst(strtolower($row['gruponomina']));
            
            //nombre y apellido trabajador
            $this->nomape= ucfirst(strtolower($row['primer_nombre'])).' '.ucfirst(strtolower($row['primer_apellido']));
            
            //cedula trabajador
            $this->cedula= $row['codtra'];
            
            //montos de asignaciones y deducciones
            $this->montos .="
                
		    <tr>
		      <td>".$row['descon']."</td>
		      <td>".number_format($row['asigna'], 2, ',', '.')."</td>
		      <td>".number_format($row['deduce'], 2, ',', '.')."</td>
		    </tr>
                
	    ";
            
            //cedula trabajador
            $this->fecha_ingreso= $row['ingresoorganismo'];
            
            //calculo sueldo
            if($row['codcon']=='0001')
            $this->sueldo= $row['asigna']*2;
            
            //total asignado
            $this->total_asignado += $row['asigna'];
            
            //total deducido
            $this->total_deducido += $row['deduce'];
            
            //cargo
            $this->cargo = $row['cargo'];
            
            //direccion
            $this->dependencia = $row['nombreunidad'];
            
            //total_pago
            $this->total_pago = $this->total_asignado - $this->total_deducido;

            $cont++;
        }
        
        //SI NO HAY DATOS EN NOMINA
        if($cont==0){
            $this->getUser()->setFlash('sms',sprintf("No existen datos para esta consulta"));
            $this->redirect("generar/index");     
            
        }
        
        //SI HAY DATOS EN NOMINA
        else{
            
            //genero el nombre del mes
            if($datos['mes']==1)$this->mes='Enero';
            else if($datos['mes']==2)$this->mes='Febrero';
            else if($datos['mes']==3)$this->mes='Marzo';
            else if($datos['mes']==4)$this->mes='Abril';
            else if($datos['mes']==5)$this->mes='Mayo';
            else if($datos['mes']==6)$this->mes='Junio';
            else if($datos['mes']==7)$this->mes='Julio';
            else if($datos['mes']==8)$this->mes='Agosto';
            else if($datos['mes']==9)$this->mes='Septiembre';
            else if($datos['mes']==10)$this->mes='Octubre';
            else if($datos['mes']==11)$this->mes='Noviembre';
            else if($datos['mes']==12)$this->mes='Diciembre';
            //
            //
            //GENERO EL TITULO
            if($datos['periodo']==1)
            $this->titulo="LAPSO: PRIMERA QUINCENA DE ".strtoupper($this->mes)." <br> NÓMINA: ".strtoupper($tipo_nomina);
            else if($datos['periodo']==2)
            $this->titulo="LAPSO: SEGUNDA QUINCENA DE ".strtoupper($this->mes)." <br> NÓMINA: ".strtoupper($tipo_nomina);
            //
        }
  }
}
