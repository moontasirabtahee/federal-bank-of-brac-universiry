<?php 
    $con = new mysqli('localhost','root','','bms');
    define('bankname', 'Federal Bank of BRAC University',"");
    $uid = '';
    if(isset($_SESSION['userId'])){
    $uid = $_SESSION['userId'];
    $flag = "user";}
    if(isset($_SESSION['cashId'])){
    $uid = $_SESSION['cashId'];
    $flag = "cash";}
    if(isset($_SESSION['managerId'])){
    $uid = $_SESSION['managerId'];
    $flag = "manager";}
    $userData = [];
    if(!empty($uid) and $flag == "user"){
      $ar = $con->query("select * from customer cs,account ac,branch br where cs.userID = ac.userID and cs.branchId = br.branchId");
      $userData = $ar->fetch_assoc();
    }

    if(!empty($uid) and $flag == "cash"){
      $ar = $con->query("Select * from employee em , branch br where em.branchId = br.branchId ");
      $userData = $ar->fetch_assoc();
    }

    if(!empty($uid) and $flag == "manager"){
      $ar = $con->query("Select * from employee em , branch br where em.branchId = br.branchId ");
      $userData = $ar->fetch_assoc();
    }
?>
<script type="text/javascript">
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>