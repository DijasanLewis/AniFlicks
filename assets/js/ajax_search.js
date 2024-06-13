//Fitur pencarian ajax
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('query');
    const resultContainer = document.getElementById('search-results');

    input.addEventListener('keyup', function() {
        const query = this.value;
        if (query.length < 3) { // Minimal 3 karakter sebelum melakukan query
            resultContainer.innerHTML = '';
            return;
        }

        fetch(`search.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                resultContainer.innerHTML = data.map(item => `
                    <div class="search-item">
                        <img src="${item.poster_path}" alt="${item.name}">
                        <div class="search-item-info">
                            <h4>${item.name}</h4>
                            <p>${item.year}, ${item.genre}</p>
                        </div>
                    </div>
                `).join('');
            })
            .catch(error => console.error('Error:', error));
    });
});