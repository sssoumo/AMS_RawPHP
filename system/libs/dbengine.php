<?php

/**
 * Database
 *
 * This class is to use DB methods
 *
 * PHP version 5.3.13
 *
 * MIT License
 *
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   PHP Class
 * @package    PDO
 * @author     Siddiqui Noor <siddiquinoor.com>
 * @copyright  2017 Siddiqui Noor
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 *
 * @example code
 *
 * $config = array("host"=>"localhost", "dbname"=>'sampledb', "username"=>'root', "password"=>'');
 * $db = new Database($config);
 * $db->set_error_log(true);
 */

/**
 * Include DB Helper Class
 */
require_once 'dbhelper.php';

/** Class Start **/
class DBEngine extends PDO
{
    /**
     * PHP Statement Handler
     *
     * @var object
     */
    private $_objStmtH = null;
    /**
     * PDO SQL Statement
     *
     * @var string
     */
    public $strSQL = '';
    /**
     * PDO SQL table name
     *
     * @var string
     */
    public $strTable = '';
    /**
     * PDO SQL Where Condition
     *
     * @var array
     */
    public $arrWhere = array();
    /**
     * PDO SQL table column
     *
     * @var array
     */
    public $arrColumn = array();
    /**
     * PDO SQL Other condition
     *
     * @var string
     */
    public $strOther = '';
    /**
     * PDO Results,Fetch All PDO Results array
     *
     * @var array
     */
    public $arrResults = array();
    /**
     * PDO Result,Fetch One PDO Row
     *
     * @var array
     */
    public $arrResult = array();
    /**
     * Get PDO Last Insert ID
     *
     * @var integer
     */
    public $intLastId = 0;
    /**
     * PDO last insert di in array
     * using with INSERT BATCH Query
     *
     * @var array
     */
    public $intAllLastId = array();
    /**
     * Get PDO Error
     *
     * @var string
     */
    public $strPdoError = '';
    /**
     * Get All PDO Affected Rows
     *
     * @var integer
     */
    public $intAffectedRows = 0;
    /**
     * Catch temp data
     * @var null
     */
    public $arrData = null;
    /**
     * Enable/Disable class debug mode
     *
     * @var boolean
     */
    public $log = false;
    /**
     * Set flag for batch insert
     * @var bool
     */
    public $batch = false;
    /**
     * PDO Error File
     *
     * @var string
     */
    const ERROR_LOG_FILE = 'DBErrors.log';
    /**
     * PDO SQL log File
     *
     * @var string
     */
    const SQL_LOG_FILE = 'DBSql.log';
    /**
     * PDO Config/Settings
     *
     * @var array
     */
    private $db_info = array();
    /**
     * Set PDO valid Query operation
     *
     * @var array
     */
    private $arrValidOperation = array('SELECT', 'INSERT', 'UPDATE', 'DELETE');
    /**
     * DBEngine PDO Object
     *
     * @var object
     */
    protected static $objDBEngine = null;

    /**
     * Auto Start on Object init
     *
     * @param array $dsn
     *
     * @throws Exception
     */
    public function __construct($dsn = array())
    {
        // if isset $dsn and it is array
        if (is_array($dsn) && count($dsn) > 0) {
            // check valid array key name
            if (!isset($dsn['host']) || !isset($dsn['dbname']) || !isset($dsn['username']) || !isset($dsn['password'])) {
                die("You haven't pass valid db config array key.");
            }
            $this->db_info = $dsn;
        } else {
            if (count($this->db_info) > 0) {
                $dsn = $this->db_info;
                // check valid array key name
                if (!isset($dsn['host']) || !isset($dsn['dbname']) || !isset($dsn['username']) || !isset($dsn['password'])) {
                    die("You haven't set valid db config array key.");
                }
            } else {
                die("You haven't set valid db config array.");
            }
        }
        // Okay, everything is clear. now connect
        // spilt array key in php variable
        extract($this->db_info);
        // try catch block start
        try {
            // use native pdo class and connect
            parent::__construct("mysql:host=$host; dbname=$dbname", $username, $password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            // set pdo error mode silent
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            /** If you want to Show Class exceptions on Screen, Uncomment below code **/
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /** Use this setting to force PDO to either always emulate prepared statements (if TRUE),
             * or to try to use native prepared statements (if FALSE). **/
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            // set default pdo fetch mode as fetch assoc
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // get pdo error and pass on error method
            die("ERROR in establish connection: " . $e->getMessage());
        }
    }

    /**
     * Unset The Class Object PDO
     */
    public function __destruct()
    {
        self::$objDBEngine = null;
    }

    /**
     * Get Instance of DBEngine Class as Singleton Pattern
     *
     * @param array $dsn
     *
     * @return object $objDBEngine
     */
    public static function getDBEngine($dsn = array())
    {
        // if not set self DBEngine object property or DBEngine set as null
        if (!isset(self::$objDBEngine) || (self::$objDBEngine !== null)) {
            // set class pdo property with new connection
            self::$objDBEngine = new self($dsn);
        }
        // return class property object
        return self::$objDBEngine;
    }

    /**
     * Start PDO Transaction
     */
    public function start()
    {
        /*** begin the transaction ***/
        $this->beginTransaction();
    }

    /**
     * Start PDO Commit
     */
    public function end()
    {
        /*** commit the transaction ***/
        $this->commit();
    }

    /**
     * Start PDO Rollback
     */
    public function back()
    {
        /*** roll back the transaction if we fail ***/
        $this->rollback();
    }

    /**
     * Return PDO Query result by index value
     *
     * @param int $iRow
     *
     * @return array:boolean
     */
    public function result($iRow = 0)
    {
        return isset($this->arrResults[$iRow]) ? $this->arrResults[$iRow] : false;
    }

    /**
     * Return PDO Query results array/json/xml type
     *
     * @param string $type
     *
     * @return mixed
     */
    public function results($type = 'array')
    {
        switch ($type) {
            case 'array':
                // return array data
                return $this->arrResults;
                break;
            case 'xml':
                //send the xml header to the browser
                header("Content-Type:text/xml");
                // return xml content
                return $this->helper()->array_to_xml($this->arrResults);
                break;
            case 'json':
                // set header as json
                header('Content-type: application/json; charset="utf-8"');
                // return json encoded data
                return json_encode($this->arrResults);
                break;
        }
    }

    /**
     * Get Affected rows by PDO Statement
     *
     * @return number:boolean
     */
    public function affected_rows()
    {
        return is_numeric($this->intAffectedRows) ? $this->intAffectedRows : false;
    }

    /**
     * Get Last Insert id by Insert query
     *
     * @return number
     */
    public function get_last_insert_id()
    {
        return $this->intLastId;
    }

    /**
     * Get all last insert id by insert batch query
     *
     * @return array
     */
    public function get_all_last_insert_id()
    {
        return $this->intAllLastId;
    }

    /**
     * Get Helper Object
     *
     * @return DBHelper
     */
    public function helper()
    {
        return new DBHelper();
    }

    /**
     * Execute RAW Query
     *
     * @param string $strSQL
     * @param array Bind Param Value
     *
     * @return DBWrapper|multi type:|number
     */
    public function query($strSQL = '', $arrBindWhereParam = array())
    {
        // clean query from white space
        $strSQL = trim($strSQL);
        // get operation type
        $operation = explode(' ', $strSQL);
        // make first word in uppercase
        $operation[0] = strtoupper($operation[0]);
        // check valid sql operation statement
        if (!in_array($operation[0], $this->arrValidOperation)) {
            self::error('invalid operation called in query. use only ' . implode(', ', $this->arrValidOperation));
        }
        // sql query pass with no bind param
        if (!empty($strSQL) && count($arrBindWhereParam) <= 0) {
            // set class property with pass value
            $this->strSQL = $strSQL;
            // set class statement handler
            $this->_objStmtH = $this->prepare($this->strSQL);
            // try catch block start
            try {
                // execute pdo statement
                if ($this->_objStmtH->execute()) {
                    // get affected rows and set it to class property
                    $this->intAffectedRows = $this->_objStmtH->rowCount();
                    // set pdo result array with class property
                    $this->arrResults = $this->_objStmtH->fetchAll();
                    // close pdo cursor
                    $this->_objStmtH->closeCursor();
                    // return pdo result
                    return $this;
                } else {
                    // if not run pdo statement sed error
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                self::error($e->getMessage() . ': ' . __LINE__);
            } // end try catch block
        } // if query pass with bind param
        else if (!empty($strSQL) && count($arrBindWhereParam) > 0) {
            // set class property with pass query
            $this->strSQL = $strSQL;
            // set class where array
            $this->arrData = $arrBindWhereParam;
            // set class pdo statement handler
            $this->_objStmtH = $this->prepare($this->strSQL);
            // start binding fields
            // bind pdo param
            $this->_bind_pdo_param($arrBindWhereParam);
            // use try catch block to get pdo error
            try {
                // run pdo statement with bind param
                if ($this->_objStmtH->execute()) {
                    // check operation type
                    switch ($operation[0]):
                        case 'SELECT':
                            // get affected rows by select statement
                            $this->intAffectedRows = $this->_objStmtH->rowCount();
                            // get pdo result array
                            $this->arrResults = $this->_objStmtH->fetchAll();
                            // return PDO instance
                            return $this;
                            break;
                        case 'INSERT':
                            // return last insert id
                            $this->intLastId = $this->lastInsertId();
                            // return PDO instance
                            return $this;
                            break;
                        case 'UPDATE':
                            // get affected rows
                            $this->intAffectedRows = $this->_objStmtH->rowCount();
                            // return PDO instance
                            return $this;
                            break;
                        case 'DELETE':
                            // get affected rows
                            $this->intAffectedRows = $this->_objStmtH->rowCount();
                            // return PDO instance
                            return $this;
                            break;
                    endswitch;
                    // close pdo cursor
                    $this->_objStmtH->closeCursor();
                } else {
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                self::error($e->getMessage() . ': ' . __LINE__);
            } // end try catch block to get pdo error
        } else {
            self::error('Query is empty..');
        }
    }

    /**
     * MySQL SELECT Query/Statement
     *
     * @param string $strTable
     * @param array $arrColumn
     * @param array $arrWhere
     * @param string $strOther
     *
     * @return multi type: array/error
     */
    public function select($strTable = '', $arrColumn = array(), $arrWhere = array(), $strOther = '')
    {
        // handle column array data
        if (!is_array($arrColumn)) $arrColumn = array();
        // get field if pass otherwise use *
        $sField = count($arrColumn) > 0 ? implode(', ', $arrColumn) : '*';
        // check if table name not empty
        if (!empty($strTable)) {
            // if more then 0 array found in where array
            if (count($arrWhere) > 0 && is_array($arrWhere)) {
                // set class where array
                $this->arrData = $arrWhere;
                // parse where array and get in temp var with key name and val
                if (strstr(key($arrWhere), ' ')) {
                    $tmp = $this->custom_where($this->arrData);
                    // get where syntax with namespace
                    $strWhere = $tmp['where'];
                } else {
                    foreach ($arrWhere as $k => $v) {
                        $tmp[] = "$k = :s_$k";
                    }
                    // join temp array with AND condition
                    $strWhere = implode(' AND ', $tmp);
                }
                // unset temp var
                unset($tmp);
                // set class sql property
                $this->strSQL = "SELECT $sField FROM `$strTable` WHERE $strWhere $strOther;";
            } else {
                // if no where condition pass by user
                $this->strSQL = "SELECT $sField FROM `$strTable` $strOther;";
            }
            // pdo prepare statement with sql query
            $this->_objStmtH = $this->prepare($this->strSQL);
            // if where condition has valid array number
            if (count($arrWhere) > 0 && is_array($arrWhere)) {
                // bind pdo param
                $this->_bind_pdo_name_space($arrWhere);
            } // if end here
            // use try catch block to get pdo error
            try {
                // check if pdo execute
                if ($this->_objStmtH->execute()) {
                    // set class property with affected rows
                    $this->intAffectedRows = $this->_objStmtH->rowCount();
                    // set class property with sql result
                    $this->arrResults = $this->_objStmtH->fetchAll();
                    // close pdo
                    $this->_objStmtH->closeCursor();
                    // return self object
                    return $this;
                } else {
                    // catch pdo error
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                // get pdo error and pass on error method
                self::error($e->getMessage() . ': ' . __LINE__);
            } // end try catch block to get pdo error
        } // if table name empty
        else {
            self::error('Table name not found..');
        }
    }

    /**
     * Execute PDO Insert
     *
     * @param string $strTable
     * @param array $arrData
     *
     * @return number last insert ID
     */
    public function insert($strTable, $arrData = array())
    {
        // check if table name not empty
        if (!empty($strTable)) {
            // and array data not empty
            if (count($arrData) > 0 && is_array($arrData)) {
                // get array insert data in temp array
                foreach ($arrData as $f => $v) {
                    $tmp[] = ":s_$f";
                }
                // make name space param for pdo insert statement
                $sNameSpaceParam = implode(',', $tmp);
                // unset temp var
                unset($tmp);
                // get insert fields name
                $sFields = implode(',', array_keys($arrData));
                // set pdo insert statement in class property
                $this->strSQL = "INSERT INTO `$strTable` ($sFields) VALUES ($sNameSpaceParam);";
                // pdo prepare statement
                $this->_objStmtH = $this->prepare($this->strSQL);
                // set class where property with array data
                $this->arrData = $arrData;
                // bind pdo param
                $this->_bind_pdo_name_space($arrData);
                // use try catch block to get pdo error
                try {
                    // execute pdo statement
                    if ($this->_objStmtH->execute()) {
                        // set class property with last insert id
                        $this->intLastId = $this->lastInsertId();
                        // close pdo
                        $this->_objStmtH->closeCursor();
                        // return this object
                        return $this;
                    } else {
                        self::error($this->_objStmtH->errorInfo());
                    }
                } catch (PDOException $e) {
                    // get pdo error and pass on error method
                    self::error($e->getMessage() . ': ' . __LINE__);
                }
            } else {
                self::error('Data not in valid format..');
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Execute PDO Insert as Batch Data
     *
     * @param string $strTable mysql table name
     * @param array $arrData mysql insert array data
     * @param boolean $safeModeInsert set true if want to use pdo bind param
     *
     * @return number last insert ID
     */
    public function insert_batch($strTable, $arrData = array(), $safeModeInsert = true)
    {
        // PDO transactions start
        $this->start();
        // check if table name not empty
        if (!empty($strTable)) {
            // and array data not empty
            if (count($arrData) > 0 && is_array($arrData)) {
                // get array insert data in temp array
                foreach ($arrData[0] as $f => $v) {
                    $tmp[] = ":s_$f";
                }
                // make name space param for pdo insert statement
                $sNameSpaceParam = implode(', ', $tmp);
                // unset temp var
                unset($tmp);
                // get insert fields name
                $sFields = implode(', ', array_keys($arrData[0]));
                // handle safe mode. If it is set as false means user not using bind param in pdo
                if (!$safeModeInsert) {
                    // set pdo insert statement in class property
                    $this->strSQL = "INSERT INTO `$strTable` ($sFields) VALUES ";
                    foreach ($arrData as $key => $value) {
                        $this->strSQL .= '(' . "'" . implode("', '", array_values($value)) . "'" . '), ';
                    }
                    $this->strSQL = rtrim($this->strSQL, ', ');
                    // return this object
                    // return $this;
                    // pdo prepare statement
                    $this->_objStmtH = $this->prepare($this->strSQL);
                    // start try catch block
                    try {
                        // execute pdo statement
                        if ($this->_objStmtH->execute()) {
                            // store all last insert id in array
                            $this->intAllLastId[] = $this->lastInsertId();
                        } else {
                            self::error($this->_objStmtH->errorInfo());
                        }
                    } catch (PDOException $e) {
                        // get pdo error and pass on error method
                        self::error($e->getMessage() . ': ' . __LINE__);
                        // PDO Rollback
                        $this->back();
                    } // end try catch block
                    // PDO Commit
                    $this->end();
                    // close pdo
                    $this->_objStmtH->closeCursor();
                    // return this object
                    return $this;
                }
                // end here safe mode
                // set pdo insert statement in class property
                $this->strSQL = "INSERT INTO `$strTable` ($sFields) VALUES ($sNameSpaceParam);";
                // pdo prepare statement
                $this->_objStmtH = $this->prepare($this->strSQL);
                // set class property with array
                $this->arrData = $arrData;
                // set batch insert flag true
                $this->batch = true;
                // parse batch array data
                foreach ($arrData as $key => $value) {
                    // bind pdo param
                    $this->_bind_pdo_name_space($value);
                    try {
                        // execute pdo statement
                        if ($this->_objStmtH->execute()) {
                            // set class property with last insert id as array
                            $this->intAllLastId[] = $this->lastInsertId();
                        } else {
                            self::error($this->_objStmtH->errorInfo());
                            // on error PDO Rollback
                            $this->back();
                        }
                    } catch (PDOException $e) {
                        // get pdo error and pass on error method
                        self::error($e->getMessage() . ': ' . __LINE__);
                        // on error PDO Rollback
                        $this->back();
                    }
                }
                // fine now PDO Commit
                $this->end();
                // close pdo
                $this->_objStmtH->closeCursor();
                // return this object
                return $this;
            } else {
                self::error('Data not in valid format..');
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Execute PDO Update Statement
     * Get No OF Affected Rows updated
     *
     * @param string $strTable
     * @param array $arrData
     * @param array $arrWhere
     * @param string $strOther
     *
     * @return number
     */
    public function update($strTable = '', $arrData = array(), $arrWhere = array(), $strOther = '')
    {
        // if table name is empty
        if (!empty($strTable)) {
            // check if array data and where array is more then 0
            if (count($arrData) > 0 && count($arrWhere) > 0) {
                // parse array data and make a temp array
                foreach ($arrData as $k => $v) {
                    $tmp[] = "$k = :s_$k";
                }
                // join temp array value with ,
                $sFields = implode(', ', $tmp);
                // delete temp array from memory
                unset($tmp);
                // parse where array and store in temp array
                foreach ($arrWhere as $k => $v) {
                    $tmp[] = "$k = :s_$k";
                }
                $this->arrData = $arrData;
                $this->arrWhere = $arrWhere;
                // join where array value with AND operator and create where condition
                $strWhere = implode(' AND ', $tmp);
                // unset temp array
                unset($tmp);
                // make sql query to update
                $this->strSQL = "UPDATE `$strTable` SET $sFields WHERE $strWhere $strOther;";
                // on PDO prepare statement
                $this->_objStmtH = $this->prepare($this->strSQL);
                // bind pdo param for update statement
                $this->_bind_pdo_name_space($arrData);
                // bind pdo param for where clause
                $this->_bind_pdo_name_space($arrWhere);
                // try catch block start
                try {
                    // if PDO run
                    if ($this->_objStmtH->execute()) {
                        // get affected rows
                        $this->intAffectedRows = $this->_objStmtH->rowCount();
                        // close PDO
                        $this->_objStmtH->closeCursor();
                        // return self object
                        return $this;
                    } else {
                        self::error($this->_objStmtH->errorInfo());
                    }
                } catch (PDOException $e) {
                    // get pdo error and pass on error method
                    self::error($e->getMessage() . ': ' . __LINE__);
                } // try catch block end
            } else {
                self::error('update statement not in valid format..');
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Execute PDO Delete Query
     *
     * @param string $strTable
     * @param array $arrWhere
     * @param string $strOther
     *
     * @return object PDO object
     */
    public function delete($strTable, $arrWhere = array(), $strOther = '')
    {
        // if table name not pass
        if (!empty($strTable)) {
            // check where condition array length
            if (count($arrWhere) > 0 && is_array($arrWhere)) {
                // make an temp array from where array data
                foreach ($arrWhere as $k => $v) {
                    $tmp[] = "$k = :s_$k";
                }
                // join array values with AND Operator
                $strWhere = implode(' AND ', $tmp);
                // delete temp array
                unset($tmp);
                // set DELETE PDO Statement
                $this->strSQL = "DELETE FROM `$strTable` WHERE $strWhere $strOther;";
                // Call PDo Prepare Statement
                $this->_objStmtH = $this->prepare($this->strSQL);
                // bind delete where param
                $this->_bind_pdo_name_space($arrWhere);
                // set array data
                $this->arrData = $arrWhere;
                // Use try Catch
                try {
                    if ($this->_objStmtH->execute()) {
                        // get affected rows
                        $this->intAffectedRows = $this->_objStmtH->rowCount();
                        // close pdo
                        $this->_objStmtH->closeCursor();
                        // return this object
                        return $this;
                    } else {
                        self::error($this->_objStmtH->errorInfo());
                    }
                } catch (PDOException $e) {
                    // get pdo error and pass on error method
                    self::error($e->getMessage() . ': ' . __LINE__);
                } // end try catch here
            } else {
                self::error('Not a valid where condition..');
            }
        } else {
            self::error('Table name not found..');
        }
    }


    /**
     * Get Total Number Of Records in Requested Table
     *
     * @param string $strTable
     * @param string $strWhere
     * @return number
     */
    public function count($strTable = '', $strWhere = '')
    {
        // if table name not pass
        if (!empty($strTable)) {
            if (empty($strWhere)) {
                // create count query
                $this->strSQL = "SELECT COUNT(*) AS NUMROWS FROM `$strTable`;";
            } else {
                // create count query
                $this->strSQL = "SELECT COUNT(*) AS NUMROWS FROM `$strTable` WHERE $strWhere;";
            }
            // pdo prepare statement
            $this->_objStmtH = $this->prepare($this->strSQL);
            try {
                if ($this->_objStmtH->execute()) {
                    // fetch array result
                    $this->arrResults = $this->_objStmtH->fetch();
                    // close pdo
                    $this->_objStmtH->closeCursor();
                    // return number of count
                    return $this->arrResults['NUMROWS'];
                } else {
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                // get pdo error and pass on error method
                self::error($e->getMessage() . ': ' . __LINE__);
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Truncate a MySQL table
     *
     * @param string $strTable
     * @return bool
     */
    public function truncate($strTable = '')
    {
        // if table name not pass
        if (!empty($strTable)) {
            // create count query
            $this->strSQL = "TRUNCATE TABLE `$strTable`;";
            // pdo prepare statement
            $this->_objStmtH = $this->prepare($this->strSQL);
            try {
                if ($this->_objStmtH->execute()) {
                    // close pdo
                    $this->_objStmtH->closeCursor();
                    // return number of count
                    return true;
                } else {
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                // get pdo error and pass on error method
                self::error($e->getMessage() . ': ' . __LINE__);
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Drop a MySQL table
     *
     * @param string $strTable
     * @return bool
     */
    public function drop($strTable = '')
    {
        // if table name not pass
        if (!empty($strTable)) {
            // create count query
            $this->strSQL = "DROP TABLE `$strTable`;";
            // pdo prepare statement
            $this->_objStmtH = $this->prepare($this->strSQL);
            try {
                if ($this->_objStmtH->execute()) {
                    // close pdo
                    $this->_objStmtH->closeCursor();
                    // return number of count
                    return true;
                } else {
                    self::error($this->_objStmtH->errorInfo());
                }
            } catch (PDOException $e) {
                // get pdo error and pass on error method
                self::error($e->getMessage() . ': ' . __LINE__);
            }
        } else {
            self::error('Table name not found..');
        }
    }

    /**
     * Return Table Fields of Requested Table
     *
     * @param string $strTable
     *
     * @return array Field Type and Field Name
     */
    public function describe($strTable = '')
    {
        $this->strSQL = $strSQL = "DESC $strTable;";
        $this->_objStmtH = $this->prepare($strSQL);
        $this->_objStmtH->execute();
        $aColList = $this->_objStmtH->fetchAll();
        foreach ($aColList as $key) {
            $aField[] = $key['Field'];
            $aType[] = $key['Type'];
        }
        return array_combine($aField, $aType);
    }

    /**
     * @param array $array_data
     * @return array
     */
    public function custom_where($array_data = array())
    {
        $syntax = '';
        foreach ($array_data as $key => $value) {
            $key = trim($key);
            if (strstr($key, ' ')) {
                $array = explode(' ', $key);
                if (count($array) == '2') {
                    $random = '';//"_".rand(1,100);
                    $field = $array[0];
                    $operator = $array[1];
                    $tmp[] = "$field $operator :s_$field" . "$random";
                    $syntax .= " $field $operator :s_$field" . "$random ";
                } elseif (count($array) == '3') {
                    $random = '';//"_".rand(1,100);
                    $condition = $array[0];
                    $field = $array[1];
                    $operator = $array[2];
                    $tmp[] = "$condition $field $operator :s_$field" . "$random";
                    $syntax .= " $condition $field $operator :s_$field" . "$random ";
                }
            }
        }
        return array(
            'where' => $syntax,
            'bind' => implode(' ', $tmp)
        );
    }

    /**
     * PDO Bind Param with :namespace
     * @param array $array
     */
    private function _bind_pdo_name_space($array = array())
    {
        if (strstr(key($array), ' ')) {
            // bind array data in pdo
            foreach ($array as $f => $v) {
                // get table column from array key
                $field = $this->get_field_from_array_key($f);
                // check pass data type for appropriate field
                switch (gettype($array[$f])):
                    // is string found then pdo param as string
                    case 'string':
                        $this->_objStmtH->bindParam(":s" . "_" . "$field", $array[$f], PDO::PARAM_STR);
                        break;
                    // if int found then pdo param set as int
                    case 'integer':
                        $this->_objStmtH->bindParam(":s" . "_" . "$field", $array[$f], PDO::PARAM_INT);
                        break;
                    // if boolean found then set pdo param as boolean
                    case 'boolean':
                        $this->_objStmtH->bindParam(":s" . "_" . "$field", $array[$f], PDO::PARAM_BOOL);
                        break;
                endswitch;
            } // end for each here
        } else {
            // bind array data in pdo
            foreach ($array as $f => $v) {
                // check pass data type for appropriate field
                switch (gettype($array[$f])):
                    // is string found then pdo param as string
                    case 'string':
                        $this->_objStmtH->bindParam(":s" . "_" . "$f", $array[$f], PDO::PARAM_STR);
                        break;
                    // if int found then pdo param set as int
                    case 'integer':
                        $this->_objStmtH->bindParam(":s" . "_" . "$f", $array[$f], PDO::PARAM_INT);
                        break;
                    // if boolean found then set pdo param as boolean
                    case 'boolean':
                        $this->_objStmtH->bindParam(":s" . "_" . "$f", $array[$f], PDO::PARAM_BOOL);
                        break;
                endswitch;
            } // end for each here
        }
    }

    /**
     * Bind PDO Param without :namespace
     * @param array $array
     */
    private function _bind_pdo_param($array = array())
    {
        // bind array data in pdo
        foreach ($array as $f => $v) {
            // check pass data type for appropriate field
            switch (gettype($array[$f])):
                // is string found then pdo param as string
                case 'string':
                    $this->_objStmtH->bindParam($f + 1, $array[$f], PDO::PARAM_STR);
                    break;
                // if int found then pdo param set as int
                case 'integer':
                    $this->_objStmtH->bindParam($f + 1, $array[$f], PDO::PARAM_INT);
                    break;
                // if boolean found then set pdo param as boolean
                case 'boolean':
                    $this->_objStmtH->bindParam($f + 1, $array[$f], PDO::PARAM_BOOL);
                    break;
            endswitch;
        } // end for each here
    }

    /**
     * Catch Error in txt file
     *
     * @param mixed $msg
     */
    public function error($msg)
    {
        // log set as true
        if ($this->log) {
            // show executed query with error
            $this->show_query();
            // die code
            $this->helper()->error_box($msg);
        } else {
            // show error message in log file
            file_put_contents(self::ERROR_LOG_FILE, date('Y-m-d h:m:s') . ' :: ' . $msg . "\n", FILE_APPEND);
            // die with user message
            $this->helper()->error();
        }
    }

    /**
     * Show executed query on call
     * @param boolean $logfile set true if wanna log all query in file
     * @return DBWrapper
     */
    public function show_query($logfile = false)
    {
        if (!$logfile) {
            echo "<div style='color:#990099; border:1px solid #777; padding:2px; background-color: #E5E5E5;'>";
            echo " Executed Query -> <span style='color:#008000;'> ";
            echo $this->helper()->format_sql($this->interpolate_query());
            echo "</span></div>";
            return $this;
        } else {
            // show error message in log file
            file_put_contents(self::SQL_LOG_FILE, date('Y-m-d h:m:s') . ' :: ' . $this->interpolate_query() . "\n", FILE_APPEND);
            return $this;
        }
    }

    /**
     * Replaces any parameter placeholders in a query with the value of that
     * parameter. Useful for debugging. Assumes anonymous parameters from
     *
     * @return mixed
     */
    protected function interpolate_query()
    {
        $sql = $this->_objStmtH->queryString;
        // handle insert batch data
        if (!$this->batch) {
            $params = ((is_array($this->arrData)) && (count($this->arrData) > 0)) ? $this->arrData : $this->strSQL;
            if (is_array($params)) {
                # build a regular expression for each parameter
                foreach ($params as $key => $value) {
                    if (strstr($key, ' ')) {
                        $real_key = $this->get_field_from_array_key($key);
                        // update param value with quotes, if string value
                        $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                        // make replace array
                        $keys[] = is_string($real_key) ? '/:s_' . $real_key . '/' : '/[?]/';
                    } else {
                        // update param value with quotes, if string value
                        $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                        // make replace array
                        $keys[] = is_string($key) ? '/:s_' . $key . '/' : '/[?]/';
                    }
                }
                $sql = preg_replace($keys, $params, $sql, 1, $count);
                if (strstr($sql, ':s_')) {
                    foreach ($this->arrWhere as $key => $value) {
                        if (strstr($key, ' ')) {
                            $real_key = $this->get_field_from_array_key($key);
                            // update param value with quotes, if string value
                            $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                            // make replace array
                            $keys[] = is_string($real_key) ? '/:s_' . $real_key . '/' : '/[?]/';
                        } else {
                            // update param value with quotes, if string value
                            $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                            // make replace array
                            $keys[] = is_string($key) ? '/:s_' . $key . '/' : '/[?]/';
                        }
                    }
                    $sql = preg_replace($keys, $params, $sql, 1, $count);
                }
                return $sql;
                #trigger_error('replaced '.$count.' keys');
            } else {
                return $params;
            }
        } else {
            $params_batch = ((is_array($this->arrData)) && (count($this->arrData) > 0)) ? $this->arrData : $this->strSQL;
            $batch_query = '';
            if (is_array($params_batch)) {
                # build a regular expression for each parameter
                foreach ($params_batch as $keys => $params) {
                    echo $params;
                    foreach ($params as $key => $value) {
                        if (strstr($key, ' ')) {
                            $real_key = $this->get_field_from_array_key($key);
                            // update param value with quotes, if string value
                            $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                            // make replace array
                            $array_keys[] = is_string($real_key) ? '/:s_' . $real_key . '/' : '/[?]/';
                        } else {
                            // update param value with quotes, if string value
                            $params[$key] = is_string($value) ? '"' . $value . '"' : $value;
                            // make replace array
                            $array_keys[] = is_string($key) ? '/:s_' . $key . '/' : '/[?]/';
                        }
                    }
                    $batch_query .= "<br />" . preg_replace($array_keys, $params, $sql, 1, $count);
                }
                return $batch_query;
                #trigger_error('replaced '.$count.' keys');
            } else {
                return $params_batch;
            }
        }
    }

    /**
     * Return real table column from array key
     * @param array $array_key
     * @return mixed
     */
    public function get_field_from_array_key($array_key = array())
    {
        // get table column from array key
        $key_array = explode(' ', $array_key);
        // check no of chunk
        return (count($key_array) == '2') ? $key_array[0] : ((count($key_array) > 2) ? $key_array[1] : $key_array[0]);
    }

    /**
     * Set PDO Error Mode to get an error log file or true to show error on screen
     *
     * @param bool $mode
     */
    public function set_error_log($mode = false)
    {
        $this->log = $mode;
    }
}

/** Class End **/
?>