<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	if (!empty($_POST))
 	{
		// Defining variables from form on the index.html page.
	   	$length = $_POST["length"];
		$width = $_POST["width"];
		$area = $length*$width; 			// Calculates the area.
		
                // Print available space
		echo "Avaliable length: ".$length."m<br />";	// prints the length
		echo "Available width: ".$width."m<br />"; 	// prints the width
		echo "Available area: ".$area."m2"; 		// prints the area
                
                // Generate Random user_id
                $length = 10;
                $user_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		
                // Connects to your Database 
 		mysql_connect("localhost", "root", "root") or die(mysql_error()); 
 		mysql_select_db("sproducts") or die(mysql_error()); 
 		$data = mysql_query("SELECT * FROM product WHERE area<= $area") 
 		or die(mysql_error()); 
		
 		Print "<form>";	// prints selection form of products that fit
 			while($info = mysql_fetch_array( $data )) 
 		{ 
			$sum_area = $area - $info['area'];
			$id = ($info['id'].'_'.$sum_area.'_'.$user_id);
			Print "<input type='radio' name='prod' value=$id />".$info['name']."<br />";
 		}  
 			Print "<input type='submit' value='submit' />";
 			Print "</form>";
	
	} else {

//===========================================================================================
// After first selection

  	  	// Display new screen after product is selected
		$answer = $_GET['prod']; // Look up answer
		list($id, $area, $user_id) = explode("_", $_GET['prod'], 3); // separate the values
                





// Save product selection for listing all products
// Get selected product from url as $id
// Insert into user $id VALUES +1

$dbConnection = mysqli_connect('localhost', 'root', 'root', 'sproducts');

$query = "INSERT INTO `user` (`user_id`) VALUES ('$user_id') ON DUPLICATE KEY UPDATE user_id = user_id";

if (mysqli_query($dbConnection, $query)) {
    echo "";
} else {
    echo "Error occurred: " . mysqli_error($dbConnection);
}

    // Add Column for the ID the user has chosen if it does not exist
    function addColumnIfItDoesNotExist() {
        //this query checks for the new column
        $query = ("SHOW COLUMNS ".
                  "FROM user ".
                  "LIKE '$id'");
        $result = mysql_query($query)  
          or die("select table user ".
                 "in addColumnIfItDoesNotExist() not successful: ".
          mysql_error());
        $rarray = mysql_fetch_array($result);
        if (NULL == $rarray[0]) {
          //here are the specifics for your new column, 
          //  both the datatype and the position in the table
          $query = ("ALTER TABLE user ".
                    "ADD COLUMN $id INT(11) unsigned NOT NULL DEFAULT '0'".
                    "AFTER user_id;");
          $result = mysql_query($query) 
            or die("altering table user not successful: ".
            mysql_error());      
        }
        return;
      }
     // echo \addColumnIfItDoesNotExist();

$query = "UPDATE user SET $id = $id + 1 WHERE user_id= $user_id";       
                
                
                
		

                

// Connect to your Database
		mysql_connect("localhost", "root", "root") or die(mysql_error()); 
 		mysql_select_db("sproducts") or die(mysql_error()); 
 		$data = mysql_query("SELECT * FROM product WHERE id= $id") 
 		or die(mysql_error());
		
		// prints selected products by finding match by id in db.
 			while($info = mysql_fetch_array( $data )) 
 		{ 
			$name = $info['name'];
			echo "Selected Products: ";
			echo $name;
			echo "; <br />";
 		}  
		// Print available space
		echo "Available space: ".$area." m2<br />";//see how to display power symbol with html
                
                // Connects to your Database 
 		mysql_connect("localhost", "root", "root") or die(mysql_error()); 
 		mysql_select_db("sproducts") or die(mysql_error()); 
 		$data = mysql_query("SELECT * FROM product WHERE area<= $area") 
 		or die(mysql_error()); 
		
 		Print "<form>";	// prints selection form of products that fit
 			while($info = mysql_fetch_array( $data )) 
 		{ 
			$sum_area = $area - $info['area'];
			$id = ($info['id'].'_'.$sum_area.'_'.$user_id);
			Print "<input type='radio' name='prod' value=$id />".$info['name']."<br />";
 		}  
 			Print "<input type='submit' value='submit' />";
 			Print "</form>";

    		
	}
        
        
        
  
