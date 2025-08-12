// Permitir solo números en el campo de cédula
function soloNumerosCedula(inputId) {
  const input = document.getElementById(inputId);
  if (!input) return;
  input.addEventListener("input", function (e) {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
}

// Llama esta función pasando el id del input de cédula, por ejemplo:
soloNumerosCedula("codigo");
soloNumerosCedula("telefono");
