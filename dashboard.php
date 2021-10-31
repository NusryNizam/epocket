<?php
if (!isset($_COOKIE['userLogin'])) {
    header("Location: login.php");
}

$monthStart = date('Y-m-01');
$userId = $_COOKIE['userLogin'];

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
            <div class="income-chart">
                <canvas id="myChart"></canvas>
            </div>
            <div class="total-view">
                <div class="total-view-card">
                    <p class="total-income">Total Income</p>
                    <div class="total-income-amount">
                        <?php
                        $sql = "SELECT SUM(recAmount) FROM record WHERE recType=1 AND userId=$userId AND recDate >= '$monthStart';";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $income = $row['SUM(recAmount)'] == null ? 0 : $row['SUM(recAmount)'];
                            echo "Rs. " . $income;
                        }
                        ?>
                    </div>
                    <p class="current-month">
                        <?php echo date('F, Y'); ?>
                    </p>
                </div>
                <div class="total-view-card">
                    <p class="total-income">Total Expense</p>
                    <div class="total-income-amount">
                        <?php
                        $sql = "SELECT SUM(recAmount) FROM record WHERE recType=2 AND userId=$userId AND recDate >= '$monthStart';";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // var_dump($row['SUM(recAmount']);
                            $expense = $row['SUM(recAmount)'] == null ? 0 : $row['SUM(recAmount)'];

                            echo "Rs. " . $expense;
                        }
                        ?>
                    </div>
                    <p class="current-month">
                        <?php echo date('F, Y'); ?>
                    </p>
                </div>
            </div>
            <div class="recent-entries">
                <p class="recent-entries-title">Recent Entries</p>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr>

                    <?php
                    $sql = "SELECT recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId ORDER BY recDate DESC;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < 5; $i++) {
                            $row = $result->fetch_assoc();
                            echo "<tr>" .
                                "<td>" . $row["recDate"] . "</td>" .
                                "<td>" . $row["categories"] . "</td>" .
                                "<td>" . $row["recDescription"] . "</td>" .
                                "<td>" . $row["type"] . "</td>" .
                                "<td>" . $row["recAmount"] . "</td>" .
                                "</tr>";
                        }
                    }
                    ?>
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
                <p class="income-recent-entries-title">Income</p>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr>

                    <?php
                    // include 'config.php';

                    $sql = "SELECT recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId AND recType=1 ORDER BY recDate DESC;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < 5; $i++) {
                            $row = $result->fetch_assoc();
                            echo "<tr>" .
                                "<td>" . $row["recDate"] . "</td>" .
                                "<td>" . $row["categories"] . "</td>" .
                                "<td>" . $row["recDescription"] . "</td>" .
                                "<td>" . $row["type"] . "</td>" .
                                "<td>" . $row["recAmount"] . "</td>" .
                                "</tr>";
                        }
                    }
                    ?>
                </table>
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
                <p class="income-recent-entries-title">Expense</p>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr>

                    <?php
                    // include 'config.php';

                    $sql = "SELECT recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId AND recType=2 ORDER BY recDate DESC;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        for ($i = 0; $i < 5; $i++) {
                            $row = $result->fetch_assoc();
                            echo "<tr>" .
                                "<td>" . $row["recDate"] . "</td>" .
                                "<td>" . $row["categories"] . "</td>" .
                                "<td>" . $row["recDescription"] . "</td>" .
                                "<td>" . $row["type"] . "</td>" .
                                "<td>" . $row["recAmount"] . "</td>" .
                                "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

    <script src="tabScript.js"></script>
    <script src="script.js"></script>
    <script src="dashboardChartScript.js"></script>

</body>

</html>