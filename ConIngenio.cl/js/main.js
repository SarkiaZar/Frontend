document.addEventListener('DOMContentLoaded', function() {
  // Menú móvil
  const menuMobile = document.querySelector('.menu-mobile');
  const navbar = document.querySelector('.navbar');
  const body = document.body;
  
  // Asegurar que la barra de navegación muestre el tema correcto
  function updateNavbarTheme() {
    const isDarkTheme = document.documentElement.getAttribute('data-theme') === 'dark';
    if (isDarkTheme) {
      navbar.classList.add('dark-theme');
    } else {
      navbar.classList.remove('dark-theme');
    }
  }
  
  // Llamar inicialmente y cuando cambie el tema
  updateNavbarTheme();
  
  menuMobile.addEventListener('click', function(e) {
    e.stopPropagation();
    navbar.classList.toggle('active');
    menuMobile.classList.toggle('active');
    // Prevenir scroll cuando el menú está abierto
    body.style.overflow = navbar.classList.contains('active') ? 'hidden' : '';
    // Actualizar tema cuando se abre el menú
    updateNavbarTheme();
  });

  // Efecto de scroll en el header
  const header = document.querySelector('.header');
  let lastScroll = 0;

  window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
  });

  // Cerrar menú al hacer clic en un enlace
  const navLinks = document.querySelectorAll('.navbar a');
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      navbar.classList.remove('active');
      menuMobile.classList.remove('active');
      body.style.overflow = '';
    });
  });

  // Cerrar menú al hacer clic fuera
  document.addEventListener('click', function(event) {
    if (!navbar.contains(event.target) && !menuMobile.contains(event.target) && navbar.classList.contains('active')) {
      navbar.classList.remove('active');
      menuMobile.classList.remove('active');
      body.style.overflow = '';
    }
  });

  // Prevenir que los clics dentro del menú lo cierren
  navbar.addEventListener('click', function(e) {
    e.stopPropagation();
  });

  // Cerrar menú al redimensionar la ventana
  window.addEventListener('resize', function() {
    if (window.innerWidth > 768 && navbar.classList.contains('active')) {
      navbar.classList.remove('active');
      menuMobile.classList.remove('active');
      body.style.overflow = '';
    }
  });

  // Smooth scroll para enlaces internos
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth'
        });
      }
    });
  });

  // Cambio de tema
  const themeToggle = document.getElementById('toggle');
  const html = document.documentElement;

  // Cargar tema guardado
  const savedTheme = localStorage.getItem('theme') || 'light';
  html.setAttribute('data-theme', savedTheme);
  themeToggle.checked = savedTheme === 'dark';
  updateNavbarTheme(); // Actualizar tema al cargar

  // Cambiar tema
  themeToggle.addEventListener('change', () => {
    const newTheme = themeToggle.checked ? 'dark' : 'light';
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateNavbarTheme(); // Actualizar tema al cambiar
  });

  // Actualizar ícono del tema
  function updateThemeIcon(theme) {
    const icon = themeToggle.querySelector('i');
    icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
  }

  // Escuchar cambios en las preferencias del sistema
  const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
  prefersDarkScheme.addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
      html.setAttribute('data-theme', e.matches ? 'dark' : 'light');
    }
  });
});