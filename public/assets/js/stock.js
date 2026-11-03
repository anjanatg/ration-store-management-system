
$(document).ready(function () {

    function toggleSupplierField() {
        if ($('#transaction_type').val() === 'addition') {
            $('#supplierField').show();
        } else {
            $('#supplierField').hide();
        }
    }
    toggleSupplierField();
    $('#transaction_type').on('change', function () {
        toggleSupplierField();
    });

});
