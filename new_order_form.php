<? require_once("connect_to_DB.php");  // inserts contents of this file here  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>New Order Form/Edit Order Form</title>
	<link rel="stylesheet" href="hw2.css"/>
	<?
	connectDB();
	session_start();?>
	<script src="validation.js"></script>
	<script src="jquery.js"></script>
<!-- Uses the "rel" attribute to identify a related HTML elt into which AJAX data can be loaded.... -->
<script type="text/javascript">
$(document).ready(function(){

		$("select").change(function(){

				var x = $("#"+$(this).attr("rel"));
	
				if ($(this).val()==""){
					x.val("");
				return;
			}else{
				x.load("getemp.php?q="+$(this).val(), function(responseTxt){
					x.val(responseTxt);
				});			
			};
			
		});
});
</script>

</head>
<body>
	<h1><a href="http://tinyurl.com/mstgdqk"><img src="http://tinyurl.com/on58dwh" alt=" photo Untitled_zps8bfcff57.jpg"/></a></h1>
	<?
		include ('navbar_func.php');
		echo navbar();
	
	// Establish a connection with the data source, and define the SQL
try{
	$strSQL = "SELECT product_id, product_name, product_cost FROM product";
	$rs = @mysqli_query($db, $strSQL);  //or die("Error in SQL statement: " . mysqli_error());  
	if(!$rs){throw new Exception("Could not connect to Database.");}
	$row = mysqli_fetch_array($rs);
	}
	catch (Exception $e){
		// redirect to a custom error page (PHP or ASP.NET or …)
		header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
		}
	// Establish a connection with the data source, and define the SQL for the orders
	
	$newID = 101;
	$rndSQL = "Select order_id FROM salesorder WHERE order_id = ".$newID;
	while(mysqli_num_rows(mysqli_query($db, $rndSQL)) > 0){
		echo "<script>console.log($newID)</script>";
		$newID++;
		$rndSQL = "Select order_id FROM salesorder WHERE order_id =". $newID;
	}
	?>
    <?$today = date("F j, Y");?>
    <form name="orderform" method="post" action="new_order_result.php" onsubmit="return validate_order()">
		<table>
			<tr>
				<td>Order Number:</td>
				<td><label><?=$newID?></label>
				<input type="hidden" id="order" type="text" name="ordernumber" value="<?=$newID?>"></td>
				<td>Order Date:</td>
				<td><label type="text" name="orderdate" value="<?=$today?>"><?=$today?></label></td>
				<input type="hidden" name="orderdate" value="<?=$today?>"/>
			</tr>
			<tr>
				<td> Customer:</td>
				<td><input id="customer"type="text" name="customer" value=""/></td>
			</tr>
			<tr>
				<td>Sale Agent:</td>
				<td><input id="salesagent" type="text" name="salesagent" value=""/></td>
				<td>Order Status:</td>
				<td><input id="orderstatus" type="text" name="orderstatus" value=""/></td>
			</tr>
		</table>
        <table border = "1">
			<tr>
				<th>Product</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>
			<?
			try{
			$rs = @mysqli_query($db, $strSQL);  //or die("Error in SQL statement: " . mysqli_error());  
			if(!$rs){throw new Exception("Could not connect to Database.");}
			}
			catch (Exception $e){
				// redirect to a custom error page (PHP or ASP.NET or …)
				header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
			}
			?>
			
			
			<?for($x=0; $x <= 19; $x++)
			//just needs to post quantity not which
				{?>
					<tr>
					<td>
					<select rel="P<?=$x?>" name="P<?=$x?>" onchange="showUser(this.value)">
						<option value="">Choose the product you'd like to purchase:</option>
						<?while($row = mysqli_fetch_array($rs)){?>
						<?print '<option value="'.$row[0].'">' . $row[1] . '</option>' . "\n";}//This is uses the datebase values?>
					</select>
					</td>
					<td>
					<input id="P<?=$x?>" type="text"name="M<?=$x?>" value="<?=$row[1]?>"></input>
					<label value="$row[1]">
							<?print '<option value="' . $row[0] .'">' . $row[1] . '</option>' . "\n";//This is uses the datebase values?>
					</td>
					<td><select name="Q<?=$x?>"  value="$row[1]">
							<?for($i = 0; $i < 10; $i++){
							print "<option value=$i>$i</option>";}//This uses the datebase values?>
							</select></td>
					</tr>
					
					<? try{
							$rs = @mysqli_query($db, $strSQL);  //or die("Error in SQL statement: " . mysqli_error());  
							if(!$rs){throw new Exception("Could not connect to Database.");}
						}
					catch (Exception $e){
							// redirect to a custom error page (PHP or ASP.NET or …)
							header("Location: error.php?msg=" . $e->getMessage() . "&line=" . $e->getLine());
					}?>
			  <?}?>
		</table> 
		<center>
			<input type="submit" value="Submit"/>
			<input type="reset" value="Reset"/>
		</center>
    </form>
</body>
</html>
