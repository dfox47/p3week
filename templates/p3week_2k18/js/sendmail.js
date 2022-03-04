var $ = jQuery.noConflict();

$(window).bind("load", function() {

	sendmail();

	// AJAX contact form
	function sendmail() {
		var messageDelay = 2000;

		$(".popup_present").find("form").submit(submitForm);

		function submitForm() {
			var contactForm = $(this);

			if (!$(this).find('.input_fio').val() || !$(this).find('.input_org').val() || !$(this).find('.input_status').val()) {
				$(".msg_incomplete").addClass("active").delay(messageDelay).queue(function() {
				// $(this).find(".msg_incomplete").addClass("active").delay(messageDelay).queue(function() {
					$(this).removeClass("active").dequeue();
				});
			}
			else {
				$(this).find(".msg_sending").addClass("active");

				$.ajax({
					url:		contactForm.attr('action') + "?ajax=true",
					type:		contactForm.attr('method'),
					data:		contactForm.serialize(),
					success:	submitFinished
				});
			}

			return false;
		}

		function submitFinished(response) {
			response = $.trim(response);
			//$('.msg_sending').removeClass("active");

			if (response == "success") {
				/*$(".msg_success").addClass("active").delay(messageDelay).queue(function() {
					$(this).removeClass("active").dequeue();
				});*/

				$(".popup_present_wrap").removeClass("active");
				$("body, html").removeClass("overflow_hidden");

				var link_item = $(".input_data").val();

				window.open('/images/2017/' + link_item + '.pdf','_blank','','');
			}
			else {
				$(".msg_fail").addClass("active").delay(messageDelay).queue(function() {
					$(this).removeClass("active").dequeue();
				});
			}
		}
	}
});