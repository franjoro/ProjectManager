$("#entrada").timepicker({
  timeFormat: "h:mm p",
  interval: 30,
  minTime: "6:00am",
  maxTime: "6:00pm",
  startTime: "6:00am",
  dynamic: false,
  dropdown: true,
  defaultTime: "now",
  scrollbar: true,
});

$("#salida").timepicker({
  timeFormat: "h:mm p",
  interval: 30,
  minTime: "6:00am",
  maxTime: "6:00pm",
  startTime: "6:00am",
  dynamic: false,
  dropdown: true,
  defaultTime:"now",
  scrollbar: true,
});

const getTodayDate = ()=>{
  let date = new Date();
  let m = ("0" + (date.getMonth() + 1)).slice(-2);
  let d = date.getDay();
  let y = date.getFullYear();
return `${d}/${m}/${y}`; 
}

