$(document).ready(function () {

    $('#distributionForm').validate({

        errorElement: 'small',
        errorClass: 'text-danger d-block',

        rules: {
            distribution_date: { required: true }
        },
        messages: {
            distribution_date: { required: 'Please select a date.' }
        },

        submitHandler: function (form) {

            $('#distributionAlert').addClass('d-none').text('');
            $('#distributionQuantityError').text('');
            $('[data-error]').text('');

            $.ajax({
                url: DISTRIBUTION_URL,
                type: 'POST',
                data: $(form).serialize(),
                dataType: 'json',

                success: function (response) {
                    window.location.href = response.redirect;
                },
                error: function (xhr) {

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (field, messages) {
                            if (field === 'quantities') {
                                $('#distributionQuantityError').text(messages[0]);
                            } else {
                                $('[data-error="' + field + '"]').text(messages[0]);
                            }
                        });
                        return;
                    }

                    $('#distributionAlert') .text('Something went wrong. Please try again.') .removeClass('d-none');
                }
            });
            return false;
        }
    });

    $('#distributionForm input[name^="quantities["]').each(function () {
        $(this).rules('add', {
            required: true,
            number: true,
            min: 0,
            messages: {
                required: 'Please enter a quantity.',
                number: 'Please enter a valid number.',
                min: 'Quantity cannot be negative.'
            }
        });
    });
    
    $('#distributionForm').on('input change', 'input', function () {
        $('#distributionQuantityError').text('');
        $('#distributionAlert').addClass('d-none');
        $(this).siblings('[data-error]').text('');
    });
});