<?php
include("connect.php");

$currentYear = date("Y");

$airlineFilter = $_GET['airlineName'] ?? '';
$departureFilter = $_GET['departureAirportCode'] ?? '';
$arrivalFilter = $_GET['arrivalAirportCode'] ?? '';
$sort = $_GET['sort'] ?? '';
$order = $_GET['order'] ?? '';

$flightsQuery = "SELECT * FROM flightlogs";

if ($airlineFilter != '' || $departureFilter != '' || $arrivalFilter != '') {
  $flightsQuery .= " WHERE";

  if ($airlineFilter != '') {
    $flightsQuery .= " airlineName='$airlineFilter'";
  }

  if ($airlineFilter != '' && ($departureFilter != '' || $arrivalFilter != '')) {
    $flightsQuery .= " AND";
  }

  if ($departureFilter != '') {
    $flightsQuery .= " departureAirportCode='$departureFilter'";
  }

  if ($departureFilter != '' && $arrivalFilter != '') {
    $flightsQuery .= " AND";
  }

  if ($arrivalFilter != '') {
    $flightsQuery .= " arrivalAirportCode='$arrivalFilter'";
  }
}

if ($sort != '') {
  $flightsQuery .= " ORDER BY $sort";

  if ($order != '') {
    $flightsQuery .= " $order";
  }
}

$flightResults = executeQuery($flightsQuery);

$airlineQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineResults = executeQuery($airlineQuery);

$airportQuery = "SELECT DISTINCT(departureAirportCode) FROM flightlogs";
$airportResults = executeQuery($airportQuery);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container my-5">
    <div class="row">
      <div class="col">
        <form>
          <div class="card p-4 rounded-5">
            <div class="h6 mb-3">Filter</div>
            <div class="row g-3">
              <div class="col-md-3">
                <label for="airlineSelect" class="form-label">Airline</label>
                <select id="airlineSelect" name="airlineName" class="form-select">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($airlineResults) > 0) {
                    while ($airlineRow = mysqli_fetch_assoc($airlineResults)) {
                      ?>
                      <option <?php if ($airlineFilter == $airlineRow['airlineName']) echo "selected"; ?>
                        value="<?php echo $airlineRow['airlineName']; ?>">
                        <?php echo $airlineRow['airlineName']; ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="arrivalSelect" class="form-label">Arrival</label>
                <select id="arrivalSelect" name="arrivalAirportCode" class="form-select">
                  <option value="">Any</option>
                  <?php
                  if (mysqli_num_rows($airportResults) > 0) {
                    while ($airportRow = mysqli_fetch_assoc($airportResults)) {
                      ?>
                      <option <?php if ($arrivalFilter == $airportRow['departureAirportCode']) echo "selected"; ?>
                        value="<?php echo $airportRow['departureAirportCode']; ?>">
                        <?php echo $airportRow['departureAirportCode']; ?>
                      </option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="sort" class="form-label">Sort By</label>
                <select id="sort" name="sort" class="form-select">
                  <option value="">None</option>
                  <option <?php if ($sort == "flightNumber") echo "selected"; ?> value="flightNumber">Flight Number</option>
                  <option <?php if ($sort == "departureDatetime") echo "selected"; ?> value="departureDatetime">
                    Departure Time
                  </option>
                  <option <?php if ($sort == "arrivalDatetime") echo "selected"; ?> value="arrivalDatetime">Arrival Time</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="order" class="form-label">Order</label>
                <select id="order" name="order" class="form-select">
                  <option <?php if ($order == "ASC") echo "selected"; ?> value="ASC">Ascending</option>
                  <option <?php if ($order == "DESC") echo "selected"; ?> value="DESC">Descending</option>
                </select>
              </div>
            </div>
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row my-5">
      <div class="col">
        <div class="card p-4 rounded-5">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-dark">
                <tr>
                  <th scope="col">Flight Number</th>
                  <th scope="col">Departure</th>
                  <th scope="col">Arrival</th>
                  <th scope="col">Airline</th>
                  <th scope="col">Departure Time</th>
                  <th scope="col">Arrival Time</th>
                  <th scope="col">Duration (Minutes)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightResults) > 0) {
                  while ($flightRow = mysqli_fetch_assoc($flightResults)) {
                    ?>
                    <tr>
                      <td><?php echo $flightRow['flightNumber']; ?></td>
                      <td><?php echo $flightRow['departureAirportCode']; ?></td>
                      <td><?php echo $flightRow['arrivalAirportCode']; ?></td>
                      <td><?php echo $flightRow['airlineName']; ?></td>
                      <td><?php echo $flightRow['departureDatetime']; ?></td>
                      <td><?php echo $flightRow['arrivalDatetime']; ?></td>
                      <td><?php echo $flightRow['flightDurationMinutes']; ?></td>
                    </tr>
                    <?php
                  }
                } else {
                  echo "<tr><td colspan='7' class='text-center'>No flights found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
