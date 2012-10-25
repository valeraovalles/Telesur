<?php


/**
 * Skeleton subclass for performing query and update operations on the 'bit_categorias' table.
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
class BitCategoriasPeer extends BaseBitCategoriasPeer {
 public static function crear_categoria($idunidad,$categoria){
        
        
        $categoria = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $categoria);       
        
        $a=new Criteria();
        $a->add(BitCategoriasUnidadesPeer::ID_UNIDAD,$idunidad);
        $a->addJoin(BitCategoriasPeer::ID_CATEGORIA, BitCategoriasUnidadesPeer::ID_CATEGORIA);
        $a->add(BitCategoriasPeer::DESCRIPCION, strtolower($categoria));
        $busca_categoria=BitCategoriasPeer::doSelect($a);
        
        if(!isset($busca_categoria[0])){
        
            $a = new BitCategorias;
            $a->setDescripcion(strtolower($categoria));
            if($a->save()){

                $a = new Criteria();
                $a->addDescendingOrderByColumn("id_categoria");
                $idultimacategoria =  BitCategoriasPeer::doSelect($a);

                $a = new BitCategoriasUnidades;
                $a->setIdUnidad($idunidad);
                $a->setIdCategoria($idultimacategoria[0]->getIdCategoria());
                if($a->save()) return "Categoria creada con exito";
                else return false;            
            } else return false;
        } else return false;
        
    }
    public static function eliminar_categoria($idcategoria){
        
        $a = new Criteria();
        $a->add(BitCategoriasPeer::ID_CATEGORIA,$idcategoria);
        $bitacoracategoria= BitBitacoraPeer::doSelect($a);
        if(isset($bitacoracategoria[0])) return "No se puede eliminar esta categoria porque se encuentra asociada a una bitacora.";

        $a = new Criteria();
        $a->add(BitSubcategoriasPeer::ID_CATEGORIA,$idcategoria);
        $bitsubcategoria=BitSubcategoriasPeer::doSelect($a);
        if(isset($bitsubcategoria[0])) return "No se puede eliminar esta categoria porque tiene asociadas subcategorias.";

        
        $a = new criteria();
        $a->add(BitCategoriasUnidadesPeer::ID_CATEGORIA,$idcategoria);
        if(BitCategoriasUnidadesPeer::doDelete($a)){        
            $a = new criteria();
            $a->add(BitCategoriasPeer::ID_CATEGORIA,$idcategoria);
            if(BitCategoriasPeer::doDelete($a))return "Categoria eliminada";
            else return false;
        }else return false;
    }
    
    public static function eliminar_subcategoria($idsubcategoria){
        
        $a = new Criteria();
        $a->add(BitBitacoraPeer::ID_SUBCATEGORIA,$idsubcategoria);
        $bitacoracategoria=  BitBitacoraPeer::doSelect($a);
        if(isset($bitacoracategoria[0])) return "No se puede eliminar esta subcategoria porque se encuentra asociada a la bitacora.";
        
        $a = new criteria();
        $a->add(BitSubcategoriasPeer::ID_SUBCATEGORIA,$idsubcategoria);
        if(BitCategoriasUnidadesPeer::doDelete($a))return "Sub-Categoria eliminada con exito";
        else return false;
    }
    
    public static function editar_categoria($idcategoria,$categoria){
        
        $categoria = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $categoria);
        $categoria=strtolower($categoria);
        
        $a=new Criteria();
	$a->add(BitCategoriasPeer::ID_CATEGORIA,$idcategoria);
	$a->add(BitCategoriasPeer::DESCRIPCION,$categoria);
	if(BitCategoriasPeer::doUpdate($a)) return 'Categoria actualizada con exito';
	else return false;
    }
} // BitCategoriasPeer
