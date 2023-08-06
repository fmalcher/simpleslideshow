const containerEl = document.querySelector('#container');
const preloadImgEl = document.querySelector('#preloadImg');

const imageTimeout = 5000;
const preloadTimeout = 1000;


let currentIndex = 0;

function updateIndex() {
    currentIndex = (currentIndex + 1) % images.length;
}

function updateImageWithCurrentIndex() {
    const url = 'pictures/' + images[currentIndex];
    preloadImgEl.src = url;

    setTimeout(() => {
        containerEl.style.backgroundImage = 'url(' + url + ')';
    }, preloadTimeout);
}


function nextImage() {
    updateIndex();
    updateImageWithCurrentIndex();
}

nextImage();
setInterval(() => nextImage(), imageTimeout);
