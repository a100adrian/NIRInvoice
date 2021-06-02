var $collectionHolder;
var maxIndex;
var index;

$(document).ready(function () {
    //index = $('#stock_index').val();
    $collectionHolder = $('#display_stock');
    $collectionHolder.DataTable();
    var maxIdex = $collectionHolder.DataTable().rows().count();

    $collectionHolder.data('index', $collectionHolder.find('#stock_list').length);
    for(var i=0; i<=maxIdex; i++){
        addFormUserView(i)
        $('#add_single_product'+i).click(function (e) {
            addForm(i);
        });
    }

    $collectionHolder.find('.n_add_form').append(addNonStockFormView());
    $('#non_stock_add_product').click(function (e) {
        maxIndex = maxIndex + 1;
        addNonStockForm(maxIndex);
    });
});


function addForm(index) {
    console.log(index);
    var $table = $('#display_selected_products');
    var $qty = $('#qty'+index).val();
    var $p = $('#price'+index).val();
    var $um = $('#um'+index).val();
    var $hash = $('#f_hash'+index).text();
    var $name = $('#f_name'+index).text();
    var value = getVal($qty, $p);
    var newForm = $collectionHolder.data('prototype');
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/\[name]" required="required"/g, '[name]" required="required" value="'+$name+'"');
    newForm = newForm.replace(/\[um]" required="required"/g, '[um]" required="required" value="'+$um+'"');
    newForm = newForm.replace(/\[qty]" required="required"/g, '[qty]" required="required" value="'+$qty+'"');
    newForm = newForm.replace(/\[price]" required="required"/g, '[price]" required="required" value="'+$p+'"');
    newForm = newForm.replace(/\[value]" required="required"/g, '[value]" required="required" value="'+value+'"');
    newForm = newForm.replace(/\[hash]" required="required"/g, '[hash]" required="required" value="'+$hash+'"');
    var row = '<tr class="tr_append-row">' +
        '<td>'+$name+'</td>' +
        '<td>'+$um+'</td>' +
        '<td>'+$qty+'</td>' +
        '<td>'+$p+'</td>' +
        '<td>'+value+'</td>' +
        '<td align="right">'+'<button type="button" id="remove_single_product'+index+'"><i class="fa fa-trash" style="font-size:18px"></i></button></td>' +
        '</tr>';
    $table.append(row);
    //console.log(newForm);
    $('#inject_forms_here').append(newForm);
    $('#remove_single_product'+index).click(function () {
        $(this).closest(".tr_append-row").remove();
        $('#invoice_billed_products_'+index).remove();
    });

}

function getVal(q, p){
    return parseInt(q) * parseFloat(p);
}

function addFormUserView(index) {

    $('#f_qty'+index).append('<input id="qty'+index+'" type="text" placeholder="Qty">');
    $('#f_um'+index).append('<input id="um'+index+'" type="text" placeholder="UM">');
    $('#f_price'+index).append('<input id="price'+index+'" type="text" placeholder="Price">');
    $('#f_add_product'+index).append('<button type="button" id="add_single_product'+index+'"><i class="fa fa-plus" style="font-size:18px"></i></button>');
}

function addNonStockFormView() {
    $('#non_stock_name').append('<input id="n_name" size="40" type="text" placeholder="Add non existing stock">');
    $('#non_stock_um').append('<input id="n_um" type="text" placeholder="UM">');
    $('#non_stock_qty').append('<input id="n_qty" type="text" placeholder="Qty">');
    $('#non_stock_price').append('<input id="n_price" type="text" placeholder="Price">');
    $('#non_stock_add_product').append('<button type="button" id="add_single_product"><i class="fa fa-plus" style="font-size:18px"></i></button>');

}

function addNonStockForm(index) {
    var $table = $('#display_selected_products');
    var $qty = $('#n_qty').val();
    var $p = $('#n_price').val();
    var value = getVal($qty, $p);
    var $um = $('#n_um').val();
    var $name = $('#n_name').val();
    var newForm = $collectionHolder.data('prototype');
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/\[name]" required="required"/g, '[name]" required="required" value="'+$name+'"');
    newForm = newForm.replace(/\[um]" required="required"/g, '[um]" required="required" value="'+$um+'"');
    newForm = newForm.replace(/\[qty]" required="required"/g, '[qty]" required="required" value="'+$qty+'"');
    newForm = newForm.replace(/\[price]" required="required"/g, '[price]" required="required" value="'+$p+'"');
    newForm = newForm.replace(/\[value]" required="required"/g, '[value]" required="required" value="'+value+'"');
    newForm = newForm.replace(/\[hash]" required="required"/g, '[hash]" required="required" value="blank_search"');
    var row = '<tr class="tr_append-row">' +
        '<td>'+$name+'</td>' +
        '<td>'+$um+'</td>' +
        '<td>'+$qty+'</td>' +
        '<td>'+$p+'</td>' +
        '<td>'+getVal($qty, $p)+'</td>' +
        '<td align="right">'+'<button type="button" id="remove_single_product'+index+'"><i class="fa fa-trash" style="font-size:18px"></i></button></td>' +
        '</tr>';
    $table.append(row);
    //console.log(newForm);
    $('#inject_forms_here').append(newForm);
    $('#remove_single_product'+index).click(function () {
        $(this).closest(".tr_append-row").remove();
        $('#invoice_billed_products_'+index).remove();
    });
}