<?php
$uploadedImages = [];
$uploadedNames = [];
$targetDirectory = "uploads/";

if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}

if (isset($_POST['upload'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            echo "<script>alert('File size exceeds 2MB. Please upload a smaller file.')</script>";
        } else {
            $imageName = $_POST['image_name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageFileName = basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

            $targetFile = $targetDirectory . $imageName . '.' . $imageFileType;

            if (file_exists($targetFile)) {
                echo "<script>alert('Sorry, file already exists.')</script>";
            } else {
                if (move_uploaded_file($imageTmpName, $targetFile)) {
                    $uploadedImages[] = $targetFile;
                    $uploadedNames[] = $imageName;
                    echo "<script>alert('The file has been uploaded successfully as $targetFile.')</script>";
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                }
            }
        }
    } else {
        echo "<script>alert('No file was uploaded or there was an upload error.')</script>";
    }
}

if (isset($_POST['delete'])) {
    $imageToDelete = $_POST['image_to_delete'];
    if (file_exists($imageToDelete)) {
        unlink($imageToDelete);
        echo "<script>alert('File deleted successfully.')</script>";
    } else {
        echo "<script>alert('File not found.')</script>";
    }
}

if (is_dir($targetDirectory)) {
    $uploadedImages = glob($targetDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    $uploadedNames = array_map(function($image) {
        return pathinfo($image, PATHINFO_FILENAME);
    }, $uploadedImages);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Picture</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #006d77, #83c5be); /* Soft teal gradient */
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        input[type="file"], input[type="text"], input[type="submit"] {
            padding: 12px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 16px;
            outline: none;
        }

        input[type="file"] {
            background-color: rgba(255, 255, 255, 0.9);
        }

        input[type="submit"] {
            background-color: #ff6f61; /* Vibrant orange */
            color: white;
            cursor: pointer;
            font-size: 18px;
            border: none;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #e95e48; /* Darker orange on hover */
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .image-box {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            width: 180px;
            height: 180px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .image-box:hover {
            transform: scale(1.05);
        }

        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-button {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            line-height: 22px;
        }

        .image-name {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #fff;
        }

        .back-btn {
            background-color: #ff6f61; /* Vibrant orange */
            color: white;
            font-size: 18px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .back-btn::before {
            content: "⬅️ "; /* Back arrow emoji */
            font-size: 18px;
        }

        .back-btn:hover {
            background-color: #e95e48; /* Darker orange on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload a Picture</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required><br>
        <input type="text" name="image_name" placeholder="Enter Image Name" required><br>
        <input type="submit" name="upload" value="Upload">
        <br>
        <br>
        <button class="back-btn" onclick="window.location.href='index.php'">BACK</button>

    <div class="image-preview">
        <?php foreach ($uploadedImages as $index => $image): ?>
            <div class="image-box">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Uploaded Image">
                <form action="upload.php" method="post" style="display:inline;">
                    <input type="hidden" name="image_to_delete" value="<?php echo htmlspecialchars($image); ?>">
                    <button type="submit" name="delete" class="delete-button">X</button>
                </form>
                <div class="image-name"><?php echo htmlspecialchars($uploadedNames[$index]); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
