let startDateInput = document.getElementById("startDate");
let endDateInput = document.getElementById("endDate");
let startDate = "";
let endDate = "";
let btnFilterIncome = document.getElementById("btnFilterIncome");

let replacerIncome = document.getElementById("replacerIncome");

startDateInput.addEventListener("change", () => {
  // console.log('changing.', startDateInput, startDateInput.value)
  startDate = startDateInput.value;
});

endDateInput.addEventListener("change", () => {
  endDate = endDateInput.value;
});

btnFilterIncome.addEventListener("click", (e) => {
  e.preventDefault();
  console.log("get income..");
  getFilteredData(startDate, endDate);
});

function getFilteredData(startDate, endDate) {
  if (startDate != "" && endDate != "") {
    console.log(startDate, endDate);
    var url = "filter-income.php";
    var data = `startDate=${startDate}&endDate=${endDate}`;
    var request = new XMLHttpRequest();
    request.open("POST", url);
    request.addEventListener("readystatechange", handleResponse);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(data);
  }
}

function handleResponse() {
  // "this" refers to the object we called addEventListener on
  var request = this;
  if (request.readyState != 4) return;

  // If there wasn't an error, run our showResponse function
  if (request.status == 200) {
    var ajaxResponse = request.responseText;
    console.log(JSON.parse(request.response));

    let rows = JSON.parse(request.response);
    let abc = rows.map((row) => {
      let modifiedRow = row.map((item) => {
        return `<td>${item}</td>`;
      });

      return `<tr>${modifiedRow}</tr>`;
    });

    console.log(
      `Income Output: ${abc.toString().replace(/,/g, "")}`,
      typeof abc.toString()
    );
    let tableHeader = `<table id="replacerIncome"><tr><th>Date</th><th>Category</th><th>Description</th><th>Type</th><th>Amount</th></tr>`;
    let tableContent = `${abc.toString().replace(/,/g, "")}`;
    let tableEnd = `</table>`;

    let wholeContent = tableHeader.concat(tableContent).concat(tableEnd);

    replacerIncome.innerHTML = wholeContent.toString();
  }
}

let checkData = () => {
  if (replacerIncome.childElementCount == 0) {
    replacerIncome.innerHTML = `<tr><td class="no-data-found"><h1>No Income Data</h1></td></tr>`;
  }
};

checkData();