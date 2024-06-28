document.addEventListener("DOMContentLoaded", function() {
    var videoContainer = document.getElementById('background-video');
    var image = document.getElementById('background-image');
    var iframe = videoContainer.querySelector('iframe');
    var highlightContent = document.querySelector('.highlight-content');

    var currentMovieIndex = 0;

    function updateContent() {
        var movie = topRatedMovies[currentMovieIndex];

        // Update background image
        image.src = movie.background_path;
        
        // Update iframe source
        var video_id = movie.trailer_link.split("v=")[1].split("&")[0];
        var loopable_link = `https://www.youtube.com/embed/${video_id}?autoplay=1&mute=1&loop=1&controls=0&rel=0&showinfo=0&cc_load_policy=0&vq=hd1080&playlist=${video_id}`;
        iframe.src = loopable_link;

        // Update highlight content
        highlightContent.querySelector('h1').textContent = movie.name;
        highlightContent.querySelector('p').textContent = movie.sinopsis;

        // Alternate display between image and video
        iframe.onload = function() {
            image.style.display = 'none';
            videoContainer.style.display = 'block';
        };

        image.style.display = 'block';
        videoContainer.style.display = 'none';

        // Increment the index and reset if necessary
        currentMovieIndex = (currentMovieIndex + 1) % topRatedMovies.length;
    }

    // Initial content update
    updateContent();

    // Set interval to change content every 10 seconds
    setInterval(updateContent, 15000);
});
