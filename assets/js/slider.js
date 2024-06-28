document.addEventListener("DOMContentLoaded", function () {
    const sliderWrapper = document.querySelector(".slider-wrapper");
    const sliderContent = document.querySelector(".slider-content");
    const prevButton = document.querySelector(".slider-prev");
    const nextButton = document.querySelector(".slider-next");

    let currentIndex = 0;
    const cardWidth = document.querySelector(".card").offsetWidth + 20; // Lebar kartu termasuk margin
    const maxIndex = Math.floor(sliderContent.children.length - sliderWrapper.offsetWidth / cardWidth);

    prevButton.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });

    nextButton.addEventListener("click", function () {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSliderPosition();
        }
    });

    function updateSliderPosition() {
        sliderContent.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }
});
