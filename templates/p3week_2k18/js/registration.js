
const regCategory       = document.querySelector('.js-reg-category')
const regCategoryDesc   = document.querySelectorAll('.js-reg-category-desc')
const regDays           = document.querySelectorAll('.js-reg-day')
const regDaysBlocks     = document.querySelectorAll('.js-reg-days')
const regEduDay         = document.querySelectorAll('.js-edu-day')
const regEducationDay   = document.querySelector('.js-reg-education-day')
const regPrice          = document.querySelector('.js-reg-price')
const regStep           = document.querySelectorAll('.js-reg-step-show')
const regSteps          = document.querySelectorAll('.js-reg-step')



let availableDays = () => {
	regDaysBlocks.forEach((block) => {
		if (regCategory.options[regCategory.selectedIndex].dataset.days === block.dataset.dayType) {
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

let categoryDesc = () => {
	regCategoryDesc.forEach((desc) => {
		if (regCategory.options[regCategory.selectedIndex].dataset.category === desc.dataset.categoryType) {
			desc.classList.add('active')

			return
		}

		desc.classList.remove('active')
	})
}

let educationalDay = () => {
	regEduDay.forEach((day) => {
		if (regCategory.options[regCategory.selectedIndex].dataset.eduDay === day.dataset.eduDay) {
			day.classList.add('active')

			return
		}

		console.log('here')

		day.classList.remove('active')
	})
}



// category change
regCategory.addEventListener('change', (e) => {
	const selectedCategory = e.target.value

	availableDays()
	calcTotal()
	categoryDesc()
	educationalDay()

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



// show days
availableDays()

// set price
calcTotal()

// show category description
categoryDesc()

// show info about educational day
educationalDay()
