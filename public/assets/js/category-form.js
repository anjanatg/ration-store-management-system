$(document).ready(function () {
    $("#categoryForm").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: "Please enter the category name."
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
            $("#categoryAlert").addClass("d-none").text("");
            $(".server-error").remove();

            $.ajax({
                url: CATEGORY_URL,
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
                    $("#categoryAlert").text(message).removeClass("d-none");
                }
            });

            return false;
        }
    });

});