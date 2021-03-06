<?php


/**
 * This class defines the structure of the 'tra_datos_externos' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Dec 27 12:53:46 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TraDatosExternosTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TraDatosExternosTableMap';

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
		$this->setName('tra_datos_externos');
		$this->setPhpName('TraDatosExternos');
		$this->setClassname('TraDatosExternos');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('tra_datos_externos_id_externo_seq');
		// columns
		$this->addPrimaryKey('ID_EXTERNO', 'IdExterno', 'INTEGER', true, null, null);
		$this->addColumn('CEDULA', 'Cedula', 'VARCHAR', true, 15, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 50, null);
		$this->addColumn('APELLIDO', 'Apellido', 'VARCHAR', true, 50, null);
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

} // TraDatosExternosTableMap
