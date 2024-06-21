function rolar(conteudo1) {
    var conteudo1 = document.querySelector(conteudo1);
    if (conteudo1) {
        window.scrollTo({
            behavior: 'smooth',
            top: conteudo1.offsetTop
        });
    }
}

const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('.nav');

hamburger.addEventListener('click', () => nav.classList.toggle('active'));