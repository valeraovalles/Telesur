<?php


/**
 * Skeleton subclass for representing a row from the 'mm_equipos_transmision' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Sep 14 12:33:54 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MmEquiposTransmision extends BaseMmEquiposTransmision {
    public function __toString(){
        
        return $this->getDescripcionEquipoTransmision();
        
    }
} // MmEquiposTransmision
