//en esta funcion nos sirve para mostrar la hora y la fecha actual
var udateTime = function () {
  //aqui se guardara la fecha y hora actual
  let currentDate = new Date(),
    hours = currentDate.getHours(),
    minutes = currentDate.getMinutes(),
    seconds = currentDate.getSeconds(),
    weekDay = currentDate.getDay(),
    day = currentDate.getDate(),
    month = currentDate.getMonth(),
    year = currentDate.getFullYear();
  //aqui los dias de la semana para poder imprimirlo
  const weekDays = [
    "Domingo",
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sabado",
  ];

  document.getElementById("weekDay").textContent = weekDays[weekDay];
  document.getElementById("day").textContent = day;
  //aqui se guardan los meses
  const months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  document.getElementById("month").textContent = months[month];
  document.getElementById("year").textContent = year;

  document.getElementById("hours").textContent = hours;

  if (minutes < 10) {
    minutes = "0" + minutes;
  }

  if (seconds < 10) {
    seconds = "0" + seconds;
  }

  document.getElementById("minutes").textContent = minutes;
  document.getElementById("seconds").textContent = seconds;
};

udateTime();

setInterval(udateTime, 1000);
