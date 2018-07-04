<!DOCTYPE html>
<html lang="en">
<head>
  <title>Price List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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


  <table id="table_id" class="table">
    <thead>
      <tr>
        <th>Наминование</th>
        <th>Описание</th>
        <th>Номер документа</th>
        <th>Дата  документа</th>
        <th>Цена</th>
      </tr>
    </thead>
    <tbody>
  <?php if (isset($pricelist)){
     foreach ($pricelist as $list){
      echo "<tr>
              <td>$list[title]</td>
              <td>$list[description]</td>
              <td>$list[document_id]</td>
              <td>$list[datetime]</td>
              <td>$list[price]</td>
            </tr>";
    }}
    ?>
    </tbody>
  </table>
</div>

</body>

<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</html>
