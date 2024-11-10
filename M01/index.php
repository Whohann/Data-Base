<?php
include("connect.php");

if (isset($_POST['btnSubmitUser'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $birthDate = $_POST['birthDate'];
  
  $insertQuery = "INSERT INTO userInfo (firstName, lastName, birthDate) VALUES ('$firstName', '$lastName', '$birthDate')";
  
  if (executeQuery($insertQuery)) {
    echo "<div class='alert alert-success'>New user added successfully</div>";
  } else {
    echo "<div class='alert alert-danger'>Error adding user</div>";
  }
}

$query = "SELECT * FROM userInfo";
$result = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Information - Blue and White Theme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3cDXmhGwDnu6r0+t8LElQsnILQp65399gMf1pqYq46nzM2LKbNBnxflEQ9ICJ" crossorigin="anonymous">
  <style>
    body {
      background-color: #f0f8ff;
      font-family: Arial, sans-serif;
      color: #333;
    }

    .navbar {
      background-color: #1e3a8a;
      padding: 20px;
      text-align: center;
    }

    .navbar-brand {
      color: #f0f8ff;
      font-size: 2.5rem;
      font-weight: bold;
    }

    .container {
      max-width: 800px;
      margin: auto;
    }

    .userInfoContainer, .formContainer {
      background-color: #ffffff;
      border: 2px solid #1e3a8a;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .formContainer h2, .userInfoContainer h2 {
      font-size: 1.8rem;
      color: #1e3a8a;
    }

    .formContainer .form-label {
      color: #1e3a8a;
      font-weight: bold;
    }

    .form-control {
      border: 1px solid #1e3a8a;
    }

    .btn-primary {
      background-color: #1e3a8a;
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #3b82f6;
    }

    .userInfoLabel {
      font-weight: bold;
      color: #1e3a8a;
    }

    .userInfoListItem {
      background-color: #e0f2fe;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <h1 class="navbar-brand">J Arts</h1>
  </nav>

  <div class="container">
    <div class="formContainer mb-4">
      <h2>Add New User</h2>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3">
          <label for="birthDate" class="form-label">Birthdate</label>
          <input type="date" class="form-control" id="birthDate" name="birthDate" required>
        </div>
        <button type="submit" class="btn btn-primary" name="btnSubmitUser">Add User</button>
      </form>
    </div>
    
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($userInfo = mysqli_fetch_assoc($result)) {
        ?>
        <div class="userInfoContainer mb-4">
          <h2>User Information</h2>
          <ul class="userInfoList">
            <li class="userInfoListItem">
              <span class="userInfoLabel">User ID: </span><?php echo $userInfo['userInfoID']; ?>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">First Name: </span><?php echo $userInfo['firstName']; ?>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">Last Name: </span><?php echo $userInfo['lastName']; ?>
            </li>
            <li class="userInfoListItem">
              <span class="userInfoLabel">Birthdate: </span><?php echo $userInfo['birthDate']; ?>
            </li>
          </ul>
        </div>
        <?php
      }
    } else {
      echo "<p>No user information found.</p>";
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C89scLLqNg5ADnX8p9z7rg3zbdqqj2qJ2Trjw5LIOgRWx8k7PBriw/dteEUyWBq6L" crossorigin="anonymous">
  </script>
</body>

</html>
