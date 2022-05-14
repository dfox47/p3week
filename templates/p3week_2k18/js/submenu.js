
let submenu = () => {
	let $submenu = document.querySelector('.submenu_wrap')

	if (!$submenu) return

	let submenuSticky = () => {
		document.querySelector('html').classList.toggle('submenu_fixed', window.pageYOffset > $submenu.offsetTop)
	}

	window.onscroll = () => {
		submenuSticky()
	}
}

window.addEventListener('resize', function() {
	setTimeout(submenu, 1000);
})

submenu()
