
let html        = document.querySelector('html')
let searchBtn   = document.querySelectorAll('.js-search-toggle')

searchBtn.forEach((button) => {
	button.addEventListener('click', () => {
		html.classList.toggle('search__active')
	})
})
