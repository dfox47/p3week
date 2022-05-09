
let submenu = () => {
	let $submenu = document.querySelector('.submenu_wrap')

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

window.addEventListener('resize', function() {
	setTimeout(submenu, 1000);
})

submenu()
