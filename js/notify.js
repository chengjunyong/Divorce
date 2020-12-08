
$("#notify").click(function(){
        var n_id = $(this).attr("value");
        $.post("ajax/notify.php",
        {
            type : "get",
            value : n_id

        },
        function(data){
            if(data != ""){
                var str = "( "+data+" ) is request you as spouse.\nPlease make sure your spouse name before accept this request";
                if(confirm(str)){
                    $.post("ajax/notify.php",
                        {
                            type : "link",
                            value : n_id

                        },function(data){
                            if(data == true){
                                alert("Relation establish successful");
                                location.reload();

                            }else{
                                alert("Relation establish unsuccessful, please try again later");
                                location.reload();
                            }
                        },"html");
                }
            }

        },"html");


    });