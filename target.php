<?php
/*
 *Ezekiel Iyanobor
 */

require("libs/config.php");
$page = easy_decrypt($_GET["id"]);
$pageDetails = getPageDetailsByName($page);
include("header.php");
?>
<?php
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page!";
  header("location: error.php");    
}
?>
<?php

/**
 * Function to query information based on 
 * a parameter: in this case, e.
 *
 */

if (isset($_POST['submit'])) 
{
	
	try 
	{
		

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM target
						WHERE aeid= :aeid";

		$aeid = $_POST['aeid'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
		
<?php  
if (isset($_POST['submit'])) 
{
	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>AEID</th>
					<th>Target_ID</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["aeid"]); ?></td>
				<td><?php echo escape($row["target_id"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['aeid']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Find target based on aeid</h2>

<form method="post">
	<label for="aeid">AEID</label>
	<input type="text" id="aeid" name="aeid">
	<input type="submit" name="submit" value="View Results">
</form>


<div class="row main-row">
    <div class="8u">
        <section class="left-content">
             <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>
    <head>
 <meta charset = "UTF-8">
 <title>target.php</title>
 <style type = "text/css">
  table, th, td {border: 1px solid black};
 </style>
 </head>
 <body>
 <p>
 <?php
  try {
  $con= new PDO('mysql:host=localhost;dbname=chemtox', "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM target";
  //first pass just gets the column names
  print "<table>";
  $result = $con->query($query);
  //return only the first row (we only need field names)
  $row = $result->fetch(PDO::FETCH_ASSOC);
  print " <tr>";
  foreach ($row as $field => $value){
   print " <th>$field</th>";
  } // end foreach
  print " </tr>";
  //second query gets the data
  $data = $con->query($query);
  $data->setFetchMode(PDO::FETCH_ASSOC);
  foreach($data as $row){
   print " <tr>";
   foreach ($row as $name=>$value){
   print " <td>$value</td>";
   } // end field loop
   print " </tr>";
  } // end record loop
  print "</table>";
  } catch(PDOException $e) {
   echo 'ERROR: ' . $e->getMessage();
  } // end try
 ?>
 </p>
 </body>
    </div>
  
</div>
<?php
include("footer.php");
?>
