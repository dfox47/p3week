
let goBack = document.querySelectorAll('.js-go-back')

goBack.forEach((btn) => {
	btn.addEventListener('click', () => {
		history.back()
	})
})
