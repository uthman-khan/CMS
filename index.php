<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <?php
    require "db1.php";
    $sql = "SELECT * FROM title";
    $select = mysqli_query($con, $sql);
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            $img = $row['image'];
        }
        echo " <link rel='shortcut icon' href='img/$img' type='image/x-icon'>";
    }
    require "db1.php";
    $sql = "SELECT * FROM title";
    $select = mysqli_query($con, $sql);
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            $titleName = $row['title'];
        }
    }
    ?>
    <title><?php echo $titleName ?></title>
</head>

<body>
    <?php
    require "partioal/_header.php";
    ?>
    <!-- Main Body Start Here................................. -->
    <div class="main">

        <!-- This is Side Bar Start From Here................................. -->
        <aside class="side_links">
            <ul>
                <?php
                require "db1.php";
                $sql = "SELECT * FROM sideBar";
                $select = mysqli_query($con, $sql);
                if (mysqli_num_rows($select) > 0) {
                    while ($row = mysqli_fetch_assoc($select)) {
                        $href = $row['href'];
                        $name = $row['name'];
                        echo "<li><a href='$href'>$name</a></li>";
                    }
                }
                ?>
            </ul>
            <?php
            require "db1.php";
            $sql = "SELECT * FROM sidebar";
            $select = mysqli_query($con, $sql);
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
                    $img = $row['image'];
                }
                echo"<img src='img/$img' alt='There is no image..'>";
            } ?>
        </aside>
        <!-- This is Side Bar close From Here................................. -->

        <!-- This is our article Which is start here................................. -->
        <article>
        <?php
        require "db1.php";
        $sql = "SELECT * FROM content";
        $select = mysqli_query($con, $sql);
        if(mysqli_num_rows($select)>0){
            while($row = mysqli_fetch_assoc($select)){
                $header = $row['header'];
                $parag = $row['paragraph'];
            }
            echo " <article class=''>
            <h2>$header</h2>
            <p>$parag</p>";
        }?>
        <h2>Our Services</h2>
        <?php
  require "db1.php";
  $sql = "SELECT * FROM servicebox";
  $select = mysqli_query($con, $sql);
  if (mysqli_num_rows($select) > 0) {
      echo"<div class='services-container'>";
      while ($row = mysqli_fetch_assoc($select)) {
          $img = $row['image'];
          $header = $row['header'];
          $p = $row['content'];
          echo "
                  <div class='service-box'>
                      <div class='service-img'>
                          
                          <img src='img/$img' alt='No Image'>
                      </div>
                      <div class='service-title'>
                          <h3>$header</h3>
                      </div>
                      <div class='service-desc'>
                          <p>$p</p>
                      </div>
                      <div class='call-to-action'>
                          <a href=''>Read more</a>
                      </div>
                  </div>";
      }
      echo"</div>";
  }?>
        </article>
        <br>

        <!--our article Close Here................................. -->

    <?php
    require "partioal/_footer.php";
    ?>


</body>

</html>