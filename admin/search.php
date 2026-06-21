<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Recherche</title>

    <style>

        body{
            font-family:Arial;
            padding:20px;
        }

        input{
            width:300px;
            padding:10px;
        }

        .result{
            padding:10px;
            border:1px solid #ddd;
            margin-top:5px;
        }

    </style>

</head>

<body>

    <h1>Recherche produit</h1>

    <input
        type="text"
        id="search"
        placeholder="Rechercher..."
    >

    <div id="results"></div>

    <script src="../public/assets/js/search.js"></script>

</body>

</html>