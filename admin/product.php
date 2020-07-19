<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Product</title>
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/templatemo-style.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
<style>
  body{
    /*margin: 6% 20% 10% 20%;
    background-image: url('../images/fastfood.jpg');*/
    font-family: Roboto, Arial, Helvetica Neue, sans-serif;
    background-color: #dec28a;

  }
* {
  box-sizing: border-box;
}
h2{
  color: black;
  font-weight: normal;
  font-size: 40px;
  text-align: center;
  margin: 10px 0 22px 0;
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=file]{
	padding: 12px;
  width: 100%;
	border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.border {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
    width: 80%;
    margin: auto;
    box-shadow: 0 4px 8px 20px rgba(0,0,0,0.2);
    transition: 0.3s;
}


.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}
form{
    padding: 2em;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>
<div class="border">
<h2>Form</h2>
  <form>
    <div class="row">
      <div class="col-25">
        <label for="category">Select Category</label>
      </div>
      <div class="col-75">
         <select id="category" >
            	<option value="">Select the category</option>
            	<option name="Cooker" >Cooker</option>
            	<option name="Pan">Pan</option>
            	<option name="Tawa" >Tawa</option>
            	<option name="Bottles">Bottles</option>
            	<option name="Induction">Induction</option>
            </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="item_name">Item Name</label>
      </div>
      <div class="col-75">
        <input type="text"  name="item_name" placeholder="Your product name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="item_price">Item Price</label>
      </div>
      <div class="col-75">
        <input type="text"  name="price" placeholder="Your Item price..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="item_desc">Item Description</label>
      </div>
      <div class="col-75">
        <textarea id="description" name="describe" placeholder="Item description.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="item_picture">Item Picture</label>
      </div>
      <div class="col-75">
        <input type="file"  name="picture" placeholder="Choose File">
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="item_available">Item Available</label>
      </div>
      <div class="col-75">
         <select id="Available" >
            	<option value="">Available or not</option>
            	<option name="Avail" >Available</option>
            	<option name="not-avail">Not Available</option>
            </select>
      </div>
    </div><br>
   <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

</body>
</html>
