<?php

/**
 * vehiculos module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage vehiculos
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseVehiculosGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'tra_vehiculos' : 'tra_vehiculos_'.$action;
  }
}
