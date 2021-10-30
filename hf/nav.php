<div id="smallScreenNav">
    <div id="logo" style="width:50%">
        <a href="index.php"><img src="assets/logo.png" alt="Logo" width="120px"></a>
    </div>
    <div id="menu"><img src="assets/menu.png" alt="open-menu"></div>
</div>

<nav id="nav" class="toggle">
    <div id="logo" style="width:50%">
        <a href="index.php"><img src="assets/logo.png" alt="Logo" width="120px"></a>
    </div>
    <div id="close"><img src="assets/close.png" alt="close-menu"></div>
    <!-- <div id="menu"><img src="assets/menu.png" alt="open-menu"></div> -->


    <!-- If cookie not set, display login and signup in navbar -->
    <?php
    if (!isset($_COOKIE['userLogin'])) {

    ?>
        <a href="index.php">
            <div>Home</div>
        </a>
        <a href="index.php#section2">
            <div>Features</div>
        </a>
        <a href="signup.php">
            <div>Create an account</div>
        </a>
        <a href="login.php" class="login-link">
            <div>Login</div>
        </a>

    <?php
    } else {
    ?>
        <!-- If cookie set, display dashboard and logout links. -->
        <a href="dashboard.php" class="dashboard-link">
            <div>Dashboard</div>
        </a>
        <a href="login.php?logout=true" class="logout-link">
            <div>Logout</div>
        </a>
    <?php
    }
    //   echo $_SERVER['REQUEST_URI'];  
    //   if($_SERVER['REQUEST_URI'] == '/dashboard.php') {
    //       echo "yes";
    //   }
    ?>
</nav>