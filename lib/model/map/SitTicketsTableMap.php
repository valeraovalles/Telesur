<?php


/**
 * This class defines the structure of the 'sit_tickets' table.
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
class SitTicketsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SitTicketsTableMap';

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
		$this->setName('sit_tickets');
		$this->setPhpName('SitTickets');
		$this->setClassname('SitTickets');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('sit_tickets_id_ticket_seq');
		// columns
		$this->addPrimaryKey('ID_TICKET', 'IdTicket', 'INTEGER', true, null, null);
		$this->addForeignKey('ID_UNIDAD', 'IdUnidad', 'INTEGER', 'sit_unidades', 'ID_UNIDAD', true, null, null);
		$this->addForeignKey('ID_SOLICITANTE', 'IdSolicitante', 'INTEGER', 'sf_guard_user_profile', 'USER_ID', true, null, null);
		$this->addForeignKey('ID_CATEGORIA', 'IdCategoria', 'INTEGER', 'sit_categorias', 'ID_CATEGORIA', false, null, null);
		$this->addForeignKey('ID_SUBCATEGORIA', 'IdSubcategoria', 'INTEGER', 'sit_subcategorias', 'ID_SUBCATEGORIA', false, null, null);
		$this->addColumn('FECHA_SOLICITUD', 'FechaSolicitud', 'DATE', true, null, null);
		$this->addColumn('HORA_SOLICITUD', 'HoraSolicitud', 'TIME', true, null, null);
		$this->addColumn('FECHA_SOLUCION', 'FechaSolucion', 'DATE', false, null, null);
		$this->addColumn('HORA_SOLUCION', 'HoraSolucion', 'TIME', false, null, null);
		$this->addColumn('SOLICITUD', 'Solicitud', 'VARCHAR', true, 1000, null);
		$this->addColumn('SOLUCION', 'Solucion', 'VARCHAR', false, 500, null);
		$this->addColumn('REASIGNADO', 'Reasignado', 'BOOLEAN', true, null, false);
		$this->addColumn('ESTATUS', 'Estatus', 'VARCHAR', true, 2, null);
		$this->addColumn('ARCHIVOS', 'Archivos', 'VARCHAR', false, 500, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('SitUnidades', 'SitUnidades', RelationMap::MANY_TO_ONE, array('id_unidad' => 'id_unidad', ), null, null);
    $this->addRelation('SfGuardUserProfile', 'SfGuardUserProfile', RelationMap::MANY_TO_ONE, array('id_solicitante' => 'user_id', ), null, null);
    $this->addRelation('SitCategorias', 'SitCategorias', RelationMap::MANY_TO_ONE, array('id_categoria' => 'id_categoria', ), null, null);
    $this->addRelation('SitSubcategorias', 'SitSubcategorias', RelationMap::MANY_TO_ONE, array('id_subcategoria' => 'id_subcategoria', ), null, null);
    $this->addRelation('SitComentarios', 'SitComentarios', RelationMap::ONE_TO_MANY, array('id_ticket' => 'id_ticket', ), null, null);
    $this->addRelation('SitTicketsReasignados', 'SitTicketsReasignados', RelationMap::ONE_TO_ONE, array('id_ticket' => 'id_ticket', ), null, null);
    $this->addRelation('SitTicketsUsuarios', 'SitTicketsUsuarios', RelationMap::ONE_TO_ONE, array('id_ticket' => 'id_ticket', ), null, null);
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

} // SitTicketsTableMap
