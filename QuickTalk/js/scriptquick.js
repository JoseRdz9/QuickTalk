// Función para cambiar a modo oscuro
const darkmode = () => {
  document.querySelector("body").setAttribute("data-bs-theme", "dark");
  document.querySelector(".sidebar").setAttribute("data-bs-theme", "dark");
  document.querySelector(".content").setAttribute("data-bs-theme", "dark");
  document.querySelector("#darkmode").setAttribute("class", "fa-solid fa-sun");
  localStorage.setItem("theme", "dark"); // Guardar el tema seleccionado en el almacenamiento local
};

// Función para cambiar a modo claro
const lightmode = () => {
  document.querySelector("body").setAttribute("data-bs-theme", "light");
  document.querySelector(".sidebar").setAttribute("data-bs-theme", "light");
  document.querySelector(".content").setAttribute("data-bs-theme", "light");
  document.querySelector("#darkmode").setAttribute("class", "fi fi-rs-moon-stars");
  localStorage.setItem("theme", "light"); // Guardar el tema seleccionado en el almacenamiento local
};

// Función para cambiar entre modos oscuro y claro
const cambiarmodo = () => {
  if (localStorage.getItem("theme") === "dark") {
    lightmode();
  } else {
    darkmode();
  }
};

// Función para verificar el tema seleccionado al cargar la página
const checkTheme = () => {
  const theme = localStorage.getItem("theme");
  if (theme === "dark") {
    darkmode();
  } else {
    lightmode();
  }
};

// Verificar el tema seleccionado al cargar la página
window.onload = checkTheme;


//Funcion de icono regresar
document.querySelector('.back-icon').addEventListener('click', function(event) {
  event.preventDefault(); // Evitar la acción predeterminada del enlace
  document.getElementById('chatcont').style.display = 'none'; // Ocultar el chat
});

const userCards = document.querySelectorAll('.user-card');
userCards.forEach(card => {
  card.addEventListener('click', function() {
      const userId = this.getAttribute('data-user-id');
      document.getElementById('chatcont').style.display = 'block'; // Mostrar el chat
  });
});


// Funcionalidad de sidebar
document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('.sidebar a');
  const contentSections = document.querySelectorAll('.content > div');

  links.forEach(link => {
    link.addEventListener('click', function(event) {
      // Comprobar si el enlace apunta a una sección de la misma página
      if (this.getAttribute('href').startsWith('#')) {
        event.preventDefault();
        const target = this.getAttribute('href').substring(1);
        contentSections.forEach(section => {
          if (section.id === target) {
            section.style.display = 'block';
          } else {
            section.style.display = 'none';
          }
        });
      }
      // Si el enlace apunta a una página externa, deja que el navegador maneje la redirección
    });
  });
});
