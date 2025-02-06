document.addEventListener('DOMContentLoaded', function() {
    let token = getCookie('token');
    const result = document.getElementById('result-section');
    fetch(`backend/functions/phpCaller.php?function=getUser&token=${token}&param=isConfigure`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.result == 0) {
            fetch('/frontend/widget/finishConfiguration.php')
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
        } else {
            fetch('/frontend/widget/resultSearch.php')
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
        }
    });
});