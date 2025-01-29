function setCookie(name, value) {
    let expires = "";
    const date = new Date();
    date.setTime(date.getTime() + (20 * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

async function getFromSql(token, param) {
    try {
        const response = await fetch(`backend/functions/getUser.php?token=${token}&param=${param}`);
        const data = await response.json();
        setCookie(param, data.result);
        return data.result;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

function deleteAllCookies() {
    const cookies = document.cookie.split("; ");
    for (let cookie of cookies) {
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        deleteCookie(name);
    }
}

function logout() {
    deleteAllCookies();
    window.location.href = '/';
}

function getCookie(name) {
    const cookie = document.cookie.split(';').find(item => item.trim().startsWith(name + '='));
    if (cookie) {
        return cookie.split('=')[1];
    }
    return false;
}