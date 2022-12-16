<-- Updated -->


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
    if ($con->query("delete from account where account.userID = '$_GET[delete]'"))
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
        <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Staff Accounts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<div class="container">
<div class="card w-100 text-center shadowBlue">
  <div class="card-header">
    All accounts
  </div>
  <div class="card-body">
   <table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Holder Name</th>
      <th scope="col">Account No.</th>
      <th scope="col">Branch Name</th>
      <th scope="col">Current Balance</th>
      <th scope="col">Account type</th>
      <th scope="col">Contact</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i=0;
      $array = $con->query("select * from customer,branch,account where customer.branchID = branch.branchId AND customer.userID=account.userID and account.userID != '1'");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['userFirstName'] ?></td>
        <td><?php echo $row['accountID'] ?></td>
        <td><?php echo $row['branchName'] ?></td>
        <td>Tk.<?php echo $row['accBalance'] ?></td>
        <td><?php echo $row['accType'] ?></td>
        <td><?php echo $row['userEmail'] ?></td>
        <td>
          <a href="show.php?userID=<?php echo $row['userID'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="View More info">View</a>
          <a href="mnotice.php?userID=<?php echo $row['userID'] ?>" class='btn btn-primary btn-sm' data-toggle='tooltip' title="Send notice to this">Send Notice</a>
          <a href="mindex.php?delete=<?php echo $row['userID'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this account">Delete</a>
        </td>
        
      </tr>
    <?php
        }
      }
     ?>
  </tbody>
</table>
  <div class="card-footer text-muted">
    <?php echo 'Fedaral Bank of BRAC'; ?>
  </div>
</div>
</body>
</html>