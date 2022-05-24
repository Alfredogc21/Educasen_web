// Codigo del preloader
window.addEventListener('load', () => {
    document.getElementById('circulo').className = 'hide';
    document.getElementById('contenidoPagina').className = '';
  });

// Codigo del SideNav
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
});

// Codigo del Parallax
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.parallax');
  var instances = M.Parallax.init(elems);
});
