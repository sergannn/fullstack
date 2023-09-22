<?php
class ModelPrice{

  private $_db;

  public function __construct($db)
  {
    $this->_db = $db;
  }
  function query($q) {
    return $this->_db->Query($q);
  }
  function getAllProduct()
  {
    return $this->_db->Query('SELECT * FROM `Product` ORDER BY ID');
  }

  function getPriceList($date)
  {
     $sqlString = "SELECT 
                  title, 
                  description, 
                  document_id, 
                  datetime, 
                  price 
              FROM 
                  Product p 
                  LEFT JOIN (
                      SELECT 
                          maxdate.product_id, 
                          maxdate.datetime AS datetime, 
                          docprb.price AS price, 
                          doc.id AS document_id 
                      FROM 
                          (
                              SELECT 
                                  docprb.product_id, 
                                  doc.datetime, 
                                  doc.id, 
                                  max(doc.datetime) max_date 
                              FROM 
                                  docprice doc 
                                  INNER JOIN docpricebody docprb ON doc.id = docprb.doc_id 
                              WHERE 
                                  doc.datetime = date('$date') 
                                  AND doc.status = '1' 
                              GROUP BY 
                                  docprb.product_id
                          ) maxdate 
                          JOIN docpricebody docprb ON docprb.product_id = maxdate.product_id 
                          JOIN docprice doc ON doc.id = docprb.doc_id 
                          AND doc.datetime = maxdate.max_date 
                          AND doc.status = '1'
                  ) price ON price.product_id = p.id 
              WHERE 
                  price.product_id IS NOT NULL 
                  OR NOT EXISTS(
                      SELECT 
                          1 
                      FROM 
                          docpricebody docprb 
                      WHERE 
                          docprb.product_id = p.id
                  ) 
              ORDER BY 
                  datetime DESC";
    return $this->_db->Query($sqlString);
  }
}
  ?>