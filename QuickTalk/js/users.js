document.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const userId = urlParams.get('user_id');

  if (userId) {
      const chatCont = document.getElementById('chatcont');
      if (chatCont) {
          chatCont.style.display = 'block';
      }
  }

  const userCards = document.querySelectorAll('.user-card');
  userCards.forEach(card => {
      card.addEventListener('click', function() {
          const userId = this.getAttribute('data-user-id');
          window.location.href = `QuickTalk.php?user_id=${userId}#chatcont`;
      });
  });

  const searchBar = document.querySelector(".search input"),
      searchIcon = document.querySelector(".search button"),
      usersList = document.querySelector(".users-list");

  function loadUsersList() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "php/load_users.php", true);
      xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                  let data = xhr.response;
                  usersList.innerHTML = data;
                  addClickEventToUserCards();
              }
          }
      }
      xhr.send();
  }

  function addClickEventToUserCards() {
      const userCards = document.querySelectorAll('.user-card');
      userCards.forEach(card => {
          card.addEventListener('click', function() {
              const userId = this.getAttribute('data-user-id');
              window.location.href = `QuickTalk.php?user_id=${userId}#chatcont`;
          });
      });
  }

  searchIcon.onclick = () => {
      searchBar.classList.toggle("show");
      searchIcon.classList.toggle("active");
      searchBar.focus();
      if (!searchBar.classList.contains("show")) {
          searchBar.value = "";
          searchBar.classList.remove("active");
          loadUsersList();
      }
  }

  searchBar.oninput = () => {
      let searchTerm = searchBar.value.trim();
      if (searchTerm) {
          searchBar.classList.add("active");
      } else {
          searchBar.classList.remove("active");
          loadUsersList();
      }
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/search.php", true);
      xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                  let data = xhr.response;
                  usersList.innerHTML = data;
                  addClickEventToUserCards();
              }
          }
      }
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("searchTerm=" + searchTerm);
  }
});
