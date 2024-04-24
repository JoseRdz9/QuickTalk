function cerrarSesion(uniqueId) {
    if (uniqueId) {
      window.location.href = 'php/logout.php?logout_id=' + uniqueId;
    } else {
      console.error('ID de usuario no válido');
    }
  }