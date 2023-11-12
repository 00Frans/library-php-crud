<?php
include "connect.php";
include "crud.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>HOME</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='css/styles.css'>

</head>

<body>
    <div class="w3-container w3-padding-16">

        <form method="POST">
            <div class="w3-row">
                <div class="w3-twothird">
                    <label>ISBN</label>
                    <input class="w3-input" type="text" name="isbn" value="<?= isset($isbn) ? $isbn : ''; ?>">

                    <label>Title</label>
                    <input class="w3-input" type="text" name="title"
                        value="<?= isset($bookDetails['title']) ? $bookDetails['title'] : ''; ?>">

                    <label>Copyright</label>
                    <input class="w3-input" type="text" name="copyright"
                        value="<?= isset($bookDetails['copyright']) ? $bookDetails['copyright'] : ''; ?>">

                    <label>Edition</label>
                    <input class="w3-input" type="text" name="edition"
                        value="<?= isset($bookDetails['edition']) ? $bookDetails['edition'] : ''; ?>">

                    <label>Price</label>
                    <input class="w3-input" type="text" name="price"
                        value="<?= isset($bookDetails['price']) ? $bookDetails['price'] : ''; ?>">

                    <label>Quantity</label>
                    <input class="w3-input" type="text" name="quantity"
                        value="<?= isset($bookDetails['quantity']) ? $bookDetails['quantity'] : ''; ?>">
                </div>

                <div class="w3-container w3-rest w3-panel w3-padding-16">
                    <div class="w3-row">
                        <button class="w3-button w3-green" name="add">ADD</button>
                        <button class="w3-button w3-blue" name="search">SEARCH</button>
                    </div>
                    <div class="w3-row w3-padding-16">
                        <input type="hidden" name="edit_id" value="<?= $bookDetails['id']; ?>">
                        <button class="w3-button w3-blue" name="save_changes">SAVE CHANGES</button>
                        <button class="w3-button w3-red" name="delete"
                            value="<?= $bookDetails['id']; ?>">DELETE</button>
                        <!-- <?php if (!empty($bookDetails)): ?>
                           //Show the "SAVE CHANGES" button if book details are found -->
                         <!-- <button class="w3-button w3-blue" name="save_changes">SAVE CHANGES</button> -->
                         <!-- Add a hidden input field to store the book ID to be edited -->
                         <!-- <input type="hidden" name="edit_id" value="<?= $bookDetails['id']; ?>"> -->

                         <!-- <button class="w3-button w3-red" name="delete" -->
                         <!-- value="<?= $bookDetails['id']; ?>">DELETE</button> -->
                         <!-- <?php endif; ?> -->
                    </div>
                    <div class="w3-container w3-padding-16">
                        <div class="w3-row">
                            <?php if (!empty($message)): ?>
                                <label class="w3-tag w3-teal w3-padding-46">
                                    <?= $message; ?>
                                </label>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="w3-container w3-padding-16">
        <table class="w3-table w3-striped w3-bordered">
            <thead>
                <tr class=" w3-green">
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Copyright</th>
                    <th>Edition</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM library";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $isbn = $row['isbn'];
                        $title = $row['title'];
                        $copyright = $row['copyright'];
                        $edition = $row['edition'];
                        $quantity = $row['quantity'];
                        $price = $row['price'];
                        $total = $row['quantity'] * $row['price'];
                        echo '<tr>
                        <td>' . $isbn . '</td>
                        <td>' . $title . '</td>
                        <td>' . $copyright . '</td>
                        <td>' . $edition . '</td>
                        <td>' . $quantity . '</td>
                        <td>' . $price . '</td>
                        <td>' . $total . '</td>
                    </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>