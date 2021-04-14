document.querySelectorAll('.like-btn').forEach(btn => btn.onclick = function() {
	this.style.opacity = '.6'
	fetch(`${this.dataset.href}?api_token=${apiToken}`)
	.then(response => response.json())
	.then(json => {
		document.querySelectorAll(this.dataset.likes).forEach(el => el.innerText = json.likes)
		document.querySelectorAll(this.dataset.dislikes).forEach(el => el.innerText = json.dislikes)
		this.style.opacity = '1'
	})
})