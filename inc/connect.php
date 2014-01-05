<?php

    $db = mysql_connect("a0968166.mysql.univie.ac.at", "a0968166", "eventshare.0");
    $db = mysql_select_db("a0968166");


    function query_element($query,$element)
    {
            $scselect = mysql_query($query) or exit((mysql_error()));
            while ($scrow=mysql_fetch_array($scselect))
            {
                    return $scrow[$element];
            }
            return false;
    }

    function query_count($query)
    {
            $fselect = mysql_query($query) or exit((mysql_error()));
                    return mysql_num_rows($fselect);
    }

    /*
     * $data = simpleq("SELECT * FROM `event`");
     * foreach($data as $item)
     * {
     *     $datum = $item['date'];
     *     $owner = $item['creator'];
     *     $id = $item['id'];
     * }
     */
    function simplequery($query)
    {
        $scselect = mysql_query($query);
        if(!$scselect) return false;
        while ($row=mysql_fetch_array($scselect))
        {
            $o = array();
            foreach($row as $key=>$rd)
                if(!is_numeric($key))
                    $o[$key] = $rd;
            $out[] = $o;
        }
        return $out;
    }
    
    /**
     * like this: array('field'=>'text','timestamp'=>time());
     * @param type $data = array(...)
     * @param type $table
     * @return boolean
     */
    function insert($data,$table)
    { 
        
        if(is_array($data) && count($data))
            foreach ($data as $key => $value)
            {
                $fields .= '`'.$key.'`,';
                $vals .= '\''.addslashes($value).'\',';
            }
        else return false;
            
        $fields = substr($fields, 0,-1);
        $vals = substr($vals, 0,-1);
        mysql_query("INSERT INTO `".$table."` ($fields) VALUES ($vals)");
        
        return mysql_insert_id();
    }
    
    /**
     * 
     * @param type $array
     * @param type $table
     * @param type $id
     * @param type $feld
     * @return type
     */
    function update($array,$table,$id,$feld='ID')
    {
        if(!$table) $table = $this->_table;
        if(!$id) $id = $this->_id;
        foreach($array as $field => $val)
            $set .= '`'.$field.'` = \''.mysql_real_escape_string($val).'\', ';
        
        
        $set = substr($set, 0,-2);
        $q = "UPDATE `".$table."` SET ".$set." WHERE `".$feld."` = '".$id."'";
        
        return mysql_query($q);
    }