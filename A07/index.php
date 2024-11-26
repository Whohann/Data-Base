<?php
include("connect.php");

if (isset($_POST['btnSubmitUser'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $birthDate = $_POST['birthDate'];

  $query = "INSERT INTO userInfo (firstName, lastName, birthDate) VALUES ('$firstName', '$lastName', '$birthDate')";
  executeQuery($query);
}

if (isset($_POST['btnUpdateUser'])) {
  $userId = $_POST['userId'];
  $updatedFirstName = $_POST['updatedFirstName'];
  $updatedLastName = $_POST['updatedLastName'];
  $updatedBirthDate = $_POST['updatedBirthDate'];

  $query = "UPDATE userInfo SET firstName = '$updatedFirstName', lastName = '$updatedLastName', birthDate = '$updatedBirthDate' WHERE userInfoID = '$userId'";
  executeQuery($query);
}

$query = "SELECT * FROM userInfo";
$result = executeQuery($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Information - Edit Feature</title>
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

    .formContainer {
      background-color: #ffffff;
      border: 2px solid #1e3a8a;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .formContainer h2 {
      font-size: 1.8rem;
      color: #1e3a8a;
    }

    .form-label {
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

    .userInfoContainer {
      background-color: #ffffff;
      border: 2px solid #1e3a8a;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
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
    if ($result->num_rows > 0) {
      while ($userInfo = mysqli_fetch_assoc($result)) {
    ?>
    <div class="userInfoContainer">
      <h2>User Information</h2>
      <p><strong>User ID:</strong> <?php echo htmlspecialchars($userInfo['userInfoID']); ?></p>
      <p><strong>First Name:</strong> <?php echo htmlspecialchars($userInfo['firstName']); ?></p>
      <p><strong>Last Name:</strong> <?php echo htmlspecialchars($userInfo['lastName']); ?></p>
      <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($userInfo['birthDate']); ?></p>

      <form action="" method="POST">
        <input type="hidden" name="userId" value="<?php echo $userInfo['userInfoID']; ?>">
        <input type="text" name="updatedFirstName" value="<?php echo htmlspecialchars($userInfo['firstName']); ?>" required>
        <input type="text" name="updatedLastName" value="<?php echo htmlspecialchars($userInfo['lastName']); ?>" required>
        <input type="date" name="updatedBirthDate" value="<?php echo htmlspecialchars($userInfo['birthDate']); ?>" required>
        <button type="submit" class="btn btn-primary" name="btnUpdateUser">Update User</button>
      </form>
    </div>
    <?php
      }
    } else {
      echo "<p>No user information found.</p>";
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
