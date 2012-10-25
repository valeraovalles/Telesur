<?php


/**
 * Skeleton subclass for performing query and update operations on the 'bit_subcategorias' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Oct 22 15:27:18 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class BitSubcategoriasPeer extends BaseBitSubcategoriasPeer {
  public static function crear_subcategoria($idcategoria,$subcategoria){
        
        $subcategoria = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $subcategoria);
        
        //convierto a minuscula
        $subcategoria= strtolower($subcategoria);
        
        //verifico si ya existe esta subcategoria
        $a=new Criteria();
        $a->add(BitSubcategoriasPeer::ID_CATEGORIA,$idcategoria);
        $a->add(BitSubcategoriasPeer::DESCRIPCION,$subcategoria);
        $busca_subcategoria=BitSubcategoriasPeer::doSelect($a);        
        if(isset($busca_subcategoria[0])) return "Ya existe una subcategoria con el mismo nombre";
        
        else{
            $a = new BitSubcategorias;
            $a->setIdCategoria($idcategoria);
            $a->setDescripcion($subcategoria);
            if ($a->save()) return "Subcategoria creada con exito";
            else return "Operación cancelada";
        }
    }
    
    public static function editar_subcategoria($idsubcategoria,$subcategoria){
        
        $subcategoria = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $subcategoria);
        $subcategoria=strtolower($subcategoria);
        
        $a=new Criteria();
	$a->add(BitSubcategoriasPeer::ID_SUBCATEGORIA,$idsubcategoria);
	$a->add(BitSubcategoriasPeer::DESCRIPCION,$subcategoria);
	if(BitSubcategoriasPeer::doUpdate($a)) return 'Subcategoria actualizada con exito';
	else return false;
    }
} // BitSubcategoriasPeer