<?php

/**
 * equiposdetransmision module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage equiposdetransmision
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseEquiposdetransmisionGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'mm_equipos_transmision' : 'mm_equipos_transmision_'.$action;
  }
}
