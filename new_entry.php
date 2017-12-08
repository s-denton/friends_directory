<?php
session_start();
include 'includes/header.html'; 
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  insertRecord($_SESSION["username"], $_POST['first_name'], $_POST['last_name'], $_POST['company'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['email'], $_POST['phone'], $_POST['birthday'], $_POST['association']);
}
?>

<nav class="navbar navbar-light navbar-expand-md">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="directory.php">All Entries</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="new_entry.php">Add New Entry</a>
        </li>
      </ul>
      <form class="form-inline" action="login.php">
      <a href="logout.php"><button class="btn btn-primary" id="nav-btn" type="button"><i class="fa fa-sign-out"></i> Logout</button></a>
    </form>
    </div>
  </nav>
  <hr>

  <div class="content-container text-left">
    <h2 class="content-title"><span><i class="fa fa-user-plus"></i></span> Add a New Entry</h2>
    <hr>

    <div class="form-container">
      <form action="" method="post">
        <p class="text-center small">Enter the individual's information below: </p>
        <div class="form-group row">
          <input type="text" name="first_name" class="form-control input-lg" placeholder="First Name">
        </div>
        <div class="form-group row">
          <input type="text" name="last_name" class="form-control input-lg" placeholder="Last Name">
        </div>
        <div class="form-group row">
          <input type="text" name="company" class="form-control input-lg" placeholder="Company">
        </div>
        <div class="form-group row">
          <input type="text" name="street" class="form-control input-lg" placeholder="Street">
        </div>
        <div class="form-group row">
          <input type="text" name="city" class="form-control input-lg" placeholder="City">
        </div>
        <div class="form-group row">
          <input type="text" name="state" class="form-control input-lg" placeholder="State">
        </div>
        <div class="form-group row">
          <input type="number" name="zip" class="form-control input-lg" placeholder="Zip Code">
        </div>
        <div class="form-group row">
          <input type="email" name="email" class="form-control input-lg" placeholder="Email">
        </div>
        <div class="form-group row">
          <input type="tel" name="phone" class="form-control input-lg" placeholder="Phone" data-mask="000-000-0000">
        </div>
        <div class="form-group row">
          <input type="date" name="birthday" class="form-control input-lg" placeholder="Birthday (yyyy-mm-dd)" data-mask="0000-00-00">
        </div>
        <div class="text-center">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="association" value="friend"> Friend
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="association" value="family"> Family
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="association" value="colleague"> Colleague
            </label>
          </div>
        </div>
        <div class="form-group row">
          <input type="submit" name="submit" class="btn btn-lg btn-success submit-btn" value="Submit Entry">
        </div>
      </form>
    </div>
  </div>

<?php include 'includes/footer.html'; ?>