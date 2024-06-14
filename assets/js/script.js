document.addEventListener("DOMContentLoaded", function() {
    var videoContainer = document.getElementById('background-video');
    var image = document.getElementById('background-image');
    var iframe = videoContainer.querySelector('iframe');

    if (iframe) {
        iframe.onload = function() {
            image.style.display = 'none';
            videoContainer.style.display = 'block';
        };
    }
});


