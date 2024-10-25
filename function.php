<?php
$conn = mysqli_connect("localhost", "root", "", "crud");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "add") {
        add();
    } elseif ($_POST["submit"] == "edit") {
        edit();
    } elseif ($_POST["submit"] == "delete") {
        delete();
    }
}

function add() {
    global $conn;

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $filename = $_FILES["file"]["name"];
    $tmpName = $_FILES["file"]["tmp_name"];
    $newfilename = uniqid() . '_' . $filename; // Generate a unique filename

    if (move_uploaded_file($tmpName, 'uploads/' . $newfilename)) {
        // Prepare your SQL query, specify column names
        $query = "INSERT INTO users (name, filename) VALUES ('$name', '$newfilename')";
        mysqli_query($conn, $query);
        echo "<script>alert('User Added Successfully'); document.location.href = 'index2.php';</script>";
    } else {
        echo "<script>alert('Error uploading file');</script>";
    }
}

function edit() {
    global $conn;

    $id = (int)$_GET["id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    // Always update the name
    $query = "UPDATE users SET name = '$name' WHERE id = $id";
    mysqli_query($conn, $query);

    if ($_FILES["file"]["error"] != 4) { // Check if a file was uploaded
        $filename = $_FILES["file"]["name"];
        $tmpName = $_FILES["file"]["tmp_name"];
        $newfilename = uniqid() . "_" . $filename;

        if (move_uploaded_file($tmpName, 'uploads/' . $newfilename)) { 
            $query = "UPDATE users SET filename = '$newfilename' WHERE id = $id";
            mysqli_query($conn, $query);
        }
    }

    echo "<script>alert('User edited successfully'); document.location.href = 'index.php';</script>";
}

function delete() {
    global $conn;
    $id = (int)$_POST["id"]; // Fetch ID from POST data

    $query = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User deleted successfully'); document.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
}
?>
