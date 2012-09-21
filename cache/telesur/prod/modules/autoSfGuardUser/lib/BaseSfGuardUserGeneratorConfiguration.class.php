<?php

/**
 * sfGuardUser module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage sfGuardUser
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSfGuardUserGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%=username%% - %%last_login%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Lista de Usuarios';
  }

  public function getEditTitle()
  {
    return 'Editando Usuario "%%username%%"';
  }

  public function getNewTitle()
  {
    return 'Nuevo Usuario';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'username',  1 => 'is_super_admin',  2 => 'sf_guard_user_permission_list',  3 => 'sf_guard_user_group_list',);
  }

  public function getFormDisplay()
  {
    return array(  'NONE' =>   array(    0 => 'username',    1 => 'password',    2 => 'password_again',    3 => 'nombre1',    4 => 'nombre2',    5 => 'apellido1',    6 => 'apellido2',    7 => 'cedula',    8 => 'id_cargo',    9 => 'id_dependencia',    10 => 'sexo',    11 => 'nacionalidad',    12 => 'extension',    13 => 'fecha_ingreso',  ),  'Permisos y Grupos' =>   array(    0 => 'is_active',    1 => 'is_super_admin',    2 => 'sf_guard_user_group_list',  ),);
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
    return array(  0 => '=username',  1 => 'last_login',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'username' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Nombre de usuario',),
      'algorithm' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'salt' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'password' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Clave',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Creado',),
      'last_login' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',  'label' => 'Ultimo acceso',),
      'is_active' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Esta activo',),
      'is_super_admin' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Administrador',),
      'sf_guard_user_permission_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Permisos',),
      'sf_guard_user_group_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Grupos',),
      'password_again' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Clave (nuevamente)',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'created_at' => array(),
      'last_login' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'sf_guard_user_permission_list' => array(),
      'sf_guard_user_group_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'created_at' => array(),
      'last_login' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'sf_guard_user_permission_list' => array(),
      'sf_guard_user_group_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'created_at' => array(),
      'last_login' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'sf_guard_user_permission_list' => array(),
      'sf_guard_user_group_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'created_at' => array(),
      'last_login' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'sf_guard_user_permission_list' => array(),
      'sf_guard_user_group_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'created_at' => array(),
      'last_login' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'sf_guard_user_permission_list' => array(),
      'sf_guard_user_group_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'sfGuardUserAdminForm';
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
    return 'sfGuardUserFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfPropelPager';
  }

  public function getPagerMaxPerPage()
  {
    return 10;
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
