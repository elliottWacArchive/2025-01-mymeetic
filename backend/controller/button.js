document.addEventListener('click', function(event) {
    if (event.target.id === 'labelFile') {
        console.log('label clicked!');
    }
    if (event.target.id === 'button') {
        console.log('button clicked!');
    }
});

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
        console.log('label clicked!');
        event.target.style.transform = "translate(0px, 0px)";
    }
    if (event.target.id === 'button') {
        console.log('btn clicked!');
        event.target.style.transform = "translate(0px, 0px)";
    }
});
