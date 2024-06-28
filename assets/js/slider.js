document.addEventListener("DOMContentLoaded", function () {
    function initSlider(sliderId) {
        const sliderWrapper = document.querySelector(`${sliderId} .slider-wrapper`);
        const sliderContent = document.querySelector(`${sliderId} .slider-content`);
        const prevButton = document.querySelector(`${sliderId} .slider-prev`);
        const nextButton = document.querySelector(`${sliderId} .slider-next`);

        let currentIndex = 0;
        const cardWidth = document.querySelector(`${sliderId} .card`).offsetWidth + 20; // Lebar kartu termasuk margin
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
    }

    initSlider("#slider-1");
    initSlider("#slider-2");
});
