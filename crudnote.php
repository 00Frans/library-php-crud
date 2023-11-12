<?php
//ADD
if (isset($_POST['add'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];

    $sql = "INSERT INTO library (isbn, title) 
    VALUES ('$isbn', '$title') ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Item added successfully";
        header("location:index.php");
    } else {
        die(mysqli_error($conn));
    }
}


//SEARCH
if (isset($_POST['search'])) {
    $isbn = $_POST['isbn'];

    $query = "SELECT * FROM library WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $query);
    $bookDetails = mysqli_fetch_assoc($result);

    if ($bookDetails) {
        $isbn = $bookDetails['isbn'];
        $title = $bookDetails['title'];

        $message = "Item found";
    } else {
        $message = "Item not found";
    }
}



// UPDATE 
if (isset($_POST['save_changes'])) {
    $id = $_POST['edit_id'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];

    $sql = "UPDATE library SET isbn='$isbn', title='$title' 
    WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Updated Successfully!";
    } else {
        die(mysqli_error($conn));
    }
}

//Delete
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql = "DELETE FROM library WHERE id=$id ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Deleted Successfully!";
        header("location:index.php");
    } else {
        die(mysqli_error($conn));
    }
}
?>