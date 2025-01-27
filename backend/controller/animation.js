document.addEventListener('DOMContentLoaded', function() {
	const btn = document.getElementById('mikuBtn');
	const img = document.getElementById('mikuImg');
	btn.addEventListener('mouseover', function() {
		img.style.transform = 'translateY(-160px)'
	});
	btn.addEventListener('mouseout', function() {
		img.style.transform = ''
	});
	btn.addEventListener('click', function() {
		img.style.transform = '';
	});
	btn.addEventListener('mouseup', function() {
		btn.style.transform = "";
	});
	btn.addEventListener('mousedown', function() {
		console.log('Miku clicked!');
		img.style.transform = '';
		btn.style.transform = "translate(5px, 5px)";
	});
});