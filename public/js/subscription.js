document.querySelectorAll('.subscribe-btn').forEach(btn => btn.onclick = function() {
	this.style.opacity = '.6'
	fetch(`${this.dataset.href}?api_token=${apiToken}`)
	.then(response => response.json())
	.then(json => {
		if(json.subscribed) {
			document.querySelectorAll(this.dataset.subscribed).forEach(el => el.hidden = false)
			document.querySelectorAll(this.dataset.unsubscribed).forEach(el => el.hidden = true)
		} else {
			document.querySelectorAll(this.dataset.unsubscribed).forEach(el => el.hidden = false)
			document.querySelectorAll(this.dataset.subscribed).forEach(el => el.hidden = true)
		}
		this.style.opacity = '1'
	})
})