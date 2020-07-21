<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Canteen</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    h1{
      font-size: 50px;
      font-family: 'Damion', cursive;
      text-align: center;
    }
   .table{
    width: 60%;
    margin-left: 20%;
    margin-right:20%;
    margin-top: 3%;
   }
  
  </style>
  </head>
  <body>
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="" class="active">Cart</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <h1>SHOPPING CART</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Samosa</td>
          <td>15</td>
          <td><input type="number" name="qty" value=""></td>
          <td>400</td>
          <td><button><a href="#">Update</a></button>&nbsp;<button><a href="#">Delete</a></button></td>
        </tr>
        <tr>
          <td>Maggie</td>
          <td>20</td>
          <td>8</td>
          <td>500</td>
          <td><button><a href="#">Update</a></button>&nbsp;<button><a href="#">Delete</a></button></td>
        </tr>
        <tr>
          <td>Pasta</td>
          <td>40</td>
          <td>10</td>
          <td>400</td>
          <td><button><a href="#">Update</a></button>&nbsp;<button><a href="#">Delete</a></button></td>
        </tr>
        <tr>
          <td>Tea</td>
          <td>15</td>
          <td>5</td>
          <td>500</td>
          <td><button><a href="#">Update</a></button>&nbsp;<button><a href="#">Delete</a></button></td>
        </tr>
        <tr>
          <td>Total Amount:</td>
      </tbody>
    </table>
    <footer>
      <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 Your Canteen</p>
         </div>  
       </div>
    </footer> <!-- Footer content-->  
  </body>
</html>