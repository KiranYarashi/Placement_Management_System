<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/addcomp.css"> -->
  <?php include_once 'includes/head.php' ?>
</head>
<body>
  <?php include_once 'includes/nav.php' ?>
  <div class="container">
    <h1 class="form-row justify-content-center">View Applied Company</h1> <br>
    <form method="POST">
      <div class="form-group">
        <label for="company_filter">Filter by company name:</label>
        <input type="text" id="company_filter" name="company_filter" placeholder="Company name">
      </div>
      <!-- <div class="form-group">
        <label for="status_filter">Filter by status:</label>
        <input type="text" id="status_filter" name="status_filter" placeholder="Status">
      </div> -->
      <input type="submit" name="submit" value="Filter">
    </form>
    <div class="table-responsive">
      <table class="table table-hover table-borderless table-dark">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Company Name</th>
            <th scope="col">Student Name</th>
            <!-- <th scope="col">Status</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
            $user = $_SESSION['username'];
            $sql = "SELECT * FROM applied WHERE name='$user'";
            if (isset($_POST['company_filter']) && !empty($_POST['company_filter'])) {
              $company_filter = mysqli_real_escape_string($conn, $_POST['company_filter']);
              $sql .= " AND company LIKE '%$company_filter%'";
            }
            // if (isset($_POST['status_filter']) && !empty($_POST['status_filter'])) {
            //   $status_filter = mysqli_real_escape_string($conn, $_POST['status_filter']);
            //   $sql .= " AND status LIKE '%$status_filter%'";
            // }
            $sql .= ";";
            $res = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($res);
            if($rescheck > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['company'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                // echo '<td>'.$row['status'].'</td>';
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include_once 'includes/footer.php' ?>
  <script>
    $(document).ready(function() {
      $("#home").removeClass("active");
      $("#view").addClass("active");
    });
  </script>
</body>
</html>
