<?php

/**
 * externos module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage externos
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseExternosGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array();
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id_externo%% - %%cedula%% - %%nombre%% - %%apellido%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Externos List';
  }

  public function getEditTitle()
  {
    return 'Edit Externos';
  }

  public function getNewTitle()
  {
    return 'New Externos';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id_externo',  1 => 'cedula',  2 => 'nombre',  3 => 'apellido',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id_externo' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'cedula' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'nombre' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'apellido' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id_externo' => array(),
      'cedula' => array(),
      'nombre' => array(),
      'apellido' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id_externo' => array(),
      'cedula' => array(),
      'nombre' => array(),
      'apellido' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id_externo' => array(),
      'cedula' => array(),
      'nombre' => array(),
      'apellido' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id_externo' => array(),
      'cedula' => array(),
      'nombre' => array(),
      'apellido' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id_externo' => array(),
      'cedula' => array(),
      'nombre' => array(),
      'apellido' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'TraDatosExternosForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'TraDatosExternosFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfPropelPager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getPeerMethod()
  {
    return 'doSelect';
  }

  public function getPeerCountMethod()
  {
    return 'doCount';
  }
}
