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
    <h1 class="form-row justify-content-center" style="margin-left: 100px;">View Company</h1> <br>
    <form method="POST">
      <input type="text" name="search" placeholder="Search by company name">
      <input type="submit" name="submit" value="Search">
    </form>
    <div class="table-responsive">
      <table class="table table-hover table-borderless table-dark">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Company Name</th>
            <th scope="col">Student Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM applied WHERE status='Selected'";
            if (isset($_POST['search'])) {
              $search = mysqli_real_escape_string($conn, $_POST['search']);
              $sql .= " AND company LIKE '%$search%'";
            }
            $sql .= ";";
            $res = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($res);
            if($rescheck > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['company'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['status'].'</td>';
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include_once 'includes/footer.php' ?>
</body>
</html>