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
    $("#stockForm").validate({
        rules: {
            product_id: {
                required: true
            },
            transaction_type: {
                required: true
            },
            quantity: {
                required: true,
                number: true,
                min: 0.01
            },
            transaction_date: {
                required: true
            }
        },

        messages: {
            product_id: "Please select a product.",
            transaction_type: "Please select the transaction type.",
            quantity: {
                required: "Please enter the quantity.",
                number: "Quantity must be a number.",
                min: "Quantity must be greater than 0."
            },
            transaction_date: "Please select the transaction date."
        },

        errorElement: "div",
        errorClass: "invalid-feedback",

        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

});