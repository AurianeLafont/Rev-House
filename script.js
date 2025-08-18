window.addEventListener('scroll', () => {
  const header = document.querySelector('.header');
  const heroHeight = document.querySelector('.hero').offsetHeight;

  if (window.scrollY > heroHeight - 140) {
    header.classList.remove('hidden');
  } else {
    header.classList.add('hidden');
  }
});

// partie concernant les drapeaux
document.querySelectorAll('.lang-list img').forEach(img => {
  img.addEventListener('click', (e) => {
    const selectedFlagSrc = e.target.getAttribute('src');
    const selectedAlt = e.target.getAttribute('alt');

    const langBtn = document.querySelector('.lang-btn');
    langBtn.innerHTML = `<img src="${selectedFlagSrc}" alt="${selectedAlt}" title="${selectedAlt}" style="width: 20px;">`;
  });
});