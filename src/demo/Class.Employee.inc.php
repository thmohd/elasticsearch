<?php

class Employee extends Company{

    const TYPE = 'employee';
    private $name;
    private $email;
    private $address;



    /**
     * @return mixed
     */
   public function __toString(){
       return $this->name;
   }


    /**
     * @param $name
     * @param $value
     */
    public function __set($key, $value){

        if(!property_exists($this,$key)){
            return;
        }
        else{
            $this->$key = $value;
        }

    }

    /**
     * @param $name
     */
    public function __get($key){
        if(!property_exists($this,$key)){
            return;
        }
        else{
            return $this->$key;
        }
    }


    /**
     * @param array $body
     * @return string|void
     */
    public function addEmployee($body = array()){

        if(!is_array($body) || !$this->isValid($body)){
            return json_encode(array("status" => 400, "msg" => "Not Array or Wrong fields"));
        }


        $data = array();
        $data['index'] = self::INDEX;
        $data['type']  = self::TYPE;
        //$data['id'] = 1; // to make auto generate delete it
        $data['body']  = $body;
        $employee = parent::getInstance();

        $result = $employee->index($data);

        return json_encode($result);

    }

    public function findEmployee($body = array()){

        if(!is_array($body) || !$this->isValid($body)){
            return json_encode(array("status" => 400, "msg" => "Not Array or Wrong fields"));
        }

        $data = array();
        $data['index'] = self::INDEX;
        $data['type']  = self::TYPE;
        $data['body']['query']['match']  = $body;

        $employee = parent::getInstance();
        //$employee = new Elasticsearch\Client();
        $result = $employee->search($data);

        return json_encode($result);

    }

    /**
     * Check if the properties as you defined them in this entity (This allow you to control the data being inserted to elasticsearch)
     * @param array $body
     * @return bool
     */
    private function isValid($body = array()){

        foreach($body as $key => $value){
            if(!property_exists($this,$key)){

                return false;
            }
        }
        return true;
    }
}