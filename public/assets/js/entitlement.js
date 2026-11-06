$(document).ready(function () {
    $('#entitlementForm').validate({
        rules: {
            card_category_id: { required: true },
            product_id: { required: true },
            monthly_quantity: { required: true, number: true, min: 1 },
            price_per_unit: { required: true, number: true, min: 0 }
        },
        messages: {
            card_category_id: 'Please select a ration card category',
            product_id: 'Please select a product',
            monthly_quantity: {
                required: 'Please enter the monthly quantity',
                min: 'Quantity must be at least 1'
            },
            price_per_unit: {
                required: 'Please enter the price',
                min: 'Price cannot be negative'
            }
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            $('#entitlementAlert').addClass('d-none');

            $.ajax({
                url: ENTITLEMENT_URL,
                type: 'POST',
                data: $(form).serialize(),
                success: function () {
                    window.location.href = response.redirect;
                },
                error: function (xhr) {
                    let message = 'Something went wrong.';

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        message = Object.values(errors)[0][0];
                    }

                    $('#entitlementAlert').text(message).removeClass('d-none');
                }
            });
        }
    });
    $('#entitlementForm select, #entitlementForm input').on('change keyup', function () {
    $(this).removeClass('is-invalid');
    $(this).siblings('.text-danger, .invalid-feedback, .error').hide();
});

});