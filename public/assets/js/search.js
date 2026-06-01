let search = document.getElementById("search");

search.addEventListener("keyup", function () {

    fetch("api/search.php?search=" + search.value)

    .then(response => response.json())

    .then(products => {

        let results = document.getElementById("results");

        results.innerHTML = "";

        products.forEach(product => {

            results.innerHTML += `
                <div class="result">
                    ${product.name}
                </div>
            `;

        });

    });

});