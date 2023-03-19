// Traumferienwohnung calendar widget
function createWidget13767() {
  var calendarNode = document.getElementById('traumfewo-calendar-13767');
  var calendarWidget = new window.tfw.CalendarWidget(calendarNode);
  calendarWidget.throttle("resize", "optimizedResize");
  window.addEventListener('resize', function(){ calendarWidget.update(); }, false);
  calendarWidget.init();
}

window.addEventListener("load", function(event){ createWidget13767(); }, false);
if(window.tfw && window.tfw.CalendarWidget){ createWidget13767() }
