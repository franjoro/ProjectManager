const start = moment().subtract(29, "days"),
  end = moment(),
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
  brProyectoToLocalS = async () => {
    let t = await $.ajax("empleados/php/getAllProyectos.php");
    localStorage.setItem("AllProyectos", t), swal.close();
  },
  fillSelectProyectos = () => {
    let t = localStorage.getItem("AllProyectos");
    t = JSON.parse(t);
    for (const e in t)
      $("#proj").append(`<option value="${e}">${t[e]}</option>`);
  };
$(function () {
  function t(t, e) {
    $("#reportrange span").html(
      t.format("MMMM D, YYYY") + " - " + e.format("MMMM D, YYYY")
    );
  }
  Swal.fire({
    title: "Please Wait!",
    html: "Loading data",
    allowOutsideClick: !1,
    onBeforeOpen: () => {
      Swal.showLoading();
    },
  }),
    $("#reportrange").daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [
            moment().subtract(1, "days"),
            moment().subtract(1, "days"),
          ],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [
            moment().subtract(1, "month").startOf("month"),
            moment().subtract(1, "month").endOf("month"),
          ],
        },
      },
      t
    ),
    t(start, end);
  const e = (t, e, a) =>
      $("#order_data").DataTable({
        dom: "Bfrtip",
        buttons: ["excel", "pdf", "print"],
        destroy: !0,
        ajax: {
          url: `php/reportes/AllHoursEmpl.php?filter=empleados&start_date=${t.format(
            "MM/DD/YYYY"
          )}&end_date=${e.format("MM/DD/YYYY")}&codePro=${a}`,
          dataSrc: "",
        },
        columnDefs: [
          { title: "Employee Name", targets: 0 },
          { title: "Hours Worked", targets: 1 },
          { title: "Lunch Time", targets: 2 },
          { title: "Salary", targets: 3 },
        ],
        columns: [
          { data: "Name_Empleado", name: "WorkZone" },
          { data: "TotalH", name: "Total" },
          { data: "lunch", name: "Total" },
          { name: "Salary", data: "Salary" },
        ],
        order: [[1, "asc"]],
      }),
    a = new Promise((t, a) => {
      e(start, end, "All");
    }),
    o = new Promise((t, e) => {
      brProyectoToLocalS();
    });
  Promise.all([a, o]).then(fillSelectProyectos());
  let r = start,
    s = end;
  $("#proj").change(() => {
    const t = $("#proj").children("option:selected").val();
    e(r, s, t);
  }),
    $("#reportrange").on("apply.daterangepicker", function (t, a) {
      (r = a.startDate),
        (s = a.endDate),
        $("#order_data").DataTable().destroy();
      const o = $("#proj").children("option:selected").val();
      e(a.startDate, a.endDate, o);
    }),
    $("#filter1").click(function () {
      l(1, 2), $("#selectores").removeClass("d-none");
    }),
    $("#filter2").click(function () {
      l(2, 1), $("#selectores").addClass("d-none");
    });
  let n = !1;
  const l = (t, e) => {
      $("#filter" + t)
        .removeClass("btn-info")
        .addClass("btn-success"),
        $("#filter" + e)
          .removeClass("btn-success")
          .addClass("btn-info"),
        $("#div_" + t).removeClass("d-none"),
        $("#div_" + e).addClass("d-none"),
        n || d();
    },
    d = () => {
      (n = !0),
        $("#order_data2").DataTable({
          dom: "Bfrtip",
          buttons: ["excel", "pdf", "print"],
          destroy: !0,
          ajax: {
            url: "php/reportes/AllHoursEmpl.php?filter=proyectos",
            dataSrc: "",
          },
          columnDefs: [
            { title: "Project Name", targets: 0 },
            { title: "Total Hours Worked", targets: 1 },
            { title: "Status", targets: 2 },
            {
              targets: -1,
              title: "Details",
              render: function (t, e, a, o) {
                return (
                  "display" === e &&
                    (t =
                      '<a href="php/reportes/consolidadoProyecto.php?projectCode=' +
                      encodeURIComponent(t) +
                      '&report=true"> Consolidated </a>'),
                  t
                );
              },
            },
          ],
          columns: [
            { data: "Name_Proyecto", name: "WorkZone" },
            { data: "TotalH", name: "Total" },
            { name: "Status", data: "Salary" },
            { name: "Code", data: "code" },
          ],
          order: [[1, "asc"]],
        });
    };
});
