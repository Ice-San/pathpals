let searchBar = document.getElementById('search-bar');
let tableExtras = document.querySelectorAll('.table-extra');

searchBar.addEventListener('input', function() {
    let searchText = searchBar.value.toLowerCase();

    tableExtras.forEach(tableExtra => {
        let tableH1 = tableExtra.querySelector('.table-content-left-extra h1');
        
        if (tableH1.textContent.toLowerCase().includes(searchText)) {
            tableExtra.classList.remove('unvisibility');
        } else {
            tableExtra.classList.add('unvisibility');
        }
    });
});
