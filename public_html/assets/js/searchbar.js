const liveSearchResults = document.getElementById('liveSearch');
function liveSearch(str) {
    if (str != 0) {
        loadDoc(str);
    } else {
        liveSearchResults.innerHTML = '';
    }
}
function loadDoc(str) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != '') {
                liveSearchResults.innerHTML = this.responseText;
            } else {
                liveSearchResults.innerHTML = '<li class="noresult">No match found :(</li>';
            }
        }
    };
    xhttp.open("POST", "incl/search.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("search=" + str);
}