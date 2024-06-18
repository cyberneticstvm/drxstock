$(function () {
    "use strict"
    $('.myDataTable').dataTable();
    $('.select2').select2();

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

    $(document).on("click", ".dltRow", function () {
        $(this).parent().parent().remove();
    });

    $(document).on("click", ".addNewProduct", function(){
        $.ajax({
            type: 'GET',
            url: '/ajax/get/products',
            dataType: 'json',
            success: function (res) {    
                $(".pdctPurRow").append(`<tr><td><select class="form-control form-control-lg select2 selProduct" name="product_id[]" required><option></option></select></td><td><input type="number" name='qty[]' class="form-control form-control-lg text-center" placeholder="0" min='1' step="1" required /></td><td><input type="number" name='unit_purchase_price[]' class="form-control form-control-lg text-end" placeholder="0" min='1' step="1" required /></td><td><input type="number" name='unit_selling_price[]' class="form-control form-control-lg text-end" placeholder="0" min='1' step="1" required /></td><td class="text-center"><a href="javascript:void(0)" class="dltRow"><i class="fa fa-trash text-danger"></i></a></td></tr>`);                    
                
                var xdata = $.map(res, function (obj) {
                    obj.text = obj.name || obj.id;
                    return obj;
                });
                //$('.selPdct').last().select2().empty();                      
                $('.selProduct').last().select2({
                    placeholder: 'Select',
                    data: xdata
                });
            },
            error: function (err) {
                console.log(err)
            }
        })
    });

    $(document).on("change", ".selPdct", function () {
        let dis = $(this); let product = dis.val(); let editQty = dis.data('qty');
        if (product) {
            $.ajax({
                type: 'GET',
                url: '/ajax/product/' + product + '/' + editQty,
                dataType: 'json',
                success: function (res) {
                    dis.parent().parent().find(".qtyAvailable").val(res[0].balanceQty);
                    dis.parent().parent().find(".qtyMax").attr("max", res[0].balanceQty);
                    dis.parent().parent().find(".qtyMax").val("1");
                    console.log(err);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    });
})