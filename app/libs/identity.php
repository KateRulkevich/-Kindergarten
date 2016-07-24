<?php
namespace app\libs;

class Field
{

    private $name=null;
    private $operator=null;
    private $comps=array();
    private $incomplete=false;

    private $all_comps = array();

    //устанавливает имя поля, например age
    public function __construct($name)
    {
        $this->name = $name;
    }

    //добавляет оператор и значение для проверки
    //(=40, например) и помещает его в свойство $comps

    public function addTest($operator, $value)
    {
        $this->comps[] = array (
            'name' => $this->name,
            'operator' => $operator,
            'value' => $value
        );
    }

    //$comps - это массив, поэтому можно
    //сравнить одно поле с др несколькими способами
    public function getComps()
    {
        return $this->comps;
    }

    //если $comps не содержит элементов, значит, к нас есть данные
    //для сранения и это поле не готово для исполнения в запросе

    public function isIncomplete()
    {
        return empty($this->comps);
    }

}

class Identity
{
    protected $currentfield = null;
    protected $fields = array();
    // private $and = null;
    private $enforce = array();

    //конструктор может запускаться и именем поля или без параметров
    function __construct($field=null, array $enforce=null)
    {
        if(!is_null($enforce)) {
            $this->enforce = $enforce;
        }
        if(!is_null($field)) {
            $this->field($field);
        }

    }

    //имена полей, на которое наложено это ограничение
    public function getObjectFields()
    {
        return $this->enforce;
    }

    //вводим поле. Генерится ошибка,
    //если текущее поле неполное (age, а не age>10)
    //этот метод возвращает ссылку на текущий объект
    //и тем самым разрешает свободный синтаксис
    public function field($fieldname)
    {
        if (!$this->isVoid() && $this->currentfield->isIncomplete() ) {
            throw new \Exception("Неполное поле");
        }
        // $this->enforceField($fieldname); это защита
        if (isset($this->fields[$fieldname])) {
            $this->currentfield = $this->fields[$fieldname];
        } else {
            $this->currentfield = new Field($fieldname);
            $this->fields[$fieldname] = $this->currentfield;
        }

        return $this;
    }

    //ЕСТЬ ЛИ ПОЛЯ у identity object
    public function isVoid()
    {
        return empty($this->fields);
    }

    public function enforceField($fieldname)
    {

        if (!in_array($fieldname, $this->enforce) && !empty($this->enforce)) {
            $forcelist = implode(', ', $this->enforce);
        throw new \Exception("{$fieldname} не является корректным полем {$forcelist}");
        }
    }


    //добавление оператора равенства к текущему полю

    public function eq($value)
    {
        return $this->operator("=", $value);
    }

    //оператор нераветсва к текущему полю
    public function noteq($value)
    {
        return $this->operator("!=", $value);
    }

    //выполняет работу для методов operator
    //получает текущее значение поля и добавляет значение оператора
    //и результат проверски
    private function operator($symbol, $value)
    {
        if ($this->isVoid()) {
            throw new \Exception("поле не определено");
        }
        
        $this->currentfield->addTest($symbol, $value);
        return $this;
    }

    //возарвщает все сравнения,
    //созданные до сих пор в ассоциативном массиве
    
    public function getComps()
    {
        foreach ($this->fields as $key => $field) {
           
            $field_array = $field->getComps();
            $this->all_comps[] =  $field_array[0];
        }
        print_r( $this->comparisons);
        return $this->all_comps;
    }

}   
