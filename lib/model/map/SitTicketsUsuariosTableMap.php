<?php


/**
 * This class defines the structure of the 'sit_tickets_usuarios' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Oct 24 11:49:54 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class SitTicketsUsuariosTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SitTicketsUsuariosTableMap';

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
		$this->setName('sit_tickets_usuarios');
		$this->setPhpName('SitTicketsUsuarios');
		$this->setClassname('SitTicketsUsuarios');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID_TICKET', 'IdTicket', 'INTEGER' , 'sit_tickets', 'ID_TICKET', true, null, null);
		$this->addForeignKey('ID_USUARIO', 'IdUsuario', 'INTEGER', 'sf_guard_user_profile', 'USER_ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('SitTickets', 'SitTickets', RelationMap::MANY_TO_ONE, array('id_ticket' => 'id_ticket', ), null, null);
    $this->addRelation('SfGuardUserProfile', 'SfGuardUserProfile', RelationMap::MANY_TO_ONE, array('id_usuario' => 'user_id', ), null, null);
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

} // SitTicketsUsuariosTableMap
