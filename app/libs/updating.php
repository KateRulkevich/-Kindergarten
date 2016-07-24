<?php
namespace app\libs;
//работает так. в модели заполняются поля fields
//fields['description'] = ' новое значение'
//потом, если надо обновить, то пишется условие в cond
//$cond['id'] = 5;
//если надо вставить новое, то условие не пишется
//затем создается объект $up = new Updating(тута имя таблицы);
//вызывается метод $up->buildStatement($fields, $cond)
//класс возвращает строку запроса, которую надо выполнить в модели

class Updating
{
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
       
    }

    public function buildStatement(array $fields, array $conditions=null)
    {
        if (!count($fields)) {
            throw new \Exception("empty array fields $fields");
        }
        
        $terms = array();
        if (!is_null($conditions)) {
            $query = "UPDATE {$this->table} SET ";
            $query .= implode("= ?, ", array_keys($fields))." = ?"; 
            $terms = array_values($fields);
            $cond = array();
            $query .= " WHERE ";
            foreach ($conditions as $key => $val) {
                $cond[]="$key = ?";
                $terms[]=$val;
            }
            $query .= implode(" AND ", $cond);
        } else {
            $query = "INSERT INTO {$this->table} (";
            $query .= implode(", ", array_keys($fields));
            $query .= ") VALUES (";
            foreach ($fields as $name => $value) {
                $terms[] = $value;
                $qs[] = '?';
            }
            $query .= implode(", ", $qs);
            $query .= ")";
        }
       
        return array($query, $terms);
    }
}



































