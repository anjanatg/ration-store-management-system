$(document).ready(function () {
    $("#loginForm").validate({
         rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email.",
                email: "valid aayitt ulla email kodukk."
            },
            password: {
                required: "Please enter your password."
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        submitHandler: function (form) {
            $("#loginAlert").addClass("d-none").text("");

            $.ajax({
                url: LOGIN,
                type: "POST",
                data: $(form).serialize(),
                dataType: "json",

                success: function (response) {
                    window.location.href = response.redirect;
                },

                error: function (xhr) {
                    let message = "Something went wrong. Please try again.";
                    if (xhr.responseJSON?.errors) 
                        {
                        message = Object.values(xhr.responseJSON.errors)[0][0];
                        }
                    else if (xhr.responseJSON?.message) 
                        {
                        message = xhr.responseJSON.message;
                        }
                    $("#loginAlert").text(message).removeClass("d-none");
                }
            });
            return false;
        } 
    });
}); 
