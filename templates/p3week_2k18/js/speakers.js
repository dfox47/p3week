
let speakersItems = document.querySelectorAll('.js-speakers-item')
let speakersLinks = document.querySelectorAll('.js-speakers-link')

speakersLinks.forEach((item) => {
	item.addEventListener('click', (link) => {
		let letter = link.target.textContent.toLowerCase()

		// remove class from all letters
		speakersLinks.forEach((e) => {
			e.classList.remove('active')
		})

		// add class to current letter
		link.target.classList.add('active')

		// ALL selected
		if ( letter === 'all' && letter === 'все' ) {
			speakersItems.forEach((item) => {
				item.classList.remove('hidden')
			})

			return
		}

		speakersItems.forEach((item) => {
			let firstLetter = item.querySelector('.speaker_name').textContent.charAt(0).toLowerCase()

			if (firstLetter === letter) {
				item.classList.remove('hidden')

				return
			}

			item.classList.add('hidden')
		})
	})
})
