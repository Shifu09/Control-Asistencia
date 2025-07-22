<!--ES EL FOOT DE LA INTERFAZ DEL ADMINISTRADOR-->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('nav-toggle');
    if (navToggle) {
      const body = document.body;
      const navBar = document.getElementById('nav-bar');
      const collapsedWidth = '56px';
      const expandedWidth = getComputedStyle(navBar).getPropertyValue('--navbar-width') || '256px';

      function adjustBodyPadding() {
        if (navToggle.checked) {
          body.style.paddingLeft = collapsedWidth;
        } else {
          body.style.paddingLeft = expandedWidth;
        }
      }

      // Adjust padding on load
      adjustBodyPadding();

      // Adjust padding on toggle
      navToggle.addEventListener('change', adjustBodyPadding);
    }
  });
</script>
</body>

</html>