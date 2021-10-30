<?php
// echo $_COOKIE['userLogin'];
if (!isset($_COOKIE['userLogin'])) {
    header("Location: login.php");
}

$monthStart = date('Y-m-01');
// print_r($monthStart);
// Getting the user ID from the cookie to identify the user.
// This helps in getting the specific user records from database.
$userId = $_COOKIE['userLogin'];

include 'config.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="dashboard-grid.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>

    <!-- <link rel="stylesheet" href="styles-login.css"> -->
    <title>ePocket</title>
    <style>
        body {
            background-image: none;
            background-color: #efffda;
        }

        #section1 {
            height: 80px !important;
        }
    </style>
</head>

<body>
    <?php include 'hf/nav.php' ?>
    <section id="section1">
    </section>

    <section>
        <p class="warning">Your device resolution is not supported. <br><b>Please try from another device instead or use landscape mode</b>.
            <br><br>Your device should be atleast 300px wide to view this content.
        </p>
        <div class="tabs">
            <!-- Tab 1 -->
            <div class="tab">
                <input type="radio" id="tab1" name="tabs" value="Dashboard" checked>
                <label for="tab1">
                    Dashboard
                </label>
                <div class="content content1">
                    <!-- <div class="chart">Chart here</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto voluptatibus eos quas tempore animi beatae? Tempore placeat cum, recusandae iure minima a asperiores. Assumenda nemo omnis atque fugiat perferendis corrupti at iste,
                        nam obcaecati eius ea harum quis repudiandae et esse officia sint deserunt praesentium non numquam voluptatibus itaque architecto velit. Facilis doloribus mollitia eum quasi dicta corrupti nostrum culpa dolores inventore quod?
                        Aliquam itaque quod autem quidem cumque? Suscipit, incidunt, exercitationem adipisci, quasi soluta eveniet obcaecati nostrum fugit voluptates consequuntur facilis inventore quas quidem autem amet! Deleniti, pariatur modi architecto
                        quo saepe magni deserunt! Maxime officiis veritatis cupiditate vel.</p> -->
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
                                include 'config.php';

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

                                <!-- <tr>
                                    <td>22.06.2021</td>
                                    <td>Food</td>
                                    <td>Pizza</td>
                                    <td>Expense</td>
                                    <td>990.00</td>
                                </tr>
                                <tr>
                                    <td>22.06.2021</td>
                                    <td>Food</td>
                                    <td>Pizza</td>
                                    <td>Expense</td>
                                    <td>990.00</td>
                                </tr>
                                <tr>
                                    <td>22.06.2021</td>
                                    <td>Utility</td>
                                    <td>Electricity</td>
                                    <td>Expense</td>
                                    <td>1290.00</td>
                                </tr>
                                <tr>
                                    <td>26.06.2021</td>
                                    <td>Utility</td>
                                    <td>Water</td>
                                    <td>Expense</td>
                                    <td>1490.00</td>
                                </tr> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2 -->
            <div class="tab">
                <input type="radio" id="tab2" name="tabs" value="Dashboard">
                <label for="tab2">
                    Income
                </label>
                <div class="content content2">
                    <h1>This is 2nd content</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto voluptatibus eos quas tempore animi beatae? Tempore placeat cum, recusandae iure minima a asperiores. Assumenda nemo omnis atque fugiat perferendis corrupti at iste,
                        nam obcaecati eius ea harum quis repudiandae et esse officia sint deserunt praesentium non numquam voluptatibus itaque architecto velit. Facilis doloribus mollitia eum quasi dicta corrupti nostrum culpa dolores inventore quod?
                        Aliquam itaque quod autem quidem cumque? Suscipit, incidunt, exercitationem adipisci, quasi soluta eveniet obcaecati nostrum fugit voluptates consequuntur facilis inventore quas quidem autem amet! Deleniti, pariatur modi architecto
                        quo saepe magni deserunt! Maxime officiis veritatis cupiditate vel.</p>
                </div>
            </div>

            <!-- Tab 3 -->
            <div class="tab">
                <input type="radio" id="tab3" name="tabs" value="Dashboard">
                <label for="tab3">
                    Expenses
                </label>
                <div class="content content3">
                    <h1>This is 3rd content</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto voluptatibus eos quas tempore animi beatae? Tempore placeat cum, recusandae iure minima a asperiores. Assumenda nemo omnis atque fugiat perferendis corrupti at iste,
                        nam obcaecati eius ea harum quis repudiandae et esse officia sint deserunt praesentium non numquam voluptatibus itaque architecto velit. Facilis doloribus mollitia eum quasi dicta corrupti nostrum culpa dolores inventore quod?
                        Aliquam itaque quod autem quidem cumque? Suscipit, incidunt, exercitationem adipisci, quasi soluta eveniet obcaecati nostrum fugit voluptates consequuntur facilis inventore quas quidem autem amet! Deleniti, pariatur modi architecto
                        quo saepe magni deserunt! Maxime officiis veritatis cupiditate vel.</p>
                </div>
            </div>
        </div>
    </section>


</body>
<script src="script.js"></script>
<script src="chartScript.js"></script>

</html>