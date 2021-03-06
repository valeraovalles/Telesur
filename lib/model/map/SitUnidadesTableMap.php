<?php


/**
 * This class defines the structure of the 'sit_unidades' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Dec 27 12:53:45 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class SitUnidadesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SitUnidadesTableMap';

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
		$this->setName('sit_unidades');
		$this->setPhpName('SitUnidades');
		$this->setClassname('SitUnidades');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('sit_unidades_id_unidad_seq');
		// columns
		$this->addPrimaryKey('ID_UNIDAD', 'IdUnidad', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', true, 100, null);
		$this->addColumn('CORREO', 'Correo', 'VARCHAR', true, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('BitCategoriasUnidades', 'BitCategoriasUnidades', RelationMap::ONE_TO_MANY, array('id_unidad' => 'id_unidad', ), null, null);
    $this->addRelation('SitCategoriasUnidades', 'SitCategoriasUnidades', RelationMap::ONE_TO_MANY, array('id_unidad' => 'id_unidad', ), null, null);
    $this->addRelation('SitTickets', 'SitTickets', RelationMap::ONE_TO_MANY, array('id_unidad' => 'id_unidad', ), null, null);
    $this->addRelation('SitUsuariosUnidades', 'SitUsuariosUnidades', RelationMap::ONE_TO_MANY, array('id_unidad' => 'id_unidad', ), null, null);
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

} // SitUnidadesTableMap
