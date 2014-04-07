<?php

/**
 * externos module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage externos
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseExternosGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'tra_datos_externos' : 'tra_datos_externos_'.$action;
  }
}
