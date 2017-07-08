

function resize() {

    var clientWidth = document.documentElement.clientWidth;

    document.documentElement.style.fontSize = 10* (clientWidth / 375) + 'px';

}

resize();

window.addEventListener('resize', resize);