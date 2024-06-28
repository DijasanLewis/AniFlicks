document.addEventListener('DOMContentLoaded', function() {
    var posterInput = document.getElementById('poster_path');
    var posterPreview = document.getElementById('poster_preview');
    var backgroundInput = document.getElementById('background_path');
    var backgroundPreview = document.getElementById('background_preview');
    var cancelButton = document.getElementById('cancel-add-button');

    posterInput.addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            posterPreview.src = e.target.result;
            posterPreview.style.display = 'block';
        }
        reader.readAsDataURL(this.files[0]);
    });

    backgroundInput.addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            backgroundPreview.src = e.target.result;
            backgroundPreview.style.display = 'block';
        }
        reader.readAsDataURL(this.files[0]);
    });

    cancelButton.addEventListener('click', function() {
        window.location.href = 'catalog.php';
    });
});