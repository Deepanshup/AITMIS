function getcolor(d){
    var y = document.getElementById(d).className;
    window.localStorage.setItem('headercolor',y);
}
function getcolorr(d){
    var y = document.getElementById(d).className;
    window.localStorage.setItem('sidebar',y);
}