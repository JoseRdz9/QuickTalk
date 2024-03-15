document.addEventListener('DOMContentLoaded', function() {
  const userCards = document.querySelectorAll('.user-card');
  
  userCards.forEach(card => {
    card.addEventListener('click', function() {
      const userId = this.getAttribute('data-user-id');
      const chatcont = document.getElementById('chatcont');
      chatcont.style.display = 'block'; // Asegura que el contenedor sea visible
      
      // Configuración para la solicitud POST
      const formData = new FormData();
      formData.append('user_id', userId);
      
      // Realiza la solicitud al servidor
      fetch('loadChat.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(html => {
        chatcont.innerHTML = html;
      })
      .catch(error => {
        console.error('Error:', error);
        chatcont.innerHTML = "<p>Hubo un error al cargar el chat.</p>";
      });
    });
  });
});


const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = () => {
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if (!searchBar.classList.contains("show")) {
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.oninput = () => {
  let searchTerm = searchBar.value.trim(); // Eliminar espacios en blanco al principio y al final
  if (searchTerm) {
    searchBar.classList.add("active");
  } else {
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}