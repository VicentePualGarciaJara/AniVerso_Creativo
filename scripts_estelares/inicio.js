let index = 0;
const slides = document.querySelectorAll(".slide");
const total = slides.length;

function showSlide(i) {
  const container = document.querySelector(".imagenes-carrusel");
  container.style.transform = `translateX(${-i * 100}%)`;
}

document.querySelector(".siguiente").addEventListener("click", () => {
  index = (index + 1) % total;
  showSlide(index);
});

document.querySelector(".anterior").addEventListener("click", () => {
  index = (index - 1 + total) % total;
  showSlide(index);
});

// 🚀 Autoplay cada 5 segundos
setInterval(() => {
  index = (index + 1) % total;
  showSlide(index);
}, 5000); // cada 5 segundos

showSlide(index);

