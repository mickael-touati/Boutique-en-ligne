let category = document.getElementById("category");

category.addEventListener("change", function () {

    fetch("api/filter.php?category=" + category.value)

    .then(response => response.json())

    .then(products => {

        let results = document.getElementById("results");

        results.innerHTML = "";

        products.forEach(product => {

            results.innerHTML += `
                <div>
                    <h3>${product.name}</h3>
                    <p>${product.price} €</p>
                </div>
            `;

        });

    });

});