if (localStorage.getItem("darkState") === null) {
    localStorage.setItem("darkState", 1);
}
var state = localStorage.getItem("darkState")

function darkMode() {
    if (state === 0) {
        localStorage.setItem("darkState", 1);
    } else {
        localStorage.setItem("darkState", 0);
    }
}
darkMode()
