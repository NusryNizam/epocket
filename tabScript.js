let tabs = document.querySelectorAll(".tabs");

let dashboardTab = document.getElementById("dbTab");
let incomeTab = document.getElementById("inTab");
let expenseTab = document.getElementById("exTab");

let dashboardSection = document.getElementById("db");
let incomeSection = document.getElementById("in");
let expenseSection = document.getElementById("ex");

let inactiveTab = "#d8d8d8";
console.log(window.location.search);
let path = window.location.search;
if(path.includes("?income")){
  clickedButton = "Income";
} else if (path.includes("?expense")){
  clickedButton = "Expense";
} else {
  clickedButton = "Dashboard"
}
toggleTabs();
// console.log(tabs);
tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // console.log(tab.innerText, " button clicked");
    clickedButton = tab.innerText;
    toggleTabs();
  });
});

function toggleTabs() {
  if (clickedButton == "Dashboard") {
    dashboardSection.style.display = "block";
    incomeSection.style.display = "none";
    expenseSection.style.display = "none";

    dashboardTab.style.backgroundColor = "white";
    incomeTab.style.backgroundColor = inactiveTab;
    expenseTab.style.backgroundColor = inactiveTab;
  } else if (clickedButton == "Income") {
    dashboardSection.style.display = "none";
    incomeSection.style.display = "block";
    expenseSection.style.display = "none";

    dashboardTab.style.backgroundColor = inactiveTab;
    incomeTab.style.backgroundColor = "white";
    expenseTab.style.backgroundColor = inactiveTab;
  } else {
    dashboardSection.style.display = "none";
    incomeSection.style.display = "none";
    expenseSection.style.display = "block";

    dashboardTab.style.backgroundColor = inactiveTab;
    incomeTab.style.backgroundColor = inactiveTab;
    expenseTab.style.backgroundColor = "white";
  }
}


let successMsg = document.querySelector('.success');
if(successMsg){
successMsg.addEventListener('click', () => {
  // window.location.href = 'dashboard.php?income';
  successMsg.style.display = "none";
})
}