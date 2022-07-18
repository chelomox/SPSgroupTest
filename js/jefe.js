console.log("hola");
$(document).ready(function(){
    $("#submit").click(function(){
        $.ajax({
            type: 'GET',
            url: "controllers/jefeController.php",
            success:function(data){
            console.log(data);
            alert(data);
            }
        });
    });
    $.ajax({
        type: 'GET',
        url: "controllers/jefeController.php",
        success:function(data){
            alert(data);
        }
    });
    
    return false;
});