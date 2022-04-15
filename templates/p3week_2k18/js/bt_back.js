
let goBack = document.querySelectorAll('.bt_back')

goBack.forEach((btn) => {
	btn.addEventListener('click', () => {
		history.back()
	})
})
