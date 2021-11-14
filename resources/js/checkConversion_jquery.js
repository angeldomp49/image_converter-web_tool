import jquery from 'jquery';

jQuery(function($){
    $('#check').click(function(event){
        $.ajax({
            url: makechtec.imageConverter.conversionDispatcherURL,
            success: function(response){
                console.log(response);
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});