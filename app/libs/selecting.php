<?php
namespace app\libs;

class  Selecting
{
    private $obj;
    private $select = null;
    private $values;
    private $order = "";
    private $where = "";
    private $group = "";
    private $limit = '';
    private $join = '';

    public function __construct(Identity $obj, $table, $add_table = null)
    {
        $this->obj = $obj;

        $all_table = (is_null($add_table)) ? $table : $table.", ".$add_table;

        $fields  =  implode (  ', ' , $this->obj->getObjectFields()  ); 
        $this->select  =  "SELECT  $fields  FROM  $all_table"; 
        
        
    }

    public function  where ()  { 
        if  (  $this->obj->isVoid()  )  { 
            return  array(  "",  array() );
        }
        $this->values  =  array(); 
        $compstrings  =  array();
        foreach  (  $this->obj->getComps() as  $comp  )  { 
            $compstrings[] =  "{$comp['name']} {$comp['operator']}  ?"; 
            $this->values[] =  $comp ['value'];
        }

        $this->where  =  "WHERE  "  .  implode( "  AND  " ,  $compstrings );
        return $this;
    }

    public function join(array $joins)
    {
        foreach ($joins as $key => $val) {
            $this->join .= " JOIN ". $key." ON (".$val[0]." = ".$val[1].") ";
        }
        
        return $this;
    }

    public function group($field)
    {
        $this->group = " GROUP BY $field ";
        return $this;
    }

    public function order($field=null)
    {
        $current_field = "position";
        if (!is_null($field)) {
            $current_field = $field;
        }
        $this->order = " ORDER BY $current_field ";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = " LIMIT $limit ";
        // $this->values[] = ;
        return $this;
    }

    public function end($in = '')
    {
        if(is_null($this->select)){
            throw new \Exeption("Поле SELECT пустое. Неозможно сформировать запрос");
        }
        return array($this->select." ".$this->join .$this->where . $this->group. $this->order . $this->limit. " ".$in, $this->values);
    }

}

