const start = moment().subtract(29, "days");
const end = moment();

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



//GuardarProyecto en Local
const brProyectoToLocalS = async () => {
    let data = await $.ajax("empleados/php/getAllProyectos.php");
    localStorage.setItem("AllProyectos", data);
    swal.close();
};
// llenar selector de proyectos
const fillSelectProyectos = () => {
    let data = localStorage.getItem("AllProyectos");
    data = JSON.parse(data);
    for (const prop in data) {
        $("#proj").append(
            `<option value="${prop}">${data[prop]}</option>`
        );
    }
};
$(function () {
    loader();
    function cb(start, end) {
        $("#reportrange span").html(
            start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
        );
    }
    $("#reportrange").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );
    //Cargo Selector de fechas
    cb(start, end);

    const dataTable = (start, end, project) =>
        $("#order_data").DataTable({
            dom: "Bfrtip",
            buttons: [
                'excel', 'pdf', 'print'
            ],
            destroy: true,
            ajax: {
                url: `php/reportes/AllHoursEmpl.php?filter=empleados&start_date=${start.format(
                    "MM/DD/YYYY"
                )}&end_date=${end.format("MM/DD/YYYY")}&codePro=${project}`,
                dataSrc: "",
            },
            columnDefs: [
                {
                    title: "Employee Name",
                    targets: 0,
                },
                {
                    title: "Hours Worked",
                    targets: 1,
                },
                {
                    title: "Salary",
                    targets: 2,
                },
            ],
            columns: [
                {
                    data: "Name_Empleado",
                    name: "WorkZone",
                },
                {
                    data: "TotalH",
                    name: "Total",
                },
                {
                    name: "Salary",
                    data: "Salary",
                },
            ],
            order: [[1, "asc"]],
        });
    //Cargo primera tabla y todos los proyectos
    const p1 = new Promise((res, rej) => {
        dataTable(start, end, 'All', () => {
            res();
        })
    })
    const p2 = new Promise((res, rej) => {
        brProyectoToLocalS(() => {
            res();
        })
    })

    // PROMESAS DE TABLA Y LOCALSTORAGE
    Promise.all([p1, p2]).then(fillSelectProyectos())
    let StarActual = start, EndActual = end;
    // selector de Proyectos
    $("#proj").change(() => {
        const selectedClient = $("#proj").children("option:selected").val();
        dataTable(StarActual, EndActual, selectedClient);
    });




    // selector de fechas
    $("#reportrange").on("apply.daterangepicker", function (ev, picker) {
        StarActual = picker.startDate;
        EndActual = picker.endDate;
        $("#order_data").DataTable().destroy();
        const PSelector = $("#proj")
            .children("option:selected")
            .val();
        dataTable(picker.startDate, picker.endDate, PSelector);
    });


    // Funcion de botones
    //Project
    $("#filter1").click(function () {
        btn_Change(1, 2);
        $("#selectores").removeClass("d-none");
    });
    //Empleados
    $("#filter2").click(function () {
        btn_Change(2, 1);
        $("#selectores").addClass("d-none");
    });
    //Cambios de botones
    let baCarga = false;
    const btn_Change = (open, close) => {
        $("#filter" + open).removeClass("btn-info").addClass("btn-success");
        $("#filter" + close).removeClass("btn-success").addClass("btn-info");
        $("#div_" + open).removeClass("d-none");
        $("#div_" + close).addClass("d-none");
        if (!baCarga) {
            tablaProjecto();
        };
    }

    // TablaProjecto 
    const tablaProjecto = () => {
        baCarga = true;
        $("#order_data2").DataTable({
            dom: "Bfrtip",
            buttons: [
                'excel', 'pdf', 'print',

            ],
            destroy: true,
            ajax: {
                url: `php/reportes/AllHoursEmpl.php?filter=proyectos`,
                dataSrc: "",
            },
            columnDefs: [

                {
                    title: "Project Name",
                    targets: 0,
                },
                {
                    title: "Total Hours Worked",
                    targets: 1,
                },
                {
                    title: "Status",
                    targets: 2,
                },
                {
                    targets: -1,
                    title: "Details",
                    render: function (data, type, row, meta) {
                        if (type === 'display') {
                            data = '<a href="php/reportes/consolidadoProyecto.php?projectCode=' + encodeURIComponent(data) + '&report=true"> Consolidated </a>';
                        }

                        return data;
                    }
                }
            ],
            columns: [
                {
                    data: "Name_Proyecto",
                    name: "WorkZone",
                },
                {
                    data: "TotalH",
                    name: "Total",
                },
                {
                    name: "Status",
                    data: "Salary",
                },
                {
                    name: "Code",
                    data: "code",
                },

            ],
            order: [[1, "asc"]],
        });
    }
});