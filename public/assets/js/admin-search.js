const searchInput = document.getElementById("searchInput");

if (searchInput) {

    searchInput.addEventListener("keyup", function () {

        let value = searchInput.value.toLowerCase();

        let rows = document.querySelectorAll("#productsTable tr");

        rows.forEach(function (row) {

            let text = row.textContent.toLowerCase();

            if (text.includes(value)) {

                row.style.display = "";

            } else {

                row.style.display = "none";

            }

        });

    });

}