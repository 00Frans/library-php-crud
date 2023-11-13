<?php 
    include('./config/config.php');

//display all books
function displayBooks(){
    global $con;

    $query = "SELECT * FROM BOOK";
    $result = mysqli_query($con,$query);

    while($row=mysqli_fetch_assoc($result)){
        $book[] = $row;
    }
    mysqli_free_result($result);

    return $book;

}
//function for display details
function getBookDetails($isbn) {
    global $con;

    $query = "SELECT * FROM BOOK WHERE isbn='$isbn'";
    $result = mysqli_query($con, $query);
    $book = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $book;
}     

?>