let amount;
let categories = new Array();
let eachCategoryAmount = new Array();
let myChart = document.getElementById("myChart").getContext("2d");
let massPopChart;

function getData() {
  categories = [];
  eachCategoryAmount = [];
  amount = JSON.parse(this.response);
  amount.forEach((e) => {
    categories.push(e[1]);
    eachCategoryAmount.push(e[2]);
  });
  drawChart();
}

function updateChart() {
  var oReq = new XMLHttpRequest();
  oReq.addEventListener("load", getData);
  oReq.open("GET", "getDashboardData.php");
  oReq.send();
}

updateChart();

let drawChart = () => {
  massPopChart = new Chart(myChart, {
    type: "pie",
    data: {
      labels: categories,
      datasets: [
        {
          label: "Expenses",
          data: eachCategoryAmount,
          backgroundColor: [
            "#ffcd56",
            "#ff6384",
            "#ff9f40",
            "#4bc0c0",
            "#34a23d",
            "#36a2eb",
            "#ff6643",
          ],
        },
      ],
    },
    options: {
      title: {
        display: true,
        text: "Expenses",
      },
      legend: {
        position: "right",
        labels: {
          fontColor: "red",
        },
      },
    },
  });
};
