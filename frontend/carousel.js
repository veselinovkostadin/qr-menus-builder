document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    let slides = document.querySelectorAll('.productsDiv');
    let total = slides.length
    for (let i = 1; i < total; i++) {
        slides[i].style.display = 'none';
    }

    document.getElementById('promotionsNext').addEventListener('click', function () {
        slides[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % total;
        slides[currentIndex].style.display = 'block';
    });


    document.getElementById('promotionsBack').addEventListener('click', function () {
        slides[currentIndex].style.display = 'none';
        currentIndex = (currentIndex - 1 + total) % total;
        slides[currentIndex].style.display = 'block';
    });
});

function redirect(UUID) {
    console.log(UUID);
}





