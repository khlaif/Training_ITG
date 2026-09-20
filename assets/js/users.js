const searchInput = document.getElementById("searchUser");
const rows = document.querySelectorAll(".user-row");

searchInput.addEventListener("input", function () {

    const searchValue = this.value.toLowerCase().trim();

    rows.forEach(function (row) {

        const name = row.querySelector(".user-name")
            .textContent
            .toLowerCase();

        if (name.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});