<?php

/**
 * vehiculos module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage vehiculos
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseVehiculosGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' => NULL,  '_delete' => NULL,);
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
    return '%%id_vehiculo%% - %%modelo%% - %%ano%% - %%placa%% - %%color%% - %%carro%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Vehiculos List';
  }

  public function getEditTitle()
  {
    return 'Edit Vehiculos';
  }

  public function getNewTitle()
  {
    return 'New Vehiculos';
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
    return array(  0 => 'id_vehiculo',  1 => 'modelo',  2 => 'ano',  3 => 'placa',  4 => 'color',  5 => 'carro',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id_vehiculo' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'modelo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'ano' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'placa' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'color' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'carro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id_vehiculo' => array(),
      'modelo' => array(),
      'ano' => array(),
      'placa' => array(),
      'color' => array(),
      'carro' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id_vehiculo' => array(),
      'modelo' => array(),
      'ano' => array(),
      'placa' => array(),
      'color' => array(),
      'carro' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id_vehiculo' => array(),
      'modelo' => array(),
      'ano' => array(),
      'placa' => array(),
      'color' => array(),
      'carro' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id_vehiculo' => array(),
      'modelo' => array(),
      'ano' => array(),
      'placa' => array(),
      'color' => array(),
      'carro' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id_vehiculo' => array(),
      'modelo' => array(),
      'ano' => array(),
      'placa' => array(),
      'color' => array(),
      'carro' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'TraVehiculosForm';
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
    return 'TraVehiculosFormFilter';
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
