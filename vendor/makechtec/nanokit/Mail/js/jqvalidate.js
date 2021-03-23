(function( $ ){
    'use strict';

    $(function() {
		var v = $("#contactform").validate({
			submitHandler: function (form) {

				let formDataToSend = $(form).serialize();

				$.ajax(
					{
						type: "POST",
						url: "https://www.starmediasoluciones.com/public/send.php",
						data: formDataToSend,
						dataType: "text",
						error: function( xmlHttpResponse,status ){
							console.log("an error has occurred");
							console.log(xmlHttpResponse.status);
						},
						success: function( dataResponse, textStatus, xmlHttpResponse ){
							$("#contactform")[0].reset();
							$("#serverResponse").html( dataResponse );
							console.log(xmlHttpResponse.status);
						}
					}
				);
				return false;
			}
		});
	});

}(jQuery));