$(document).ready(function () {

    $("#myForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "postForm.ajax.php",
            data: $("#myForm").serialize(),
            dataType: "json",

            success: function (msg) {
                $("#formResponse").addClass(msg.status);
                $("#formResponse").html('Email Sent');

            },
            error: function () {
                $("#formResponse").html("There was an error submitting the form. Please try again.");
            }
        });

        return false;


    });


});
