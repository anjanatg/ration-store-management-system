$(document).ready(function () {

    $('#entitlementForm').validate({

        rules: {
            card_category_id: {
                required: true
            },
            product_id: {
                required: true
            },
            monthly_quantity: {
                required: true,
                number: true,
                min: 0.01
            },
            quantity: {
                required: true,
                number: true,
                min: 0.01
            },
            price_per_unit: {
                required: true,
                number: true,
                min: 0
            },
            price: {
                required: true,
                number: true,
                min: 0
            }
        },

        messages: {
            card_category_id: 'Please select a ration card category.',
            product_id: 'Please select a product.',

            monthly_quantity: {
                required: 'Please enter monthly quantity.',
                min: 'Quantity must be greater than 0.'
            },

            quantity: {
                required: 'Please enter monthly quantity.',
                min: 'Quantity must be greater than 0.'
            },

            price_per_unit: {
                required: 'Please enter the price.',
                min: 'Price cannot be negative.'
            },

            price: {
                required: 'Please enter the price.',
                min: 'Price cannot be negative.'
            }
        },

        errorPlacement: function (error, element) {
            let name = element.attr('name');
            $('[data-error="' + name + '"]').html(error);
        },

        highlight: function (element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');

            let name = $(element).attr('name');
            $('[data-error="' + name + '"]').html('');
        },

        submitHandler: function (form) {

            $('.error-message').html('');
            $('.is-invalid').removeClass('is-invalid');

            $('#entitlementAlert').addClass('d-none').html('');

            $.ajax({

                url: ENTITLEMENT_URL,
                type: 'POST',
                data: $(form).serialize(),
                dataType: 'json',

                headers: {'Accept': 'application/json'},
                success: function (response) {
                    window.location.href = response.redirect;
                },
                error: function (xhr) {

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, messages) {
                            $('[data-error="' + key + '"]')
                                .html(messages[0]);

                            $('[name="' + key + '"]')
                                .addClass('is-invalid');
                        });

                    } else {

                        let message = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                        $('#entitlementAlert')
                            .text(message)
                            .removeClass('d-none');
                    }
                }
            });

            return false;
        }
    });

});