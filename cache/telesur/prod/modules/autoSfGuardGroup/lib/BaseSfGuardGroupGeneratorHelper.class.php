<?php

/**
 * sfGuardGroup module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage sfGuardGroup
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseSfGuardGroupGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'sf_guard_group' : 'sf_guard_group_'.$action;
  }
}
