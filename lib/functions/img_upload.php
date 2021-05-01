<?php

function img_process($file_name,$tmp_name,$id)
{
        // call the Auto_id module and insert img URL into DB         
        $grn_image = $id."_".$file_name;

        //redirect the file into newly created folder with its name
        $path="../../images/grn/".$grn_image;

        $db_path = "images/grn/".$grn_image;
        
        move_uploaded_file($tmp_name,$path);

        return $db_path;

}

function img_product($file_name,$tmp_name,$id,$folder_name)
{
        // call the Auto_id module and insert img URL into DB 
        $prod_image = $id."_".$file_name;

        //redirect the file into newly created folder with its name
        $path="../../images/".$folder_name."/".$prod_image;

        $db_path = "images/".$folder_name."/".$prod_image;
        
        move_uploaded_file($tmp_name,$path);

        return $db_path;
}

function img_employee($file_name,$tmp_name,$id,$folder_name)
{
        // call the Auto_id module and insert img URL into DB 
        $emp_image = $id."_".$file_name;

        //redirect the file into newly created folder with its name
        $path="../../images/".$folder_name."/".$emp_image;

        $db_path = "images/".$folder_name."/".$emp_image;
        
        move_uploaded_file($tmp_name,$path);

        return $db_path;
}

function img_part($file_name,$tmp_name,$id,$folder_name)
{
        // call the Auto_id module and insert img URL into DB 
        $part_image = $id."_".$file_name;

        //redirect the file into newly created folder with its name
        $path="../../images/".$folder_name."/".$part_image;

        $db_path = "images/".$folder_name."/".$part_image;
        
        move_uploaded_file($tmp_name,$path);

        return $db_path;
}

function grn_pdf($file_name,$tmp_name,$id,$folder_name)
{
        // call the Auto_id module and insert img URL into DB 
        $grn_pdf = $id."_".$file_name;

        //redirect the file into newly created folder with its name
        $path="../../images/".$folder_name."/".$grn_pdf;

        $db_path = "images/".$folder_name."/".$grn_pdf;
        
        move_uploaded_file($tmp_name,$path);

        return $db_path;
}

?>
