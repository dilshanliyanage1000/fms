<?php

//insert.php;

if(isset($_POST["product"]))
{
 include('../../functions/db_conn.php');

 include_once('../../functions/Id_maker.php');

 $connect = Connection();
 
  $prod_id = $_POST['product'];

 for($count = 0; $count < count($_POST["part"]); $count++)
 {
  // $prod_id = mysqli_real_escape_string($connect, $_POST['product'][$count]);
  $part_id = mysqli_real_escape_string($connect, $_POST['part'][$count]);
  $part_qty = mysqli_real_escape_string($connect, $_POST['qty'][$count]);


  // $data = array(
  //  ':prod_id'   => $_POST["product"],
  //  ':part_id'   => $_POST["part"][$count],
  //  ':part_qty'  => $_POST["qty"][$count],
  // );

  $id = Auto_id('prodraw_id','m_prod_parts_tbl','PRM');

  $query = "INSERT INTO m_prod_parts_tbl (prodraw_id, prod_id, part_id, part_qty,prodraw_status) VALUES ('$id','$prod_id','$part_id','$part_qty', 1)";

  $statement = mysqli_query($connect, $query);

  //validate the command
  if (mysqli_errno($connect)) {
    echo (mysqli_error($connect));
}

    if($statement > 0){
      echo("success");
      
    }
 }

// echo("success");

}


?>
