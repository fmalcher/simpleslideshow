const containerEl = document.querySelector('#container');
const preloadImgEl = document.querySelector('#preloadImg');

const imageTimeout = 2000;
const preloadTimeout = 8000;


let currentIndex = 0;

function updateIndex() {
    currentIndex = (currentIndex + 1) % images.length;
}

function updateImageWithCurrentIndex() {
    const url = 'https://' + ncUser + ':' + ncPassword + '@' + ncBaseUrl + images[currentIndex];
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
