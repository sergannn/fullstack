<!DOCTYPE html>
<html lang="en">
<head>
  <title>Price List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.js" ></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js" ></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js" ></script>
<script src="../dataTables.altEditor.free.js" ></script>

  <style>
body {
    background-color: #f0f2f3;
    background: -webkit-radial-gradient(rgba(0, 0, 0, .1)1px, transparent 1px);
    background: radial-gradient(rgba(0, 0, 0, 0.15)1px, rgba(216, 217, 219, 0.28) 1px);
    -webkit-background-size: 8px 8px;
    background-size: 8px 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Прайслист</h2>
  <p>Список товаров с последней ценой на: <?php echo $date ?></p>  
  <form action="index.php" method="post">
   <p>Выберите дату: <input type="date" name="calendar">
   <input type="submit" value="Отправить"></p>
  </form>
<?php  echo '<div style="display:none;" id="keys">';
             foreach($pricelist[0] as $key=>$value) 
             { echo '<span>'.$key.'</span>';
            
             }
            echo '</div>';
            ?>

  <table id="table_id" class="table">
    <!--<thead>
      <tr>
        <th>Наминование</th>
        <th>Описание</th>
        <th>Номер документа</th>
        <th>Дата  документа</th>
        <th>Цена</th>
      </tr>
    </thead>-->
    <tbody>
  <?php if (isset($pricelist)){
   // print_r($pricelist);
   
    foreach($pricelist as $list) 
    { 
      echo '<tr>';
      //print_r($list);
      foreach($list as $key=>$field)
      {echo '<td>'.$field.'</td>';}
   
    }
   echo '</tr>';
  }
   ?>

    </tbody>
  </table>
</div>

</body>

<script>
$(document).ready(function() {
    console.log('ready');
/*здесь массив - названия столбцов - у них есть data и title
подозреваю, что data - говорит о том, что в json под этим ключем данные,
а title - как оно будет выглядеть в таблице
*/
/* json файла два - они почти одинаковые, я пока не понял в чем разница
смотрим, есть ли там id,name,position*/
/* id,name есть, судя по всему - второй файл это фейк, как будто инфа вернулась с сервера
после запросов в духе "редактировать" */
/*видимо, json файл попал в кеш или не сохранился
либо обращение идет не к этому файлу*/
       
url_ws_mock_ok="../controllers/ajaxController.php";   
/*itle, 
                  description, 
                  document_id, 
                  datetime, 
                  price */
                  var columnDefs = [];
                  $("#keys span").each(function(index,el)
                  {console.log(el);
                      columnDefs.push({data:el.innerHTML,title:el.innerHTML});
                  });
               //   window.keys=columnDefs;

    var myTable;
    myTable = $('#table_id').DataTable({
      dom: 'Bfrtip',       
      select: 'single',
    responsive: true,
    altEditor: true,     // Enable altEditor
      columns: columnDefs,
      buttons: [
        {
        text: 'Add',
        name: 'add'        // do not change name
        },
        {
        extend: 'selected', // Bind to Selected row
        text: 'Edit',
        name: 'edit'        // do not change name
        },
        {
        extend: 'selected', // Bind to Selected row
        text: 'Delete',
        name: 'delete'      // do not change name
        }
    ],
    onAddRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be / with type='PUT'
                url: url_ws_mock_ok,
                type: 'PUT  ',
                data: rowdata,
                success: success,
                error: error
            });
        },
        onDeleteRow: function(datatable, rowdata, success, error) {
          console.log(rowdata);
            $.ajax({
                // a tipycal url would be /{id} with type='DELETE'
                url: url_ws_mock_ok,
                type: 'DELETE',
                data: rowdata[0],
                success: success,
                error: error
            });
        },
        onEditRow: function(datatable, rowdata, success, error) {
            $.ajax({
                // a tipycal url would be /{id} with type='POST'
                url: url_ws_mock_ok,
                type: 'POST',
                data: rowdata,
                success: success,
                error: error
            });
        }
            });
        
    });





</script>
</html>
