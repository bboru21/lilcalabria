<?php

/*****************************************************************

 $Id: database.php 28 2009-12-23 17:24:04Z mikeschutz@gmail.com $

 *****************************************************************/



//-----------------------------------------------------------

// database.inc - Mike's PEAR database abstraction layer

// (c)2003 Mike Schutz http://wasaa.com

// This code may not be reproduced or modified in any form

// without pre-written consent by the author.

//-----------------------------------------------------------

// UPDATED 2009-03-02 : Removed depricated PEAR code. mysql only.

//-----------------------------------------------------------


$DB_TYPE = 'mysql';

$DB_USER = 'bboru21';

$DB_PASS = 'Iwiwotn17';

$DB_HOST = 'birch.safesecureweb.com';

$DB_NAME = 'bboru21';





//-----------------------------------------------------------

// dbSetup - declare database variables

//-----------------------------------------------------------

function dbSetup ($type, $user, $pass, $host, $name) {

        global $DB_TYPE, $DB_USER, $DB_PASS, $DB_HOST, $DB_NAME;

        if ($type != NULL) $DB_TYPE = $type;

        if ($user != NULL) $DB_USER = $user;

        if ($pass != NULL) $DB_PASS = $pass;

        if ($host != NULL) $DB_HOST = $host;

        if ($name != NULL) $DB_NAME = $name;

} // dbSetup





//-----------------------------------------------------------

// dbInsert - Insert an associative array into the database

//            Builds SQL INSERT statement into $tablename

//            with column names and VALUES populated by the

//            keys and data in $insert_array

//-----------------------------------------------------------

function dbInsert ($tablename, $insert_array) {

        $sql = "INSERT INTO $tablename ";

        // set up fields:

        $sql .= '(' . implode (',', array_keys($insert_array)). ')';

        // set up values:

        foreach ($insert_array as $key) {

                if ($key == "") $values[] = "NULL";

                else $values[] = "'" . $key . "'";

        }

        $sql .= ' VALUES (' . implode (',', $values) . ')';


		return dbRunQuery ($sql);

} // dbInsert







//-----------------------------------------------------------

// dbUpdate - Update an associative array into the database

//            Builds SQL UPDATE statement into $tablename

//            with column names and VALUES populated by the

//            keys and data in $insert_array

//-----------------------------------------------------------

function dbUpdate ($tablename, $key_column, $key_match, $update_array) {

        $sql = "UPDATE $tablename";

        // set values to change

        foreach (array_keys($update_array) as $key)

                $assignments[] = "$key=$update_array[$key]";

        $sql .= " SET " . implode (',', $assignments);

        $sql .= " WHERE $key_column=$key_match";
		
		return dbRunQuery ($sql);

} // dbUpdate







//-----------------------------------------------------------

// dbDelete - delete the specified row from specified table

//-----------------------------------------------------------

function dbDelete ($tablename, $key, $match) {

        if (!is_numeric($match)) $match = "'$match'";

        $sql = "DELETE FROM $tablename WHERE $key = $match";

		return dbRunQuery ($sql);

} // dbDelete







//-----------------------------------------------------------

// dbGetAssoc - run a database query and return all results

//              as an associative array

//-----------------------------------------------------------

function dbGetAssoc ($sql) {

        global $DB_TYPE, $DB_USER, $DB_PASS, $DB_HOST, $DB_NAME;

        $link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die("RDBS error.");

        mysql_select_db($DB_NAME) or die('Select error');

        $result = mysql_query($sql);

        if (!$result) return false;

        if (mysql_num_rows($result) == 0) return false;

        $row = mysql_fetch_assoc($result);

        mysql_close($link);

        return $row;

} // dbGetAssoc







//-----------------------------------------------------------

// dbGetAllMDS - run a database query and return all results

//               in an associative array, on column names

//-----------------------------------------------------------

function dbGetAllMDS ($sql) {

        global $DB_TYPE, $DB_USER, $DB_PASS, $DB_HOST, $DB_NAME;

        $link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die("RDBS error.");

        mysql_select_db($DB_NAME) or die('Select error');

        $result = mysql_query($sql);

        if (!$result) return false;

        if (mysql_num_rows($result) == 0) return false;

        while ($row = mysql_fetch_assoc($result))

                $all_rows[] = $row;

        mysql_close($link);

        return $all_rows;

} // dbGetAllMDS

//-----------------------------------------------------------

// dbGetOne - return a single item from the db

//-----------------------------------------------------------

function dbGetOne($sql) {

        global $DB_TYPE, $DB_USER, $DB_PASS, $DB_HOST, $DB_NAME;

        $link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die("RDBS error.");

        mysql_select_db($DB_NAME) or die('Select error');

        $result = mysql_query($sql);

        if (!$result) return false;

        if (mysql_num_rows($result) == 0) return false;

        $item = mysql_fetch_row($result);

        mysql_close($link);

        return $item[0];

} // dbQuery







//-----------------------------------------------------------

// dbRunQuery - call with query, return num rows affected

//-----------------------------------------------------------

function dbRunQuery($sql) {

        global $DB_TYPE, $DB_USER, $DB_PASS, $DB_HOST, $DB_NAME;

        $link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) or die("RDBS error.");

        mysql_select_db($DB_NAME, $link) or die('Select error');

        $result = mysql_query($sql, $link);

		if (preg_match("/^insert/i", $sql)) return mysql_insert_id();

        if ($result==false) return false;

        if ($result==true) return true;

        if (mysql_affected_rows($result) == 0) return false;

        return $result;

} // dbQuery

