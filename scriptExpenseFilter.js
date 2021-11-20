let startDateInputExpense = document.getElementById("startDateExpense");
let endDateInputExpense = document.getElementById("endDateExpense");
let startDateExpense = "";
let endDateExpense = "";
let btnFilterExpense = document.getElementById("btnFilterExpense");

let replacerExpense = document.getElementById("replacerExpense");

startDateInputExpense.addEventListener("change", () => {
  startDateExpense = startDateInputExpense.value;
});

endDateInputExpense.addEventListener("change", () => {
  endDateExpense = endDateInputExpense.value;
});

btnFilterExpense.addEventListener("click", (e) => {
  e.preventDefault();
  // console.log(
  //   `get expenses after click... ${startDateExpense}, ${endDateExpense}`
  // );
  getFilteredDataExpense(startDateExpense, endDateExpense);
});

function getFilteredDataExpense(startDateExpense, endDateExpense) {
  if (startDateExpense != "" && endDateExpense != "") {
    // console.log(startDateExpense, endDateExpense);
    var url = "filter-expense.php";
    var data = `startDateExpense=${startDateExpense}&endDateExpense=${endDateExpense}`;
    var request2 = new XMLHttpRequest();
    request2.open("POST", url);
    request2.addEventListener("readystatechange", handleResponseExpense);
    request2.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request2.send(data);
  }
}

function handleResponseExpense() {
  // "this" refers to the object we called addEventListener on
  var request2 = this;
  if (request2.readyState != 4) return;

  // If there wasn't an error, run our showResponse function
  if (request2.status == 200) {
    var ajaxResponse = request2.responseText;
    // console.log(JSON.parse(request2.response));

    let rows = JSON.parse(request2.response);
    let abc = rows.map((row) => {
      let modifiedRow = row.map((item) => {
        return `<td>${item}</td>`;
      });

      return `<tr>${modifiedRow}</tr>`;
    });

    let tableHeader = `<table id="replacerExpense"><tr><th>Date</th><th>Category</th><th>Description</th><th>Type</th><th>Amount</th></tr>`;
    let tableContent = `${abc.toString().replace(/,/g, "")}`;
    // console.log(tableContent)

    let rowKeys = tableContent.match(/(<td>)(\d+)(<\/td>)/gm);
    // console.log(rowKeys);

    let keys = rowKeys.map((key) => {
      return key.match(/\d+/);
    });

    keys = keys.map((k) => k[0]);
    // console.log(keys);

    let create = async () => {
      tableContent = tableContent.replace(
        /(<td>)(\d+)(<\/td>)/gm,
        `<td><button class="deleteRecord deleteRecordExp"><span class="tooltip">Delete Row</span></button></td>`
      );
    };

    let deleteRecordButtonsExp;

    create().then(() => {
      deleteRecordButtonsExp =
        document.getElementsByClassName("deleteRecordExp");
      keys.forEach((key, index) => {
        Array.from(deleteRecordButtonsExp).forEach((button, btnIndex) => {
          if (index == btnIndex) {
            button.setAttribute("value", key);
          }
        });
      });

      Array.from(deleteRecordButtonsExp).forEach((button) => {
        button.addEventListener("click", () => {
          // console.log(`${button.value} button clicked`);
          // deleteIncomeRecord(button.value);
          let confirmationExp = document.querySelector(
            ".confirmationExpenseDialog"
          );
          confirmationExp.classList.remove("hidden");

          let btnNo = document.getElementById("btnNoExpense");
          let btnYes = document.getElementById("btnYesExpense");

          btnNo.addEventListener("click", () => {
            confirmationExp.classList.add("hidden");
          });

          btnYes.addEventListener("click", () => {
            deleteExpenseRecord(button.value);
            confirmationExp.classList.add("hidden");
          });
        });
      });
    });

    let tableEnd = `</table>`;

    let wholeContent = tableHeader.concat(tableContent).concat(tableEnd);

    replacerExpense.innerHTML = wholeContent.toString();
  }
}

let checkExpenseData = () => {
  if (replacerExpense.childElementCount == 0) {
    replacerExpense.innerHTML = `<tr><td class="no-data-found"><h1>No Expense Data</h1></td></tr>`;
  }
};

checkExpenseData();

function deleteExpenseRecord(recordId) {
  var url = "delete-income-record.php";
  var data = `recordId=${recordId}`;
  // console.log(`brrrrrrr..... ${recordId}`)
  var request = new XMLHttpRequest();
  request.open("POST", url);
  request.addEventListener("readystatechange", handleExpenseDeletionResponse);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(data);
}

function handleExpenseDeletionResponse() {
  // "this" refers to the object we called addEventListener on
  var request = this;
  if (request.readyState != 4) return;

  // If there wasn't an error, run our showResponse function
  if (request.status == 200) {
    var ajaxResponse = request.responseText;
    // console.log(ajaxResponse);
  }

  getFilteredDataExpense(startDateExpense, endDateExpense);
}
