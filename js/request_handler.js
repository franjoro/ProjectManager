const error_empty = () => {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Rellenar todos los espacios vacios",
    });
  },
  loader = () => {
    Swal.fire({
      title: "Please Wait!",
      html: "Loading data",
      allowOutsideClick: !1,
      onBeforeOpen: () => {
        Swal.showLoading();
      },
    });
  },
  AlertaExito = () => {
    Swal.mixin({
      toast: !0,
      position: "top-end",
      showConfirmButton: !1,
      timer: 3e3,
      timerProgressBar: !0,
      onOpen: (e) => {
        e.addEventListener("mouseenter", Swal.stopTimer),
          e.addEventListener("mouseleave", Swal.resumeTimer);
      },
    }).fire({ icon: "success", title: "Operación exitosa" });
  },
  AlertaFallido = () => {
    Swal.mixin({
      toast: !0,
      position: "top-end",
      showConfirmButton: !1,
      timer: 3e3,
      timerProgressBar: !0,
      onOpen: (e) => {
        e.addEventListener("mouseenter", Swal.stopTimer),
          e.addEventListener("mouseleave", Swal.resumeTimer);
      },
    }).fire({ icon: "error", title: "Algo salio mal..." });
  },
  Alertausuario = () => {
    Swal.mixin({
      toast: !0,
      position: "top-end",
      showConfirmButton: !1,
      timer: 3e3,
      timerProgressBar: !0,
      onOpen: (e) => {
        e.addEventListener("mouseenter", Swal.stopTimer),
          e.addEventListener("mouseleave", Swal.resumeTimer);
      },
    }).fire({ icon: "error", title: "Pin de usuario existente" });
  },
  NotEditable = () => {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "You cannot edit this cell on this table",
    });
  },
  crearMascara = () => {
    $(".precioClase").mask("000,000,000,000,000.00", { reverse: !0 });
  },
  brProyectoToLocalS = async () => {
    let e = await $.ajax("empleados/php/ObtenerProyecto.php");
    localStorage.setItem("proyectos", e), swal.close();
  },
  tablaClientes = () => {
    $.ajax({ url: "php/clientes/tabla.php" }).done(function (e) {
      $("#clientTable").html(e), $("#dataTable").DataTable();
    });
  };
$("#clienteForm").submit(function (e) {
  e.preventDefault();
  const t = $(this).serialize();
  $.ajax({
    url: "php/clientes/insert.php",
    type: "post",
    data: t,
    beforeSend: () => {
      $("#New_button").css("display", "none"),
        $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (e) {
      tablaClientes(),
        AlertaExito(),
        $("#New_button").css("display", "block"),
        $("#loader").removeClass("visible").addClass("invisible"),
        $("#clienteForm")[0].reset();
    })
    .fail(function (e, t, o) {
      AlertaFallido();
    });
});
const deleteCliente = (e) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this! ID ctz: " + e,
      icon: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((t) => {
      t.value &&
        $.ajax({ url: "php/clientes/eliminar.php?id=" + e }).done((e) => {
          tablaClientes();
        });
    });
  },
  seeClientes = (e) => {
    loader(),
      $.ajax({ url: "php/clientes/detalles.php?id=" + e }).done((e) => {
        swal.close(), Swal.fire({ title: "Information details", html: e });
      });
  };
$("#clientTable").on("click", "tbody td", function () {
  const e = $(this).data();
  if ("delete" === e.tabla)
    return (
      (t = e.code),
      void Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! ID ctz: " + t,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((e) => {
        e.value &&
          $.ajax({ url: "php/clientes/eliminar.php?id=" + t }).done((e) => {
            tablaClientes();
          });
      })
    );
  var t;
  Swal.fire({
    title: "Edit cell",
    text:
      "You will edit a cell this will be reflected in the reporting information ",
    input: "text",
    inputValue: $(this).text(),
    icon: "info",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((t) => {
    t.value &&
      $.ajax({
        url: "php/edit.php",
        data: {
          tabla: e.tabla,
          columna: e.columna,
          campo: t.value,
          code: e.code,
        },
        type: "POST",
      }).done((e) => {
        AlertaExito(), tablaClientes();
      });
  });
});
const tablaPropiedades = () => {
  $.ajax({ url: "php/propiedades/tabla.php" }).done(function (e) {
    $("#PTable").html(e), $("#dataTable").DataTable();
  });
};
$("#propiedadesForm").submit(function (e) {
  e.preventDefault();
  const t = $(this).serialize();
  $.ajax({
    url: "php/propiedades/insert.php",
    type: "post",
    data: t,
    beforeSend: () => {
      $("#New_button").css("display", "none"),
        $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (e) {
      tablaPropiedades(),
        AlertaExito(),
        $("#New_button").css("display", "block"),
        $("#loader").removeClass("visible").addClass("invisible"),
        $("#propiedadesForm")[0].reset();
    })
    .fail(function (e, t, o) {
      AlertaFallido();
    });
}),
  $("#proOwner").focus(() => {
    $.ajax({ url: "php/proyecto/ObtenerClientes.php" }).done((e) => {
      $("#proOwner").html(e);
    });
  });
const deletePropiedades = (e) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this! ID ctz: " + e,
    icon: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((t) => {
    if (t.value) {
      const t = new Promise((t, o) => {
        $.ajax({ url: "php/propiedades/eliminar.php?id=" + e }).done(() => {
          t();
        });
      });
      Promise.all([t]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
          () => {
            location.reload();
          }
        )
      );
    }
  });
};
$("#PTable").on("click", "tbody td", function () {
  const e = $(this).data();
  return "delete" === e.tabla
    ? deletePropiedades(e.code)
    : "NotEditable" === e.tabla
    ? NotEditable()
    : void Swal.fire({
        title: "Edit cell",
        text:
          "You will edit a cell this will be reflected in the reporting information ",
        input: "text",
        inputValue: $(this).text(),
        icon: "info",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, edit it!",
      }).then((t) => {
        t.value &&
          $.ajax({
            url: "php/edit.php",
            data: {
              tabla: e.tabla,
              columna: e.columna,
              campo: t.value,
              code: e.code,
            },
            type: "POST",
          }).done((e) => {
            AlertaExito(), tablaPropiedades();
          });
      });
});
const tablaProvedores = () => {
  $.ajax({ url: "php/providers/tabla.php" }).done(function (e) {
    $("#clientProviders").html(e), $("#dataTable").DataTable();
  });
};
$("#providersForm").submit(function (e) {
  e.preventDefault();
  const t = $(this).serialize();
  $.ajax({
    url: "php/providers/insert.php",
    type: "post",
    data: t,
    beforeSend: () => {
      $("#New_button").css("display", "none"),
        $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (e) {
      tablaProvedores(),
        AlertaExito(),
        $("#New_button").css("display", "block"),
        $("#loader").removeClass("visible").addClass("invisible"),
        $("#providersForm")[0].reset();
    })
    .fail(function (e, t, o) {
      AlertaFallido();
    });
});
const deleteProviders = (e) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this! ID ctz: " + e,
    icon: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((t) => {
    if (t.value) {
      const t = new Promise((t, o) => {
        $.ajax({ url: "php/providers/eliminar.php?id=" + e }).done(() => {
          t();
        });
      });
      Promise.all([t]).then(
        Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
          () => {
            location.reload();
          }
        )
      );
    }
  });
};
$("#clientProviders").on("click", "tbody td", function () {
  const e = $(this).data();
  if ("delete" === e.tabla)
    return (
      (t = e.code),
      void Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! ID ctz: " + t,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((e) => {
        if (e.value) {
          const e = new Promise((e, o) => {
            $.ajax({ url: "php/providers/eliminar.php?id=" + t }).done(() => {
              e();
            });
          });
          Promise.all([e]).then(
            Swal.fire(
              "Deleted!",
              "Your file has been deleted.",
              "success"
            ).then(() => {
              location.reload();
            })
          );
        }
      })
    );
  var t;
  Swal.fire({
    title: "Edit cell",
    text:
      "You will edit a cell this will be reflected in the reporting information ",
    input: "text",
    inputValue: $(this).text(),
    icon: "info",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((t) => {
    t.value &&
      $.ajax({
        url: "php/edit.php",
        data: {
          tabla: e.tabla,
          columna: e.columna,
          campo: t.value,
          code: e.code,
        },
        type: "POST",
      }).done((e) => {
        AlertaExito(), tablaProvedores();
      });
  });
});
const tablaEmpleados = () => {
  $.ajax({ url: "php/empleados/tabla.php" }).done(function (e) {
    $("#tableEmpleado").html(e), $("#dataTable").DataTable();
  });
};
$("#empleadosForm").submit(function (e) {
  e.preventDefault();
  const t = $(this).serialize(),
    o = $("#pin").val();
  $.ajax({
    url: "php/empleados/insert.php?pin=" + o,
    type: "post",
    data: t,
    beforeSend: () => {
      $("#New_button").css("display", "none"),
        $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (e) {
      "pinUsed" == e
        ? Swal.mixin({
            toast: !0,
            position: "top-end",
            showConfirmButton: !1,
            timer: 3e3,
            timerProgressBar: !0,
            onOpen: (e) => {
              e.addEventListener("mouseenter", Swal.stopTimer),
                e.addEventListener("mouseleave", Swal.resumeTimer);
            },
          }).fire({ icon: "error", title: "Pin de usuario existente" })
        : (tablaEmpleados(), AlertaExito()),
        $("#New_button").css("display", "block"),
        $("#loader").removeClass("visible").addClass("invisible"),
        $("#empleadosForm")[0].reset();
    })
    .fail(function (e, t, o) {
      AlertaFallido();
    });
});
const deleteEmpleado = (e) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this! ID ctz: " + e,
      icon: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((t) => {
      if (t.value) {
        const t = new Promise((t, o) => {
          $.ajax({ url: "php/empleados/eliminar.php?id=" + e }).done(() => {
            t();
          });
        });
        Promise.all([t]).then(
          Swal.fire("Deleted!", "Your file has been deleted.", "success").then(
            () => {
              tablaEmpleados();
            }
          )
        );
      }
    });
  },
  restartPassword = (e) => {
    Swal.fire({
      title: "Are you sure?",
      text:
        "You are about to reset this user's password, it will be the same as their assigned pin",
      icon: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes!",
    }).then((t) => {
      if (t.value) {
        const t = new Promise((t, o) => {
          $.ajax({ url: "empleados/php/password.php?id=" + e }).done((e) => {
            t();
          });
        });
        Promise.all([t]).then(
          Swal.fire(
            "Updated!",
            "the user can change the password in their profile",
            "success"
          ).then(() => {
            tablaEmpleados();
          })
        );
      }
    });
  };
$("#tableEmpleado").on("click", "tbody td", function () {
  const e = $(this).data();
  return "delete" === e.tabla
    ? ((t = e.code),
      void Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! ID ctz: " + t,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((e) => {
        if (e.value) {
          const e = new Promise((e, o) => {
            $.ajax({ url: "php/empleados/eliminar.php?id=" + t }).done(() => {
              e();
            });
          });
          Promise.all([e]).then(
            Swal.fire(
              "Deleted!",
              "Your file has been deleted.",
              "success"
            ).then(() => {
              tablaEmpleados();
            })
          );
        }
      }))
    : "restart" === e.tabla
    ? restartPassword(e.code)
    : "NotEditable" === e.tabla
    ? NotEditable()
    : void Swal.fire({
        title: "Edit cell",
        text:
          "You will edit a cell this will be reflected in the reporting information ",
        input: "text",
        inputValue: $(this).text(),
        icon: "info",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, edit it!",
      }).then((t) => {
        t.value &&
          $.ajax({
            url: "php/edit.php",
            data: {
              tabla: e.tabla,
              columna: e.columna,
              campo: t.value,
              code: e.code,
            },
            type: "POST",
          }).done((e) => {
            AlertaExito(), tablaEmpleados();
          });
      });
  var t;
});
const tablaProyecto = () => {
  $.ajax({ url: "php/proyecto/tabla.php" }).done(function (e) {
    $("#projectTable").html(e),
      $("#dataTable").DataTable({
        dom: "Bfrtip",
        buttons: ["excel", "pdf", "print"],
      });
  });
};
$("#ProyectosForm").submit(function (e) {
  e.preventDefault();
  const t = $(this).serialize();
  $.ajax({
    url: "php/proyecto/insert.php",
    type: "post",
    data: t,
    beforeSend: () => {
      $("#New_button").css("display", "none"),
        $("#loader").removeClass("invisible").addClass("visible");
    },
  })
    .done(function (e) {
      tablaProyecto(),
        AlertaExito(),
        $("#New_button").css("display", "block"),
        $("#loader").removeClass("visible").addClass("invisible"),
        $("#ProyectosForm")[0].reset(),
        1 == $("#defaultCheck1").prop("checked") &&
          window.navigate("cotizaciones.php"),
        brProyectoToLocalS();
    })
    .fail(function (e, t, o) {
      AlertaFallido();
    });
});
let banderaDown = !1;
$("#client")
  .focus(() => {
    banderaDown ||
      $.ajax({ url: "php/proyecto/ObtenerClientes.php" }).done((e) => {
        (banderaDown = !0), $("#client").html(e);
      });
  })
  .change(() => {
    const e = $("#client").children("option:selected").val();
    $.ajax({
      url: "php/proyecto/ObtenerPropiedades.php",
      data: { cliente: e },
    }).done((e) => {
      $("#ProyectoSelectPropiedades").html(e);
    }),
      $("#ProyectoSelectPropiedades").prop("disabled", !1);
  });
const deleteProyecto = (e) => {
    Swal.fire({
      title: "Close Project?",
      text: "You won't be able to revert this! ID ctz: " + e,
      icon: "warning",
      showCancelButton: !0,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Close it!",
    }).then((t) => {
      if (t.value) {
        const t = new Promise((t, o) => {
          $.ajax({ url: "php/proyecto/eliminar.php?id=" + e }).done(() => {
            brProyectoToLocalS(), t();
          });
        });
        Promise.all([t]).then(
          Swal.fire("Closed!", "Your file has been Closed.", "success").then(
            () => {
              tablaProyecto();
            }
          )
        );
      }
    });
  },
  obtClientesToEditPro = (e) => {
    $.ajax({ url: "php/proyecto/getClientesEdit.php" }).done((t) => {
      (toSend = JSON.parse(t)),
        Swal.fire({
          title: "Select client to edit",
          input: "select",
          inputOptions: toSend,
          inputPlaceholder: "Select a client",
          showCancelButton: !0,
        }).then((t) => {
          t.value &&
            $.ajax({
              url: "php/edit.php",
              data: {
                tabla: e.tabla,
                columna: e.columna,
                campo: t.value,
                code: e.code,
              },
              type: "POST",
            }).done((e) => {
              AlertaExito(), tablaProyecto();
            });
        });
    });
  },
  obtPropiedadToEditPro = (e) => {
    const t = e.cliente;
    $.ajax({ url: "php/proyecto/getPropiedadEdit.php?cliente=" + t }).done(
      (t) => {
        (toSend = JSON.parse(t)),
          Swal.fire({
            title: "Select client to edit",
            input: "select",
            inputOptions: toSend,
            inputPlaceholder: "Select a client",
            showCancelButton: !0,
          }).then((t) => {
            t.value &&
              $.ajax({
                url: "php/edit.php",
                data: {
                  tabla: e.tabla,
                  columna: e.columna,
                  campo: t.value,
                  code: e.code,
                },
                type: "POST",
              }).done((e) => {
                AlertaExito(), tablaProyecto();
              });
          });
      }
    );
  };
$("#projectTable").on("click", "tbody td", function () {
  const e = $(this).data();
  return "delete" === e.tabla
    ? ((t = e.code),
      void Swal.fire({
        title: "Close Project?",
        text: "You won't be able to revert this! ID ctz: " + t,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Close it!",
      }).then((e) => {
        if (e.value) {
          const e = new Promise((e, o) => {
            $.ajax({ url: "php/proyecto/eliminar.php?id=" + t }).done(() => {
              brProyectoToLocalS(), e();
            });
          });
          Promise.all([e]).then(
            Swal.fire("Closed!", "Your file has been Closed.", "success").then(
              () => {
                tablaProyecto();
              }
            )
          );
        }
      }))
    : "NotEditable" === e.tabla
    ? NotEditable()
    : "cliente" === e.select
    ? obtClientesToEditPro(e)
    : "propiedad" === e.select
    ? obtPropiedadToEditPro(e)
    : void Swal.fire({
        title: "Edit cell",
        text:
          "You will edit a cell this will be reflected in the reporting information ",
        input: "textarea",
        inputValue: $(this).text(),
        icon: "info",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, edit it!",
      }).then((t) => {
        t.value &&
          $.ajax({
            url: "php/edit.php",
            data: {
              tabla: e.tabla,
              columna: e.columna,
              campo: t.value,
              code: e.code,
            },
            type: "POST",
          }).done((e) => {
            AlertaExito(), tablaProyecto();
          });
      });
  var t;
});
