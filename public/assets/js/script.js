$(function () {
    "use strict"
    $('.myDataTable').dataTable();
    $('.select2').select2();
    $(".hideDiv").hide();

    $(document).on("change", ".ptype", function(){
        let tid = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/ajax/change/type',
            data: { 'type_id': tid},
            success: function (res) {              
                if(res.category_id == 3){
                    $(".divAxis, .divAdd").hide();
                    $(".selAxis, .selAdd").val("");
                    $(".selAxis, .selAdd").select2();
                }else{
                    $(".divAxis, .divAdd").show();
                }
                if(res.category_id == 1 || res.category_id == 3){
                    $(".divEye").hide();
                    $(".selEye").val("");
                    $(".selEye").select2();
                }else{
                    $(".divEye").show();
                }
            },
            error: function (err) {
                console.log(err)
            }
        })
    });
})