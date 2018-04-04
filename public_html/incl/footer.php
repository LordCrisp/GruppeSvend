<!-- Footer (start) -->
<footer>

</footer>
<!-- Footer (end) -->

<!-- Scripts (start) -->
<!-- Header script (start) -->
<script>
var headerButtons = document.getElementsByClassName('header__button');
for (var z = 0; z < headerButtons.length; z++) {
  var elem = headerButtons[z];
  elem.onclick = function(e) {
    const elem = e.target;
    if (elem.dataset.menuOpen) {
      var target = elem.dataset.menuOpen;
      var menu = document.getElementById(target);
      if (!menu.classList.contains('active')) {
        menu.classList.add('active');
      }
    } if (elem.dataset.menuClose) {
      var target = elem.dataset.menuClose;
      var menu = document.getElementById(target);
      if (menu.classList.contains('active')) {
        menu.classList.replace('active', 'closing');
        setTimeout(function() {
          menu.classList.remove('closing');
        }, 400);
      }
    }
  }
}
</script>
<!-- Menu script (end) -->
<!-- Scripts (end) -->
