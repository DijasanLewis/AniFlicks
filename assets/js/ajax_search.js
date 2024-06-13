document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('query');
    const searchResults = document.getElementById('search-results');

    searchInput.addEventListener('input', function () {
        const query = searchInput.value;

        if (query.length > 0) {
            fetch(`../includes/search.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        searchResults.classList.add('has-results'); //Memunculkan border setelah mendapatkan hasil pencarian
                        data.forEach(item => {
                            const resultItem = document.createElement('a');
                            resultItem.href = `details.php?title_id=${item.title_id}`;
                            resultItem.classList.add('search-result-item');
                            resultItem.innerHTML = `
                                <img src="${item.poster_path}" alt="${item.name}">
                                <div class="details">
                                    <h3>${item.name} (${item.year})</h3>
                                    <small>Genre: ${item.genre}</small>
                                </div>
                            `;
                            searchResults.appendChild(resultItem);
                        });
                    } else {
                        searchResults.classList.remove('has-results');
                    }
                });
        } else {
            searchResults.innerHTML = '';
        }
    });

    document.addEventListener('click', function (event) {
        if (!searchResults.contains(event.target) && event.target !== searchInput) {
            searchResults.innerHTML = '';
        }
    });
});