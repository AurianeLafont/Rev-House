document.querySelectorAll('.carousel').forEach((carousel) => {
  const track = carousel.querySelector('.carousel-track');
  const images = Array.from(track.children);
  const prevButton = carousel.querySelector('.prev');
  const nextButton = carousel.querySelector('.next');
  const dotsContainer = carousel.querySelector('.carousel-dots');

  let currentIndex = 0;
  let intervalId;

  // Met à jour le carrousel : déplacement + points
  function updateCarousel() {
    const imageWidth = images[0].getBoundingClientRect().width;
    track.style.transform = `translateX(-${currentIndex * imageWidth}px)`;

    // Met à jour les points
    dotsContainer.querySelectorAll('span').forEach((dot, i) => {
      dot.classList.toggle('active', i === currentIndex);
    });
  }

  // Passe à l’image suivante
  function moveToNext() {
    currentIndex = (currentIndex + 1) % images.length;
    updateCarousel();
  }

  // Passe à l’image précédente
  function moveToPrev() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateCarousel();
  }

  // Lance ou redémarre le défilement automatique
  function startAutoSlide() {
    clearInterval(intervalId); // Arrête l’ancien intervalle
    intervalId = setInterval(moveToNext, 5000); // Redémarre
  }

  // Crée les points de navigation
  images.forEach((_, i) => {
    const dot = document.createElement('span');
    dot.addEventListener('click', () => {
      currentIndex = i;
      updateCarousel();
      startAutoSlide(); // Réinitialise le défilement auto
    });
    dotsContainer.appendChild(dot);
  });

  // Événements des flèches
  prevButton.addEventListener('click', () => {
    moveToPrev();
    startAutoSlide(); // Réinitialise aussi ici
  });

  nextButton.addEventListener('click', () => {
    moveToNext();
    startAutoSlide(); // Réinitialise aussi ici
  });

  // Responsive : recalcule sur redimensionnement
  window.addEventListener('resize', updateCarousel);

  // Initialisation
  updateCarousel();
  startAutoSlide();
});
