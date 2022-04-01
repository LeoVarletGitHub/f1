<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Oswald'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
    <title>Pilotes</title>

    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="index.js"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/page.css">
</head>
<?php
require "header.php";
?>
<body>
<h1>
<div class='table-responsive'>
    <table>
        <thead>
        <tr>
           <th >Numéro</th>
           <th >Nom</th>
           <th >Ecurie</th>
        </tr>
        </thead>
        <tbody id="lesLignes"></tbody>
    </table>
</div>
</h1>
</body>
</html>

