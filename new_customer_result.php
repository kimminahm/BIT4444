<? require_once("connect_to_DB.php");  // inserts contents of this file here  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>New Customer Processed</title>
	<link rel="stylesheet" href="hw2.css"/>
	<?session_start();
	connectDB();?>
</head>
<body>
	<h1><a href="http://tinyurl.com/mstgdqk"><img src="http://tinyurl.com/on58dwh" alt=" photo Untitled_zps8bfcff57.jpg"/></a></h1>
	<?
		include ('navbar_func.php');
		echo navbar();
	?>
	<?
		$customer = $_POST['custID'];
		$region = $_POST['region'];
		$company = $_POST['companyname'];
		$lname = $_POST['lastname'];
		$fname = $_POST['firstname'];
		$add1 = $_POST['address1'];
		$add2 =$_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$phone = $_POST['phone'];
		$fax = $_POST['fax'];
		$email = $_POST['email'];
	?>
	<table>
		<tr>
			<td>Customer ID: </td>
			<td><?print $customer?></td>
			<td>Region: </td>
			<td><?print $region?></td>
		</tr>
		<tr>
			<td> Company Name: </td>
			<td><?print $company?></td>
		</tr>
		<tr>
			<td> Contact Information:</td>
		</tr>
        <tr>
			<td> Last Name: </td>
			<td><?print $lname?></td>
		</tr>
		<tr>
			<td> First Name: </td>
			<td><?print $fname?></td>
		</tr>
		<tr>
			<td> Street Address 1: </td>
			<td><?print $add1?></td>
		</tr>
		<tr>
			<td> Street Address 2: </td>
			<td><?print $add2?></td>
		</tr>
		<tr>
			<td> City: </td>
			<td><?print $city?></td>
			<td> State: </td>
			<td><?print $state?></td>
			<td> Zip: </td>
			<td><?print $zip?></td>
		</tr>
		<tr>
			<td> Phone: </td>
			<td><?print $phone?></td>
			<td> Fax: </td>
			<td><?print $fax?></td>
			<td> Email: </td>
			<td><?print $email?></td>
		</tr>
    </table>
	<?
	$check = "SELECT cust_id FROM customer WHERE cust_id=$customer";
	$cresult = mysqli_query($db, $check);
	if(mysqli_num_rows($cresult)===0){
		$sql = "INSERT INTO customer (cust_id, cust_company, cust_lname, cust_fname, cust_address, cust_city, cust_state, cust_zip
		, region_id, cust_phone, cust_fax, cust_email) VALUES ('".$customer."', '".$company."', '".$lname."', '".$fname."', '".$add1."', '".$city."', '".$state."',
		'".$zip."', '".$region."', '".$phone."', '".$fax."', '".$email."')";
		if (mysqli_query($db, $sql)) 
		{
			echo "Record Insert successfully<br/>";
		}	 
		else 
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
	}else{
		echo "Value already exists <br/>";
	}?>
	<form method="post" action="hw2.php">
		<input type="hidden" name="page" value="home"/>
		</br>
		<input type="submit" value="Return"/>
	</form>
</body>
</html>