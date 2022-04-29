
let $newsItems = document.querySelectorAll('.js-news-latest-link')

$newsItems.forEach((item) => {
	let newsLink    = item.href
	let $newsImg    = item.querySelector('.js-news-latest-img')
	let $response   = item.querySelector('.js-news-latest-response')
	let xhttp       = new XMLHttpRequest()

	xhttp.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			$response.innerHTML = this.responseText
			$newsImg.style.backgroundImage = "url(" + $response.querySelector('.item-page__news img').currentSrc + ")"
		}
	}
	xhttp.open('GET', newsLink, true)
	xhttp.send()
})
