
<hr xmlns="http://www.w3.org/1999/html">

<nav class="navbar navbar-light " style="background-color: #e3f2fd;">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link"  href="register_form.php">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="forgot_form.php">Forgot Password</a>
        </li>



        <?php
        if(isset($_SESSION['id'])){
            $name=$_SESSION['name'];
            echo '<li class="nav-item">';
            echo ' <a href="view_sales.php" class="nav-link">View All Sales</a> ';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '  <a href="buy_seat_form.php" class="nav-link">Buy Seats</a> ';
            echo '</li>';
            echo '<li class="nav-item">';
            echo '  <a href="view_tickets.php" class="nav-link">View My Tickets</a> ';
            echo '</li>';

        }
        ?>

        <li class="nav-item">
            <a href="mainPage.php" class="nav-link">Main</a> 
        </li>
        <li class="nav-item">
            <a   href="login_form.php" class="btn btn-primary-outline">Login</a>
        </li>
        
    </ul>

   
</nav>


<hr>