<?php


/**
 * This class defines the structure of the 'mm_equipo_transmision' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Sep 14 12:32:13 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MmEquipoTransmisionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MmEquipoTransmisionTableMap';

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
		$this->setName('mm_equipo_transmision');
		$this->setPhpName('MmEquipoTransmision');
		$this->setClassname('MmEquipoTransmision');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('mm_equipo_transmision_id_equipo_transmision_seq');
		// columns
		$this->addPrimaryKey('ID_EQUIPO_TRANSMISION', 'IdEquipoTransmision', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPCION_EQUIPOS_TRANSMISION', 'DescripcionEquiposTransmision', 'VARCHAR', false, 100, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // MmEquipoTransmisionTableMap
