
const regCategory   = document.querySelector('.js-reg-category')
const regDays       = document.querySelectorAll('.js-reg-days')

// category selection
regCategory.addEventListener('change', (e) => {
	const selectedCategory = e.target.value

	// Standard
	if ( selectedCategory === 'type1' ) {
		regDays.forEach((regDay,i) => {
			regDay.checked = i === 0
		})

		return
	}

	// Business
	if ( selectedCategory === 'type2' ) {
		regDays.forEach((regDay,i) => {
			if ( i === 0 || i === 1 ) {
				regDay.checked = true

				return
			}

			regDay.checked = false
		})

		return
	}

	// Premium
	if ( selectedCategory === 'type3' ) {
		for (let regDay of regDays) {
			regDay.checked = true
		}
	}
})

regDays.forEach((item, indexDay) => {
	item.addEventListener('change', e => {
		const selectedCategory = regCategory.value

		console.log('index | ', indexDay)

		// Standard
		if ( selectedCategory === 'type1') {
			regDays.forEach(regDay => {
				regDay.checked = false
			})

			item.checked = true

			return
		}

		// Business
		if ( selectedCategory === 'type2') {
			regDays.forEach((regDay, i) => {
				regDay.checked = false

				if ( indexDay === i ) {
					console.log()
				}
			})

			item.checked = true
		}
	})
})
