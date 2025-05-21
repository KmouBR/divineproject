// menu mobile
const menuCloseButton = document.querySelector("#menu-close-button");
const menuOpenButton  = document.querySelector("#menu-open-button");

menuOpenButton.addEventListener("click", () =>
  document.body.classList.toggle("show-mobile-menu")
);
menuCloseButton.addEventListener("click", () =>
  menuOpenButton.click()
);

// GSAP Animations
gsap.registerPlugin(ScrollTrigger);

// 1) HERO: entra com escala, fade e stagger nos textos e botões
gsap.from(".hero-image", {
  scale: 0.8,
  opacity: 0,
  duration: 1.2,
  ease: "power3.out"
});
gsap.from(".hero-details .title", {
  y: -30,
  opacity: 0,
  duration: 0.8,
  delay: 0.3
});
gsap.from(".hero-details .subtitle", {
  y: -20,
  opacity: 0,
  duration: 0.8,
  delay: 0.5
});
gsap.from(".hero-details .description", {
  y: -10,
  opacity: 0,
  duration: 0.8,
  delay: 0.7
});
gsap.from(".hero-details .button", {
  scale: 0,
  opacity: 0,
  stagger: 0.2,
  duration: 0.5,
  delay: 0.9,
  ease: "back.out(1.7)"
});

// 2) REVEAL de cada seção ao scroll (exceto a hero)
gsap.utils.toArray("section:not(.hero-section)").forEach((sec) => {
  gsap.from(sec, {
    scrollTrigger: {
      trigger: sec,
      start: "top 80%",
      // markers: true  // descomente pra ver gatilhos
    },
    y: 50,
    opacity: 0,
    duration: 0.8,
    ease: "power2.out"
  });
});

// 3) HOVER NOS BOTÕES E LINKS: leve “pop”
document.querySelectorAll(".button, .nav-link").forEach((el) => {
  el.addEventListener("mouseenter", () => {
    gsap.to(el, { scale: 1.1, duration: 0.2 });
  });
  el.addEventListener("mouseleave", () => {
    gsap.to(el, { scale: 1, duration: 0.2 });
  });
});

// 4) CLICK PARTY NO BOTÃO DE ENVIO
const submitBtn = document.querySelector('.contact-form button');

submitBtn.addEventListener('click', e => {
  e.preventDefault();
  
  // timeline de animação
  const tl = gsap.timeline({
    onComplete: () => submitBtn.closest('form').submit()
  });

  tl
    // 1) pulso inicial
    .to(submitBtn, {
      scale: 1.3,
      duration: 0.2,
      ease: 'power2.out'
    })
    // 2) pula levemente pra cima
    .to(submitBtn, {
      y: -10,
      duration: 0.15,
      ease: 'power1.out'
    }, '<') // "<" faz rodar junto com o scale
    // 3) glow rápido via box-shadow
    .to(submitBtn, {
      boxShadow: '0px 0px 20px var(--secondary-color)',
      duration: 0.2,
      yoyo: true,
      repeat: 1,
      ease: 'sine.inOut'
    })
    // 4) balanço de rotação
    .to(submitBtn, {
      rotation: 10,
      duration: 0.15,
      ease: 'elastic.out(1, 0.5)'
    })
    .to(submitBtn, {
      rotation: -10,
      duration: 0.15,
      ease: 'elastic.out(1, 0.5)'
    })
    // 5) volta à posição normal
    .to(submitBtn, {
      rotation: 0,
      y: 0,
      scale: 1,
      duration: 0.4,
      ease: 'bounce.out'
    });
});

