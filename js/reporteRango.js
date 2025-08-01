//aqui agarramos la fecha con el formato que nesecitamos
$(document).ready(function() {
  $('.date').datepicker({
    format: 'dd-mm-yyyy',
    //aqui le ponemos en lenguaje esp
    //para que salga todo en esp
    language: 'es',
  })
});

//seleccionar tipo orden en modal, nos ayuda a buscar y los mandamos a la siguiente
//pagina y los metemos donde esta el id mostrar_datoss que es en la tabla
$(document).on('click', '#buscar', function(e) {
  //aqui se guarda la fecha inicial y la fecha final 
  var fechai=$('#fechai').val();
  var fechaf=$('#fechaf').val();

  //utilizamos la libreria moment.js para manipular fechas en javascript
  var f1=moment(fechai, "DD-MM-YYYY");
  var f2=moment(fechaf, "DD-MM-YYYY");

  //si la fecha inicio es menor o igual que la fecha fin
  if(f1.isBefore(f2)||f1.isSame(f2)){
    $.ajax({
      type: 'POST',
      url:'verAsistencia.php',
      data: {fechai:fechai,fechaf:fechaf},
      dataType:'html',
      success: function(datax) {
        $("#mostrar_datoss").html(datax);
      }
    });
  } // aqui validamos
  else{
    Swal.fire({icon: 'warning', title: 'Fechas incorrectas', text: 'La fecha de inicio debe ser menor o igual que la fecha de fin.'})
    $("#mostrar_datoss").html('<tr><td colspan="8">No hay datos.</td></tr>');
  }
});
