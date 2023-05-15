<?php
$table = "Producto";
$link = mysqli_connect("localhost", "root", "", $table);

$result = mysqli_query($link, "SELECT * FROM $table");
$num_rows = mysqli_num_rows($result);
$field_info = mysqli_fetch_fields($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-5">Product List</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <?php foreach ($field_info as $val): ?>
                <th scope="col"><?php echo $val->name; ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < $num_rows; $i++):
            $row = mysqli_fetch_array($result);
            ?>
            <tr>
                <?php foreach ($field_info as $val): ?>
                    <td><?php echo $row[$val->name]; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
