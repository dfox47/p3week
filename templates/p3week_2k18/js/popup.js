
let popupClose      = document.querySelectorAll('.js-popup-close')
let popupShow       = document.querySelectorAll('.js-popup-show')
let popupList       = document.querySelectorAll('.js-popup')
let popupShowReg    = document.querySelectorAll('.js-popup-show-reg')

popupClose.forEach((button) => {
	button.addEventListener('click', (e) => {
		e.preventDefault()

		popupList.forEach((popup) => {
			popup.classList.remove('active')
		})
	})
})

popupShow.forEach((button) => {
	button.addEventListener('click', (e) => {
		e.preventDefault()

		let popupShowId = e.target.dataset.popup

		popupList.forEach((popup) => {
			let popupListId = popup.dataset.popup

			if ( popupListId === popupShowId ) {
				popup.classList.add('active')

				return
			}

			popup.classList.remove('active')
		})
	})
})

popupShowReg.forEach((button) => {
	button.addEventListener('click', (e) => {
		e.preventDefault()

		document.querySelector('.js-popup[data-popup="registration"]').classList.add('active')
		document.querySelector('html').classList.remove('menu_top__active')
	})
})
