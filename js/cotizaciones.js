//HELPERS
const crearMascara = () => {
  $(".precioClase").mask("000,000,000,000,000.00", {
    reverse: true,
  });
};

const brProyectoToLocalS = async (selected) => {
  let data = await $.ajax("empleados/php/ObtenerProyecto.php");
  localStorage.setItem("proyectos", data);
  fillSelectProyectos("r", selected);
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

const AlertaExito = () => {
  Swal.fire("Good job!", "Data Inserted", "success");
};
let contador = 1;
// Cotizaciones===================================================

// DIVISON PARA INGRESO DE DATOOOOS===============================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================
//IMPRIMIR NUEVA CATEGORIA
const imprimirCategoria = () => {
  contador++;
  let row = `
  <div class="card cate${contador}">
    <div class="card-body works${contador}" >
        <div class="row justify-content-start">
            <div class="col-md-3 col-sm-3"> <label for="type">Job categories</label> <select name="type[]" REQUIRED id="type${contador}"
                    class="form-control">

<option value="Wall Repairs">Wall Repairs</option>
<option value="Painting Walls">Painting Walls</option>
<option value="Painting Walls and Trim">Painting Walls and Trim</option>
<option value="Painting of other items">Painting of other items</option>
<option value="Painting of Ceilings">Painting of Ceilings</option>
<option value="Drywall installation">Drywall installation</option>
<option value="Ceiling Repair ">Ceiling Repair </option>
<option value="Ceiling Texturing">Ceiling Texturing</option>
<option value="Demolition">Demolition</option>
<option value="Plumbing">Plumbing</option>
<option value="Tile Installation-Floor">Tile Installation-Floor</option>
<option value="Tile Installation-Backsplash">Tile Installation-Backsplash</option>
<option value="Baseboard installation">Baseboard installation</option>
<option value="Floor Installation">Floor Installation</option>
<option value="Ceiling Repair">Ceiling Repair</option>
<option value="Miscellaneous">Miscellaneous</option>
<option value="Colour Consulting">Colour Consulting</option>
<option value="Garbage Removal">Garbage Removal</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-2"> <label for="precio">Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text"
                        class="form-control precioClase" REQUIRED name="price[]" >
                </div>
            </div>
            <div class="col-md-1">
                    <label for="place">Delete category</label>  <a class="btn btn-danger text-white " onclick="deleteCategoria(${contador})" ><i class="fas fa-folder-minus"></i></a>
            </div>
        </div>
        <div class="row justify-content-end">
            <label class="col-sm-1 col-form-label">Work</label>
               <div class="col-sm-5">
                 <textarea
                    class="form-control" REQUIRED name="work[]" rows="1"></textarea>
               </div>
               <div class="col-sm-1">
                    <a class="btn btn-info btn-sm btnAddrWork text-white" id="btnAddrWork${contador}"
                    data-turno="${contador}" data-turnoW="1">Add work</a>
               </div> 
        </div>

    </div>
</div>
  `;
  $("#categorias").append(row);
  crearMascara();
};

//IMPRIMIR TODA UN AREA DE TRABAJO

const imprimirFila = (contadorActual) => {
  let row = `
<div class="form-row zone">
    <div class="col-md-11"> <label for="place"> Work Zone</label> <input type="text" REQUIRED id="place" name="place" class="form-control">
    </div>
    <div class="col-md-1 "><label for="place">Add Category</label>  <a class="btn btn-success text-white " onclick="imprimirCategoria()" ><i class="fas fa-folder-plus"></i></a>
    </div>
</div>
<div id="categorias" class='zone'>
<div class="card">
    <div class="card-body works${contadorActual}">
        <div class="row justify-content-start">
            <div class="col-md-3 col-sm-3"> <label for="type">Job categories</label> <select name="type[]" REQUIRED id="type"
                    class="form-control">

<option value="Wall Repairs">Wall Repairs</option>
<option value="Painting Walls">Painting Walls</option>
<option value="Painting Walls and Trim">Painting Walls and Trim</option>
<option value="Painting of other items">Painting of other items</option>
<option value="Painting of Ceilings">Painting of Ceilings</option>
<option value="Drywall installation">Drywall installation</option>
<option value="Ceiling Repair ">Ceiling Repair </option>
<option value="Ceiling Texturing">Ceiling Texturing</option>
<option value="Demolition">Demolition</option>
<option value="Plumbing">Plumbing</option>
<option value="Tile Installation-Floor">Tile Installation-Floor</option>
<option value="Tile Installation-Backsplash">Tile Installation-Backsplash</option>
<option value="Baseboard installation">Baseboard installation</option>
<option value="Floor Installation">Floor Installation</option>
<option value="Ceiling Repair">Ceiling Repair</option>
<option value="Miscellaneous">Miscellaneous</option>
<option value="Colour Consulting">Colour Consulting</option>
<option value="Garbage Removal">Garbage Removal</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-2"> <label for="precio">Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text"
                        class="form-control  precioClase" REQUIRED name="price[]" >
                </div>
            </div>
        </div>
        <div class="row justify-content-end " >
               <label class="col-sm-1 col-form-label">Work</label>
               <div class="col-sm-5">
                 <textarea
                    class="form-control" name="work[]" REQUIRED rows="1"></textarea>
               </div>
               <div class="col-sm-1">
                    <a class="btn btn-info btn-sm btnAddrWork text-white" id="btnAddrWork${contador}"
                    data-turno="${contadorActual}" data-turnoW="1">Add work</a>
               </div>
        </div>
    </div>
</div>
</div>
`;
  $("#rowsC").append(row);
};

//IMPRIMIR MAS FILAS DE TRABAJOS
const imprimirTrabajo = (data) => {
  let html = `
  <div id="trabajo${data.turnow + 1}C${data.turno}">
  <hr>
  <div class="row justify-content-end"  >
  <label class="col-sm-1 col-form-label">Work</label>
               <div class="col-sm-5">
               <textarea class="form-control" REQUIRED name="work[]" rows="1"></textarea>
               </div>
               <div class="col-sm-1">
                     <a class="btn btn-danger btn-sm text-white" onclick="deleteWork(${
    data.turnow + 1
    },${data.turno})" >Remove Work</a>
             </div>
             </div>
  </div>
`;

  $(".works" + data.turno).append(html);
  $("#btnAddrWork" + data.turno).data("turnow", data.turnow + 1);
};

//Inicializa con la primera area de trabajo
imprimirFila(contador);

//BORRAR CATEGORIA
const deleteCategoria = (contadorDeturno) => {
  contador = contador - 1;
  $(".cate" + contadorDeturno).remove();
};
//BORRAR WORK
const deleteWork = (turnoW, turno) => {
  let id = `#trabajo${turnoW}C${turno}`;
  $(id).remove();
  let v = $("#btnAddrWork" + turno).data("turnow");
  $("#btnAddrWork" + turno).data("turnow", v - 1);
};

// DIVISON PARA INGRESO DE DATOOOOS================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ DIVISION PARA MOSTRAR DATOS===============================

// FORMATEAR DATOS PARA TABLA
const format = async (d) => {
  let data = await $.ajax("php/cotizaciones/ObtenerDatosC.php?cliente=" + d.code);
  data = JSON.parse(data);
  let before;
  let html = `<table class="table table-stripeed table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">`;
  data.map((element) => {
    if (element.cat !== before) {
      html += `
        <tr>
        <th>${element.cat} </th>
        <th>$ ${element.total} </th>
        </tr> 
        <tr> <td> ${element.detalle}</td>      <td></td></tr>
        `;
    } else {
      html += `
        <tr>
        <td>${element.detalle} </td>
        <td></td>
        </tr>  `;
    }
    // html += ` <tr>
    // <td>${element.cat} </td>
    // <td>${element.total} </td>
    // <td>${element.detalle} </td>
    // </tr>  `;
    before = element.cat;
  });
  html += `</table>`;
  return html;
};
// TABLA
var table;
const tabla = (id) => {
  table = $("#example").DataTable({
    destroy: true,
    ajax: {
      url: `php/cotizaciones/ObtenerCotizaciones.php?cliente=${id}`,
      dataSrc: "",
    },
    columns: [
      {
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      { data: "WorkZone", name: "WorkZone" },
      { data: "total", name: "Total" },
    ],
    order: [[1, "asc"]],
  });
};

// Add event listener for opening and closing details
$("#example").on("click", "td.details-control", function () {
  var tr = $(this).closest("tr");
  var row = table.row(tr);

  if (row.child.isShown()) {
    // This row is already open - close it
    row.child.hide();
    tr.removeClass("shown");
  } else {
    // Open this row
    format(row.data()).then((data) => {
      row.child(data).show();
      tr.addClass("shown");
    });
  }
});

//============================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ DIVISION PARA MOSTRAR DATOS===============================

$("#rowsC")
  .on("click", ".btnAddrWork", function () {
    data = $(this).data();
    imprimirTrabajo(data);
  })
  //   // Insertar============ / Cotizaciones
  .submit(async function (event) {
    event.preventDefault();
    const ProjectSelectorCtciones = $("#ProjectSelectorCtciones")
      .children("option:selected")
      .val();
    console.log(ProjectSelectorCtciones);
    if (validate.isEmpty(ProjectSelectorCtciones)) {
      return alert("Debe Seleccionar proyecto");
    } else {
      loader();
      let worksPerTurno = [];
      for (let i = 1; i <= contador; i++) {
        worksPerTurno.push($("#btnAddrWork" + i).data().turnow);
      }
      $(".precioClase").each(function () {
        var text = $(this).val().replace(",", "");
        $(this).val(text.trim());
      });
      const NewP = $("#generico").val();
      const NewCliente = $("#clienteSelectNew")
        .children("option:selected")
        .val();
      const serializedData = $(this).serialize();
      const query = await $.ajax({
        url: `php/cotizaciones/insert.php?arreglo=${JSON.stringify(
          worksPerTurno
        )}&contador=${contador}&proyectoId=${ProjectSelectorCtciones}&NewP=${NewP}&NewCliente=${NewCliente}`,
        type: "POST",
        data: serializedData,
      });
      brProyectoToLocalS(ProjectSelectorCtciones);

      swal.close();
      AlertaExito();
      tabla(ProjectSelectorCtciones);
      $(".zone").remove();
      contador = 1;
      imprimirFila(contador);
      console.log(query);
    }
  });

//     $.ajax({
//       url: `php/cotizaciones/insert.php?contador=${contador}&proyectoId=${ProjectSelectorCtciones}&generico=${NewP}&cliente=${NewCliente}`,
//       type: "post",
//       data: serializedData,
//       //   beforeSend: () => {
//       //     $("#New_button").css("display", "none");
//       //     $("#loader").removeClass("invisible").addClass("visible");
//       //   },
//     }).done(function (data) {
//       $("#generico").val("");
//       contador = 1;
//       $("#rowsC").html("");
//       imprimirFila(contador, false);
//       crearMascara();
//       $("#rowsC")[0].reset();

//       const select = new Promise((resolve, reject) => {
//         $.ajax({
//           url: "php/cotizaciones/ObtenerProyecto.php",
//         }).done((data) => {
//           bPCtz = true;
//           $("#ProjectSelectorCtciones").html(data);
//           resolve();
//         });
//       });

//       const ShowCoti = new Promise((resolve, reject) => {
//         $.ajax({
//           url: "php/cotizaciones/ObtenerCotizaciones.php",
//           data: { cliente: ProjectSelectorCtciones },
//         }).done((data) => {
//           $(".materialesDiv").css("display", "none");
//           $("#btnAddMaterial").removeClass("visible").addClass("invisible");
//           $("#tablaMateriales").html(data);
//           $("#dataTable").DataTable();
//           resolve();
//         });
//       });

//       Promise.all([select, ShowCoti]).then(AlertaExito());
//     });
//   })
//   .on("click", ".BtnRowErase", function () {
//     let contadorDeturno = $(this).data("turno");
//     contador = contador - 1;
//     $(".turno" + contadorDeturno).remove();
//   });

// $("#addRowBtnC").click(() => {
//   contador = contador + 1;
//   $("#rowsC").append(`<hr class="new2">`);
//   imprimirFila(contador);
//   crearMascara();
// });

//SELECT de proyectos
let bPCtz = false;
$("#ProjectSelectorCtciones").change(() => {
  const selectedProject = $("#ProjectSelectorCtciones")
    .children("option:selected")
    .val();
  if (selectedProject == 0) {
    $("#newInput").removeClass("invisible").addClass("visible");
    $("#newCliente").removeClass("invisible").addClass("visible");
    $("#newKind").removeClass("invisible").addClass("visible");
  } else {
    $("#newInput").removeClass("visible").addClass("invisible");
    $("#newCliente").removeClass("visible").addClass("invisible");
    $("#newKind").removeClass("visible").addClass("invisible");
  }
  $(".materialesDiv").css("display", "flex");
  $("#btnAddMaterial").removeClass("invisible").addClass("visible");
  crearMascara();
  $("#mensaje").addClass("invisible");
  $(".dowPart").css("display", "block");

  tabla(selectedProject);
});
//=========================================================================================================================

//SELECT DE CLIENTES
let bClt = false;
$("#clienteSelectNew").hover(() => {
  if (bClt) return;
  $.ajax({
    url: "php/proyecto/ObtenerClientes.php",
  }).done((data) => {
    bClt = true;
    $("#clienteSelectNew").html(data);
  });
});

// SELECT DE TIPO  DE PROYECTO
$("#KindPro").change(() => {
  const valor = $("#KindPro").children("option:selected").val();
  const mesActual = ("0" + (new Date().getMonth() + 1)).slice(-2);
  const NombreNuevoProyecto = $("#generico").val(valor + mesActual);
});

const fillSelectProyectos = (op, selected) => {
  if (op === "r") {
    $("#ProjectSelectorCtciones").find("option").remove();
    $("#ProjectSelectorCtciones").append(
      `<option disabled selected></option><option value="0">* New Project *</option>`
    );
    $(`ProjectSelectorCtciones option[value=${selected}]`).attr(
      "selected",
      "selected"
    );
    $("#newInput").removeClass("visible").addClass("invisible");
    $("#newCliente").removeClass("visible").addClass("invisible");
    $("#newKind").removeClass("visible").addClass("invisible");
  }
  let data = localStorage.getItem("proyectos");
  data = JSON.parse(data);
  for (const prop in data) {
    $("#ProjectSelectorCtciones").append(
      `<option value="${prop}">${data[prop]}</option>`
    );
  }
};

//Eliminar Ctz
const deleteThisCtz = (id, cliente) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this! ID ctz: " + id,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      const p1 = new Promise((res, rej) => {
        $.ajax({
          url: `php/cotizaciones/eliminarCtz.php?id=${id}`,
        }).done(() => {
          $.ajax({
            url: "php/cotizaciones/ObtenerCotizaciones.php",
            data: { cliente },
          }).done((data) => {
            $("#tablaMateriales").html(data);
            $("#dataTable").DataTable();
          });
          res();
        });
      });

      Promise.all([p1]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success")
      );
    }
  });
};
//Boton para generar reporte cotizacion
const generateReport = () => {
  const selectedProject = $("#ProjectSelectorCtciones")
    .children("option:selected")
    .val();
  let url = `php/reportes/linkCotizacion.php?projectCode=${selectedProject}`;
  let win = window.open(url, "_blank");
  // Cambiar el foco al nuevo tab (punto opcional)
  win.focus();
};
//Boton para generar Invoice
const generateReportF = () => {
  const selectedProject = $("#ProjectSelectorCtciones")
    .children("option:selected")
    .val();
  let url = `php/reportes/linkFactura.php?projectCode=${selectedProject}`;
  let win = window.open(url, "_blank");
  // Cambiar el foco al nuevo tab (punto opcional)
  win.focus();
};
