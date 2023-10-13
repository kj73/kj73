function changeSearchUI() {
    pageTitle = document.getElementById("pageTitle");
    searchBar = document.getElementById("searchBar");

    if (pageTitle.style.display == "none") {
        pageTitle.style.display = "block";
        searchBar.style.display = "none";
    }
    else {
        pageTitle.style.display = "none";
        searchBar.style.display = "block";
    }
}