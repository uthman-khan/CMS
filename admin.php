<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header("Location: http://localhost/ASS/login.php");
} else if ($_SESSION['role'] == 0) {
  header("Location: http://localhost/ASS/index.php");
}
// database connection...
require_once "db1.php";
$title = false;
$nav = false;
$sidebar = false;
$content = false;
$box = false;
$editbox = false;
$editcontent = false;
$nothing = false;
// echo $_GET['update'];
if (isset($_GET['t'])) {
  $title = true;
} elseif (isset($_GET['n'])) {
  $nav = true;
} elseif (isset($_GET['s'])) {
  $sidebar = true;
} elseif (isset($_GET['cnt'])) {
  $content = true;
} elseif (isset($_GET['b'])) {
  $box = true;
} else {
  $nothing = true;
}



if (isset($_GET['deletenav'])) {
  
  $id = $_GET['deletenav'];
  $delete = "DELETE FROM `header` WHERE `header`.`id` = $id";
  if (!mysqli_query($con, $delete)) {
    //     echo "<p style='Color:green'>Data updated into DataBase</p>";
    // } else {
    echo "<p style='color:red'>Error:</p> " . $delete . "<br>" . mysqli_error($con);
  }
  $nav = true;
}
// Delete Content In our webside...........................
if (isset($_GET['deletecontent'])) {
  
  $id = $_GET['deletecontent'];
  $delete = "DELETE FROM `content` WHERE `content`.`id` = $id";
  if (!mysqli_query($con, $delete)) {
    //     echo "<p style='Color:green'>Data updated into DataBase</p>";
    // } else {
    echo "<p style='color:red'>Error:</p> " . $delete . "<br>" . mysqli_error($con);
  }
  $content = true;
}
// Editing Content In our webside...........................
$editcontent2 = false;
$editcontent = false;
if (isset($_GET['editcontent'])) {
  $editcontent = true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_GET['editcontent'];
    $header = $_POST["name"];
    $paragrap = $_POST["paragraph"];
    $update = "UPDATE `content` SET `header` = '$header', `paragraph`='$paragrap' WHERE `content`.`id` = $id;";
    if (!mysqli_query($con, $update)) {
      echo "<p style='color:red'>Error:</p> " . $update . "<br>" . mysqli_error($con);
    }
    $editcontent2 = true;
    $editcontent = false;
  }
  $content = true;
}
// This is your box coding.....................
if (isset($_GET['deletebox'])) {
  
  $id = $_GET['deletebox'];
  $delete = "DELETE FROM `servicebox` WHERE `servicebox`.`id` = $id";
  if (!mysqli_query($con, $delete)) {
    //     echo "<p style='Color:green'>Data updated into DataBase</p>";
    // } else {
    echo "<p style='color:red'>Error:</p> " . $delete . "<br>" . mysqli_error($con);
  }
  $box = true;
} else {
  // echo "<p style='margin:0px 0px 0px 300px;'>nothing</p>";
}
if (isset($_GET['editbox'])) {
  $editbox = true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_GET['editbox'];
    $paragrap = mysqli_real_escape_string($con, $_POST["content"]);
    $header = mysqli_real_escape_string($con, $_POST["name"]);
    $img = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $img = mysqli_real_escape_string($con, $img);
    if ($img && $paragrap) {
      move_uploaded_file($tmp_name, "img/" . $img);
      $update = "UPDATE servicebox SET servicebox.image = '$img', header = '$header', content='$paragrap' WHERE id = $id;";
      if (!mysqli_query($con, $update)) {
        echo "<p style='color:red'>Error:</p> " . $update . "<br>" . mysqli_error($con);
      }
    } elseif ($img) {
      move_uploaded_file($tmp_name, "img/" . $img);
      $update = "UPDATE `servicebox` SET `image` = '$img', `header` = '$header' WHERE `servicebox`.`id` = $id;";
      if (!mysqli_query($con, $update)) {
        echo "<p style='color:red'>Error:</p> " . $update . "<br>" . mysqli_error($con);
      }
    } elseif ($paragrap) {
      $update = "UPDATE `servicebox` SET `header` = '$header', `content`='$paragrap' WHERE `id` = $id;";
      if (!mysqli_query($con, $update)) {
        echo "<p style='color:red'>Error:</p> " . $update . "<br>" . mysqli_error($con);
      }
    } else {
      $update = "UPDATE `servicebox` SET `header` = '$header' WHERE `servicebox`.`id` = $id;";
      if (!mysqli_query($con, $update)) {
        echo "<p style='color:red'>Error:</p> " . $update . "<br>" . mysqli_error($con);
      }
    }
    $editbox = false;
  }
  $box = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admainstrator</title>
  <link rel="shortcut icon" href="img/Manegeer.PNG" type="image/x-icon">
  <link rel="stylesheet" href="css/Admainstyle.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <!-- <link href="js/bootstrap-4.6.2-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
  <!-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->
  <link href="css/fontawesome/css/all.css" rel="stylesheet">
  <style>
    .imput {
      border: 0px;
      height: 40px;
      color: rgba(0, 20, 25, 1.0);
      font-weight: 600;
      width: 100px;
      border-radius: 20px;
      transition: .3s;
    }

    .imputSub {
      background-color: rgba(255, 200, 10, 1.0);
    }

    .imputEd {
      background: rgba(20, 255, 200, 0.9);
    }

    .input {
      float: left;
      border: 0px;
      height: 40px;
      color: rgba(222, 222, 255, 1.0);
      margin-right: 20px;
      font-weight: 600;
      width: 100px;
      border-radius: 20px;
      transition: .3s;
    }

    .content_style {
      color: #000f;
      border: 2px solid rgba(60, 200, 255, 0.9);
      border-radius: 5px 30px 30px 30px;
    }

    .content_style:nth-child(odd) {
      background-color: rgba(60, 200, 255, 0.2);
    }

    .content_style:nth-child(even) {
      background-color: rgba(140, 25, 120, 0.2);
    }

    .content_style:nth-child(odd):hover {
      background-color: rgba(60, 200, 255, 0.1);
    }

    .content_style:nth-child(even):hover {
      background-color: rgba(140, 25, 120, 0.1);
    }
  </style>
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark imputSub imput" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="admin.php">Administrator</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
          <div>
            <div class="input-group">
              <input type="text" class="form-control search-menu" placeholder="Search...">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="<?php $_SERVER['PHP_SELF'] ?>?t=true">
                <i class="fa fa-diagram-project"></i>
                <span>Title Bar</span>
              </a>
            </li>

            <li class="sidebar-dropdown">
              <a href="<?php $_SERVER['PHP_SELF'] ?>?n=true">
                <i class="fa fa-header"></i>
                <span>Header</span>
              </a>
            </li>
            <li class="sidebar-dropdown">
              <a href="<?php $_SERVER['PHP_SELF'] ?>?s=true">
                <i class="fa fa-sign "></i>
                <span>Side Bar</span>
              </a>

            </li>
            <li class="sidebar-dropdown">
              <a href="<?php $_SERVER['PHP_SELF'] ?>?cnt=true">
                <i class="fa fa-chart-line"></i>
                <span>Content</span>
              </a>
            </li>
            <li class="sidebar-dropdown">
              <a href="<?php $_SERVER['PHP_SELF'] ?>?b=true">
                <i class="fa fa-box"></i>
                <span>Services Box</span>
              </a>
            </li>
            <li class="header-menu">
              <span>Extra</span>
            </li>
            <li>
              <a href="index.php" target="_blank">
                <i class="fa fa-home"></i>
                <span>Your Webside</span>
              </a>
            </li>
            <li>
              <a href="About Us.php" target="_blank">
                <i class="fa fa-user"></i>
                <span>About Us</span>
              </a>
            </li>
            <li>
              <a href="contact.php" target="_blank">
                <i class="fa fa-contact-card"></i>
                <span>Contact Us</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer">

        <a href="logout.php">
          <i class="fa fa-award"> LogOut</i>
          <!-- <i class="fa fa-award"> Footer</i> -->
        </a>
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">
        <?php
        // This is for changing your title okay.................................--------------- \
        if ($title == 'true') {
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
            
            $tmp_name = $_FILES['image']['tmp_name'];
            $img = $_FILES['image']['name'];
            $title = $_POST["title"];
            move_uploaded_file($tmp_name, "img/" . $img);
            $insert = "INSERT INTO title (title, image) VALUES('$title', '$img')";

            if (!mysqli_query($con, $insert)) {
              //     echo "<p style='Color:green'>Data Inserted into DataBase</p>";
              // } else {
              echo "<p style='color:red'>Error:</p> " . $insert . "<br>" . mysqli_error($con);
            }
          }
          echo "<div class='container'>
                        <header class='header'>
                            <h1 id='title'>Content Management System for title and icon</h1>
                            <p id='description'>Change The Title of your webside on the top and change also the Image.</p>
                        </header>

                        <form id='survey-form' action='admin.php?t=true' method='POST' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label for='name'>Title</label>
                                <input type='text' name='title' id='name' class='form-control' placeholder='Enter your title' required />
                            </div>
                            <div class='form-group'>
                                <label>Image</label>
                                <div class='custom-file'>
                                    <span>Choose a file to upload</span>
                                    <input type='file' name='image' id='img'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <button type='submit' class='btn-dark imputSub imput p-2' name='Submit'>
                                  Submit
                                </button>
                            </div>

                        </form>

                </div>";
          
          $sql = "SELECT * FROM title";
          $select = mysqli_query($con, $sql);
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
              $titleName = $row['title'];
              $img = $row['image'];
            }
            echo "
                    <h2>This is your Title And Image of Webside</h2>
                    <div style='margin:60px 0px 0px 10%;'> 
                    <img src='img/$img' style='width:12%; border-radius:30px;'> ";
          }
          echo $titleName . "</div>";
        } elseif ($nav == 'true') {

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $name = $_POST["name"];
            $href = $_POST["href"];
            $insert = "INSERT INTO header (header, href) VALUES('$name', '$href')";

            if (!mysqli_query($con, $insert)) {
              //     echo "<p style='Color:green'>Data Inserted into DataBase</p>";
              // } else {
              echo "<p style='color:red'>Error:</p> " . $insert . "<br>" . mysqli_error($con);
            }
          }
          echo "
                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System for header buttons</h1>
                        <p id='description'>Change The header buttons of your webside .</p>
                    </header>

                    <form id='survey-form' action='admin.php?n=true' method='POST'>
                        <div class='form-group'>
                            <label for='name'>Name</label>
                            <input type='text' name='name' id='name' class='form-control' placeholder='Enter your name' required />
                        </div>
                        <div class='form-group'>
                            <label for='name'>href</label>
                            <input type='text' name='href' id='name' class='form-control' placeholder='Enter the ref' required />
                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn-dark imputSub imput p-2' name='Submit'>
                                  Add
                                </button>
                        </div>

                    </form>

                </div>";
          echo "  <h2>This is your Menu Bar</h2>";
          
          $sql = "SELECT * FROM header";
          $select = mysqli_query($con, $sql);
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
              $id = $row['id'];
              $header = $row['header'];
              $href = $row['href'];
              echo "
                        <div style='margin:60px 0px 0px 10%;'> 
                        <button type='button' class='input btn-success' href='$href'>$header</button> ";
              echo "<div style='position:relative; left:80%; top:5px;'>
                                <a href='admin.php?deletenav=$id' class='text-danger'><i class='fa fa-close fa-2x'></i></a>
                            </div>";
              echo "</div>";
            }
          }
        } elseif ($sidebar == 'true') {
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
            
            $tmp_name = $_FILES['image']['tmp_name'];
            $img = $_FILES['image']['name'];
            $href = $_POST["href"];
            $name = $_POST["name"];
            move_uploaded_file($tmp_name, "img/" . $img);
            $insert = "INSERT INTO sidebar (href, name, image) VALUES('$href', '$name','$img')";

            if (!mysqli_query($con, $insert)) {
              //     echo "<p style='Color:green'>Data Inserted into DataBase</p>";
              // } else {
              echo "<p style='color:red'>Error:</p> " . $insert . "<br>" . mysqli_error($con);
            }
          }
          echo "
                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System for Sidebar</h1>
                        <p id='description'>Change The Side Bar of your Webside on left side.</p>
                    </header>

                    <form id='survey-form' action='admin.php?s=true' method='POST' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label for='name'>Name</label>
                            <input type='text' name='name' id='name' class='form-control' placeholder='Enter name' required />
                        </div>
                        <div class='form-group'>
                            <label for='href'>href</label>
                            <input type='text' name='href' id='href' class='form-control' placeholder='Enter URL of the Page' required />
                        </div>
                        <div class='form-group'>
                            <label>Image</label>
                            <div class='custom-file'>
                                <span>Choose a file to upload</span>
                                <input type='file' name='image' id='img'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn-dark imputSub imput' name='Submit'>Add</button>
                        </div>

                    </form>

                </div>";
          echo "  <h2>This is your Side Bar</h2>";
          
          $sql = "SELECT * FROM sidebar";
          $select = mysqli_query($con, $sql);
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
              $href = $row['href'];
              $name = $row['name'];
              $img = $row['image'];
              echo "<div style='margin:10px 0px 0px 0%;'>";
              echo "<a href='$href'>$name</a> ";
              echo "</div>";
            }
            echo "<div style='position:absolute; top:74%; left:60%; width:15%;'><img src='img/$img' style='width:100%;'></div>";
          }
        } elseif ($content == 'true') {
          if ($editcontent == false && $editcontent2 == false) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
              $header = $_POST["header"];
              $content = $_POST["textarea"];
              if ($header && $content) {
                $insert = "INSERT INTO content (header, paragraph) VALUES('$header', '$content')";
                if (!mysqli_query($con, $insert)) {
                  //     echo "<p style='Color:green'>Data Inserted into DataBase</p>";
                  // } else {
                  echo "<p style='color:red'>Error:</p> " . $insert . "<br>" . mysqli_error($con);
                }
              }
            }
          } elseif ($editcontent) {
            
            $id = $_GET['editcontent'];
            $sql = "SELECT * FROM content WHERE `id`='$id'";
            $select = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($select);
            $header = $row['header'];
            $content = $row['paragraph'];
            echo "
                                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System for Content</h1>
                        <p id='description'>Change or add some Content in your webside.</p>
                    </header>
                    
                    <form id='survey-form' action='admin.php?editcontent=$id' method='POST'>
                        <div class='form-group'>
                            <label for='header'>Enter your Header</label>
                            <input type='text' name='name' id='name' value='$header' class='form-control' />
                            </div>
                        <div class='form-group'>
                        <label for='area'>Enter your Content</label>
                        <textarea id='area' name='paragraph' class='text-area' style='width: 100%; border: 1px solid #eeaeff;'>$content</textarea>
                        </div>
                        
                        <div class='form-group'>
                        <button type='submit' class='btn-dark imputEd imput p-2' name='Submit'>Edit</button>
                        </div>
                        
                        </form>
                        
                        </div>";
          }
          if (!$editcontent) {
            echo "
                                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System of Content</h1>
                        <p id='description'>Change or add some Content in your webside.</p>
                    </header>
                    
                    <form id='survey-form' action='admin.php?cnt=true' method='POST'>
                        <div class='form-group'>
                            <label for='header'>Enter your Header</label>
                            <input type='text' name='header' id='name' class='form-control' placeholder='Enter your Header' required />
                            </div>
                        <div class='form-group'>
                        <label for='area'>Enter your Content</label>
                        <textarea id='area' name='textarea' class='text-area' style='width: 100%; border: 1px solid #eeaeff;' placeholder='Describe your Content here....'></textarea>
                        </div>
                        
                        <div class='form-group'>
                        <button type='submit' class='btn-dark imputSub imput p-2' name='Submit'>Add</button>
                        </div>
                        
                        </form>
                        
                        </div>";
          }
          // this is fatching........................................
          echo "  <h2>This is your Content</h2>";
          
          $sql = "SELECT * FROM content";
          $select = mysqli_query($con, $sql);
          if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
              $id = $row['id'];
              $header = $row['header'];
              $p = $row['paragraph'];
              $p = (strlen($p) > 10) ? (substr($p, 0, 100) . "...") : $p;
              echo "<div class='content_style' style='margin:5px 0px 0px 0px;'>";
              echo "<h2 style='margin:10px 0px 0px 10px;'>$header</h2>";
              echo "<div style='position:relative; left:90%; top:-40px;'>
                                <a href='admin.php?editcontent=$id' style='margin:0px 20px 0px 0px' class='text-dark'><i class='fa fa-edit fa-2x'></i></a>
                                <a href='admin.php?deletecontent=$id' class='text-danger'><i class='fa fa-close fa-2x'></i></a>
                            </div>";
              echo "<p style='margin:0px 0px 10px 10px;'>$p</p>";
              echo "</div>";
            }
          }
        }
        // Service Box Start from here.......................
        elseif ($box == 'true') {
          if (!$editbox) {

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
              

              $paragrap = mysqli_real_escape_string($con, $_POST["textarea"]);
              $header = mysqli_real_escape_string($con, $_POST["header"]);

              $tmp_name = $_FILES['image']['tmp_name'];
              $img = $_FILES['image']['name'];

              move_uploaded_file($tmp_name, "img/" . $img);

              // Escape image name just in case (not critical but good practice)
              $img = mysqli_real_escape_string($con, $img);

              $insert = "INSERT INTO servicebox (image, header, content) 
           VALUES ('$img', '$header', '$paragrap')";

              if (!mysqli_query($con, $insert)) {
                echo "<p style='color:red'>Error:</p> " . $insert . "<br>" . mysqli_error($con);
              } else {
                echo "<p style='color:green'>Data Inserted into Database</p>";
              }
            }
          } elseif ($editbox) {
            
            $id = $_GET['editbox'];
            $sql = "SELECT * FROM servicebox WHERE `id`='$id'";
            $select = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($select);
            $header = $row['header'];
            $content = $row['content'];
            $image = $row['image'];
            echo "
                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System of Service Box</h1>
                        <p id='description'>Change or add some Service Box in webside.</p>
                    </header>

                    <form id='survey-form' action='admin.php?editbox=$id' method='POST' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label for='header'>Enter your Header</label>
                            <input type='text' name='name' id='name' class='form-control' value='$header' />
                        </div>
                        <div class='form-group'>
                            <label for='area'>Enter your Content</label>
                            <textarea id='area' name='content' class='text-area' style='width: 100%; border: 1px solid #eeaeff;'>$content</textarea>
                        </div>

                        <div class='form-group'>
                            <label>Image</label>
                            <div class='custom-file'>
                                <span>Choose a file to upload</span>
                                <input type='file' name='img' id='img'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <button type='submit' class='btn-dark imputEd imput p-2' name='Submit'>Edit</button>
                        </div>

                    </form>

                </div>";
          }
          if (!$editbox) {
            echo "
                <div class='container'>
                    <header class='header'>
                        <h1 id='title'>Content Management System of Service Box</h1>
                        <p id='description'>Change or add some Service Box in webside.</p>
                    </header>

                    <form id='survey-form' action='admin.php?b=true' method='POST' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label for='header'>Enter your Header</label>
                            <input type='text' name='header' id='name' class='form-control' placeholder='Enter your Header' required />
                        </div>
                        <div class='form-group'>
                            <label for='area'>Enter your Content</label>
                            <textarea id='area' name='textarea' class='text-area' style='width: 100%; border: 1px solid #eeaeff;' placeholder='Describe your Content here....' required></textarea>
                        </div>

                        <div class='form-group'>
                            <label>Image</label>
                            <div class='custom-file'>
                                <span>Choose a file to upload</span>
                                <input type='file' name='image' id='img' required>
                            </div>
                        </div>

                        <div class='form-group'>
                            <button type='submit' class='btn-dark imputSub imput p-2' name='Submit'>Add</button>
                        </div>

                    </form>

                </div>";
          }
          echo "  <h2>This is your Service Box</h2>";
          
          $sql = "SELECT * FROM servicebox";
          $select = mysqli_query($con, $sql);
          if (mysqli_num_rows($select) > 0) {
            echo "    <link rel='stylesheet' href='css/sBoxStyle.css'>";
            echo "<div class='services-container'>";
            while ($row = mysqli_fetch_assoc($select)) {
              $id = $row['id'];
              $img = $row['image'];
              $header = $row['header'];
              $p = $row['content'];
              $p = (strlen($p) > 140) ? (substr($p, 0, 140) . "...") : $p;
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
                                            <div class='call-to'>
                                            <div class='call-to-action'>
                                                <a href=''#>Read more</a>
                                            </div>
                                            <div class='call-to-delete'>
                                                <a href='admin.php?deletebox=$id'>Delete</a>
                                            </div>
                                            <div class='call-to-edit'>
                                                <a href='admin.php?editbox=$id'>Edit</a>
                                            </div>
                                            </div>
                                        </div>";
            }
            echo "</div>";
          }
        } else {
          echo "
                <h2>Content Management System (CMS) Page</h2>
                <h5>Our Webside</h5>
                <hr>
                <div class='row'>
                    <div class='col-xs-12 col-sm-12 col-md-12'>
                        <div class='card rounded-0 p-0 shadow-sm'>
                            <!-- <img src=' class='card-img-top rounded-0' alt='Angular pro sidebar'>  -->
                            <iframe src='index.php' frameborder='0' height='500px'></iframe>
                            <div class='card-body text-center'>
                                <a href='admin.php?t=true' class='btn btn-primary btn-sm'>Edit page</a>
                                <a href='index.php' class='btn btn-success btn-sm' target='_blank'>Preview</a>
                            </div>
                        </div>
                    </div>
                </div>
                 ";
        }
        ?>


      </div>

    </main>
    <!-- page-content" -->
  </div>
  <!-- page-wrapper -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap-4.6.2-dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <!-- partial -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- <script src="js/bootstrap-4.6.2-dist/js/bootstrap.min.js"></script> -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/script.js"></script>

</body>

</html>