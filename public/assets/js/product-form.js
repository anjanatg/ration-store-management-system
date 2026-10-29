$(document).ready(function () {
    $("#productForm").validate({
        rules: {
            name: {
                required: true
            },
            category_id: {
                required: true
            },
            unit: {
                required: true
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            available_stock: {
                required: true,
                number: true,
                min: 0
            }
        },
        messages: {
            name: "Please enter the product name.",
            category_id: "Please select a category.",
            unit: "Please select a unit.",
            price: {
                required: "Please enter the price.",
                number: "Price must be a number.",
                min: "Price cannot be less than 0."
            },
            available_stock: {
                required: "Please enter the available stock.",
                number: "Stock must be a number.",
                min: "Stock cannot be less than 0."
            }
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
        },
        submitHandler: function (form) {
            $("#productAlert").addClass("d-none").text("");
            $(".server-error").remove();

            $.ajax({
                url: PRODUCT_URL,
                type: "POST",
                data: $(form).serialize(),
                dataType: "json",

                success: function (response) {
                    window.location.href = response.redirect;
                },

                error: function (xhr) {
                    var message = "Something went wrong. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            var input = $(form).find('[name="' + field + '"]');

                            if (input.length) {
                                input.addClass("is-invalid");

                                $("<div>")
                                .addClass("invalid-feedback server-error")
                                .text(messages[0])
                                .insertAfter(input);
                            }
                        });
                        message = Object.values(errors)[0][0];
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    $("#productAlert").text(message).removeClass("d-none");
                }
            });

            return false;
        }
    });

});