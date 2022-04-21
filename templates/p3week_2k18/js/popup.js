
let popupClose  = document.querySelectorAll('.js-popup-close')
let popupShow   = document.querySelectorAll('.js-popup-show')
let popupList   = document.querySelectorAll('.js-popup')

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

popupClose.forEach((button) => {
	button.addEventListener('click', (e) => {
		e.preventDefault()

		popupList.forEach((popup) => {
			popup.classList.remove('active')
		})
	})
})
