<?php
if (!isset($_COOKIE['userLogin'])) {
    header("Location: login.php");
}

$monthStart = date('Y-m-01');
$userId = $_COOKIE['userLogin'];

$defaultStartDate = date('Y-m-01');
$defaultEndDate = date('Y-m-j', strtotime("last day of this month"));

include 'config.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="dashboardStyles.css">
    <link rel="stylesheet" href="incomeStyles.css">
    <link rel="stylesheet" href="formStyles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
    <title>Dashboard | ePocket</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include 'hf/nav.php' ?>
    <div id="tabbar">
        <div id="dbTab" class="tabs">Dashboard</div>
        <div id="inTab" class="tabs">Income</div>
        <div id="exTab" class="tabs">Expense</div>
    </div>


    <!-- DASHBOARD SECTION -->


    <section id="db" class="sections section1" style="background-color: white">
        <div class="grid-container">
            <div class="income-chart" id="chartParent">
                <canvas id="myChart"></canvas>
            </div>
            <div class="total-view">
                <div class="total-view-card">
                    <p class="total-income">Total Income</p>
                    <div class="total-income-amount" id="incAmount">
                        <!-- INSERT: income -->
                    </div>
                    <p class="current-month">
                        <?php echo date('F, Y'); ?>
                    </p>
                </div>
                <div class="total-view-card">
                    <p class="total-income">Total Expense</p>
                    <div class="total-income-amount" id="expAmount">
                        <!-- INSERT: expense -->
                    </div>
                    <p class="current-month">
                        <?php echo date('F, Y'); ?>
                    </p>
                </div>
            </div>
            <div class="recent-entries">
                <p class="recent-entries-title">Recent Entries</p>

                <table id="recentTable">
                    <!-- <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr> -->
                    <!-- INSERT: tableData -->
                </table>
            </div>
        </div>
    </section>


    <!-- INCOME SECTION -->


    <section id="in" class="sections section2" style="background-color: white">
        <div class="income-container">
            <div id="income-form-container">

                <?php
                if ($_SERVER['REQUEST_URI'] == "/dashboard.php?income?success=true") {
                    echo '<p class="success">Record added successfully</p>';
                }
                ?>

                <form id="income-form" action="income-backend.php" name="income-form" method="post">
                    <label for="date">Date<br>
                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </label>
                    <br>
                    <label for="category">Category<br>
                        <!-- <input type="" name="category" required> -->
                        <select name="category" id="categoryDropdown">
                            <?php
                            $sql3 = "SELECT catId, categories from category";
                            $result3 = $conn->query($sql3);

                            if ($result3->num_rows > 0) {
                                while ($row = $result3->fetch_assoc()) {
                                    $value = $row['categories'];
                                    $valueId = $row['catId'];
                                    echo '<option value="' . $valueId . '">' . $value . '</option>';
                                }
                            }

                            ?>
                        </select>
                    </label>
                    <br>
                    <label for="description">Description<br>
                        <input type="text" name="description" required>
                    </label>
                    <br>
                    <label for="amount">Amount<br>
                        <input type="number" name="amount" min="1" required>
                    </label>
                    <br>
                    <br>
                    <input type="submit" class="btn-light" name="addIncome" value="Add Income">
                </form>
            </div>
            <div class="income-recent-entries">
                <div class="title-row">
                    <p class="income-recent-entries-title">Income</p><button><img src="assets/filter_list_black_24dp.svg"></button>
                </div>
                <div class="filter-by-date hide" id="income-filter-row">
                    <form action="" method="post">
                        <label for="startDate">From:
                            <input type="date" name="startDate" id="startDate" value="<?php echo $defaultStartDate ?>" required></label>
                        <label for="endDate">To:
                            <input type="date" name="endDate" id="endDate" value="<?php echo $defaultEndDate ?>" required></label>
                        <input type="submit" class="btn-secondary" id="btnFilterIncome" value="Filter">
                    </form>
                </div>
                <table id="replacerIncome">
                </table>
                <div class="confirmationIncomeDialog confirmation hidden">
                    <div>
                        <p>Are you sure you want to delete?</p>
                        <p><button id="btnYes" class="btn-secondary">Yes</button><button id="btnNo" class="btn-secondary">No</button></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- EXPENSE SECTION -->


    <section id="ex" class="sections section3" style="background-color: white">
        <div class="income-container">
            <div id="income-form-container">

                <?php
                if ($_SERVER['REQUEST_URI'] == "/dashboard.php?expense?success=true") {
                    echo '<p class="success">Record added successfully</p>';
                }
                ?>

                <form id="income-form" action="expense-backend.php" name="income-form" method="post">
                    <label for="date">Date<br>
                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </label>
                    <br>
                    <label for="category">Category<br>
                        <!-- <input type="" name="category" required> -->
                        <select name="category" id="categoryDropdown">
                            <?php
                            $sql3 = "SELECT catId, categories from category";
                            $result3 = $conn->query($sql3);

                            if ($result3->num_rows > 0) {
                                while ($row = $result3->fetch_assoc()) {
                                    $value = $row['categories'];
                                    $valueId = $row['catId'];
                                    echo '<option value="' . $valueId . '">' . $value . '</option>';
                                }
                            }

                            ?>
                        </select>
                    </label>
                    <br>
                    <label for="description">Description<br>
                        <input type="text" name="description" required>
                    </label>
                    <br>
                    <label for="amount">Amount<br>
                        <input type="number" name="amount" min="1" required>
                    </label>
                    <br>
                    <br>
                    <input type="submit" class="btn-light" name="addExpense" value="Add Expense">
                </form>
            </div>
            <div class="income-recent-entries">
                <div class="title-row">
                    <p class="income-recent-entries-title">Expense</p><button><img src="assets/filter_list_black_24dp.svg"></button>
                </div>
                <div class="filter-by-date hide" id="expense-filter-row">
                    <form action="" method="post">
                        <label for="startDateExpense">From:
                            <input type="date" name="startDateExpense" id="startDateExpense" value="<?php echo $defaultStartDate ?>" required></label>
                        <label for="endDateExpense">To:
                            <input type="date" name="endDateExpense" id="endDateExpense" value="<?php echo $defaultEndDate ?>" required></label>
                        <input type="submit" class="btn-secondary" id="btnFilterExpense" value="Filter">
                    </form>
                </div>
                <table id="replacerExpense">
                </table>
                <div class="confirmationExpenseDialog confirmation hidden">
                    <div>
                        <p>Are you sure you want to delete?</p>
                        <p><button id="btnYesExpense" class="btn-secondary">Yes</button><button id="btnNoExpense" class="btn-secondary">No</button></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="scriptIncomeFilter.js"></script>
    <script src="scriptExpenseFilter.js"></script>
    <script>
        window.onload = () => {
            let currentDate = new Date();
            let cDay = currentDate.getDate();
            let cMonth = currentDate.getMonth() + 1;
            let cYear = currentDate.getFullYear();
            startDate = `${cYear}-${cMonth}-01`;

            let forLastDay = new Date(
                currentDate.getYear(),
                currentDate.getMonth() + 1,
                0
            );
            let lastDay = forLastDay.getDate();

            endDate = `${cYear}-${cMonth}-${lastDay}`;

            startDateExpense = `${cYear}-${cMonth}-01`;
            endDateExpense = `${cYear}-${cMonth}-${lastDay}`;
            getFilteredDataExpense(startDateExpense, endDateExpense);
            getFilteredData(startDate, endDate);
            getDashboardInfo();
        };

        let filterButton = document.querySelectorAll('.title-row button');
        let expenseFilterRow = document.getElementById('expense-filter-row');
        let incomeFilterRow = document.getElementById('income-filter-row');
        filterButton[0].addEventListener('click', () => {
            incomeFilterRow.classList.toggle('hide');
        })

        filterButton[1].addEventListener('click', () => {
            expenseFilterRow.classList.toggle('hide');
        })


        function getDashboardInfo() {
            console.log('running...')
            var url = "dashboardBackend.php";
            var request2 = new XMLHttpRequest();
            request2.open("POST", url);
            request2.addEventListener("readystatechange", handleInfoResponse);
            request2.setRequestHeader(
                "Content-type",
                "application/json"
            );
            request2.send();
        }

        function handleInfoResponse() {
            // "this" refers to the object we called addEventListener on
            var request2 = this;
            if (request2.readyState != 4) return;

            // If there wasn't an error, run our showResponse function
            if (request2.status == 200) {
                var ajaxResponse = request2.responseText;

                let received = JSON.parse(request2.response);
                // console.log(received.income);
                document.getElementById('incAmount').innerText = `Rs. ${received.income}`
                document.getElementById('expAmount').innerText = `Rs. ${received.expense}`
                document.getElementById('recentTable').innerHTML = `<tr><th>Date</th><th>Category</th><th>Description</th><th>Type</th><th>Amount</th></tr>${received.tableData.join("")}`;

                console.log(received.tableData.join(""))
            }
        }
    </script>
    <script src="tabScript.js"></script>
    <script src="script.js"></script>
    <script src="dashboardChartScript.js"></script>

</body>

</html>