<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); 
	session_start();
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	//$sql = "SELECT queue.queueNumber, transaction.transaction, queueingtransaction.queueingTransactionDate, queueingTransaction.queueingTransactionStatus, transaction.officeID_FK FROM queueingtransaction INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK WHERE queueingTransactionStatus = 'Waiting';";
	$result = mysqli_query($con, "call selectQueueTable('$staffID')");
	$resultCheck = mysqli_num_rows($result);
		while ($row = mysqli_fetch_assoc($result)) {
			$array[] = $row;
			echo "<tr><td>" . $row['queueNumber'] ."</td>"."<td>".$row['transaction']. "</td>"."<td>".$row['queueingTransactionDate'].  "</td></tr>";
		}
?>