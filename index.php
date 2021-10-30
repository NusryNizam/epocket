<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" href="styles-login.css"> -->
    <title>ePocket</title>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include 'hf/nav.php'?>
    
    <!-- Main content -->
    <section id="section1">
        <div id="section1-left">
            <h1 class="h1-light">Personal Finance Management</h1>
            <p class="p-light">Manage your personal finances, income, expenditure all in one place without any hassle.
                Pick your
                categories of expenses and income and just enter the values. We’ll take care of the rest.</h6>
                <br><br>
                <button class="btn-light get-started">Get Started</button>
        </div>
        <div id="section1-right">
            <img src="assets/undraw_Pie_chart_re_bgs8.svg" alt="Pie-Chart" style="width: 40vw">
        </div>
    </section>
    <section id="section2">
        <h1 class="h1-light" style="text-align: center;">Features</h1>
        <div class="card-container">
            <div class="card">
                <div><img src="assets/1.svg" alt="Investment" ></div>
                <div>Visualize your income and expenses</div>
            </div>
            <div class="card">
                <div><img src="assets/2.svg" alt="Investment" ></div>
                <div>Categorization of income and expenses</div>
            </div>
            <div class="card">
                <div><img src="assets/3.svg" alt="Investment" ></div>
                <div>Conveniently access all your data</div>
            </div>
            <div class="card">
                <div><img src="assets/4.svg" alt="Investment" ></div>
                <div>Securely store your data with ePocket</div>
            </div>
        </div>
        <br>
        <br>
        <div><button class="btn-light get-started">Get Started</button></div>
    </section>
    <br><br><br><br>
    
    <?php include 'hf/footer.php' ?>

</body>
<script src="script.js"></script>

</html>
