<?php require './Sorting/sortimage.php'; 

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];



?>

<html>
    <head>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }




}
</style>


    </head>
    <body>

         <div class="topnav" id="myTopnav">
                <a href="galery.php" class="active">Home</a>
                <a href="Email.php">Email Notification</a>
                <a href="sorting.php">Sort</a>
                <a href="#about">About</a>
                <a href="SMS.php">SMS API</a>
                <a href="changepass.php">Change Password</a>
                 <a href="Index.php">Log-out</a>
           
              
            
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
                                        </a>

                 
        </div>



<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
        <br>
        <div class="container">
          <div class="table-responsive">
   
          <h6>Welcome, <?php echo htmlspecialchars($username); ?>!</h6>
          <p>You have successfully logged in. Sorting.</p>
          <table class="table table-hover w-75 mx-auto">
                 <thead class="table-dark">
                     <tr class="table-dark">
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                 </thead>
            <?php
                $pictures = mysqli_query($conn, "SELECT * FROM sorting2 WHERE Username = '$username'");
                $i = 1;

                foreach($pictures as $user) :
                    
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $user["Tname"]; ?></td>
                <td><img src="Image/<?php echo $user["Filename"]; ?>"width="150"></td>
                <td>
                    <a href="./Sorting/Edit.php?ID=<?php echo $user['ID']; ?>" class="btn btn-outline-info" style="width: 71px;">Edit</a>
                   
                    <form class="" action="" method="post">
                        <br>
                        <button type="submit" class="btn btn-outline-danger" name="submit" value= <?php echo $user['ID']; ?>>Delete</button>
                    </form>

                </td>
            </tr>
             <?php endforeach; ?>           

                  </table>
                                      <br>
                 
                                    
                                     <div class="d-flex justify-content-center">
                                         <a href="./Sorting/Add.php" class="btn btn-primary">Create</a>
                                     </div>
                 </div>
        </div>
    </body>
</html>