<?php 
class MainController{

    private $_db;

    public function __construct($db)
    {
       $this->_db = $db; 
    }

    //управляющая функция контроллера
    public function Request()
    {
        //создание обьекта модели с параметром подключения к БД
        $ModerPrice = new ModelPrice($this->_db);
      

        if (isset($_POST['calendar'])) {
           $date = $_POST['calendar']; 
           $pricelist = $ModerPrice->getAllProduct();
        }

        //отображение вида
        include('views/view.php');
 
    }
}
