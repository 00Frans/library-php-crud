<?php
if (isset($_POST['add'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $copyright = $_POST['copyright'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO library (isbn, title, copyright, edition,  quantity, price) 
    VALUES ('$isbn', '$title', '$copyright', '$edition', '$quantity','$price') ";
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
        // If the book with the given ISBN is found, display its details in the form.
        $isbn = $bookDetails['isbn'];
        $title = $bookDetails['title'];
        $copyright = $bookDetails['copyright'];
        $edition = $bookDetails['edition'];
        $price = $bookDetails['price'];
        $quantity = $bookDetails['quantity'];
        $message = "Item found";
    } else {
        // If the book is not found, show an error message.
        $message = "Item not found";
    }
}



// UPDATE (after the user edits and clicks "SAVE CHANGES")
if (isset($_POST['save_changes'])) {
    $id = $_POST['edit_id']; // Get the book ID to be edited

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $copyright = $_POST['copyright'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Update the book details in the database
    $sql = "UPDATE library SET isbn='$isbn', title='$title', copyright='$copyright', 
    edition='$edition', price='$price', quantity='$quantity' WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Updated Successfully!";
    } else {
        die(mysqli_error($conn));
    }
}

//Delete

if (isset($_POST['delete'])) {
    $id = $_POST['delete']; // Get the book ID to be deleted

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