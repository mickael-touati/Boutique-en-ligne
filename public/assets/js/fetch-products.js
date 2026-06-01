fetch("/Boutique-en-ligne/admin/api/products.php")

.then(response => response.json())

.then(products => {

    console.log(products);

    let container = document.getElementById("products");

    products.forEach(product => {

        container.innerHTML += `
            <div class="card">
                <h3>${product.name}</h3>
                <p>${product.price} €</p>
                <p>Stock : ${product.stock}</p>
            </div>
        `;

    });

})

.catch(error => {

    console.log(error);

});