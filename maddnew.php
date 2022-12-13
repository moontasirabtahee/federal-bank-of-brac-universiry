<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Federal Bank of BRACU</title>
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
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo 'Fedaral Bank of BRAC'; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="mindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Staff Accounts</a></li>
      <li class="nav-item active">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
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
  if (!$con->query("insert into customer (userID, userEmail, userPassword, userFirstName, userMidName, userLastName, city, myaddress, branchID) values ('$_POST[userID]', '$_POST[userEmail]', '$_POST[userPassword]', '$_POST[userFirstName]', '$_POST[userMidName]','$_POST[userLastName]','$_POST[city]','$_POST[myaddress]','$_POST[branchId]')"))
  {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from account where account.userID ='$_GET[del]'");
}
  
  
 ?>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
   New Account Forum (Customer Details)
  </div>
  <div class="card-body bg-dark text-white">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST">
          <th>ID</th>
          <td><input class="form-control" type="number" name="userID" id="userID" required placeholder="User ID"></td>
          <th>Email</th>
          <td><input class="form-control" type="email" name="userEmail" id="userEmail" required placeholder="User Email"></td>
          <th>Password</th>
          <td><input class="form-control" type="password" name="userPassword" id="userPassword" required placeholder="User Password"></td>
        </tr>

        <tr>
          <th>First Name </th>
          <td><input class="form-control" type="text" name="userFirstName" id="userFirstName" required placeholder="User First Name"></td>
          <th>Mid Name</th>
          <td><input class="form-control" type="text" name="userMidName" id="userMidName"  required placeholder="User Middle Name"></td>
          <th>Last Name</th>
          <td><input class="form-control" type="text" name="userLastName" id="userLastName" required placeholder="User Last Name"></td>
          
        </tr>
        <tr>
          <th>City</th>
          <td><input class="form-control" type="text" name="city" id="city" required placeholder="User City"></td>
          <th>Address</th>
          <td><input class="form-control" type="text" name="myaddress" id="myaddress" required placeholder="User Address"></td>
          <th>Branch</th>
          <td>
            <label for="branchId"></label>
            <input type="hidden" name="branchId" id="branchId">
            <select name="branchId" id="branchId">
              <option value="101">101-Mohakhali</option>
              <option value="201">201-Demra</option>
              <option value="301">301-Gulshan</option>
              <option value="401">401-Chittagong</option>
              <option value="501">501-Khulna</option>
            </select>
          </td> 
        </tr>
        <tr>
          <td colspan="4">
            <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Save Account</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Reset</button></form>
          </td>
        </tr>
      </tbody>
    </table>
    

  </div>
  <div class="card-footer text-muted">
    <?php echo 'Fedaral Bank of BRAC'; ?>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          Enter Details
         <input class="form-control w-75 mx-auto" type="empEmail" name="empEmail" required placeholder="Email">
         <input class="form-control w-75 mx-auto" type="empPassword" name="empPassword" required placeholder="Password">
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