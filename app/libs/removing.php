<?php
namespace app\libs;
//в cond прописываюся условия, по которым удалять, лучше всего id
//создается объект с именем таблицей
//$rem = new Removing(имя таблицы)
//строится запрос 
//$rem->buildStatement;
//он возвращается в модель и там выполняется
class  Removing
{
  private $table;

    public function __construct($table)
    {
        $this->table = $table;
       
    }

    public function buildStatement(array $conditions)
    {
        if (!count($conditions)) {
            throw new Exception("empty array conditions $conditions");
        }
        $query = "DELETE FROM {$this->table} WHERE ";
        
        $cond = array();
       
        
        foreach ($conditions as $key => $val) {
            $cond[]="$key = $val";
          
        }
        
        $query .= implode(" AND ", $cond);
        
       
        return array($query);
    }

}

