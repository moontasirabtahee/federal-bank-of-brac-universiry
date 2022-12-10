<?php 
function setBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','bms');
	$array = $con->query("select * from account where accountID='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['accBalance'] + $amount;
		// echo  "bartese";
		return $con->query("update account set accBalance = '$balance' where accountID  = '$accountNo'");
	}else
	{
		$balance = $row['accBalance'] - $amount;
		return $con->query("update account set accBalance = '$balance' where accountID  = '$accountNo'");
	}
}
function setOtherBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','bms');
	$array = $con->query("select * from account where accountID='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update account set accBalance = '$balance' where accountID = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update account set accBalance = '$balance' where accountID = '$accountNo'");
	}
}
function makeTransaction($action,$amount,$other)
{
	$con = new mysqli('localhost','root','','bms');
	if ($action == 'transfer')
	{
		return $con->query("insert into accounttransaction (theAction,debit,outerAcc,userId) values ('transfer','$amount','$other','$_SESSION[userId]')");
	}
	if ($action == 'withdraw')
	{
		return $con->query("insert into accounttransaction (theAction,debit,outerAcc,userId) values ('withdraw','$amount','$other','$_SESSION[userId]')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into accounttransaction (theAction,credit,outerAcc ,userId) values ('deposit','$amount','$other','$_SESSION[userId]')");
		
	}
}
function makeTransactionCashier($action,$amount,$other,$userId)
{
	$con = new mysqli('localhost','root','','bms');
	if ($action == 'transfer')
	{
		return $con->query("insert into accounttransaction(theAction,debit,checkNo ,userId) values ('transfer','$amount','$other','$userId')");
	}
	if ($action == 'withdraw')
	{
		return $con->query("insert into accounttransaction(theAction,debit,checkNo ,userId) values ('withdraw','$amount','$other','$userId')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into accounttransaction(theAction,credit,checkNo ,userId) values ('deposit','$amount','$other','$userId')");
		
	}
}
 ?>