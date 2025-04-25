<?php
// Pripojenie k databáze
include 'db.php';

// Spracovanie formulára na pridanie novej práce
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_job'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $sql = "INSERT INTO jobs (title, description, location) VALUES ('$title', '$description', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "New job added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Získanie zoznamu prác
$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Hirevac</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>Hirevac</span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-lg-7 col-md-8 mx-auto">
            <div class="detail-box">
              <h1>Build Your <br> POWERFUL CAREER</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Formulár na pridanie novej práce -->
  <section class="category_section">
    <div class="container">
      <h2>Add New Job</h2>
      <form method="POST" action="index.php">
        <div class="form-group">
          <input type="text" name="title" class="form-control" placeholder="Job Title" required>
        </div>
        <div class="form-group">
          <textarea name="description" class="form-control" placeholder="Job Description" required></textarea>
        </div>
        <div class="form-group">
          <input type="text" name="location" class="form-control" placeholder="Location" required>
        </div>
        <button type="submit" name="add_job" class="btn btn-primary">Add Job</button>
      </form>
    </div>
  </section>

  <!-- Zobrazenie všetkých prác -->
  <section class="category_section">
    <div class="container">
      <h2>Available Jobs</h2>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='job'>";
          echo "<h3>" . $row['title'] . "</h3>";
          echo "<p>" . $row['description'] . "</p>";
          echo "<p><strong>Location: </strong>" . $row['location'] . "</p>";
          echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> ";
          echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
          echo "</div><hr>";
        }
      } else {
        echo "<p>No jobs found.</p>";
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer_section">
    <div class="container">
      <p>&copy; <span id="displayYear"></span> All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
    </div>
  </footer>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <script src="js/custom.js"></script>

</body>
</html>

<?php
$conn->close(); // Zavrie pripojenie na databázu
?>
