# DBEngine Class Features

> **DBEngine Class has very useful methods to re-use in various database related operation.**


- RAW query							[`query()`](#query)
- Select query						[`select ()`](#select)
- Insert query 						[`insert ()`](#insert)
- Insert batch						[`insert_batch()`](#insert_batch)
- Update query						[`update()`](#update)
- Delete query 						[`delete()`](#delete)
- Truncate table					[`truncate()`](#truncate)
- Drop table						[`drop()`](#drop)
- Describe table					[`describe()`](#describe)
- Count records						[`count()`](#count)
- Show/debug executed query			[`show_query()`](#show_query)
- Get last insert id				[`get_last_insert_id()`](#get_last_insert_id)
- Get all last insert id			[`get_all_last_insert_id()`](#get_all_last_insert_id)
- Get MySQL results					[`results()`](#results)
- Get MySQL result					[`result()`](#result)
- Get status of executed query		[`affected_rows()`](#affected_rows)
- Begin transactions				[`start()`](#start)
- Commit the transaction			[`end()`](#end)
- Rollback the transaction			[`back()`](#back)
- Debugger PDO Error 				[`set_error_log()`](#set_error_log)

Methods Explanations
--------------------

#### <a name="query"></a> query()

Method Signature
```
public function query( $strSQL = '', $arrBindWhereParam = array() )
```
**Explanations:** This method uses for simple MySQL query; you can execute any valid MySQL query 
with passing parameter or as a simple raw query.

**Example:**
```
$sql = 'select * from customers limit 5;';
$data = $db->query($sql)->results();

Raw Query:
SELECT * FROM customers LIMIT 5;
```


#### <a name="select"></a> select()

Method Signature
```
public function select( $strTable = '', $arrColumn = array(), $arrWhere = array(), $strOther = '' )
```
Explanations: The select method is made for getting table data from just passing the table name, if you omit column then you will get all fields of requested table else you can pass table field as an array. If you want to pass a where clause then you can use third parameter of select method and by passing fourth parameter you can send other filters.

Example:
```
Get all table fields from table without passing 2nd parameter.

$select = $db->select('customers');
$data = $select->results();

Raw Query:
SELECT * FROM `customers` ;

Or

You can use one line code to get a result array

$data = $db->select('employees')->results();

Raw Query:
SELECT * FROM `employees` ;

Get only selected fields from table

$data = $db->select('employees', array('employeeNumber','lastName','firstName'))->results();

Raw Query:
SELECT employeenumber, lastname, firstname FROM `employees` ;

Or

$fieldsArray = array('employeeNumber','lastName','firstName');
$data = $db->select('employees', $fieldsArray)->results();

Raw Query:
SELECT employeenumber, lastname, firstname FROM `employees` ;

$selectFields = array('employeeNumber','lastName','firstName');
$whereConditions = array('lastname'=>'Siddiqui');
$data = $db->select('employees', $selectFields, $whereConditions, 'ORDER BY employeeNumber DESC LIMIT 5')->results();

Raw Query:
SELECT employeenumber, lastname, firstname FROM `employees` WHERE lastname = "Siddiqui" ORDER BY employeenumber DESC LIMIT 5;

Custom Where Clause with Select Method:

You can set your own custom where clause

$whereConditions = array('lastname ='=>'Siddiqui', 'or jobtitle ='=> 'Technical Director', 'and isactive ='=>1, 'and doc ='=> '2009-05-01' );
$data = $db->select('employees','',$whereConditions)->results();

Raw Query:
SELECT * FROM `employees` WHERE lastname = "Siddiqui" OR jobtitle = "Technical Director" AND isactive = 1 AND doc = '2009-05-01' ;

OR

$whereConditions = array('lastname ='=>'Siddiqui', 'or jobtitle ='=> 'Technical Director', 'and isactive ='=>1, 'and doc ='=> '2009-05-01' );
$data = $db->select('employees',array('employeenumber','lastname','jobtitle'),$whereConditions)->results();

Raw Query:
SELECT employeenumber, lastname, jobtitle FROM 'employees' WHERE lastname = "Siddiqui" OR jobtitle = "Technical Director" AND isactive = 1 AND doc = '2009-05-01' ;
```

#### <a name="insert"></a> insert()

Method Signature
```
public function insert($strTable, $arrData = array())
```
**Explanations:** Using insert method you can insert record into selected table. Just pass data as an array with fields as array key and the array data will insert into table. Insert method automatically convert your array data in to SQL injection safe data. Calling `get_last_insert_id()` just after `insert()` will return the last insert ID.

**Example:**
```
$dataArray = array('first_name'=>'Siddiqui','last_name'=>'Noor','age'=>40);
$data = $db->insert('test',$dataArray)->get_last_insert_id();

Raw Query:
INSERT INTO `test` (first_name,last_name,age) VALUES ("Siddiqui","Noor",40);
```

#### <a name="insert_batch"></a> insert_batch()

Method Signature
```
public function insert_batch($strTable, $arrData = array(), $safeModeInsert = true)
```
**Explanations:** You can use this method for inserting multiple array data in same table. You have to just send full array data and rest of thing `insert_batch` will handle. You can send third parameter as false if you don't want to insert parameterize insert or send true if want to secure insertions. `insert_batch` works with MySQL transactions so you don't need to worry about failure data. It will be rollback if anything goes wrong.

**Example:**
```
$dataArray[] = array('first_name'=>'Siddiqui','last_name'=>'Noor','age'=>40);
$dataArray[] = array('first_name'=>'Peter','last_name'=>'Mark','age'=>45);
$dataArray[] = array('first_name'=>'Robert','last_name'=>'Neher','age'=>30);
$data = $db->insert_batch('test',$dataArray, true)->get_all_last_insertId();

Raw Query:
INSERT INTO `test` (first_name, last_name, age) VALUES ("Siddiqui", "Noor", 40);
INSERT INTO `test` (first_name, last_name, age) VALUES ("Peter", "Mark", 45);
INSERT INTO `test` (first_name, last_name, age) VALUES ("Robert", "Neher", 30);
```

#### <a name="update"></a> update()

Method Signature
```
public function update($strTable = '', $arrData = array(), $arrWhere = array(), $strOther = '')
```
**Explanations:** Update method is use for update a table with array data. You can send array data as update data in table.

**Example:**
```
$dataArray = array('first_name'=>'Noor','last_name'=>'Siddiqui','age'=>38);
$aWhere = array('id'=>23);
$data = $db->update('test', $dataArray, $aWhere)->affected_rows();

Raw Query:
UPDATE `test` SET first_name = "Noor", last_name = "Siddiqui", age = 38 WHERE id = 23 ;

Or

$dataArray = array('first_name'=>'Noor','last_name'=>'Siddiqui','age'=>38);
$aWhere = array('age'=>38, 'last_name'=>'Siddiqui');
$data = $db->update('test', $dataArray, $aWhere)->affected_rows();

Raw Query:
UPDATE `test` SET first_name = "Noor", last_name = "Siddiqui", age = 38 WHERE
age = 38 AND last_name = "Siddiqui" ;
```

#### <a name="delete"></a> delete()

Method Signature
```
public function delete($strTable, $arrWhere = array(), $strOther = '')
```
**Explanations:** You can delete records from table by send table name and your where clause array.

**Example:**
```
$aWhere = array('age'=>38);
$data = $db->delete('test', $aWhere)->affected_rows();

Raw Query:
DELETE FROM `test` WHERE age = 38 ;

$aWhere = array('age'=>45, 'first_name'=> 'Peter');
$data = $db->delete('test', $aWhere)->affected_rows();

Raw Query:
DELETE FROM `test` WHERE age = 45 AND first_name = "Peter" ;
```

#### <a name="truncate"></a> truncate()

Method Signature
```
public function truncate($strTable = '')
```
**Explanations:** You can truncate table by just pass table name.

**Example:**
```
$data = $db->truncate('test');

Raw Query:
TRUNCATE TABLE `test`;
```

#### <a name="drop"></a> drop()

Method Signature
```
public function drop($strTable = '')
```
**Explanations:** You can drop table by just pass table name.

**Example:**
```
$data = $db->drop('test');

Raw Query:
DROP TABLE `test`;
```

#### <a name="describe"></a> describe()

Method Signature
```
public function describe($strTable = '')
```
**Explanations:** You can get a table field name and data type.

**Example:**
```
$data = $db->describe('test');

Raw Query:
DESC  `test`;
```

#### <a name="count"></a> count()

Method Signature
```
public function count($strTable = '', $strWhere = '')
```
**Explanations:** This function will return the number of total rows in a table.

**Example:**
```
echo $q = $db->count('employees');
$db->show_query();

Raw Query:
23
SELECT COUNT(*) AS numrows FROM `employees`;

echo $q = $db->count('employees','firstname = "Siddiqui"');
$db->show_query();

Raw Query:
1
SELECT COUNT(*) AS numrows FROM `employees` WHERE firstname = "mary";
echo $db = $p->count('employees','jobtitle="Sales Rep"');
$db->show_query();

Raw Query:
17
SELECT COUNT(*) AS numrows FROM `employees` WHERE jobtitle="Technical Director";
```

#### <a name="show_query"></a> show_query()

Method Signature
```
public function show_query($logfile = false)
```
**Explanations:** By this function you can get executed query. It will show raw query on your screen. If you want to logfile to save query then you can send 2nd param as true. By default it's false.

**Example:**
```
$db->show_query();

Raw Query:
SELECT COUNT(*) AS numrows FROM `test`;
```

#### <a name="get_last_insert_id"></a> get_last_insert_id()

Method Signature
```
public function get_last_insert_id()
```
**Explanations:** Get a newly inserted id by insert function.

**Example:**
```
$lid = $db->get_last_insert_id();

Return: Number/Integer
```

#### <a name="get_all_last_insert_id"></a> get_all_last_insert_id()

Method Signature
```
public function get_all_last_insert_id()
```
**Explanations:** Get all newly inserted id by insertBatch function.

**Example:**
```
$lid = $db->get_all_last_insert_id();
```

#### <a name="results"></a> results()

Method Signature
```
public function results($type = 'array')
```
**Explanations:** Get array result data by executed SELECT or Select Query. You can get result in three formats Array, XML and JSON. Just pass 1st param as 'array' or 'xml' or 'json'. By default it will return array.

**Example:**
```
$data = $db->results();
$data = $db->results('xml');
$data = $db->results('json');

Return: Array | XML | JSON
```

#### <a name="affected_rows"></a> affected_rows()

Method Signature
```
public function affected_rows()
```
**Explanations:** Get number of affected rows by update, delete and select etc. statement or false.

**Example:**
```
$data = $db->affected_rows();
```

#### <a name="start"></a> start()

Method Signature
```
public function start()
```
**Explanations:** Start the MySQL transaction.

**Example:**
```
$db->start();
```

#### <a name="end"></a> end()

Method Signature
```
public function end()
```
**Explanations:** Commit the MySQL transaction.

**Example:**
```
$db->end();
```

#### <a name="back"></a> back()

Method Signature
```
public function back()
```
**Explanations:** Rollback the MySQL transaction.

**Example:**
```
$db->back();
```

#### <a name="set_error_log"></a> set_error_log()

Method Signature
```
public function set_error_log($mode = false)
```
**Explanations:** set_error_log, method works for show/hide PDO error. If you send true then all errors will show on screen or if you send false then all errors will store in log file in same location.

**Example:**
```
// include DBEngine
include_once 'class/dbengine.php';

// set connection data
$dbConfig = array
(
"host"=>"localhost", "dbname"=>'test', "username"=>'root', "password"=>''
);

// get instance of DBEngine
$db = DBEngine::getDBEngine($dbConfig);

// set error log mode true to show all error on screen
$db->set_error_log(true);
```




