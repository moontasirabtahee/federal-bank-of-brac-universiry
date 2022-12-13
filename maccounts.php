<-- Updated -->

<?php
$con = new mysqli('localhost','root','','bms');
define('bankname', 'Federal Bank of BRAC University');
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from customer where userID = '$_GET[userID]'"))
    {
      header("location:mindex.php");
    }
  } ?>
</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo 'Federal Bank of BRAC'; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="mindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">  <a class="nav-link" href="maccounts.php">Staff Accounts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php

if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into employee (empFirstName,empMidName,empLastName,empID,empEmail,empPassword,empSalary,branchId,designation) values ('$_POST[empFirstName]','$_POST[empMidName]','$_POST[empLastName]','$_POST[empID]','$_POST[empEmail]','$_POST[empPassword]','$_POST[empSalary]','$_POST[branchId]','cashier')"))
  {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from employee where empID ='$_GET[del]'");
}

  $array = $con->query("select empID,empEmail,empPassword,designation from employee where designation='cashier'");

 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    All Staff Accounts <button class="btn btn-outline-info btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add New Staff Account</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>Email</th>
          <th>Password</th>
          <th>Designation</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if ($array->num_rows > 0)
          {
            while ($row = $array->fetch_assoc())
            {
              echo "<tr>";
              echo "<td>".$row['empID']."</td>";
              echo "<td>".$row['empEmail']."</td>";
              echo "<td>".$row['empPassword']."</td>";
              echo "<td>".$row['designation']."</td>";
              echo "<td><a href='maccounts.php?del=$row[empID]' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
          }
         ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted">
    <?php echo 'Federal Bank of BRAC'; ?>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          <div class="form-group">
            <label for="empID" class="control-label">Employee ID</label>
            <input class="form-control" type="number" name="empID" id="empID" required placeholder="Employee ID">
          </div>
          <div class="form-group">
            <label for="empFirstName" class="control-label">First Name</label>
            <input class="form-control" type="text" name="empFirstName" id="empFirstName" required placeholder="First Name">
          </div>
          <div class="form-group">
            <label for="empMidName" class="control-label">Middle Name</label>
            <input class="form-control" type="text" name="empMidName" id="empMidName" required placeholder="Middle Name">
          </div>
          <div class="form-group">
            <label for="empLastName" class="control-label">Last Name</label>
            <input class="form-control" type="text" name="empLastName" id="empLastName" required placeholder="Last Name">
          </div>
          <div class="form-group">
            <label for="empEmail" class="control-label">Email</label>
            <input class="form-control" type="email" name="empEmail" id="empEmail" required placeholder="Email">
          </div>
          <div class="form-group">
            <label for="empPassword" class="control-label">Password</label>
            <input class="form-control" type="password" name="empPassword" id="empPassword" required placeholder="Password">
          </div>
          <div class="form-group">
            <label for="empSalary" class="control-label">Salary</label>
            <input class="form-control" type="number" name="empSalary" id="empSalary" required placeholder="Salary">
          </div>
          <div class="form-group">
            <label for="branchId">Branch ID</label>
            <input type="hidden" name="branchId" id="branchId">
            <select name="branchId" id="branchId">
              <option value="101">101-Mohakhali</option>
              <option value="201">201-Demra</option>
              <option value="301">301-Gulshan</option>
              <option value="401">401-Chittagong</option>
              <option value="501">501-Khulna</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>