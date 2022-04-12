
const regCategory   = document.querySelector('.js-reg-category')
const regDays       = document.querySelectorAll('.js-reg-days')
const regPrice      = document.querySelector('.js-reg-price')
const regStep       = document.querySelectorAll('.js-reg-step-show')
const regSteps      = document.querySelectorAll('.js-reg-step')

// set price at page load
regPrice.innerHTML = regCategory.options[regCategory.selectedIndex].dataset.price

regStep.forEach((item) => {
	item.addEventListener('click', (e) => {
		e.preventDefault()
		const step = e.target.dataset.step

		// hide all steps
		regSteps.forEach( (step) => {
			step.classList.remove('active')
		})

		// show selected step
		document.querySelector('.js-reg-step[data-step="' + step + '"]').classList.add('active')
	})
})

// category selection
regCategory.addEventListener('change', (e) => {
	const selectedCategory = e.target.value

	// set price after category changed
	regPrice.innerHTML = e.target.options[e.target.selectedIndex].dataset.price;

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

// selected days changed | depend on category type
regDays.forEach((item, indexDay) => {
	item.addEventListener('change', () => {
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
