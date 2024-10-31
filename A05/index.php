<?php
include("connect.php");
$query = "SELECT * FROM userInfo";
$result = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3cDXmhGwDnu6r0+t8LElQsnILQp65399gMf1pqYq46nzM2LKbNBnxflEQ9ICJ" crossorigin="anonymous">
  <style>
    .userInfoContainer {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px;
      border: 1px solid #ccc;
    }

    .userInfoList {
      list-style-type: none;
      padding: 0;
    }

    .userInfoListItem {
      margin-bottom: 10px;
    }

    .userInfoLabel {
      font-weight: bold;
    }

    .navbar {
      background-color: #477180;
      border-bottom: 1px solid #dee2e6;
      box-shadow: 0 2px 5px;
      padding: 30px;
    }

    .navbar-brand {
      font-weight: bold;
      color: #ebe1d8;
      font-size: 36px;
      text-align: center;
      display: block;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($act4batabase = mysqli_fetch_assoc($result)) {
      ?>

      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <h1 class="navbar-brand">J Arts</h1>
        </div>
        </div>
      </nav>
      <div class="container mt-4">
        <div class="userInfoContainer">
          <h2>User Information</h2>
          <ul class="userInfoList">
            <li class="userInfoListItem">
              <span class="userInfoLabel">User ID: <?php echo $act4batabase['userInfoID'] ?></span>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">First Name: <?php echo $act4batabase['firstName'] ?></span>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">Last Name: <?php echo $act4batabase['lastName'] ?></span>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">Birthdate: <?php echo $act4batabase['birthDate'] ?></span>
            </li>
          </ul>
        </div>
      </div>
      <?php
    }
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C89scLLqNg5ADnX8p9z7rg3zbdqqj2qJ2Trjw5LIOgRWx8k7PBriw/dteEUyWBq6L" crossorigin="anonymous">
    </script>
</body>

</html>
