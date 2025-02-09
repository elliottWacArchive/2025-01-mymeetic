document.addEventListener('DOMContentLoaded', function() {
    const profile = document.getElementById('profile');
    const profileWidth = profile.offsetWidth;
    const list = document.querySelector('#profile-container .list');
    let isOpen = false;

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