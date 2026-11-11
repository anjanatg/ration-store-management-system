
$(document).ready(function () {

    $('#customerForm').validate({

        rules: {
            name: {
                required: true,
                minlength: 3
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            ration_card_number: {
                required: true,
                maxlength: 15
            },
            card_category_id: {
                required: true
            },
            address: {
                required: true
            }
        },

        messages: {
            name: {
                required: 'Please enter customer name.',
                minlength: 'Name must contain at least 3 characters.'
            },
            phone: {
                required: 'Please enter phone number.',
                digits: 'Please enter numbers only.',
                minlength: 'Phone number must contain 10 digits.',
                maxlength: 'Phone number must contain 10 digits.'
            },
            ration_card_number: {
                required: 'Please enter ration card number.',
                maxlength: 'Ration card number cannot exceed 15 characters.'
            },
            card_category_id: {
                required: 'Please select ration card category.'
            },
            address: {
                required: 'Please enter customer address.'
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
            $('#successMessage').addClass('d-none').html('');

            $.ajax({
                url: CUSTOMER_URL,
                type: 'POST',
                data: $(form).serialize(),
                dataType: "json",

                success: function (response) {

                    $('#successMessage')
                        .removeClass('d-none')
                        .text(response.message);

                    form.reset();

                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 1000);
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
                        alert('Something went wrong. Please try again.');
                    }
                }
            });

            return false;
        }
    });

});
