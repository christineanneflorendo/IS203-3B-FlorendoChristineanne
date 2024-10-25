<?php
require('./database.php');

if (isset($_POST['delete'])){
    $deleteId = $_POST['deleteID'];

    $querrydelete = "DELETE FROM form WHERE id = $deleteId";
    $sqldelete = mysqli_query($connection,$querrydelete);

    echo '<script>alert("Succesfully Deleted")</script>';
    echo '<script>window.location.href = "/GOMEZ/Index.php"</script>';
}

?>