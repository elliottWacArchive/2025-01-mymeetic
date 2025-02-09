document.addEventListener('mouseup', function(event) {
    if (event.target.id === 'labelFile') {
        event.target.style.transform = "";
    }
    if (event.target.id === 'button') {
        event.target.style.transform = "";
    }
});

document.addEventListener('mousedown', function(event) {
    if (event.target.id === 'labelFile') {
        event.target.style.transform = "translate(0px, 0px)";
    }
    if (event.target.id === 'button') {
        event.target.style.transform = "translate(0px, 0px)";
    }
});
