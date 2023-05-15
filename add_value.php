<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

$action = "add";
$db = "Proyecto";
$table = $_POST["Table"];
$link = mysqli_connect("localhost", "root", "", $db);
$data = $_POST["array"];

$select = mysqli_query($link, "SELECT * FROM $table");
$num_rows = mysqli_num_rows($select);
$field_info = mysqli_fetch_fields($select);

$try = true;
$unique = $_POST["Unique"];

for ($i = 0; $i < $num_rows; $i++) {
    $row = mysqli_fetch_array($select);
    if ($row[0] === $data[0] || $data[0] === "") {
        $try = false;
        break;
    }
}

if ($data[0] === "") {
    $try = false;
}

if ($try || $unique) {
    $rows = "(";
    $info = "(";

    for ($i = 0; $i < count($field_info); $i++) {
        $rows .= $field_info[$i]->name;

        if ($field_info[$i]->type === 253 || $field_info[$i]->type === 254) {
            $info .= "'";
        }
        $info .= $data[$i];
        if ($field_info[$i]->type === 253 || $field_info[$i]->type === 254) {
            $info .= "'";
        }

        if ($i !== count($field_info) - 1) {
            $rows .= ", ";
            $info .= ", ";
        }
    }

    $rows .= ")";
    $info .= ")";

    $query = "INSERT INTO $table $rows VALUES $info;";

    if ($try) {
        $result = mysqli_query($link, $query);
    }

    header("location:javascript://history.go(-1)");
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Insertar valores válidos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p class="mb-0">Inserte valores válidos.</p>
        </div>
        <a class="btn btn-secondary" href="javascript://history.go(-2)">Volver</a>
    </div>
    </body>
    </html>
    <?php
}
?>
