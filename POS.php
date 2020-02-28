<?php
  session_start();
  if(!isset($_SESSION['Name'])|| $_SESSION['role']!="User"){
	  header("location:index.php");
  }
  $link=mysqli_connect("localhost","root","");
  mysqli_select_db($link,"restaurant_management");
  $sql="SELECT `Name` FROM `foods` ";
  $query=mysqli_query($link,$sql) or die(mysqli_error($query));
  $sql2="SELECT `name` FROM `drinks` ";
  $result=mysqli_query($link,$sql2) or die(mysqli_error($result));
?>
<!DOCTYPE html>
<html>
<head>
     <style type="text/css">
            body{background-color:white;}
            h1{color:black;
               text-align:center;
			   font-family:palatino linotype;
			   text-decoration:underline;}
		    table {border:3px solid black;
			       }
			
            td {background-color:2px dashed black;
			    }
            th  {padding:30px;
			     font-size:200%;
				 font-family:palatino linotype;
				 text-decoration:underline;}	
            input {color:green;}
            button{cursor: pointer; font-size: 20px;}
            li{
            	cursor: pointer;
                list-style: none;
            }

     </style>
   <title>
        Restaurant POS
   </title>
   <script type="text/javascript" src="js/jquery.js"></script>
 </head>
 <body>
   <a href="index.php"><button>Logout</button></a>
   <h1>Welcome <?php echo $_SESSION['Name']; ?> you are logged in as <?php echo $_SESSION['role']; ?></h1>
  <body>
  <table align="left" width="80%" bgcolor="orange" name="table1">
    <tr>
	   <th colspan="3">RESTAURANT POINT OF SALE</th>
	</tr>
	<tr>
	   <td>
	   	<label><h2><b><u>FOOD SECTION:</u></b></h2></label><br>
	   	<label for="Food"><b>SELECT FOOD:</b></label>
	   	<select  id="selectFood">
	   	<option value="">Select Food</option>
	   	<?php
	   	while($row=mysqli_fetch_assoc($query)){ 
	   	 ?>
	   	 <option value="<?= $row['Name'] ?>"><?= $row['Name'] ?></option>
	   	 <?php
	   	}
	   	 ?>
	   </select>
	   <label><b>QTY:</b></label>
	   <input id="qtyFood" type="number" name="" placeholder="Enter Quantity">
	   <br><br>
	   <button onclick="addFood()"><b>ADD FOOD</b></button>
	</td>
	   <td>
	   	<label><h2><b><u>DRINKS SECTION:</u></b></h2></label><br>
	   	<label for="Drink"><b>SELECT DRINK:</b></label>
	   	<select id="selectDrink">
	   	<option value="">Select Drink </option>
	   	<?php
	   	while($array=mysqli_fetch_assoc($result)){  
	   	?>
	   	<option value="<?= $array['name'] ?>"><?= $array['name'] ?></option>
	   	<?php
	   	}  
	   	?>
	   </select>
	   <label><b>QTY:</b></label>
	   <input id="qtyDrink" type="number" name="" placeholder="Enter Quantity">
	   <br><br>
	   <button onclick="addDrink()"><b>ADD DRINK</b></button>
	</td>
	</tr>
  </table>
  <table align="right" width="60" bgcolor="yellow" name="table2">
  <aside>
     <tr>
	     <th height="70">PAYMENT SECTION:</th>
	 </tr>
	 <tr>
	    <td height="70"><b>CASH:</b>     <input type="number" min="1.00" max="99999.00" step="any" placeholder="Enter cash Received"></td>
	 </tr>
	 <tr>
	    <td height="70"><b>MPESA:</b>    <input type="text" placeholder="Enter Transaction ID"></td>
	 </tr>
	 <tr>
	    <td height="70"><b>BALANCE:</b>  <input type="number" min="1.00" max="99999.00" step="any" >
	 </tr>
	 <tr>
	    <td height="70"><button><b>TOTAL</b></button>    <button><b>PRINT</b></button>  </td>
	 </tr>
	 
  </aside>
  </table>
  <table width=80% bgcolor="skyblue" name="table3">
      <tr>
      	<td>
      		<label><h2><u>ITEMS IN THE CART:</u></h2></label>
      		<ul id="list">
  	          <li></li>
            </ul>
      	</td>
	     <td height="300"><b>AMOUNT:</b> <input id="amount" type="number" name="Amount"></td>
		 <td height="300" ><button onclick="deleteLI()"><b>REMOVE SELECTED</b></button></td>
	  </tr>
  </table> 
</body>
</head>
</html>
<script type="text/javascript">
	var food = document.getElementById("selectFood");
	var drink = document.getElementById("selectDrink");
	function addFood(){
		            var qtyFood = document.getElementById("qtyFood").value;
		            var selectFood=food.options[food.selectedIndex].value;
		            if(qtyFood != "" && qtyFood != 0 && selectFood != "" ){
		            	var listNode= document.getElementById("list");
                        textNode = document.createTextNode(qtyFood +" "+ selectFood),
                        liNode= document.createElement("LI");

                        liNode.appendChild(textNode);
                        listNode.appendChild(liNode);


                        // Reset Food Quantity
                        refreshFood();
		            }
                    else{

                    	alert("Oops! Please select Food and put Quantity");
                    	refreshFood();
                    }
                    

            }
    function refreshFood(){
    	document.getElementById("qtyFood").value="";
    }
    function refreshDrink(){
    	document.getElementById("qtyDrink").value="";
    }
    function addDrink(){
    	            var qtyDrink = document.getElementById("qtyDrink").value;
		            var selectDrink=drink.options[drink.selectedIndex].value;
		            if(qtyDrink != "" && qtyDrink != 0 && selectDrink != "" ){
		            	var listNode= document.getElementById("list");
                        textNode = document.createTextNode(qtyDrink +" "+ selectDrink),
                        liNode= document.createElement("LI");

                        liNode.appendChild(textNode);
                        listNode.appendChild(liNode);


                        // Reset Drink Quantity
                        refreshDrink();
		            }
                    else{

                    	alert("Oops! Please select Drink and put Quantity");
                    	refreshDrink();
                    }
                    
    }
</script>

