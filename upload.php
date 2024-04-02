<!DOCTYPE html>
<html>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        </style>
<?php
$target_dir = "uploads/";
$uploadOk = 1;

// Function to list files in directory
function listUploadedFiles($dir) {
    $files = scandir($dir);
    echo "<h2>Uploaded Files:</h2>";
    echo '<form action="" method="post">';
    echo '<input type="submit" name="delete" value="Delete Selected">';
    echo '<input type="submit" name="new_folder" value="New Folder">';
    echo '<select name="sort_by">';
    echo '<option value="name">Sort by Name</option>';
    echo '<option value="date">Sort by Date</option>';
    echo '</select>';
    echo '<input type="submit" name="sort" value="Sort">';
    echo '<ul>';
    foreach($files as $file) {
        if ($file != "." && $file != "..") {
            echo '<li><input type="checkbox" name="files[]" value="'.$file.'">'.$file.'</li>';
        }
    }
    echo '</ul>';
    echo '</form>';
}

//This is the part where it does the file upload thingy
if(isset($_POST["submit"])) {
    // The fileupload directory thing
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //This checks if the file is an image
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    //checks if the file is already uploaded under the same name
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    //edit this if you want to set the file limit upload
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Delete selected files
if(isset($_POST["delete"])) {
    if(isset($_POST['files'])) {
        foreach($_POST['files'] as $file) {
            $file_path = $target_dir . $file;
            if(file_exists($file_path)) {
                unlink($file_path);
            }
        }
        echo "Selected files have been deleted.";
    }
}

// Create new folder
if(isset($_POST["new_folder"])) {
    $new_folder_name = "New_Folder_" . date("Ymd_His");
    $new_folder_path = $target_dir . $new_folder_name;
    if (!file_exists($new_folder_path)) {
        mkdir($new_folder_path);
        echo "New folder '$new_folder_name' created successfully.";
    } else {
        echo "Folder already exists.";
    }
}

// Sort files
if(isset($_POST["sort"])) {
    $sort_by = $_POST["sort_by"];
    $files = scandir($target_dir);
    switch($sort_by) {
        case "name":
            sort($files);
            break;
        case "date":
            usort($files, function($a, $b) use ($target_dir) {
                return filemtime($target_dir . $a) < filemtime($target_dir . $b);
            });
            break;
    }
    echo "<h2>Uploaded Files:</h2>";
    echo "<ul>";
    foreach($files as $file) {
        if ($file != "." && $file != "..") {
            echo "<li>$file</li>";
        }
    }
    echo "</ul>";
}

// Display list of uploaded files
listUploadedFiles($target_dir);
?>

</html>