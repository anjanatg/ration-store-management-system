$(document).ready(function () {
    var isEdit = $("#userForm").data("mode") === "edit";
    $("#userForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: !isEdit,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#password"
            },
            age: {
                number: true,
                min: 1,
                max: 120
            },
            phone: {
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            gender: {
                required: true
            }
        },
        messages: {
            name: "Please enter the user's name.",
            email: {
                required: "Please enter a email.",
                email: "Enter the correct valid email."
            },
            password: {
                required: "Please enter a password.",
                minlength: "Password must be at least 8 characters."
            },
            password_confirmation: {
                equalTo: "Passwords do not match."
            },
            gender: "Select a gender."
        },
        errorElement: "div",
        errorClass: "invalid-feedback",
        errorPlacement: function (error, element) {
            if (element.attr("name") === "gender") {
                error.css("display", "block").appendTo("#gender-error");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            $("#userAlert").addClass("d-none").text("");
            $(".server-error").remove();

            $.ajax({
                url: USER_URL,
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
                            if (field === "gender") {
                                $("<div>")
                                    .addClass("invalid-feedback server-error")
                                    .css("display", "block")
                                    .text(messages[0])
                                    .appendTo("#gender-error");
                                return;
                            }
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
                    $("#userAlert").text(message).removeClass("d-none");
                }
            });

            return false;
        }
    });

});