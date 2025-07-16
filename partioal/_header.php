<div id="top-img">
    <h1>Welcome</h1>
    <p>This Website was made just for DIT project.<br>Lorem ipsum dolor sit, amet consectetur adipisicing elit. <br> Vitae vero atque omnis repellendus, reiciendis minus.</p>
</div>
<!-- This is Top NavBar or Header Start Here................................. -->
<header>
    <nav id="menu">
        <ul>
            <?php
            require "db1.php";
            $sql = "SELECT * FROM header";
            $select = mysqli_query($con, $sql);
            // $select = mysqli_query($con, "SELECT * FROM std");
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
                    $id = $row['id'];
                    $headerName = $row['header'];
                    $link = $row['href'];
                    echo "
                    <li><a href='$link'>" . $headerName . "</a></li>";
                }
            }
            ?>
        </ul>
    </nav>
    <!-- This is my logo................................. -->

    <div id="logo">
        <a href="index.php">Usman Khan</a>
    </div>
    <!-- This is Top Icon................................. -->
    <nav id="social-link">
        <ul>
            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i></a></li>
            <?php
            session_start();
            if($_SESSION['role']==1){
                ?>
            <li><a href="admain.php"><i class="fa fa-edit"></i></a></li>
        <?php } ?>
    </nav>
</header>