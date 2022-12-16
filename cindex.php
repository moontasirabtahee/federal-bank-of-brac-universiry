<?php
session_start();
if(!isset($_SESSION['cashId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Federal Bank of BRACU</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php $note ="";
    // if (isset($_POST['withdrawOther']))
    // { 
    //   $accountNo = $_POST['otherNo'];
    //   $checkNo = $_POST['checkno'];
    //   $amount = $_POST['amount'];
    //   if(setBalance($amount,'debit',$accountNo))
    //   $note = "<div class='alert alert-success'>successfully transaction done</div>";
    //   else
    //   $note = "<div class='alert alert-danger'>Failed</div>";

    // }
    if (isset($_POST['withdraw']))
    {
      $array2 = $con->query("select * from account ac,customer cr where ac.userID = cr.userID and accountID  = '$_POST[otherNo]'");
        // $array3 = $con->query("select * from account where accountID  = '$_POST[otherNo]'");  
      if ($array2->num_rows > 0) 
          $row2 = $array2->fetch_assoc();
          echo ($row2['accBalance']);
          if($_POST['amount']<$row2['accBalance']-100){

          setBalance($_POST['amount'],'debit',$_POST['otherNo']);
          makeTransactionCashier('withdraw',$_POST['amount'],1000000000,$_POST['otherNo']);
          $note = "<div class='alert alert-success'>successfully transaction done</div>";}
      else{
        $note = "<div class='alert alert-success'>Account Balance is less then 100</div>";
      }

}
    if (isset($_POST['deposit']))
    {
      setBalance($_POST['amount'],'credit',$_POST['otherNo']);
      makeTransactionCashier('deposit',$_POST['amount'],1000000000,$_POST['otherNo']);
      $note = "<div class='alert alert-success'>successfully transaction done</div>";

    }
   ?>
</head>
<body style="background-size: 100%" class="bg-gradient-seconday">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="cindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item"><a class="nav-link" href="caccounts.php">Account Setting</a></li> -->
     <!--  <li class="nav-item"><a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item"><a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->
    </ul>
    <?php include 'csideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<div class="row w-100" style="padding: 11px">
  <div class="col">
    <div class="card text-center w-75 mx-auto">
  <div class="card-header">
    Account Information
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $note; ?>
      <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Enter Account Number</h5>
            <input type="text" name="otherNo" class="form-control " placeholder="Enter  Account number" required>
            <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info</button>
          </div>
      </form>
    </p>
    <?php if (isset($_POST['get'])) 
      {
        $array2 = $con->query("select * from account ac,customer cr where ac.userID = cr.userID and accountID  = '$_POST[otherNo]'");
        // $array3 = $con->query("select * from account where accountID  = '$_POST[otherNo]'");
        {
          if ($array2->num_rows > 0) 
          { $row2 = $array2->fetch_assoc();
            echo "<div class='row'>
                  <div class='col'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountID]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[userFirstName] $row2[userMidName] $row2[userMidName]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='$row2[accType]' readonly required>
                     
                  
                  </div>
                  <div class='col'>
                    Bank Balance
                    <input type='text' class='form-control my-1'  value='Rs.$row2[accBalance]' readonly required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount' required>
                   <button type='submit' name='withdraw' class='btn btn-success btn-bloc btn-sm my-1'> Withdraw</button>
                   <button type='submit' name='deposit' class='btn btn-success btn-bloc btn-sm my-1'> Deposit</button>

                   </form>
                  </div>
                </div>";}
          // }elseif ($array3->num_rows > 0) {
          //  $row2 = $array3->fetch_assoc();
          //   echo "
          //   <div class='row'>
          //         <div class='col'>
                  
          //           Account No.
          //           <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
          //           Account Holder Name.
          //           <input type='text' class='form-control' value='$row2[name]' readonly required>
          //           Account Holder Bank Name.
          //           <input type='text' class='form-control' value='".bankname."' readonly required>Bank Balance
          //           <input type='text' class='form-control my-1'  value='Rs.$row2[balance]' readonly required>
                     
                  
          //         </div>
          //         <div class='col'>
          //           Transaction Process.
          //           <form method='POST'>
                     
          //           <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
          //           <input type='hidden' value='$row2[id]' name='userId' class='form-control ' required>
          //           <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
          //           <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for withdraw' max='$row2[balance]' required>
          //          <button type='submit' name='withdraw' class='btn btn-primary btn-bloc btn-sm my-1'> Withdraw</button></form><form method='POST'> 
          //           <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
          //           <input type='hidden' value='$row2[id]' name='userId' class='form-control ' required>
          //          <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
          //           <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for deposit'  required>

          //          <button type='submit' name='deposit' class='btn btn-success btn-bloc btn-sm my-1'> Deposit</button></form>
          //         </div>
          //       </div>
          //   ";
          // }
          else
            echo "<div class='alert alert-success w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
        }
  } 
      ?>
  </div>
  <div class="card-footer text-muted">
    <?php echo bankname; ?>
  </div>
</div>
  </div>
  
</div>
</body>
</html>