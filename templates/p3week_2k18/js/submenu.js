
let $submenu        = document.querySelector('.submenu').offsetTop
let $html           = document.querySelector('html')

let submenuSticky = () => {
	$html.classList.toggle('submenu_fixed', window.pageYOffset > $submenu)
}

window.onscroll = () => {
	submenuSticky()
}
