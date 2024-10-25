<?php



require('./database.php');



if(isset($_POST['create'])){

    $Fname = $_POST['Fname'];

    $Mname = $_POST['Mname'];

    $Lname = $_POST['Lname'];



    $querryCreate = "INSERT INTO form VALUES(null, '$Fname', '$Mname', '$Lname')";

    $sqlCreate = mysqli_query($connection, $querryCreate);



    echo '<script>alert("Successfully Created")</script>';

    echo '<script>window.location.href = "/gomez/Index.php"</script>';

}



?>