$(document).ready(function(){
    $(".form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength:8,
                nowhitespace: true
            },
            confirmPassword: {
                required: true,
                equalTo: "#password",
                nowhitespace: true
            }
        },
        messages: {
            email: {
                required: "Please enter a E-Mail Address",
                email: "You E-Mail Address is not valid!"
            },
            password: {
                required:"Please enter an new Password",
                minlength: "Please enter at least 8 characters!",
                nowhitespace: "Please make no use of whitespaces!"
            },
            confirmPassword: {
                required:"Please conform your Password!",
                equalTo:"Passwords doesn't match!",
                nowhitespace: "Please make no use of whitespaces!"
            }
        }
    });
});