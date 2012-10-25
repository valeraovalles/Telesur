<?php


/**
 * This class defines the structure of the 'bit_categorias' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Oct 24 11:49:50 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class BitCategoriasTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BitCategoriasTableMap';

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
		$this->setName('bit_categorias');
		$this->setPhpName('BitCategorias');
		$this->setClassname('BitCategorias');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('bit_categorias_id_categoria_seq');
		// columns
		$this->addPrimaryKey('ID_CATEGORIA', 'IdCategoria', 'INTEGER', true, null, null);
		$this->addColumn('DESCRIPCION', 'Descripcion', 'VARCHAR', false, 100, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('BitCategoriasUnidades', 'BitCategoriasUnidades', RelationMap::ONE_TO_ONE, array('id_categoria' => 'id_categoria', ), null, null);
    $this->addRelation('BitSubcategorias', 'BitSubcategorias', RelationMap::ONE_TO_MANY, array('id_categoria' => 'id_categoria', ), null, null);
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

} // BitCategoriasTableMap