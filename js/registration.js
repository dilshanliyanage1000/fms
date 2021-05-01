$(document).ready(function(){
    //check btn click
    $("#btn_reg").click(function(){
        
        //send ajax request to process page
        $.ajax({
            url:"lib/route/registration.php",
            type:"POST",
            data:$("#reg_form").serialize(),
            success: (data) => {
                if(data == "success"){
                    window.location.href="lib/views/admin.php";
                }
                else{
                    alert(data);
                }
            },
            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        })
    })
})