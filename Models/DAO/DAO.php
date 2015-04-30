<?php

namespace Models\DAO;
use \Config\Config;

class DAO{
    public function __construct(){
        $this->conex = Config::getDatabaseConnection();
    }
    public function simpleConexQuery($columnsAndAliases = array(),$tableName = '', $whereString = '', $columnsAndOrders = array(), $start = null, $end = null){
        return $this->conex->query($this->simpleQueryString($columnsAndAliases,$tableName, $whereString, $columnsAndOrders, $start, $end));
    }
    public function simpleQueryString($columnsAndAliases = array(),$tableName = '', $whereString = '', $columnsAndOrders = array(), $start = null, $end = null){
        $result = 
            'SELECT '
            . $this->selectColumnsString($columnsAndAliases)
            . ' FROM ' . $tableName
            . ' ' . $this->prependWhereWhenValid($whereString)
            . ' ' . $this->orderByColumnsString($columnsAndOrders)
            . ' ' . $this->limitString($start,$end);
        return $result;
    }
    public function selectColumnsString($columnsAndAliases = array()){
        if(empty($columnsAndAliases)){
            return '*';
        }
        $result = '';
        $i = 0;
        foreach($columnsAndAliases as $columnName => $alias){
            $separator = ($i === 0)? '' : ',';
            if(is_numeric($columnName)){
                $columnName = $alias;
                $result .= "$separator $columnName";
            }else{
                $result .= "$separator $columnName AS $alias";
            }
            $i++;
        };
        return $result;
    }
    public function orderByColumnsString($columnsAndOrders = array()){
        if(empty($columnsAndOrders)){
            return '';
        }
        $result = 'ORDER BY';
        $i = 0;
        foreach ($columnsAndOrders as $columnName => $order) {
            $separator = ($i === 0)? '' : ',';
            if(is_numeric($columnName)){
                $columnName = $order;
                $result .= "$separator $columnName";
            }else{
                $result .= "$separator $columnName $order";
            }
            $i++;
        }
        return $result;
    }
    public function limitString($limit = null,$offset = null){
        $result = '';
        if($limit){
            $result = "LIMIT $limit ";
            if($offset){
                $result .= "OFFSET $offset";
            }
        }
        // $result .= ";";
        return $result;
    }
    public function prependWhereWhenValid($whereString = ''){
        if($whereString){
            $whereString .= 'WHERE '. $whereString;
        }
        return $whereString;
    }
}