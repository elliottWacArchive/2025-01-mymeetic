function setAge(ageSet) {
    console.log("exec");
    output = [];
    ageSet.forEach(range => {
        let [start, end] = range.split('-').map(Number);
        for (let i = start; i <= end; i++) {
            output.push(i);
        }
    });
    return output;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('SEARCH READY');
    const filter = document.getElementById('filter');
    const search = document.getElementById('search');
    const profile = document.getElementById('profile');
    const shadow = document.getElementById('searchbar-shadow');
    const resultSection = document.getElementById('result-section');
    // const profileContainer = document.getElementById('profile-container');
    const filterContainer = document.getElementById('filter-container');
    const list = document.querySelector('#profile-container .list');
    let isOpen = false;
    let isShadowOpen = false;

	filter.addEventListener('mouseup', async function() {
        filter.style.transform = "";
        filter.style.boxShadow = "";
        if (!isShadowOpen) {
            shadow.style.marginRight = "-84px";
            filterContainer.style.display = 'flex';
        } else {
            shadow.style.marginRight = "";
            filterContainer.style.display = '';
        }
        isShadowOpen = !isShadowOpen;
	});
	filter.addEventListener('mousedown', function() {
        filter.style.transform = "translateX(-5px) scale(0.92)";
        filter.style.boxShadow = "inset 0px 0px 10px 2px rgba(0,0,0,0.3), inset 25px 0px 18px -22px rgba(0,0,0,0.4)";        
	});

    search.addEventListener('mouseup', async function() {
        search.style.transform = "";
        search.style.boxShadow = "";
        if (document.getElementById('searchbar').value) {
            username_list.push("%" + document.getElementById('searchbar').value + "%");
        }
        age_list = setAge(age_list);
        jsonDoc = {
            "city": ville_list,
            "gender": genre_list,
            "hobbies": loisir_list,
            "age": age_list,
            "username": username_list
        };
        console.log(age_list);
        console.log(JSON.stringify(jsonDoc));
        const reponse = await fetch('backend/functions/phpCaller.php?function=search&input=' + JSON.stringify(jsonDoc))
        const data = await reponse.json();
        console.log(data);
        username_list = [];
        ville_list = [];
        genre_list = [];
        loisir_list = [];
        age_list = [];
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
    
    let genreOpen = false;
    let loisirOpen = false;
    let ageOpen = false;

    let ville_list = [];
    let genre_list = [];
    let loisir_list = [];
    let age_list = [];
    let username_list = [];

    function getSize(element) {
        let TotalWidth = 0;
        let TotalHeight = 0;
        element.forEach(item => {
            TotalWidth += item.offsetWidth;
            TotalHeight += item.offsetHeight;
        });
        return [TotalWidth, TotalHeight];
    }

    document.addEventListener('click', function(event) {
        // console.log("ville : " + ville_list + "\ngenre : " + genre_list + "\nloisir : " + loisir_list + "\nage : " + age_list);
        if (event.target.id == 'genre-activator') {
            if (loisirOpen) {
                document.getElementById('loisir-selector').style.width = '';
                document.getElementById('loisir-selector').style.height = '';
                loisirOpen = false;
            }
            if (ageOpen) {
                document.getElementById('age-selector').style.width = '';
                document.getElementById('age-selector').style.height = '';
                ageOpen = false;
            }
            if (!genreOpen) {
                const genreItems = document.querySelectorAll('#genre-selector .select');
                const genreSize = getSize(genreItems);
                document.getElementById('genre-selector').style.width = genreSize[0] + 20 + 'px';
                document.getElementById('genre-selector').style.height = genreSize[1] + 'px';
            } else {
                document.getElementById('genre-selector').style.width = '';
                document.getElementById('genre-selector').style.height = '';
            }
            genreOpen = !genreOpen;
        }
        if (event.target.id == 'loisir-activator') {
            if (genreOpen) {
                document.getElementById('genre-selector').style.width = '';
                document.getElementById('genre-selector').style.height = '';
                genreOpen = false;
            }
            if (ageOpen) {
                document.getElementById('age-selector').style.width = '';
                document.getElementById('age-selector').style.height = '';
                ageOpen = false;
            }
            if (!loisirOpen) {
                const loisirItems = document.querySelectorAll('#loisir-selector .select');
                const loisirSize = getSize(loisirItems);
                document.getElementById('loisir-selector').style.width =  loisirSize[0] + 'px';
                document.getElementById('loisir-selector').style.height = loisirSize[1] + 'px';
            } else {
                document.getElementById('loisir-selector').style.width = '';
                document.getElementById('loisir-selector').style.height = '';
            }
            loisirOpen = !loisirOpen;
        }
        if (event.target.id == 'age-activator') {
            if (genreOpen) {
                document.getElementById('genre-selector').style.width = '';
                document.getElementById('genre-selector').style.height = '';
                genreOpen = false;
            }
            if (loisirOpen) {
                document.getElementById('loisir-selector').style.width = '';
                document.getElementById('loisir-selector').style.height = '';
                loisirOpen = false;
            }
            if (!ageOpen) {
                const ageItems = document.querySelectorAll('#age-selector .select');
                const ageSize = getSize(ageItems);
                document.getElementById('age-selector').style.width = ageSize[0] + 'px';
                document.getElementById('age-selector').style.height = ageSize[1] + 'px';
            } else {
                document.getElementById('age-selector').style.width = '';
                document.getElementById('age-selector').style.height = '';
            }
            ageOpen = !ageOpen;
        }
        if (event.target.id == 'add') {
            if (document.getElementById('searchbar').value) {
                const search = document.getElementById('searchbar').value;
                const searchItem = document.createElement('div');
                const close = document.createElement('div');
                ville_list.push(search);
                close.classList.add('delete');
                searchItem.classList.add('added');
                searchItem.innerHTML = search;
                searchItem.appendChild(close);
                document.getElementById('ville-content').appendChild(searchItem);
                document.getElementById('searchbar').value = '';
            }
        }
        if (event.target.classList.contains('delete')) {
            ville_list.splice(ville_list.indexOf(event.target.parentElement.innerText), 1);
            event.target.parentElement.remove();
        }
        if (event.target.classList.contains('select')) {
            // console.log(event.target.id);
            if (event.target.classList.contains('selected')) {
                switch (event.target.parentElement.id)
                {
                    case 'genre-selector':
                        genre_list.splice(genre_list.indexOf(event.target.id), 1);
                        break;
                    case 'loisir-selector':
                        loisir_list.splice(loisir_list.indexOf(event.target.id), 1);
                        break;
                    case 'age-selector':
                        age_list.splice(age_list.indexOf(event.target.id), 1);
                        break;
                }
                event.target.classList.remove('selected');
            } else {
                switch (event.target.parentElement.id)
                {
                    case 'genre-selector':
                        genre_list.push(event.target.id);
                        break;
                    case 'loisir-selector':
                        loisir_list.push(event.target.id);
                        break;
                    case 'age-selector':
                        age_list.push(event.target.id);
                        break;
                }
                event.target.classList.toggle('selected');
            }
        }
    });
});
