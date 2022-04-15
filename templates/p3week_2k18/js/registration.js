
const regCategory       = document.querySelector('.js-reg-category')
const regDays           = document.querySelectorAll('.js-reg-day')
const regEducationDay   = document.querySelector('.js-reg-education-day')
const regPrice          = document.querySelector('.js-reg-price')
const regShowAtCat      = document.querySelectorAll('.js-reg-show-at-category')
const regStep           = document.querySelectorAll('.js-reg-step-show')
const regSteps          = document.querySelectorAll('.js-reg-step')



let showAtCategory = () => {
	regShowAtCat.forEach((block) => {
		if ( block.dataset.category.includes(regCategory.options[regCategory.selectedIndex].dataset.category) ) {
			block.classList.add('active')

			return
		}

		block.classList.remove('active')
	})
}

let calcTotal = () => {
	let categoryPrice   = parseInt(regCategory.options[regCategory.selectedIndex].dataset.price)
	let educationalDay  = parseInt(regEducationDay.checked ? regEducationDay.dataset.price : 0)

	regPrice.innerHTML  = categoryPrice + educationalDay
}



// category change
regCategory.addEventListener('change', (e) => {
	const selectedCategory = e.target.value

	calcTotal()
	showAtCategory()

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

		// Standard
		if ( selectedCategory === 'type1') {
			regDays.forEach(regDay => {
				regDay.checked = false
			})

			item.checked = true

			return
		}

		// Business
		if ( selectedCategory === 'type2x') {
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

// update total price after educational day selected/unselected
regEducationDay.addEventListener('change', () => {
	calcTotal()
})

// steps
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



// set price
calcTotal()

showAtCategory()