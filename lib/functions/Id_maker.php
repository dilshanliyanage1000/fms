<?php
    //import database connection
    include_once('db_conn.php');


    function Auto_id($id, $table, $string){

        //calling the connection
        $conn = Connection();

        $string = $string;

        $prev_id = "SELECT $id FROM $table ORDER BY $id DESC limit 1;";

        $result = mysqli_query($conn,$prev_id);

        //error checking 
        if(mysqli_errno($conn)){
            echo(mysqli_error($conn));
        }

        if(mysqli_num_rows($result) > 0 ){

            $rec = mysqli_fetch_assoc($result);
            $lid = $rec[$id];
            $num = substr($lid,3);
            $num = $num+1;
            $id = str_pad($num,7,'0',STR_PAD_LEFT);
            $newId = $string.$id;
            return($newId);
        }
        else{
            $newId = $string.'0000001';
            return($newId);
        }
    }    
?>