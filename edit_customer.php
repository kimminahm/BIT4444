<? require_once("connect_to_DB.php");  // inserts contents of this file here  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Edit Order</title>
	<link rel="stylesheet" href="hw2.css"/>
	<?connectDB();?>
	<?session_start();?>
</head>
<body>
	<h1><a href="http://tinyurl.com/mstgdqk"><img src="http://tinyurl.com/on58dwh" alt=" photo Untitled_zps8bfcff57.jpg"/></a></h1>
	<hr/>
	<?if($_SESSION['account'] == "manager"){print '
	<h4>Welcome '.$_SESSION['name'].'</h4>
	<div id="nav">
		<h3>Navigation - Edit Order</h3>
		<form name="form1" method="post" action="hw2.php">
			<div>
			<select name="page">
				<option value="home">Home</option>
				<option value="order">New Order Form</option>
				<option value="edit">Edit Order Form</option>
				<option value="customer">New Customer Form</option>
				<option value="edit_customer">Edit Customer</option>
				<option value="manage">Management Access Only</option>
				<option value="report">Itemized Sales Report</option>
				<option value="performance">Performance Report</option>
				<option value="business">Business Report</option>
			</select>
			<input type="hidden" name="acct" value="manager"/>
			</div>
			<p><input type="submit" value="Submit" /></p>
		</form>
		8:00 a.m. BIT 4444<br/>
		Group 6 Team Members:<br/>
			Minahm Kim<br/>
			Andrew Knittle<br/>
			Nathan Egbert<br/>
			Last Modified: 9/26/2014
	
	</div>';}
	else{print '

	<h4>Welcome '.$_SESSION['name'].' <form method="POST" action="signout.php"><input type="submit" value="Logout" /></form><br /></h4>
	<hr/>
	<div id="nav">
		<h3>Navigation - User Portal</h3>
		<form name="form1" method="post" action="hw2.php">
			<div>
			<select name="page">
				<option value="home">Home</option>
				<option value="order">New Order Form</option>
				<option value="edit">Edit Order</option>
				<option value="customer">New Customer Form</option>
				<option value="edit_customer">Edit Customer</option>
				<option value="item">Itemize sales report</option>
			</select>
			<input type="hidden" name="acct" value="user"/>
			</div>
			<p><input type="submit" value="Submit" /></p>
		</form>
		8:00 a.m. BIT 4444:<br/>
		Group 6 Team Members:<br/>
			Minahm Kim<br/>
			Andrew Knittle<br/>
			Nathan Egbert<br/>
			Last Modified: 9/26/2014
	</div>';}
	if(isset($_REQUEST['order_select'])){
		$strPerson = "SELECT * from customer WHERE cust_id=".$_POST['order'];
		$cust = mysqli_query($db, $strPerson) or die("Error in SQL statement: " . mysqli_error());
		$id = mysqli_fetch_array($cust);
		?><form name="form1" method="post" action="customer_result.php">
	<table>
		<tr>
			<td>Customer ID: </td>
			<td><input type='text' name="custID"  value="<?=$id['cust_id']?>">
			<td>Region: </td>
			<td><input type='text' name="region"  value="<?=$id['region_id']?>">
			</td>
							 

		</tr>
		<tr>
			<td> Company Name: </td>
			<td><input type='text' name="companyname"  value="<?=$id['cust_company']?>"> </td>

		</tr>
		<tr>
			<td> Contact Information:</td>
		</tr>
        <tr>
			<td> Last Name: </td>
			<td><input type='text' name="lastname"  value="<?=$id['cust_lname']?>">
			</td>

		</tr>
		<tr>
			<td> First Name: </td>
			<td><input type='text' name="firstname"  value="<?=$id['cust_fname']?>">
					</td>
		</tr>
		<tr>
		
			<td> Street Address 1: </td>
			<td><input type='text' name="address1"  value="<?=$id['cust_address']?>"></td>
			
		</tr>
		<tr>
			<td> Street Address 2: </td>
			<td><input type='text' name="address2"  value="address2"></td>
		</tr>
		<tr>
			<td> City: </td>
			<td><input type='text' name="city"  value="<?=$id['cust_city']?>"></td>
			<td> State: </td>
			<td><input type='text' name="state"  value="<?=$id['cust_state']?>">
					</td>
							
			<td> Zip: </td>
			<td><input type='text' name="zip"  value="<?=$id['cust_zip']?>"></td>
		</tr>
		<tr>
			<td> Phone: </td>
			<td><input type='text' name="phone"  value="<?=$id['cust_phone']?>"></td>
				
			<td> Fax: </td>
			<td><input type="text" name="fax" value="<?=$id['cust_fax']?>"/></td>
			<td> Email: </td>
			<td><input type="text" name="email" value="<?=$id['cust_email']?>"/></td>
		</tr>
    </table>
		<center>
			<p/><input type="submit" value="Submit"/>
			<input type="reset" value="Reset"/><p/>
		</center>
    </form><?
	}else{
		$strSQL = "SELECT cust_id, cust_fname, cust_lname FROM customer";
		$rs = mysqli_query($db, $strSQL) or die("Error in SQL statement: " . mysqli_error());
		
		?><div id="section">
		<form method="POST" action"edit_order.php">
		<?$row = mysqli_fetch_array($rs)?>
		<select name="order">
		<option value="<?= $row[0]?>"><? echo "Customer ID ".$row[0]." ".$row[1]." ".$row[2];?></option><?
		while($row = mysqli_fetch_array($rs)){?>
			<option value="<?= $row[0]?>"><? echo "Customer ID: ".$row[0]." ".$row[1]." ".$row[2];?></option>
		<?}?>
		</select>
		<br/>
		<br/>
		<input type="submit" value="Submit" name="order_select"></input>
		</form></div><?
	}
	?>
	<h5>Last Modified: 9/26/2014</h5>
	</body>
</html>