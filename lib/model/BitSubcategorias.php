<?php


/**
 * Skeleton subclass for representing a row from the 'bit_subcategorias' table.
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
class BitSubcategorias extends BaseBitSubcategorias {
    
    public function __toString(){
        
        return $this->getDescripcion();
        
    }
} // BitSubcategorias
