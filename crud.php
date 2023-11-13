<?php 
    include('./function/function.php');

    //add book
    if(isset($_POST['add_book'])){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $copyright = $_POST['copyright'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // Check if the ISBN already exists
        $check_isbn_query = "SELECT isbn FROM BOOK WHERE isbn = '$isbn'";
        $check_isbn_result = mysqli_query($con, $check_isbn_query);

        // Check if any of the input fields are empty
        if(empty($isbn) || empty($title) || empty($copyright) || empty($edition) || empty($price) || empty($quantity)) {
            $error = "Please fill in all the fields";
            header("Location: index.php?error=$error");
            exit();
        }     
        else if (mysqli_num_rows($check_isbn_result) > 0) {
            $error = "ISBN already exists";
            header("Location: index.php?error=$error");
            exit();
        }

        $add_book = "INSERT INTO BOOK(isbn, title, copyright, edition, price, quantity)
        VALUES('$isbn','$title','$copyright','$edition','$price','$quantity')";

        $add_book_query = mysqli_query($con, $add_book);

        if($add_book_query){
            $message="Added successfully";
            header("Location: index.php?message=$message");
            exit();
        }
        else{
            $message="Adding failed";
            header("Location: index.php?message=$message");
        }

    }
    //delete book
    else if(isset($_POST['delete_book'])){
        $isbn = $_POST['isbn'];

        //Check if isbn is empty
        if(empty($isbn)){
            $error = "Deleting book failed";
            header(("Location: index.php?error=$error"));
            exit();
        }

        $delete_book = "DELETE FROM book WHERE isbn='$isbn'";
        $delete_book_query=mysqli_query($con, $delete_book);

        if($delete_book_query){
            $message="Deleted book successfully";
            header("Location: index.php?message=$message");
            exit();
        }
        else{
            $error = "Deleting book failed";
            header(("Location: index.php?error=$error"));
            exit();
        }
    }
    //search book using isbn
    if (isset($_POST['search'])) {
        // Retrieve the ISBN from the form
        $isbn = $_POST['isbn'];
    
        // Call the displayBooks() function to get the books
        $books = displayBooks();
    
        $found = false;
        $bookDetails = array();
    
        foreach ($books as $book) {
            // Check if the ISBN matches
            if ($book['isbn'] === $isbn) {
                // Book is found
                $found = true;
                $bookDetails = $book; // Assign the book details
                break;
            }
        }
    
        if ($found) {
            $message = "Item found";
            header("Location: index.php?message=$message&isbn=$isbn");
            exit(); 
        } else {
            $error = "Item not found";
            header("Location: index.php?error=$error");
            exit(); 
        }    
    }

    //update book
    if(isset($_POST['update_book'])){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $copyright = $_POST['copyright'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // Check if any of the input fields are empty
        if(empty($isbn) || empty($title) || empty($copyright) || empty($edition) || empty($price) || empty($quantity)) {
            $error = "Please fill in all the fields";
            header("Location: index.php?error=$error");
            exit();
        }    

        $update_book = "UPDATE book 
                        SET 
                        isbn = '$isbn',
                        title = '$title',
                        copyright = '$copyright',
                        edition = '$edition',
                        price = '$price',
                        quantity = '$quantity'
                        WHERE
                        isbn = '$isbn'
                        ";
        $update_book_query = mysqli_query($con, $update_book);

        if($update_book_query){
            $message = "Updated book successfully";
            header("Location: index.php?message=$message");
            exit();
        }
        else{
            $error = "Updating book failed";
            header("Location: index.php?error=$error");
            exit();
        }
    }
    
?>