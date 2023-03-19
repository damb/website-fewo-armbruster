const kTotalPersons = 6;
var adultsSelect = document.getElementById("number_of_adults");
var childrenSelect = document.getElementById("number_of_children");

function showChildrenOptions() {
  let numAdults = parseInt(adultsSelect.value);

  for (let i = 0; i < childrenSelect.length; i++) {
    let val = parseInt(childrenSelect.options[i].value);
    if (numAdults + val > kTotalPersons) {
      childrenSelect.options[i].disabled = true;
    } else {
      childrenSelect.options[i].disabled = false;
    }
  }
}

function showAdultOptions() {
  let numChildren = parseInt(childrenSelect.value);

  for (let i = 0; i < adultsSelect.length; i++) {
    let val = parseInt(adultsSelect.options[i].value);
    if (numChildren + val > kTotalPersons) {
      adultsSelect.options[i].disabled = true;
    } else {
      adultsSelect.options[i].disabled = false;
    }
  }
}

var arrivalDate = document.getElementById("arrival_date");
var departureDate = document.getElementById("departure_date");

let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
arrivalDate.min = tomorrow.toISOString().split("T")[0];

let earliestDepartureDate = new Date();
earliestDepartureDate.setDate(earliestDepartureDate.getDate() + 5);
departureDate.min = earliestDepartureDate.toISOString().split("T")[0];

function setMinDepartureDate() {
  let earliestDepartureDate = new Date(arrivalDate.valueAsDate);
  earliestDepartureDate.setDate(earliestDepartureDate.getDate() + 4);

  departureDate.min = earliestDepartureDate.toISOString().split("T")[0];
  if (departureDate.value && earliestDepartureDate > departureDate.valueAsDate) {
    departureDate.valueAsDate = earliestDepartureDate;
  }
}

