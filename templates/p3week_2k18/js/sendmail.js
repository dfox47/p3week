
var $ = jQuery.noConflict()

$(window).bind('load', function() {
	sendmail()

	// AJAX contact form
	function sendmail() {
		var messageDelay = 2000

		$('.popup_present').find('form').submit(submitForm)

		function submitForm() {
			let contactForm = $(this)

			if (!contactForm.find('.input_fio').val() || !contactForm.find('.input_org').val() || !contactForm.find('.input_status').val()) {
				$('.msg_incomplete').addClass('active').delay(messageDelay).queue(function() {
					contactForm.removeClass('active').dequeue()
				})
			}
			else {
				contactForm.find('.msg_sending').addClass('active')

				$.ajax({
					data:       contactForm.serialize(),
					success:    submitFinished,
					type:       contactForm.attr('method'),
					url:        contactForm.attr('action') + '?ajax=true'
				})
			}

			return false
		}

		function submitFinished(response) {
			response = $.trim(response)

			if (response === 'success') {
				$('.popup_present_wrap').removeClass('active')
				$('body, html').removeClass('overflow_hidden')

				let linkItem = $('.input_data').val()

				window.open('/images/2017/' + linkItem + '.pdf','_blank','','')
			}
			else {
				$('.msg_fail').addClass('active').delay(messageDelay).queue(function() {
					$(this).removeClass('active').dequeue()
				})
			}
		}
	}
})
