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
    };
crearMascara = () => {
    $(".precioClase").mask("000,000,000,000,000.00", { reverse: !0 });
};
const costosExtraData =
    '               <div class="form-row">\n                <div class="form-group col-md-3">\n                  <label for="inputEmail4">Proovedor</label>\n                  <select name="provider" id="proovedores" required class="form-control form-control-sm proovedores">\n                    <option disabled selected>Seleccionar proovedor</option>\n                    <option disabled>Loading...</option>\n                  </select>\n                </div>\n                <div class="form-group col-md-3">\n                  <label>Bill number</label>\n                  <input type="text" required class="form-control form-control-sm" name="bill">\n                </div>\n                <div class="form-group col-md-3">\n                  <label>Fecha</label>\n                  <input type="text" required class="form-control form-control-sm" name="date" id="date">\n                </div>\n                <div class="form-group col-md-3">\n                  <label>Forma de pago</label>\n                  <select name="paym" class="form-control form-control-sm">\n                    <option selected disabled>Elegir metodo de pago</option>\n                    <option value="te">TE</option>\n                    <option value="cr">CR</option>\n                    <option value="ot">OT</option>\n                  </select>\n                </div>\n              </div>\n              <div class="form-group">\n                <div class="custom-control custom-checkbox custom-control-inline">\n                  <input type="checkbox" id="gst" name="gst" value="1" class="custom-control-input">\n                  <label class="custom-control-label" for="gst">GST 5%</label>\n                </div>\n                <div class="custom-control custom-checkbox custom-control-inline">\n                  <input type="checkbox" id="pst" name="pst" value="1" class="custom-control-input">\n                  <label class="custom-control-label" for="pst">PST 7%</label>\n                </div>\n              </div>\n            ',
    imprimirFila = (e, t) => {
        let o,
            a = `\n              <div class="form-row  turno${e}">\n                <div class="form-group col-md-6 ">\n                  <textarea class="form-control form-control-sm mytextarea" name="concepto[]"  required placeholder="Concepto..." rows="1"></textarea>\n                </div>\n                <div class="form-group col-md-1 ">\n                  <input type="text" class="form-control form-control-sm precioClase" required data-turno="${e}"  value="0" name="precio[]" id="precio${e}">\n                </div>\n                <div class="form-group col-md-1">\n                  <input type="number" step="1" value="1" class="form-control form-control-sm cantidadClase" data-turno="${e}"  name="cantidad[]" id="cantidad${e}">\n                </div>\n                <div class="form-group col-md-2">\n                  <input type="text" readonly  value="0" class="form-control form-control-sm " name="total[]" id="total${e}">\n                </div>\n                <div class="form-group col-md-1">\n                </div>\n              </div>\n                    `,
            l = `\n              <div class="form-row  turno${e}">\n                <div class="form-group col-md-6 ">\n                  <textarea class="form-control form-control-sm mytextarea" placeholder="Concepto..." required  name="concepto[]" rows="1"></textarea>\n                </div>\n                <div class="form-group col-md-1 ">\n                  <input type="text" class="form-control form-control-sm precioClase" required data-turno="${e}"  value="0" name="precio[]" id="precio${e}">\n                </div>\n                <div class="form-group col-md-1">\n                  <input type="number" step="1" value="1" class="form-control form-control-sm cantidadClase" data-turno="${e}"  name="cantidad[]" id="cantidad${e}">\n                </div>\n                <div class="form-group col-md-2">\n                  <input type="text" readonly  value="0" class="form-control form-control-sm " name="total[]" id="total${e}">\n                </div>\n                <div class="form-group col-md-1">\n                  <button  data-turno="${e}" class="btn btn-warning BtnRowErase"><i class="fas fa-trash"></i></button>\n                </div>\n              </div>\n                    `;
        return (
            (o = t ? "#rows" : "#rowsC"), 1 === e ? $(o).append(a) : $(o).append(l)
        );
    };
let banderaDownProo = !1,
    contador = 1;
imprimirFila(contador, !0);

const getTable = (e) => {
    $.ajax({
        url: "php/materiales/ObtenerTabla.php",
        data: { cliente: e },
    }).done((e) => {
        $(".materialesDiv").css("display", "flex"),
            $("#btnAddMaterial").removeClass("invisible").addClass("visible"),
            $("#tablaMateriales").html(e),
            $("#dataTable").DataTable();
    });
};

$("#ProjectSelectorCostos").change(() => {
    const e = $("#ProjectSelectorCostos").children("option:selected").val();
    getTable(e);
});

$("#addRowBtn").click(() => {
    (contador += 1), imprimirFila(contador, !0), crearMascara();
});


const fillSelectProyectos = () => {
    let e = localStorage.getItem("proyectos");
    e = JSON.parse(e);
    for (const t in e)
        $("#ProjectSelectorCostos").append(`<option value="${t}">${e[t]}</option>`);
};



$("#rows")
    .on("keyup", ".precioClase", function () {
        const e = $(this).data("turno"),
            t = $("#total" + e),
            o = $("#cantidad" + e).val(),
            a = $(this).val().replace(",", ""),
            l = Number(o) * Number(a);
        t.val(l.toFixed(2));
    })
    .on("focusout", ".precioClase", function () {
        "" === $(this).val() && $(this).val("0");
    })
    .on("focusin", ".precioClase", function () {
        "0" === $(this).val() && $(this).val("");
    })
    .on("change", ".cantidadClase", function () {
        const e = $(this).data("turno"),
            t = $("#total" + e),
            o = $("#precio" + e)
                .val()
                .replace(",", ""),
            a = Number(o) * Number($(this).val());
        t.val(a.toFixed(2));
    })
    .on("click", ".BtnRowErase", function () {
        let e = $(this).data("turno");
        (contador -= 1), $(".turno" + e).remove();
    })
    .on("mouseenter ", ".proovedores", function () {
        banderaDownProo ||
            $.ajax({ url: "php/materiales/ObtenerProovedores.php" }).done((e) => {
                (banderaDownProo = !0), $(".proovedores").html(e);
            });
    })
    .submit(function (e) {
        e.preventDefault(),
            loader(),
            $(".precioClase").each(function () {
                var e = $(this).val().replace(",", " ");
                $(this).val(e.trim());
            });
        a = $(this).serialize();
        const t = $("#ProjectSelectorCostos").children("option:selected").val();
        $.ajax({
            url: `php/materiales/insert.php?contador=${contador}&proyectoId=${t}`,
            type: "post",
            data: a,
        }).done(function (e) {
            if ("billAlreadyExist" === e) return alertabillrepeat();

            $('.mytextarea').val('');
            $('.precioClase').val('');    
            $("input[type=text]").val('');         
            $('#proovedores').prop('selectedIndex', 0)
            $('#paym').prop('selectedIndex', 0)

            
            
            const o = $("#ProjectSelectorCostos").children("option:selected").val();
            getTable(o)
            swal.close();
            AlertaExito();
        });
    });


const deleteThisCosto = (e, t) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! ID ctz: " + e,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((o) => {
        if (o.value) {
            $.ajax({ url: "php/materiales/eliminarCostos.php?id=" + e }).done(
                () => {
                    const o = $("#ProjectSelectorCostos").children("option:selected").val();
                    getTable(o)
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            );
        }
    });
};




$("#tablaMateriales").on("click", "tbody td", function () {
    const e = $(this).data();
    return "delete" === e.tabla
        ? deleteThisCosto(e.code)
        : "NotEditable" === e.tabla
            ? NotEditable() : null;
});
const alertabillrepeat = () => {
    Swal.fire(
        "Bill number problem",
        "This bill number already exist with this provider",
        "error"
    );
};
