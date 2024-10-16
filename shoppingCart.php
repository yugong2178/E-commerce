<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo"Need to Login first";
    header("location: login.php");
    exit;
}


$connect = mysqli_connect("localhost","root","","qs_product");

if(isset($_POST['add_to_cart'])){
    
    if(isset($_SESSION['cart'])){

        $session_array_id = array_column($_SESSION['cart'],"id");

        if(!in_array($_GET['id'],$session_array_id)){
         
            $session_array =array(
                'id' => $_GET['id'],
                "name" => $_POST['name'],
                "price" =>$_POST['price'],
                "quantity" => $_POST['quantity']
            );
    
            $_SESSION['cart'][]=$session_array;
        }

    }else{
        $session_array =array(
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity']
        );

        $_SESSION['cart'][]=$session_array;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <style>.col-md-6{
        text-align: center;
    }
	
    </style>
</head>
<body>
<?php include('include/navigation.php'); ?>
<br>
<br>
<br>
    <div class="container_fluid">
        <div class="col-md-12">
            <div class="row">
                
                <div class="col-md-6">
                    <br><br>
                    <h2 class="text-center">Shopping Cart</h2>
                    <br><br>
                    <div class="col-md-12">
                        <div class="row">
                    <?php

                    $query ="SELECT * FROM products";
                    $result =mysqli_query($connect,$query);

                    while($row =mysqli_fetch_array($result)){?>
                     <div class="col-md-4">
                        <form method ="post" action="shoppingCart.php?id=<?=$row['id']?>" >
                            <img  class = "center" src="img/<?=$row['img']?>" style='height: 150px;'>
                            <h5 class="text-center"><?=$row['name'];?></h5>
                            <h5 class="text-center">RM<?=number_format($row['price'],2);?></h5>
                            <input type="hidden" name="name" value="<?=($row['name']) ?>">
                            <input type="hidden" name="price" value="<?=($row['price']) ?>">
                            <input type="number" name="quantity" value="1" class= "form-control">
                            <input type="submit" name="add_to_cart" class="btn btn-warning btn-block my-2" value ="Add To Cart"> 
                        </form>
                     </div>
					
                    <?php }
                    ?>
                        </div>
                    </div>
                </div>
				<br><br><br><br><br><br>
                <div class="col-md-6">
                    <br><br>
                    <h2 class="text-center">Item Selected</h2>
                    <br><br>
                    <?php

                    $total =0;

                    $output="";

                    $output.="
                        <table class='table table-bordered table-striped'>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                    ";

                    if(!empty($_SESSION['cart'])){

                        foreach($_SESSION['cart'] as $key => $value){
                            $output .="
                                <tr>
                                    <td>".$value['id']."</td>
                                    <td>".$value['name']."</td>
                                    <td>RM".$value['price']."</td>
                                    <td>".$value['quantity']."</td>
                                    <td>RM".number_format((floatval($value['price']) * intval($value['quantity'])),2)."</td>
                                    <td>
                                        <a href='shoppingCart.php?action=remove&id=".$value['id']."'>
                                        <button class ='btn btn-danger btn-block'>Remove</button>
                                        </a>
                                    </td>
                                </tr>
                            ";

                            $total = $total + intval($value['quantity']) * floatval($value['price']);
                        }

                        $output .="
                            <tr>
                            <td colspan ='3'></td>
                            <td></b>Total Price</b></td>
                            <td>RM".number_format($total,2)."</td>
                            <td>
                                <a href='shoppingCart.php?action=clearall'>
                                <button class ='btn btn-warning'>Clear All</button>
                                </a>
                            </tr>
                            <tr>
                            <td colspan ='6' ><a href='payment.php'>
                            <button class ='center btn btn-danger btn-block'>Payment</button>
                               </a></td>
                                    
                        
                        ";
                    }

                     echo $output;
                     
                   
                    ?>
                </div>
            </div>   
        </div>
    </div>    


    <?php

    if(isset($_GET['action'])){
        if($_GET['action']== "clearall"){
            unset($_SESSION['cart']);
        }

        if($_GET['action']== "remove"){

            foreach($_SESSION['cart'] as $key =>$value){
                if($value['id']== $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }

    }
    ?>
   
    


</body>

   <?php include('include/footer.php'); ?>
</html>