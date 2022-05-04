
let submenu = () => {
	let $submenu        = document.querySelector('.submenu')

	if (!$submenu) return

	let submenuOffset   = $submenu.offsetTop
	let $html           = document.querySelector('html')

	let submenuSticky = () => {
		$html.classList.toggle('submenu_fixed', window.pageYOffset > submenuOffset)
	}

	window.onscroll = () => {
		submenuSticky()
	}
}

submenu()
