<?php
include("connect.php");

if (isset($_GET['id'])) {
  $userId = $_GET['id'];
  $query = "SELECT * FROM userInfo WHERE userInfoID = '$userId'";
  $result = executeQuery($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3cDXmhGwDnu6r0+t8LElQsnILQp65399gMf1pqYq46nzM2LKbNBnxflEQ9ICJ" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f8ff;
      font-family: Arial, sans-serif;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      max-width: 500px;
      background-color: #ffffff;
      border: 2px solid #1e3a8a;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .card h3 {
      color: #1e3a8a;
      font-weight: bold;
      text-align: center;
    }
    .info {
      margin: 15px 0;
      font-size: 1.1rem;
    }
    .info strong {
      color: #1e3a8a;
    }
    .btn-back {
      text-decoration: none;
      color: #fff;
      background-color: #1e3a8a;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 5px;
      display: inline-block;
      text-align: center;
      transition: background-color 0.3s;
    }
    .btn-back:hover {
      background-color: #3b82f6;
    }
    .text-center {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="card">
    <h3>View User</h3>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
      while ($userInfo = mysqli_fetch_assoc($result)) {
    ?>
      <div class="info">
        <strong>User ID:</strong> <?php echo htmlspecialchars($userInfo['userInfoID']); ?>
      </div>
      <div class="info">
        <strong>First Name:</strong> <?php echo htmlspecialchars($userInfo['firstName']); ?>
      </div>
      <div class="info">
        <strong>Last Name:</strong> <?php echo htmlspecialchars($userInfo['lastName']); ?>
      </div>
      <div class="info">
        <strong>Birthdate:</strong> <?php echo htmlspecialchars($userInfo['birthDate']); ?>
      </div>
      <div class="text-center">
        <a href="index.php" class="btn-back">Back to List</a>
      </div>
    <?php
      }
    } else {
      echo "<p class='text-danger text-center'>No user found with the specified ID.</p>";
    }
    ?>
  </div>
</body>

</html>