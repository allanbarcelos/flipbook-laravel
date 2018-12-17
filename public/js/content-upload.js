$(document).ready(function() {
    $('form#formDelete').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type     : "POST",
            data     : {_token: CSRF_TOKEN, 'idClient' : formData},
            dataType: 'JSON',
            cache    : false,
            success  : function()
            {

            },
            error: function()
            {

            }
        }).fail(
            function(){

            }
        );
    });
});
