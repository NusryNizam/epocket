let amount;
let categories = new Array();
let eachCategoryAmount = new Array();
function getData(){
    // console.log(this.response);
    amount = JSON.parse(this.response);
    console.log(amount);
    amount.forEach(e => {
        categories.push(e[1]);
        eachCategoryAmount.push(e[2]);
    })
    console.log(categories, eachCategoryAmount);
    drawChart();
}

 
var oReq = new XMLHttpRequest();
oReq.addEventListener("load", getData);
oReq.open("GET", "getDataForChart.php");
oReq.send();

let myChart = document.getElementById('myChart').getContext('2d');

let drawChart = () => {

    let massPopChart = new Chart(myChart, {

        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                label: 'Expenses',
                data: eachCategoryAmount,
                backgroundColor: [
                    'rgb(100, 201, 207',
                    'rgb(253, 228, 156)',
                    'rgb(255, 183, 64)',
                    'rgb(223, 113, 27)'
                ]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Expenses'
            },
            legend: {
                position: 'right',
                labels: {
                    fontColor: 'red'
                }
            }
        }
    });
}

