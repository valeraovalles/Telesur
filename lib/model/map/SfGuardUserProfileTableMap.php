<?php


/**
 * This class defines the structure of the 'sf_guard_user_profile' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Oct 31 11:39:56 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class SfGuardUserProfileTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SfGuardUserProfileTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('sf_guard_user_profile');
		$this->setPhpName('SfGuardUserProfile');
		$this->setClassname('SfGuardUserProfile');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'sf_guard_user', 'ID', true, null, null);
		$this->addForeignKey('ID_DEPENDENCIA', 'IdDependencia', 'INTEGER', 'tsur_dependencias', 'ID_DEPENDENCIA', true, null, null);
		$this->addForeignKey('ID_CARGO', 'IdCargo', 'INTEGER', 'tsur_cargos', 'ID_CARGO', true, null, null);
		$this->addColumn('NOMBRE1', 'Nombre1', 'VARCHAR', true, 100, null);
		$this->addColumn('NOMBRE2', 'Nombre2', 'VARCHAR', false, 100, null);
		$this->addColumn('APELLIDO1', 'Apellido1', 'VARCHAR', true, 100, null);
		$this->addColumn('APELLIDO2', 'Apellido2', 'VARCHAR', false, 100, null);
		$this->addColumn('CEDULA', 'Cedula', 'VARCHAR', true, 15, null);
		$this->addColumn('SEXO', 'Sexo', 'CHAR', true, 1, null);
		$this->addColumn('NACIONALIDAD', 'Nacionalidad', 'CHAR', true, 5, null);
		$this->addColumn('FECHA_NACIMIENTO', 'FechaNacimiento', 'DATE', false, null, null);
		$this->addColumn('EXTENSION', 'Extension', 'INTEGER', false, null, 0);
		$this->addColumn('FECHA_INGRESO', 'FechaIngreso', 'DATE', false, null, null);
		$this->addColumn('HORA_ENTRADA', 'HoraEntrada', 'TIME', false, null, null);
		$this->addColumn('HORA_SALIDA', 'HoraSalida', 'TIME', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('TsurDependencias', 'TsurDependencias', RelationMap::MANY_TO_ONE, array('id_dependencia' => 'id_dependencia', ), null, null);
    $this->addRelation('TsurCargos', 'TsurCargos', RelationMap::MANY_TO_ONE, array('id_cargo' => 'id_cargo', ), null, null);
    $this->addRelation('BitBitacora', 'BitBitacora', RelationMap::ONE_TO_MANY, array('user_id' => 'id_usuario', ), null, null);
    $this->addRelation('CpControldepersonal', 'CpControldepersonal', RelationMap::ONE_TO_MANY, array('user_id' => 'id_usuario', ), null, null);
    $this->addRelation('CtConstancias', 'CtConstancias', RelationMap::ONE_TO_MANY, array('user_id' => 'id_solicitante', ), null, null);
    $this->addRelation('EstSolicitudes', 'EstSolicitudes', RelationMap::ONE_TO_MANY, array('user_id' => 'id_solicitante', ), null, null);
    $this->addRelation('LcLicencias', 'LcLicencias', RelationMap::ONE_TO_MANY, array('user_id' => 'id_responsable', ), null, null);
    $this->addRelation('SitComentarios', 'SitComentarios', RelationMap::ONE_TO_MANY, array('user_id' => 'id_usuario', ), null, null);
    $this->addRelation('SitTickets', 'SitTickets', RelationMap::ONE_TO_MANY, array('user_id' => 'id_solicitante', ), null, null);
    $this->addRelation('SitTicketsReasignados', 'SitTicketsReasignados', RelationMap::ONE_TO_MANY, array('user_id' => 'user_id', ), null, null);
    $this->addRelation('SitTicketsUsuarios', 'SitTicketsUsuarios', RelationMap::ONE_TO_MANY, array('user_id' => 'id_usuario', ), null, null);
    $this->addRelation('SitUsuariosUnidades', 'SitUsuariosUnidades', RelationMap::ONE_TO_ONE, array('user_id' => 'id_usuario', ), null, null);
    $this->addRelation('TraAsignaciones', 'TraAsignaciones', RelationMap::ONE_TO_MANY, array('user_id' => 'id_conductor', ), null, null);
    $this->addRelation('TraSolicitudes', 'TraSolicitudes', RelationMap::ONE_TO_MANY, array('user_id' => 'id_solicitante', ), null, null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // SfGuardUserProfileTableMap
