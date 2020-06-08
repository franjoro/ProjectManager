const error_empty = () => {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: "Rellenar todos los espacios vacios",
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

const AlertaExito = () => {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
  Toast.fire({
    icon: "success",
    title: "Operación exitosa",
  });
};
const AlertaFallido = () => {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
  Toast.fire({
    icon: "error",
    title: "Algo salio mal...",
  });
};

const Alertausuario = () => {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
  Toast.fire({
    icon: "error",
    title: "Pin de usuario existente",
  });
};


const NotEditable = () =>{
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "You cannot edit this cell on this table",
  });
}


//Mascara de materiales/cotizaciones Dinero
const crearMascara = () => {
  $(".precioClase").mask("000,000,000,000,000.00", {
    reverse: true,
  });
};

// ==========================================================CLIENTES=======================
//Obtener tabla

const tablaClientes = () => {
  $.ajax({
    url: "php/clientes/tabla.php",
  }).done(function (data) {
    $("#clientTable").html(data);
    $("#dataTable").DataTable();
  });
};

//Registrar nuevo cliente
$("#clienteForm").submit(function (event) {
  event.preventDefault();
  const serializedData = $(this).serialize();

  $.ajax({
    url: "php/clientes/insert.php",
    type: "post",
    data: serializedData,
    beforeSend: () => {
      $("#New_button").css("display", "none");
      $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (data) {
      tablaClientes();
      AlertaExito();
      $("#New_button").css("display", "block");
      $("#loader").removeClass("visible").addClass("invisible");
      $("#clienteForm")[0].reset();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error("The following error occurred: " + textStatus, errorThrown);
      AlertaFallido();
    });
});

// Borrar cliente
const deleteCliente = (id) => {
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
      $.ajax({
        url: `php/clientes/eliminar.php?id=${id}`,
      }).done((data) => {
        console.log(data);
        tablaClientes();
      });
    }
  });
};

// VER CLIENTES
const seeClientes = id =>{
  loader();
  $.ajax({
    url:"php/clientes/detalles.php?id="+id
  }).done( data =>{
    swal.close();
    Swal.fire({
      title: "Information details",
      html: data,
    });
  } )
}
// ACTUALIZAR CLIENTES 
$("#clientTable").on("click", "tbody td", function () {
  const toSend = $(this).data();
  if(toSend.tabla === "delete") {return deleteCliente(toSend.code)}
  Swal.fire({
    title: "Edit cell",
    text:"You will edit a cell this will be reflected in the reporting information ",
    input:"text",
    inputValue : $(this).text() , 
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url:"php/edit.php",
        data:{tabla: toSend.tabla, columna: toSend.columna, campo: result.value, code: toSend.code},
        type:"POST"
      }).done((data)=>{
        console.log(data)
        AlertaExito();
        tablaClientes();
      } )
    }
  });
});

// ==========================================================Propiedades=======================
//Obtener tabla
const tablaPropiedades = () => {
  $.ajax({
    url: "php/propiedades/tabla.php",
  }).done(function (data) {
    $("#PTable").html(data);
    $("#dataTable").DataTable();
  });
};
//Registrar nueva propiedades
$("#propiedadesForm").submit(function (event) {
  event.preventDefault();
  const serializedData = $(this).serialize();
  $.ajax({
    url: "php/propiedades/insert.php",
    type: "post",
    data: serializedData,
    beforeSend: () => {
      $("#New_button").css("display", "none");
      $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (data) {
      tablaPropiedades();
      AlertaExito();
      $("#New_button").css("display", "block");
      $("#loader").removeClass("visible").addClass("invisible");
      $("#propiedadesForm")[0].reset();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error("The following error occurred: " + textStatus, errorThrown);
      AlertaFallido();
    });
});
//Obtener Clientes
$("#proOwner").focus(() => {
  $.ajax({
    url: "php/proyecto/ObtenerClientes.php",
  }).done((data) => {
    $("#proOwner").html(data);
  });
});

const deletePropiedades = (id) => {
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
          url: `php/propiedades/eliminar.php?id=${id}`,
        }).done(() => {
          res();
        });
      });
      Promise.all([p1]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
          () => {
            location.reload();
          }
        )
      );
    }
  });
};

// ACTUALIZAR PROPIEDADES 
$("#PTable").on("click", "tbody td", function () {
  const toSend = $(this).data();
  if (toSend.tabla === "delete") {
    return deletePropiedades(toSend.code);
  }
  if (toSend.tabla === "NotEditable") {
    return NotEditable();
  }
  Swal.fire({
    title: "Edit cell",
    text:
      "You will edit a cell this will be reflected in the reporting information ",
    input: "text",
    inputValue: $(this).text(),
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "php/edit.php",
        data: {
          tabla: toSend.tabla,
          columna: toSend.columna,
          campo: result.value,
          code: toSend.code,
        },
        type: "POST",
      }).done((data) => {
        AlertaExito();
        tablaPropiedades();
      });
    }
  });
});


// ==========================================================Proveedores=======================
//Obtener tabla
const tablaProvedores = () => {
  $.ajax({
    url: "php/providers/tabla.php",
  }).done(function (data) {
    $("#clientProviders").html(data);
    $("#dataTable").DataTable();
  });
};
//Registrar nueva proveedor
$("#providersForm").submit(function (event) {
  event.preventDefault();
  const serializedData = $(this).serialize();
  $.ajax({
    url: "php/providers/insert.php",
    type: "post",
    data: serializedData,
    beforeSend: () => {
      $("#New_button").css("display", "none");
      $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (data) {
      tablaProvedores();
      console.log(data);

      AlertaExito();
      $("#New_button").css("display", "block");
      $("#loader").removeClass("visible").addClass("invisible");
      $("#providersForm")[0].reset();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error("The following error occurred: " + textStatus, errorThrown);
      AlertaFallido();
    });
});

const deleteProviders = (id) => {
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
          url: `php/providers/eliminar.php?id=${id}`,
        }).done(() => {
          res();
        });
      });
      Promise.all([p1]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
          () => {
            location.reload();
          }
        )
      );
    }
  });
};
// ACTUALIZAR PROOVEDORES 
$("#clientProviders").on("click", "tbody td", function () {
  const toSend = $(this).data();
  if (toSend.tabla === "delete") {
    return deleteProviders(toSend.code);
  }
  // if (toSend.tabla === "NotEditable") {
  //   return NotEditable();
  // }
  Swal.fire({
    title: "Edit cell",
    text:
      "You will edit a cell this will be reflected in the reporting information ",
    input: "text",
    inputValue: $(this).text(),
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "php/edit.php",
        data: {
          tabla: toSend.tabla,
          columna: toSend.columna,
          campo: result.value,
          code: toSend.code,
        },
        type: "POST",
      }).done((data) => {
        AlertaExito();
        tablaProvedores();
      });
    }
  });
});
// ==========================================================Empleados=======================
//Obtener tabla
const tablaEmpleados = () => {
  $.ajax({
    url: "php/empleados/tabla.php",
  }).done(function (data) {
    $("#clientTable").html(data);
    $("#dataTable").DataTable();
  });
};
//Registrar nuevo empleado
$("#empleadosForm").submit(function (event) {
  console.log("Entra");
  event.preventDefault();
  const serializedData = $(this).serialize();
  const pin = $("#pin").val();
  $.ajax({
    url: "php/empleados/insert.php?pin="+ pin,
    type: "post",
    data: serializedData,
    beforeSend: () => {
      $("#New_button").css("display", "none");
      $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (data) {
      console.log(data);
      if (data == "pinUsed") {
        Alertausuario();
      } else {
        tablaEmpleados();
        AlertaExito();
      }
      $("#New_button").css("display", "block");
      $("#loader").removeClass("visible").addClass("invisible");
      $("#empleadosForm")[0].reset();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error("The following error occurred: " + textStatus, errorThrown);
      AlertaFallido();
    });
});

const deleteEmpleado = (id) => {
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
          url: `php/empleados/eliminar.php?id=${id}`,
        }).done(() => {
          res();
        });
      });
      Promise.all([p1]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
          () => {
            location.reload();
          }
        )
      );
    }
  });
};

// ==========================================================Proyectos=======================
//Obtener tabla
const tablaProyecto = () => {
  $.ajax({
    url: "php/proyecto/tabla.php",
  }).done(function (data) {
    $("#clientTable").html(data);
    $("#dataTable").DataTable();
  });
};
//Registrar nueva proyecto
$("#ProyectosForm").submit(function (event) {
  event.preventDefault();
  const serializedData = $(this).serialize();
  $.ajax({
    url: "php/proyecto/insert.php",
    type: "post",
    data: serializedData,
    beforeSend: () => {
      $("#New_button").css("display", "none");
      $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (data) {
      tablaProyecto();
      console.log(data);
      AlertaExito();
      $("#New_button").css("display", "block");
      $("#loader").removeClass("visible").addClass("invisible");
      $("#ProyectosForm")[0].reset();
      if ($("#defaultCheck1").prop("checked") == true) {
        window.navigate("cotizaciones.php");
      }
      return;
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error("The following error occurred: " + textStatus, errorThrown);
      AlertaFallido();
    });
});
//Obtener Clientes
let banderaDown = false;
$("#client")
  .focus(() => {
    if (banderaDown) return;
    $.ajax({
      url: "php/proyecto/ObtenerClientes.php",
    }).done((data) => {
      console.info("query");
      banderaDown = true;
      $("#client").html(data);
    });
  })
  .change(() => {
    const selectedClient = $("#client").children("option:selected").val();
    $.ajax({
      url: "php/proyecto/ObtenerPropiedades.php",
      data: { cliente: selectedClient },
    }).done((data) => {
      $("#ProyectoSelectPropiedades").html(data);
    });
    $("#ProyectoSelectPropiedades").prop("disabled", false);
  });

const deleteProyecto = (id)=>{
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
            url: `php/proyecto/eliminar.php?id=${id}`,
          }).done(() => {
            res();
          });
        });

        Promise.all([p1]).then(
          Swal.fire("Deleted!", "Your file has been deleted.", "success").then( ()=>{
            location.reload()
          } )
        );
      }
    });
}




// =================================================================MATERIALES Y COTIZACIONES =======================
//ObtenerProyectos / Materiales

const costosExtraData = `               <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="inputEmail4">Proovedor</label>
                  <select name="provider" id="proovedores" required class="form-control form-control-sm proovedores">
                    <option disabled selected>Seleccionar proovedor</option>
                    <option disabled>Loading...</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Bill number</label>
                  <input type="text" required class="form-control form-control-sm" name="bill">
                </div>
                <div class="form-group col-md-3">
                  <label>Fecha</label>
                  <input type="text" required class="form-control form-control-sm" name="date" id="date">
                </div>
                <div class="form-group col-md-3">
                  <label>Forma de pago</label>
                  <select name="paym" class="form-control form-control-sm">
                    <option selected disabled>Elegir metodo de pago</option>
                    <option value="te">TE</option>
                    <option value="cr">CR</option>
                    <option value="ot">OT</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="gst" name="gst" value="1" class="custom-control-input">
                  <label class="custom-control-label" for="gst">GST 5%</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="pst" name="pst" value="1" class="custom-control-input">
                  <label class="custom-control-label" for="pst">PST 7%</label>
                </div>
              </div>
            `;

const imprimirFila = (turno, MOrC) => {
  let htmlToPrintFirst = `
              <div class="form-row  turno${turno}">
                <div class="form-group col-md-6 ">
                  <textarea class="form-control form-control-sm mytextarea" name="concepto[]"  required placeholder="Concepto..." rows="1"></textarea>
                </div>
                <div class="form-group col-md-1 ">
                  <input type="text" class="form-control form-control-sm precioClase" required data-turno="${turno}"  value="0" name="precio[]" id="precio${turno}">
                </div>
                <div class="form-group col-md-1">
                  <input type="number" step="1" value="1" class="form-control form-control-sm cantidadClase" data-turno="${turno}"  name="cantidad[]" id="cantidad${turno}">
                </div>
                <div class="form-group col-md-2">
                  <input type="text" readonly  value="0" class="form-control form-control-sm " name="total[]" id="total${turno}">
                </div>
                <div class="form-group col-md-1">
                </div>
              </div>
                    `;
  let htmlToPrint = `
              <div class="form-row  turno${turno}">
                <div class="form-group col-md-6 ">
                  <textarea class="form-control form-control-sm mytextarea" placeholder="Concepto..." required  name="concepto[]" rows="1"></textarea>
                </div>
                <div class="form-group col-md-1 ">
                  <input type="text" class="form-control form-control-sm precioClase" required data-turno="${turno}"  value="0" name="precio[]" id="precio${turno}">
                </div>
                <div class="form-group col-md-1">
                  <input type="number" step="1" value="1" class="form-control form-control-sm cantidadClase" data-turno="${turno}"  name="cantidad[]" id="cantidad${turno}">
                </div>
                <div class="form-group col-md-2">
                  <input type="text" readonly  value="0" class="form-control form-control-sm " name="total[]" id="total${turno}">
                </div>
                <div class="form-group col-md-1">
                  <button  data-turno="${turno}" class="btn btn-warning BtnRowErase"><i class="fas fa-trash"></i></button>
                </div>
              </div>
                    `;
  let decision;
  MOrC ? (decision = "#rows") : (decision = "#rowsC");

  if (turno === 1) {
    return $(decision).append(htmlToPrintFirst);
  } else {
    return $(decision).append(htmlToPrint);
  }
};

let banderaDownProo = false;

let contador = 1;
imprimirFila(contador, true);
//SELECT DE PROYECTO Materiales
let CostosBool = false;
$("#ProjectSelectorCostos")
  .hover(() => {
    if (CostosBool) return;
    $.ajax({
      url: "php/cotizaciones/ObtenerProyecto.php",
    }).done((data) => {
      CostosBool = true;
      $("#ProjectSelectorCostos").html(data);
    });
  })
  //Obtener tabla
  .change(() => {
    const selectedProject = $("#ProjectSelectorCostos")
      .children("option:selected")
      .val();
    if (selectedProject == 0) {
      $("#newInput").removeClass("invisible").addClass("visible");
    } else {
      $("#newInput").removeClass("visible").addClass("invisible");
    }
    $.ajax({
      url: "php/materiales/ObtenerTabla.php",
      data: { cliente: selectedProject },
    }).done((data) => {
      $(".materialesDiv").css("display", "flex");
      $("#btnAddMaterial").removeClass("invisible").addClass("visible");
      $("#tablaMateriales").html(data);
      $("#dataTable").DataTable();
    });
  });

//Agregar fila Materiales
$("#addRowBtn").click(() => {
  contador = contador + 1;
  imprimirFila(contador, true);
  crearMascara();
});

$("#rows")
  .on("keyup", ".precioClase", function () {
    const contadorDeturno = $(this).data("turno");
    const inputTotal = $("#total" + contadorDeturno);
    const cantidad = $("#cantidad" + contadorDeturno).val();
    const precio = $(this).val().replace(",", "");
    const multiplicacion = Number(cantidad) * Number(precio);
    inputTotal.val(multiplicacion.toFixed(2));
  })
  .on("focusout", ".precioClase", function () {
    if ($(this).val() === "") $(this).val("0");
  })
  .on("focusin", ".precioClase", function () {
    if ($(this).val() === "0") $(this).val("");
  })
  .on("change", ".cantidadClase", function () {
    const contadorDeturno = $(this).data("turno");
    const inputTotal = $("#total" + contadorDeturno);
    const precio = $("#precio" + contadorDeturno)
      .val()
      .replace(",", "");
    const multiplicacion = Number(precio) * Number($(this).val());
    inputTotal.val(multiplicacion.toFixed(2));
  })
  .on("click", ".BtnRowErase", function () {
    let contadorDeturno = $(this).data("turno");
    contador = contador - 1;
    $(".turno" + contadorDeturno).remove();
  })
  .on("mouseenter ", ".proovedores", function () {
    if (banderaDownProo) return;
    console.log("Hover ");
    $.ajax({
      url: "php/materiales/ObtenerProovedores.php",
    }).done((data) => {
      banderaDownProo = true;
      $(".proovedores").html(data);
    });
  })

  // Insertar============ / materiales
  .submit(function (event) {
    event.preventDefault();
    $(".precioClase").unmask();
    const selectedProject = $("#ProjectSelectorCostos")
      .children("option:selected")
      .val();
    if (selectedProject == "x") return alert("Debe Seleccionar proyecto");
    const NewP = $("#generico").val();
    const serializedData = $(this).serialize();
    $.ajax({
      url: `php/materiales/insert.php?contador=${contador}&proyectoId=${selectedProject}&generico=${NewP}`,
      type: "post",
      data: serializedData,
      //   beforeSend: () => {
      //     $("#New_button").css("display", "none");
      //     $("#loader").removeClass("invisible").addClass("visible");
      //   },
    }).done(function (data) {
      console.log(data);
      $("#generico").val("");
      contador = 1;
      $("#rows")[0].reset();
      $("#rows").html(costosExtraData);
      banderaDownProo = false;
      imprimirFila(contador, true);
      $("#date").datepicker();
      crearMascara();
      $("#newInput").removeClass("visible").addClass("invisible");

      const select = new Promise((resolve, reject) => {
        $.ajax({
          url: "php/cotizaciones/ObtenerProyecto.php",
        }).done((data) => {
          bPCtz = true;
          $("#ProjectSelectorCostos").html(data);
          resolve();
        });
      });

      const ShowCoti = new Promise((resolve, reject) => {
        const selectedProject = $("#ProjectSelectorCostos")
          .children("option:selected")
          .val();
        $.ajax({
          url: "php/materiales/ObtenerTabla.php",
          data: { cliente: selectedProject },
        }).done((data) => {
          $(".materialesDiv").css("display", "flex");
          $("#btnAddMaterial").removeClass("invisible").addClass("visible");
          $("#tablaMateriales").html(data);
          $("#dataTable").DataTable();
          resolve();
        });
      });

      Promise.all([ShowCoti, select]).then(AlertaExito());
    });
  });

// Cotizaciones===================================================
imprimirFila(contador, false);

$("#addRowBtnC").click(() => {
  contador = contador + 1;
  imprimirFila(contador, false);
  crearMascara();
});

$("#rowsC")
  .on("keyup", ".precioClase", function () {
    const contadorDeturno = $(this).data("turno");
    const inputTotal = $("#total" + contadorDeturno);
    const cantidad = $("#cantidad" + contadorDeturno).val();
    const precio = $(this).val().replace(",", "");
    const multiplicacion = Number(cantidad) * Number(precio);
    inputTotal.val(multiplicacion.toFixed(2));
  })
  .on("focusout", ".precioClase", function () {
    if ($(this).val() === "") $(this).val("0");
  })
  .on("focusin", ".precioClase", function () {
    if ($(this).val() === "0") $(this).val("");
  })
  .on("change", ".cantidadClase", function () {
    const contadorDeturno = $(this).data("turno");
    const inputTotal = $("#total" + contadorDeturno);
    const precio = $("#precio" + contadorDeturno)
      .val()
      .replace(",", "");
    const multiplicacion = Number(precio) * Number($(this).val());
    inputTotal.val(multiplicacion.toFixed(2));
  })
  // Insertar============ / Cotizaciones
  .submit(function (event) {
    event.preventDefault();
    $(".precioClase").unmask();
    const ProjectSelectorCtciones = $("#ProjectSelectorCtciones")
      .children("option:selected")
      .val();
    if (ProjectSelectorCtciones == "x")
      return alert("Debe Seleccionar proyecto");
    const NewP = $("#generico").val();
    const NewCliente = $("#clienteSelectNew").children("option:selected").val();
    const serializedData = $(this).serialize();

    $.ajax({
      url: `php/cotizaciones/insert.php?contador=${contador}&proyectoId=${ProjectSelectorCtciones}&generico=${NewP}&cliente=${NewCliente}`,
      type: "post",
      data: serializedData,
      //   beforeSend: () => {
      //     $("#New_button").css("display", "none");
      //     $("#loader").removeClass("invisible").addClass("visible");
      //   },
    }).done(function (data) {
      $("#generico").val("");
      contador = 1;
      $("#rowsC").html("");
      imprimirFila(contador, false);
      crearMascara();
      $("#rowsC")[0].reset();

      const select = new Promise((resolve, reject) => {
        $.ajax({
          url: "php/cotizaciones/ObtenerProyecto.php",
        }).done((data) => {
          bPCtz = true;
          $("#ProjectSelectorCtciones").html(data);
          resolve();
        });
      });

      const ShowCoti = new Promise((resolve, reject) => {
        $.ajax({
          url: "php/cotizaciones/ObtenerCotizaciones.php",
          data: { cliente: ProjectSelectorCtciones },
        }).done((data) => {
          $(".materialesDiv").css("display", "nonre");
          $("#btnAddMaterial").removeClass("visible").addClass("invisible");
          $("#tablaMateriales").html(data);
          $("#dataTable").DataTable();
          resolve();
        });
      });

      Promise.all([select, ShowCoti]).then(AlertaExito());
    });
  })
  .on("click", ".BtnRowErase", function () {
    let contadorDeturno = $(this).data("turno");
    contador = contador - 1;
    $(".turno" + contadorDeturno).remove();
  });
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
$("#KindPro").change(()=>{
  const valor = $("#KindPro").children("option:selected").val();
  const mesActual = ("0" + (new Date().getMonth() + 1)).slice(-2);
  const NombreNuevoProyecto = $("#generico").val(valor+mesActual);
} );

//SELECT de proyectos
let bPCtz = false;
$("#ProjectSelectorCtciones")
  .hover(() => {
    if (bPCtz) return;
    $.ajax({
      url: "php/cotizaciones/ObtenerProyecto.php",
    }).done((data) => {
      bPCtz = true;
      $("#ProjectSelectorCtciones").html(data);
    });
  })
  .change(() => {
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

    $.ajax({
      url: "php/cotizaciones/ObtenerCotizaciones.php",
      data: { cliente: selectedProject },
    }).done((data) => {
      $(".materialesDiv").css("display", "flex");
      $("#btnAddMaterial").removeClass("invisible").addClass("visible");
      $("#tablaMateriales").html(data);
      $("#dataTable").DataTable();
    });



  });

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


