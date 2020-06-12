const PutTimePicker = () => {
  $(".entrada").timepicker({
    timeFormat: "HH:mm",
    interval: 30,
    // minTime: "6:00am",
    // maxTime: "6:00pm",
    startTime: "6:00am",
    dynamic: false,
    dropdown: false,
    defaultTime: "now",
    // scrollbar: true,
  });

  $(".salida").timepicker({
    timeFormat: "HH:mm",
    interval: 30,
    // minTime: "6:00am",
    // maxTime: "6:00pm",
    startTime: "6:00am",
    dynamic: false,
    dropdown: false,
    defaultTime: "now",
    // scrollbar: true,
  });
};

const loader = () => {
  Swal.fire({
    title: "Please Wait!",
    html: "Loading data",
    allowOutsideClick: false,
    onBeforeOpen: () => {
      Swal.showLoading();
    },
  });
};



let numeroTotal = 1;
let ShowIfExistSomething = false; 

// NUEVO SIN INGRESO A BASE
const NewWork = () => {
  ShowIfExistSomething = false;
  let htmlLayaout = `<tr><td>${numeroTotal}</td>
                                    <td>
                                        <div class="form-group input-group-sm">
                                            <select name="proyecto" class="form-control" id="proyecto">
                                                <option selected disabled value="x" >Select Project...</option>
                                                <option disabled>Loading...</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Entry Hour" type="text" class="form-control entrada"
                                                name="entrada" id="entrada" />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="insertarEntrada()">
                                                Registrar
                                            </button>
                                        </div>
                                    </td>
                                </tr>`;
  return $("#turno").append(htmlLayaout);
};
// HORA DE ENTRADA REGISTRADA
const WorkToRegiOut = (id, actual) => {
  let htmlLayaout = `  
                                <tr>
                                    <td>${id}</td>
                                    <td>
                                        <h5>Work in progress... Don't forget to record your departure time</h5>
                                        <p>Project: ${actual.name}</p>
                                        <p>Entry Hour: ${actual.startime}</p>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Exit Hour" type="text" class="form-control salida"
                                                name="salida" id="salida"  />
                                        </div>
                                        <div class="form-group input-group-sm">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="insertarSalida(${actual.code}, '${actual.startime}')" >
                                                Registrar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                             `;
  return $("#turno").append(htmlLayaout);
};
// TRABAJO COMPLETADO

const WorkDone = (id, actual) => {
  let htmlLayaout = `           <tr>
                                    <td>${id}</td>
                                    <td colspan="2">
                                        <h5>Work Done Today</h5>
                                        <p>Project: ${actual.name}</p>
                                        <p>Entry Hour: ${actual.startime}</p>
                                        <p>Exit Hour: ${actual.endtime}</p>
                                    </td>
                                </tr>`;
  return $("#turno").append(htmlLayaout);
};

const getTodayDate = () => {
  let date = new Date();
  let m = ("0" + (date.getMonth() + 1)).slice(-2);
  let d = date.getDay();
  let y = date.getFullYear();
  return `${d}/${m}/${y}`;
};

$("#newbtn").click(() => {
  if(ShowIfExistSomething) NewWork() ; return PutTimePicker(); 
  Swal.fire({
    icon: "warning",
    title: "Oops...",
    text: "you have to close your current job to start another!",
  })
 
});



const NumeroDeTrabajoToday = () => {
  loader();
  // STATUS RECUERDO  0 = Hora de entrada registrada, 1 = hora de entrada y salida registrada
  $.ajax({
    url: "php/cantidad.php?date=" + getTodayDate(),
  }).done((data) => {
    data = JSON.parse(data);
    //variables
    const numRows = data.num;
    if (numRows === 0) NewWork();

    if (numRows > 0) {
      data.data.forEach((actual, id) => {
        numeroTotal = id + 1;
        if (actual.status == 0) WorkToRegiOut(id + 1, actual);
        if (actual.status == 1) {WorkDone(id + 1, actual) ; ShowIfExistSomething  = true ; numeroTotal++; };
      });
    }
    PutTimePicker();
    swal.close();
  });
};

$(document).ready(function () {
  NumeroDeTrabajoToday();
  $("#fecha").text(getTodayDate());
});

// Traer proyectos SELECT
let banderaDown = false;
$("#turno").on("focus", "#proyecto", function () {
  if (banderaDown) return;
  $.ajax({
    url: "php/ObtenerProyecto.php",
  }).done((data) => {
    banderaDown = true;
    $("#proyecto").html(data);
  });
});


const calculardiferencia = (hora_inicio, hora_final) => {
  // Expresión regular para comprobar formato
  var formatohora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
  // Si algún valor no tiene formato correcto sale
  if (!(hora_inicio.match(formatohora) && hora_final.match(formatohora))) {
    return;
  }
  // Calcula los minutos de cada hora
  var minutos_inicio = hora_inicio
    .split(":")
    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
  var minutos_final = hora_final
    .split(":")
    .reduce((p, c) => parseInt(p) * 60 + parseInt(c));
  // Si la hora final es anterior a la hora inicial sale
  if (minutos_final < minutos_inicio) return;
  // Diferencia de minutos
  var diferencia = minutos_final - minutos_inicio;
  // Cálculo de horas y minutos de la diferencia
  var horas = Math.floor(diferencia / 60);
  var minutos = diferencia % 60;
  const total = horas + ":" + (minutos < 10 ? "0" : "") + minutos;
  return total;
};





// Insertar Hora de entrada y proyecto
const insertarEntrada = () => {
  const entrada = $("#entrada").val();
  const selectedProject = $("#proyecto").children("option:selected").val();
  if (entrada === "" || selectedProject === "x") {
    return alert("Fill information correctly");
  }
  Swal.fire({
    title: "Are you sure?",
    text: "you are going to record your work hours",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: "php/insertarEntrada.php?date=" + getTodayDate(),
        data: { entrada, selectedProject },
      }).done((data) => {
        console.log(data);
        Swal.fire(
          "OK",
          "Don't forget to record your departure time",
          "success"
        ).then(() => {
          location.reload();
        });
      });
    }
  });
};
// Insertar Hora de SALIDA y horas

const insertarSalida = (code,entrada) => {
  const salida = $("#salida").val();
  const horas = calculardiferencia(entrada, salida);
  if (code === "") {
    return alert("Fill information correctly");
  }
  Swal.fire({
    title: "Are you sure?",
    text: "you are going to record your departure",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: "php/insertarSalida.php?date=" + getTodayDate(),
        data: { code, salida, horas  },
      }).done((data) => {
        console.log(data);
        Swal.fire("OK", "Work Done", "success").then( () =>{location.reload()});

      });
    }
  });
};



// ACTUALIZAR PASS USER
$("#change").click( () =>{  
  const toSend = JSON.stringify($("#change").data().id);
  console.log(toSend)
  Swal.fire({
    title: "Change my password",
    text: "Here you can edit your password ",
    input: "password",
    inputValue: $(this).text(),
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "php/password.php?FromEmpleado=" + result.value + "&id=" + toSend,
      }).done(() => {
        Swal.fire(
          "OK",
          "Don't forget to start next time with your new password",
          "success"
        );
      });
    }
  });
});

