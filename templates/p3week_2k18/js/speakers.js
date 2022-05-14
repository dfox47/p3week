
let speakersItems = document.querySelectorAll('.js-speakers-item')
let speakersLinks = document.querySelectorAll('.js-speakers-link')

speakersLinks.forEach((item) => {
	item.addEventListener('click', (link) => {
		let letter = link.target.dataset.link

		// remove class from all letters
		speakersLinks.forEach((e) => {
			e.classList.remove('active')
		})

		// add class to current letter
		link.target.classList.add('active')

		// ALL selected
		if ( letter === 'all' ) {
			speakersItems.forEach((item) => {
				item.classList.remove('hidden')
			})

			return
		}

		speakersItems.forEach((item) => {
			if (item.dataset.name === letter) {
				item.classList.remove('hidden')

				return
			}

			item.classList.add('hidden')
		})
	})
})
