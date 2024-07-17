document.addEventListener('DOMContentLoaded', function() {
    var dropdown = document.querySelector('.dropdown');
    var dropdownMenu = dropdown.querySelector('.dropdown-menu');

    dropdown.addEventListener('click', function(event) {
        event.stopPropagation();
        dropdownMenu.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdownMenu.classList.remove('active');
        }
    });
});
// JavaScript para manejar el toggle del menú móvil
const toggleButton = document.getElementById('mobile-menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

toggleButton.addEventListener('click', function() {
    mobileMenu.classList.toggle('hidden');
//fin..............................

    
});
 //eventos de los botones "asistir en el index.html"
    // Obtén el botón por su ID
    const btnAsistir1 = document.getElementById('btnAsistir1');

    // Agrega un evento de clic al botón
    btnAsistir1.addEventListener('click', function() {
        // Redirige a la página 'registro.html'
        window.location.href = 'registro.html';
    });

    // Obtén el botón por su ID
    const btnAsistir2 = document.getElementById('btnAsistir2');

    // Agrega un evento de clic al botón
    btnAsistir2.addEventListener('click', function() {
        // Redirige a la página 'registro.html'
        window.location.href = 'registro.html';
    });

    // Obtén el botón por su ID
    const btnAsistir3 = document.getElementById('btnAsistir3');

    // Agrega un evento de clic al botón
    btnAsistir3.addEventListener('click', function() {
        // Redirige a la página 'registro.html'
        window.location.href = 'registro.html';
    });
 //fin........................................................

