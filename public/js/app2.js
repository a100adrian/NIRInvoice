var $collectionHolder;

$(document).ready(function() {
    $('#example').DataTable();

    $collectionHolder = $('#stock-list');
    $collectionHolder.data('index', 0);
    $('#add_single_product').click(function () {
        addFormAndPreview();
    })
} );

function addFormAndPreview() {
    var index = $collectionHolder.data('index');

    console.log(index);
    var $table = $('#display_selected_products');
    var $qty = $('#qty').val();
    var $um = $('#um').val();
    var $price = $('#price').val();
    var $type = $('#type').val();
    var $obs = $('#obs').val();
    var $name = $('#name').val();
    var value = getVal($qty, $price);
    var newForm = $collectionHolder.data('prototype');
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/\[name]" required="required"/g, '[name]" required="required" value="'+$name+'"');
    newForm = newForm.replace(/\[qty]" required="required"/g, '[qty]" required="required" value="'+$qty+'"');
    newForm = newForm.replace(/\[um]" required="required"/g, '[um]" required="required" value="'+$um+'"');
    newForm = newForm.replace(/\[price]" required="required"/g, '[price]" required="required" value="'+$price+'"');
    newForm = newForm.replace(/\[type]" required="required"/g, '[type]" required="required" value="'+$type+'"');
    newForm = newForm.replace(/\[value]" required="required"/g, '[value]" required="required" value="'+value+'"');
    newForm = newForm.replace(/\[obs]" replace="replace_me"/g, '[obs]" value="'+$obs+'"');
    $collectionHolder.data('index', index+1);
    var row = '<tr class="tr_append-row">' +
        '<td>'+$name+'</td>' +
        '<td>'+$um+'</td>' +
        '<td>'+$type+'</td>' +
        '<td>'+$qty+'</td>' +
        '<td>'+$price+'</td>' +
        '<td>'+value+'</td>' +
        '<td>'+$obs+'</td>' +
        '<td align="right">'+'<button type="button" id="remove_single_product'+index+'"><i class="fa fa-trash" style="font-size:18px"></i></button></td>' +
        '</tr>';
    $table.append(row);
    $('.panel').append(newForm);
    setFocus();
    $('#remove_single_product'+index).click(function () {
        $(this).closest(".tr_append-row").remove();
        $('#nir_products_'+index).remove();
    });

}

function setFocus() {
    var $qty = $('#qty');
    var $um = $('#um');
    var $price = $('#price');
    var $type = $('#type');
    var $obs = $('#obs');
    var $name = $('#name');
    $name.val('').attr('placeholder', 'name').focus();
    $qty.val('').attr('placeholder', 'qty');
    $um.val('').attr('placeholder', 'um');
    $price.val('').attr('placeholder', 'price');
    $type.val('');
    $obs.val('').attr('placeholder', 'obs');
}

function getVal(q, p){
    return parseInt(q) * parseFloat(p);
}
