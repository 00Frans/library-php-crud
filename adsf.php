<?php
include('crud.php');
include "connect.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-5 card shadow">
            <form action="crud.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <!-- inputs -->
                        <div class="mb-3">
                            <input type="text" class="form-control mt-3" name="isbn" placeholder="ISBN #"
                                value="<?= isset($isbn) ? $isbn : ''; ?>">
                            <input type="text" class="form-control mt-3" name="title" placeholder="Title"
                                value="<?= isset($bookDetails['title']) ? $bookDetails['title'] : ''; ?>">
                            <input type="text" class="form-control mt-3" name="copyright" placeholder="Copyright"
                                value="<?= isset($bookDetails['copyright']) ? $bookDetails['copyright'] : ''; ?>">
                            <input type="text" class="form-control mt-3" name="edition" placeholder="Edition"
                                value="<?= isset($bookDetails['edition']) ? $bookDetails['edition'] : ''; ?>">
                            <input type="text" class="form-control mt-3" name="price" placeholder="Price"
                                value="<?= isset($bookDetails['price']) ? $bookDetails['price'] : ''; ?>">
                            <input type="text" class="form-control mt-3" name="quantity" placeholder="Quantity"
                                value="<?= isset($bookDetails['quantity']) ? $bookDetails['quantity'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-5 mx-5 px-5">
                        <div class="row">
                            <!-- buttons -->
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary mt-3 mx-5 w-100"
                                    name="search">Search</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary mt-3 mx-5 w-100"
                                    name="update_book">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary mt-3 mx-5 w-100"
                                    name="add_book">Add</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary mt-3 mx-5 w-100"
                                    name="delete_book">Delete</button>
                            </div>
                        </div>
                        <div class="mx-5 w-100">
                            <!-- message prompt -->
                            <?php
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo '<div class="alert alert-success mt-3">' . $message . '</div>';
                            } else if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                echo '<div class="alert alert-danger mt-3">' . $error . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
            <!-- display table -->
            <div class="table-responsive mt-3">
                <table class="table table-primary table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ISBN #</th>
                            <th scope="col">Title</th>
                            <th scope="col">Copyright</th>
                            <th scope="col">Edition</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>

                        </tr>
                    </thead>
                    <tbody class="table">
                        <?php
                        $getBook = displayBooks();
                        $totalQuantity = 0;
                        $totalPrice = 0;
                        foreach ($getBook as $book) {
                            ?>
                            <tr class="">
                                <td>
                                    <?= $book['isbn']; ?>
                                </td>
                                <td>
                                    <?= $book['title']; ?>
                                </td>
                                <td>
                                    <?= $book['copyright']; ?>
                                </td>
                                <td>
                                    <?= $book['edition']; ?>
                                </td>
                                <td>
                                    <?= $book['quantity']; ?>
                                </td>
                                <td>
                                    <?= $book['price'] * $book['quantity']; ?>
                                </td>
                                <?php
                                $totalQuantity += $book['quantity'];
                                $totalPrice += $book['price'] * $book['quantity'];
                        }
                        ?>
                        </tr>
                        <tr class="float-right">
                            <td colspan="4"></td>
                            <td>
                                <?= $totalQuantity; ?>
                            </td>
                            <td>
                                <?= $totalPrice; ?>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </main>

</body>

</html>