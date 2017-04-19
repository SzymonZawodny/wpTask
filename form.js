$(document).ready(function () {

    $("#myForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "postForm.ajax.php",
            data: $("#myForm").serialize(),
            dataType: "json",

            success: function (msg) {
                $("#formResponse").removeClass('error');
                $("#formResponse").addClass(msg.status);
                if (msg.status) {
                    $("#formResponse").html(msg.message);
                } else {
                    $("#formResponse").html("Email sent!");
                }

            },
            error: function () {
                $("#formResponse").removeClass('success');
                $("#formResponse").addClass('error');
                $("#formResponse").html("There was an error submitting the form. Please try again.");            }
        });

        return false;


    });


});
