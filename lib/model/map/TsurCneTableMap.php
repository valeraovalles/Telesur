<?php


/**
 * This class defines the structure of the 'tsur_cne' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Oct 31 11:39:59 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TsurCneTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TsurCneTableMap';

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
		$this->setName('tsur_cne');
		$this->setPhpName('TsurCne');
		$this->setClassname('TsurCne');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('tsur_cne_id_seq');
		// columns
		$this->addColumn('NACIONALIDAD', 'Nacionalidad', 'VARCHAR', false, 5, null);
		$this->addColumn('CEDULA', 'Cedula', 'VARCHAR', false, 20, null);
		$this->addColumn('PRIMER_APELLIDO', 'PrimerApellido', 'VARCHAR', false, 50, null);
		$this->addColumn('SEGUNDO_APELLIDO', 'SegundoApellido', 'VARCHAR', false, 50, null);
		$this->addColumn('PRIMER_NOMBRE', 'PrimerNombre', 'VARCHAR', false, 50, null);
		$this->addColumn('SEGUNDO_NOMBRE', 'SegundoNombre', 'VARCHAR', false, 50, null);
		$this->addColumn('COD', 'Cod', 'VARCHAR', false, 20, null);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
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

} // TsurCneTableMap
