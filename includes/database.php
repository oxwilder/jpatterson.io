<?php


  function db_connect($link = 'db_link') {
    global $$link;

    $$link = mysqli_connect(DB_PROXY_IP, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PROXY_PORT);

    if ( !mysqli_connect_errno() ) {
      mysqli_set_charset($$link, 'utf8mb4');
    } 

    return $$link;
  }

  function db_close($link = 'db_link') {
    global $$link;

    return mysqli_close($$link);
  }

  function db_error($query, $errno, $error) { 
    error_log('ERROR: [' . $errno . '] ' . $error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    die('<font color="#000000"><strong>' . $errno . ' - ' . $error . '<br /><br />' . $query . '<br /><br /><small><font color="#ff0000">[TEP STOP]</font></small><br /><br /></strong></font>');
  }

  function db_query($query, $link = 'db_link') {
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY: ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysqli_query($$link, $query) or db_error($query, mysqli_errno($$link), mysqli_error($$link));

    return $result;
  }

  function db_spCall($query) {

    #we use a separate connection for these results otherwise mysqli throws a fit with stored procedures
    $link = mysqli_connect(DB_PROXY_IP, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PROXY_PORT);

	  mysqli_set_charset($link, 'utf8');

    $myQuery = mysqli_query($link, $query);
    if($myQuery === false)
    {
      db_error($query, mysqli_errno($link), mysqli_error($link));
      return false;
    }

    $result = mysqli_fetch_all($myQuery, MYSQL_ASSOC);
    mysqli_free_result($myQuery);
    mysqli_close($link);

    return $result;
  }

  function db_tablemeta($table)
  {
    $metadata = array();
    $meta = mysqli_fetch_all(tep_db_query('SELECT COLUMN_NAME, COLUMN_DEFAULT, DATA_TYPE
                                                from information_schema.columns c
                                                where TABLE_SCHEMA = "'.DB_DATABASE.'" 
                                                and c.TABLE_NAME = "'.$table.'"'), MYSQL_ASSOC);

    foreach($meta as $m)
    {
      $metadata[$m['COLUMN_NAME']] = array('default' => $m['COLUMN_DEFAULT'],
                                            'datatype' => $m['DATA_TYPE'],
                                          );
    }
    return $metadata;
  }

  function db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') 
  {

    #get meta for table
    $meta = db_tablemeta($table);

    reset($data);
    #~~~~~~~~~~~~~~~~~~
    #     INSERT
    #~~~~~~~~~~~~~~~~~~
    if ($action == 'insert') 
    {
      $query = 'insert into ' . $table . ' (';
      #build column list
      foreach($data as $columns=>$value)
        $query .= $columns . ', ';
      
      $query = substr($query, 0, -2) . ') values (';
      foreach($data as $col=>$value) {
        $default = $meta[$col]['default'];
        if((!isset($value) || $value == '') && isset($default)) $value = $default;
        if(!isset($value) && in_array(strtoupper($meta[$col]['datatype']), array('TEXT', 'BLOB', 'JSON'))) $value = '';
        if(empty($value) && in_array(strtoupper($meta[$col]['datatype']), array('DATETIME')) && $default == 'CURRENT_TIMESTAMP') $value = 'now()';

        #if datatype for column is numeric and you gave us an empty string we change to NULL
        if(in_array(strtoupper($meta[$col]['datatype']), array('INT', 'FLOAT', 'DOUBLE', 'DECIMAL', 'NUMERIC', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'BIT')) && $value === '')
          $value = NULL;

        if($value === 'now()')
            $query .= 'now(), ';
        elseif($value === 'null')
            $query .= 'null, ';
        elseif($value === '')
            $query .= '"' . db_input($value) . '", ';
        elseif($value === null)
            $query .= 'null, ';
        else
            $query .= '"' . db_input($value) . '", ';
      }
      $query = substr($query, 0, -2) . ')';
    } 
    #~~~~~~~~~~~~~~~~~~
    #     UPDATE
    #~~~~~~~~~~~~~~~~~~
    elseif ($action == 'update') 
    {
      $query = 'update ' . $table . ' set ';
      foreach($data as $col=>$value) 
      {
        $default = $meta[$col]['default'];
        if((!isset($value) || $value == '') && isset($default)) $value = $default;
        if(!isset($value) && in_array(strtoupper($meta[$col]['datatype']), array('TEXT', 'BLOB', 'JSON'))) $value = '';

        #if datatype for column is numeric and you gave us an empty string we change to NULL
        if(in_array(strtoupper($meta[$col]['datatype']), array('INT', 'FLOAT', 'DOUBLE', 'DECIMAL', 'NUMERIC', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'BIT')) && $value === '')
          $value = NULL;

        if($value === 'now()')
            $query .= $col . ' = now(), ';
        elseif($value === 'null')
            $query .= $col .= ' = null, ';
        elseif($value === '')
            $query .= $col . ' = "' . db_input($value) . '", ';
        elseif($value === null)
            $query .= $col .= ' = null, ';
        else
            $query .= $col . ' = "' . db_input($value) . '", ';
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return db_query($query, $link);
  }

  function db_fetch_array($db_query) {
    return mysqli_fetch_array($db_query, MYSQLI_ASSOC);
  }

  function db_num_rows($db_query) {
    return mysqli_num_rows($db_query);
  }

  function db_data_seek($db_query, $row_number) {
    return mysqli_data_seek($db_query, $row_number);
  }

  function db_insert_id($link = 'db_link') {
    global $$link;

    return mysqli_insert_id($$link);
  }

  function db_free_result($db_query) {
    return mysqli_free_result($db_query);
  }

  function db_fetch_fields($db_query) {
    return mysqli_fetch_field($db_query);
  }

  function db_output($string) {
    return htmlspecialchars($string);
  }

  function db_input($string, $link = 'db_link') {
    global $$link;

    return mysqli_real_escape_string($$link, $string);
  }

  function db_prepare_input($string) {
    if (is_string($string)) {
      return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      foreach($string as $key=>$value) {
        $string[$key] = db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }

  function db_affected_rows($link = 'db_link') {
    global $$link;

    return mysqli_affected_rows($$link);
  }

  function db_get_server_info($link = 'db_link') {
    global $$link;

    return mysqli_get_server_info($$link);
  }

?>
