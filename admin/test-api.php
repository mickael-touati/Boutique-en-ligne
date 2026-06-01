<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Test API</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f4f6f8;
            padding:20px;
        }

        .card{
            background:white;
            padding:15px;
            margin-bottom:15px;
            border-radius:8px;
        }

    </style>

</head>

<body>

    <h1>Produits depuis API</h1>

    <div id="products"></div>

    <script>

        fetch("api/products.php")

        .then(response => response.json())

        .then(products => {

            let container = document.getElementById("products");

            products.forEach(product => {

                container.innerHTML += `
                    <div class="card">
                        <h3>${product.name}</h3>
                        <p>Prix : ${product.price} €</p>
                        <p>Stock : ${product.stock}</p>
                    </div>
                `;

            });

        })

        .catch(error => {

            console.log(error);

        });

    </script>

</body>

</html>