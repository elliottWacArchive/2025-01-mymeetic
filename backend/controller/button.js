console.log('DOM fully loaded and parsed');

// SIGN UP LOGIN BTN
const btn = document.getElementById('button');

btn.addEventListener('click', function() {
    console.log('button clicked!');
});
btn.addEventListener('mouseup', function() {
    btn.style.transform = "";
});
btn.addEventListener('mousedown', function() {
    console.log('btn clicked!');
    btn.style.transform = "translate(0px, 0px)";
});
