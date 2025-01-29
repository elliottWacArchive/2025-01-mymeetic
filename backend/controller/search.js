document.addEventListener('DOMContentLoaded', function() {
    console.log('SEARCH READY');
    const filter = document.getElementById('filter');
    const search = document.getElementById('search');

    filter.addEventListener('click', function() {
        console.log('filter clicked!');
    });

    search.addEventListener('click', function() {
        console.log('search clicked!');
    });

	filter.addEventListener('mouseup', async function() {
        filter.style.transform = "";
        filter.style.boxShadow = "";
	});
	filter.addEventListener('mousedown', function() {
        filter.style.transform = "translateX(-5px) scale(0.92)";
        filter.style.boxShadow = "inset 0px 0px 10px 2px rgba(0,0,0,0.3), inset 25px 0px 18px -22px rgba(0,0,0,0.4)";
	});

    search.addEventListener('mouseup', async function() {
        search.style.transform = "";
        search.style.boxShadow = "";
	});
	search.addEventListener('mousedown', function() {
        search.style.transform = "translateX(-5px) scale(0.91)";
        search.style.boxShadow = "inset 0px 0px 10px 2px rgba(0,0,0,0.3), inset 25px 0px 18px -22px rgba(0,0,0,0.4)";
	});
});
