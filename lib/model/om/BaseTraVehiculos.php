<?php

/**
 * Base class that represents a row from the 'tra_vehiculos' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Sep 14 15:26:14 2012
 *
 * @package    lib.model.om
 */
abstract class BaseTraVehiculos extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TraVehiculosPeer
	 */
	protected static $peer;

	/**
	 * The value for the id_vehiculo field.
	 * @var        int
	 */
	protected $id_vehiculo;

	/**
	 * The value for the modelo field.
	 * @var        string
	 */
	protected $modelo;

	/**
	 * The value for the ano field.
	 * @var        int
	 */
	protected $ano;

	/**
	 * The value for the placa field.
	 * @var        string
	 */
	protected $placa;

	/**
	 * The value for the color field.
	 * @var        string
	 */
	protected $color;

	/**
	 * The value for the carro field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $carro;

	/**
	 * @var        array TraAsignaciones[] Collection to store aggregation of TraAsignaciones objects.
	 */
	protected $collTraAsignacioness;

	/**
	 * @var        Criteria The criteria used to select the current contents of collTraAsignacioness.
	 */
	private $lastTraAsignacionesCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'TraVehiculosPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->carro = true;
	}

	/**
	 * Initializes internal state of BaseTraVehiculos object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id_vehiculo] column value.
	 * 
	 * @return     int
	 */
	public function getIdVehiculo()
	{
		return $this->id_vehiculo;
	}

	/**
	 * Get the [modelo] column value.
	 * 
	 * @return     string
	 */
	public function getModelo()
	{
		return $this->modelo;
	}

	/**
	 * Get the [ano] column value.
	 * 
	 * @return     int
	 */
	public function getAno()
	{
		return $this->ano;
	}

	/**
	 * Get the [placa] column value.
	 * 
	 * @return     string
	 */
	public function getPlaca()
	{
		return $this->placa;
	}

	/**
	 * Get the [color] column value.
	 * 
	 * @return     string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * Get the [carro] column value.
	 * 
	 * @return     boolean
	 */
	public function getCarro()
	{
		return $this->carro;
	}

	/**
	 * Set the value of [id_vehiculo] column.
	 * 
	 * @param      int $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setIdVehiculo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id_vehiculo !== $v) {
			$this->id_vehiculo = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::ID_VEHICULO;
		}

		return $this;
	} // setIdVehiculo()

	/**
	 * Set the value of [modelo] column.
	 * 
	 * @param      string $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setModelo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->modelo !== $v) {
			$this->modelo = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::MODELO;
		}

		return $this;
	} // setModelo()

	/**
	 * Set the value of [ano] column.
	 * 
	 * @param      int $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setAno($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ano !== $v) {
			$this->ano = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::ANO;
		}

		return $this;
	} // setAno()

	/**
	 * Set the value of [placa] column.
	 * 
	 * @param      string $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setPlaca($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->placa !== $v) {
			$this->placa = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::PLACA;
		}

		return $this;
	} // setPlaca()

	/**
	 * Set the value of [color] column.
	 * 
	 * @param      string $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setColor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->color !== $v) {
			$this->color = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::COLOR;
		}

		return $this;
	} // setColor()

	/**
	 * Set the value of [carro] column.
	 * 
	 * @param      boolean $v new value
	 * @return     TraVehiculos The current object (for fluent API support)
	 */
	public function setCarro($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->carro !== $v || $this->isNew()) {
			$this->carro = $v;
			$this->modifiedColumns[] = TraVehiculosPeer::CARRO;
		}

		return $this;
	} // setCarro()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->carro !== true) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id_vehiculo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->modelo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ano = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->placa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->color = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->carro = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = TraVehiculosPeer::NUM_COLUMNS - TraVehiculosPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TraVehiculos object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TraVehiculosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TraVehiculosPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collTraAsignacioness = null;
			$this->lastTraAsignacionesCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TraVehiculosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseTraVehiculos:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				TraVehiculosPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseTraVehiculos:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TraVehiculosPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseTraVehiculos:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseTraVehiculos:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				TraVehiculosPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TraVehiculosPeer::ID_VEHICULO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TraVehiculosPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setIdVehiculo($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += TraVehiculosPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collTraAsignacioness !== null) {
				foreach ($this->collTraAsignacioness as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = TraVehiculosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTraAsignacioness !== null) {
					foreach ($this->collTraAsignacioness as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TraVehiculosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdVehiculo();
				break;
			case 1:
				return $this->getModelo();
				break;
			case 2:
				return $this->getAno();
				break;
			case 3:
				return $this->getPlaca();
				break;
			case 4:
				return $this->getColor();
				break;
			case 5:
				return $this->getCarro();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TraVehiculosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdVehiculo(),
			$keys[1] => $this->getModelo(),
			$keys[2] => $this->getAno(),
			$keys[3] => $this->getPlaca(),
			$keys[4] => $this->getColor(),
			$keys[5] => $this->getCarro(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TraVehiculosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdVehiculo($value);
				break;
			case 1:
				$this->setModelo($value);
				break;
			case 2:
				$this->setAno($value);
				break;
			case 3:
				$this->setPlaca($value);
				break;
			case 4:
				$this->setColor($value);
				break;
			case 5:
				$this->setCarro($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TraVehiculosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdVehiculo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setModelo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAno($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPlaca($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setColor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCarro($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);

		if ($this->isColumnModified(TraVehiculosPeer::ID_VEHICULO)) $criteria->add(TraVehiculosPeer::ID_VEHICULO, $this->id_vehiculo);
		if ($this->isColumnModified(TraVehiculosPeer::MODELO)) $criteria->add(TraVehiculosPeer::MODELO, $this->modelo);
		if ($this->isColumnModified(TraVehiculosPeer::ANO)) $criteria->add(TraVehiculosPeer::ANO, $this->ano);
		if ($this->isColumnModified(TraVehiculosPeer::PLACA)) $criteria->add(TraVehiculosPeer::PLACA, $this->placa);
		if ($this->isColumnModified(TraVehiculosPeer::COLOR)) $criteria->add(TraVehiculosPeer::COLOR, $this->color);
		if ($this->isColumnModified(TraVehiculosPeer::CARRO)) $criteria->add(TraVehiculosPeer::CARRO, $this->carro);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);

		$criteria->add(TraVehiculosPeer::ID_VEHICULO, $this->id_vehiculo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getIdVehiculo();
	}

	/**
	 * Generic method to set the primary key (id_vehiculo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setIdVehiculo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TraVehiculos (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setModelo($this->modelo);

		$copyObj->setAno($this->ano);

		$copyObj->setPlaca($this->placa);

		$copyObj->setColor($this->color);

		$copyObj->setCarro($this->carro);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getTraAsignacioness() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTraAsignaciones($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setIdVehiculo(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     TraVehiculos Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     TraVehiculosPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TraVehiculosPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collTraAsignacioness collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTraAsignacioness()
	 */
	public function clearTraAsignacioness()
	{
		$this->collTraAsignacioness = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTraAsignacioness collection (array).
	 *
	 * By default this just sets the collTraAsignacioness collection to an empty array (like clearcollTraAsignacioness());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTraAsignacioness()
	{
		$this->collTraAsignacioness = array();
	}

	/**
	 * Gets an array of TraAsignaciones objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this TraVehiculos has previously been saved, it will retrieve
	 * related TraAsignacioness from storage. If this TraVehiculos is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array TraAsignaciones[]
	 * @throws     PropelException
	 */
	public function getTraAsignacioness($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTraAsignacioness === null) {
			if ($this->isNew()) {
			   $this->collTraAsignacioness = array();
			} else {

				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				TraAsignacionesPeer::addSelectColumns($criteria);
				$this->collTraAsignacioness = TraAsignacionesPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				TraAsignacionesPeer::addSelectColumns($criteria);
				if (!isset($this->lastTraAsignacionesCriteria) || !$this->lastTraAsignacionesCriteria->equals($criteria)) {
					$this->collTraAsignacioness = TraAsignacionesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTraAsignacionesCriteria = $criteria;
		return $this->collTraAsignacioness;
	}

	/**
	 * Returns the number of related TraAsignaciones objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TraAsignaciones objects.
	 * @throws     PropelException
	 */
	public function countTraAsignacioness(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTraAsignacioness === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				$count = TraAsignacionesPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				if (!isset($this->lastTraAsignacionesCriteria) || !$this->lastTraAsignacionesCriteria->equals($criteria)) {
					$count = TraAsignacionesPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collTraAsignacioness);
				}
			} else {
				$count = count($this->collTraAsignacioness);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a TraAsignaciones object to this object
	 * through the TraAsignaciones foreign key attribute.
	 *
	 * @param      TraAsignaciones $l TraAsignaciones
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTraAsignaciones(TraAsignaciones $l)
	{
		if ($this->collTraAsignacioness === null) {
			$this->initTraAsignacioness();
		}
		if (!in_array($l, $this->collTraAsignacioness, true)) { // only add it if the **same** object is not already associated
			array_push($this->collTraAsignacioness, $l);
			$l->setTraVehiculos($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TraVehiculos is new, it will return
	 * an empty collection; or if this TraVehiculos has previously
	 * been saved, it will retrieve related TraAsignacioness from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TraVehiculos.
	 */
	public function getTraAsignacionessJoinTraSolicitudes($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTraAsignacioness === null) {
			if ($this->isNew()) {
				$this->collTraAsignacioness = array();
			} else {

				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				$this->collTraAsignacioness = TraAsignacionesPeer::doSelectJoinTraSolicitudes($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

			if (!isset($this->lastTraAsignacionesCriteria) || !$this->lastTraAsignacionesCriteria->equals($criteria)) {
				$this->collTraAsignacioness = TraAsignacionesPeer::doSelectJoinTraSolicitudes($criteria, $con, $join_behavior);
			}
		}
		$this->lastTraAsignacionesCriteria = $criteria;

		return $this->collTraAsignacioness;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TraVehiculos is new, it will return
	 * an empty collection; or if this TraVehiculos has previously
	 * been saved, it will retrieve related TraAsignacioness from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TraVehiculos.
	 */
	public function getTraAsignacionessJoinSfGuardUserProfile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraVehiculosPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTraAsignacioness === null) {
			if ($this->isNew()) {
				$this->collTraAsignacioness = array();
			} else {

				$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

				$this->collTraAsignacioness = TraAsignacionesPeer::doSelectJoinSfGuardUserProfile($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TraAsignacionesPeer::ID_VEHICULO, $this->id_vehiculo);

			if (!isset($this->lastTraAsignacionesCriteria) || !$this->lastTraAsignacionesCriteria->equals($criteria)) {
				$this->collTraAsignacioness = TraAsignacionesPeer::doSelectJoinSfGuardUserProfile($criteria, $con, $join_behavior);
			}
		}
		$this->lastTraAsignacionesCriteria = $criteria;

		return $this->collTraAsignacioness;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTraAsignacioness) {
				foreach ((array) $this->collTraAsignacioness as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collTraAsignacioness = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseTraVehiculos:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseTraVehiculos::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseTraVehiculos
