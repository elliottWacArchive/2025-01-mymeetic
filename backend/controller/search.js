document.addEventListener('DOMContentLoaded', function() {
    console.log('SEARCH READY');
    const filter = document.getElementById('filter');
    const search = document.getElementById('search');
    const profile = document.querySelector('#profile');
    const profileContainer = document.querySelector('#profile-container');
    const list = document.querySelector('#profile-container .list');
    let isOpen = false;

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

    const profileWidth = profile.offsetWidth;
    list.style.width = profileWidth + 5 + 'px';
    list.style.borderRadius = profileWidth / 2 + 'px';
    profile.addEventListener('click', function() {
        if (!isOpen) {
            list.style.width = '200px';
            // profileContainer.style.borderRadius ="10px";
        } else {
            list.style.width = profileWidth + 5 + 'px';
            // profileContainer.style.borderRadius ="100%";
        }
        isOpen = !isOpen;
    });
});
