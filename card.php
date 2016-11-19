<?php 
session_start();
error_reporting(0);
$connect = mysqli_connect("localhost","root","","use");
if (isset($_POST["add_to_card"]))
{
	
	if (isset($_SESSION["shopping_cart"])){
		
		
		if (!in_array($_GET["id"],$item_array_id))
		{
			
		$count = count($_SESSION["shopping_cart"])	;
		$item_array = array(
				'item_id' =>$_GET["id"],
				'item_name' =>$_POST["hidden_name"],
		 		'item_price' =>$_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"]
				);
			$_SESSION["shopping_cart"] [$count] =$item_array;
		}
		else {
			
			echo  '<script>alert ("Item Already Added")</script>'; 
			echo  '<script> window.location = "card.php"</script>';
			
		
	}
	}
	else {
		$item_array = array(
				'item_id' =>$_GET["id"],
				'item_name' =>$_POST["hidden_name"],
				'item_price' =>$_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"],
				
				);
				
			$_SESSION["shopping_cart"][0] = $item_array;
				
		
	}
}

if (isset($_GET["action"])){
	
	if ($_GET["action"] == "delete"){
		
		
		foreach ($_SESSION["shopping_cart"] as  $keys => $values){
			
			
			if ($values["item_id"] == $_GET["id"]){
				
				unset($_SESSION["shopping_cart"] [$keys]);
				echo '<script>alert("item removed")</script>';
				echo '<script>window.location="card.php"</script>';
			}
		}
	}
	
	
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>gangula.com | Catalogue</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Dynalight_400.font.js" type="text/javascript"></script>
<script src="js/FF-cash.js" type="text/javascript"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="js/hover-image.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.bxSlider.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#slider-2').bxSlider({
        pager: true,
        controls: false,
        moveSlideQty: 1,
        displaySlideQty: 4
    });
    $("a[data-gal^='prettyPhoto']").prettyPhoto({
        theme: 'facebook'
    });
});
</script>
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->

</head>
<body id="page3">
<!--==============================header=================================-->
<header>
  <div class="row-top">
    <div class="main">
      <div class="wrapper">
        <h1><a href="index.html">Catering<span>.com</span></a></h1>
        <nav>
          <ul class="menu">
            <li><a href="index.html">About</a></li>
            <li><a href="menu.html">Menu</a></li>
            <li><a class="active" href="catalogue.html">Catalogue </a></li>
            <li><a href="shipping.html">Shipping</a></li>
            <li><a href="faq.html">FAQ </a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>



  

  <br/>
  <div class = "container" style = "width:700px;">
  <h3 align = "center" style = "color:blue;"><b><u>SHOPPING CARD</u></b></h3><br/>
  <?php
$query = "SELECT * FROM tblproduct ORDER BY id ASC";
$result= mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0 ){
	
	while ($row = mysqli_fetch_array($result)){
		
		?>
		
		

	
	


	<div class="col-md-4">
	<form method="post" action="card.php?action=add&id=<?php echo $row["id"]; ?>">
	<div style = "border:1px solid #333;background-color:#f1f1f1;border-rdius:5px;">
	<img src="<?php echo $row["image"]; ?>" class = "img-responsive"/><br/>
	<h4 class ="text-info"><?php echo $row["name"];  ?></h4>
	<h4 class ="text-danger">$ <?php echo $row["price"]; ?></h4>
	<input type = "text" name = "quantity" class= "form-control" value = ""/>
	<input type = "hidden" name ="hidden_name" value ="<?php echo $row["name"]; ?>"/>
	<input type = "hidden" name ="hidden_price" value ="<?php echo $row["price"]; ?>"/>
	<input type = "submit" name = "add_to_card" style = "margin-top:5px;" class ="btn btn-success" value= "Add to card"/>
	
	</div>
	
	</form>
</div>
	
	<?php 
	}
}
	
	
	?>
	<div style = "clear:both"></div>
	<br/>
	<h3 style = "color:black;font-size:2.5em;"><b>ORDER DETAILS</b></h3>
	<div class = "table-responsive">
	<table class = "table table-bordered">
	<tr>
	<th width = "20%" style = "color:red;font-size:1.5em;"><b>ITEM NAME</b></th>
	<th width = "10%"style = "color:red;font-size:1.5em;"><b>QUANTITY</b> </th>
	<th width = "20%"style = "color:red;font-size:1.5em;"><b>PRICE</b> </th>
	<th width = "15%"style = "color:red;font-size:1.5em;"><b>TOTAL</b> </th>
	<th width = "5%"style = "color:red;font-size:1.5em;"><b>ACTION</b> </th>
	
	
	
	
	
	</tr>
	
	
	<?php 
	if (!empty($_SESSION["shopping_cart"]))
	{
		
		$total = 0;
		foreach($_SESSION["shopping_cart"] as $keys => $values){
		
		
		
		
	
	
	
	
	
	
	?>
	<tr>
	<td><?php echo  $values ["item_name"] ;?></td>
		<td><?php echo  $values ["item_quantity"] ;?></td>
		<td>$<?php echo  $values ["item_price"] ;?></td>
		<td> <?php echo number_format($values["item_quantity"] * $values["item_price"],2);?></td>
		<td><a href = "card.php?action=delete&id=<?php  echo $values["item_id"];?>"><span class ="text-danger">Remove</span></a></td>
	<td><?php echo  $values ["total"] ;?></td>
	
	
	</tr>
	<?php 
		
	$total = $total + ($values["item_quantity"] * $values["item_price"]);
		} 
		?>
		 <tr>
		<td  colsapan = "3" align = "right">Total</td>
		<td align = "right"> $ <?php echo number_format($total,2);?></td>
		<td></td>
	
		
		
		</tr>
		<?php 
		
	} 
	?>
		
		
	</table>
	
	</div>
	
	
	
	
	
	
	
	
	</div>

	
   
  
  
<footer>
  <div class="main">
    <div class="aligncenter"> <span>Copyright &copy; <a href="#">Domain Name</a> All Rights Reserved</span> Design by <a target="_blank" href="http://www.templatemonster.com/">TemplateMonster.com</a> </div>
  </div>
</footer>
<script type="text/javascript">Cufon.now();</script>
</body>
</html>
  
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  
  








