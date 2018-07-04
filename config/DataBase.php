<?php
class DataBase{

    // идентификатор подключения к бд
    private $_linkIndentifier;

    public function __construct($host,$user,$pass,$db)
    {
        $this->_linkIndentifier = mysqli_connect($host,$user,$pass,$db) or die(mysqli_connect_error()); 
        mysqli_select_db($this->_linkIndentifier,$dbName);
    }

    //функция для запросов к бд с возвратом ассоциативного массива
    public function Query($query)
    {
        $result = mysqli_query($this->_linkIndentifier,$query);
        if( $result ){
        $arr = array();
        while($row = mysqli_fetch_assoc($result))
            $arr[] = $row;
        return $arr;
        }else{
        return 'failure! check for errors and do something else';
        }
    }

    // функция для выполнения запросов без возврата
    public function Execute($query)
    {
        $result = mysqli_query($this->_linkIndentifier,$query);
    }
}

?>