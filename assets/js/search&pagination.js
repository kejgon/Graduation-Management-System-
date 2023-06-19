const table = document.getElementById("myTable");
const searchInput = document.getElementById("searchInput");
const previousBtn = document.getElementById("previous");
const nextBtn = document.getElementById("next");
const pageNumber = document.getElementById("pageNumber");
const totalPages = document.getElementById("totalPages");
const rowsPerPage = 10;

let currentPage = 1;

searchInput.addEventListener("keyup", function () {
    currentPage = 1;
    updateTable();
});

previousBtn.addEventListener("click", function () {
    currentPage--;
    updateTable();
});

nextBtn.addEventListener("click", function () {
    currentPage++;
    updateTable();
});

function updateTable() {
    const filter = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName("tr");
    let startRow = (currentPage - 1) * rowsPerPage;
    let endRow = startRow + rowsPerPage;
    let totalRows = 0;



    for (let i = 0; i < rows.length; i++) {
        // Show the table header
        rows[0].style.display = "";
        const cells = rows[i].getElementsByTagName("td");
        let found = false;

        for (let j = 0; j < cells.length; j++) {
            const cellValue = cells[j].innerHTML.toLowerCase();
            if (cellValue.indexOf(filter) > -1) {
                found = true;
                break;
            }
        }

        if (found) {
            totalRows++;
            if (i >= startRow && i < endRow) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        } else {
            rows[i].style.display = "none";
        }
    }

    const totalPageCount = Math.ceil(totalRows / rowsPerPage);
    totalPages.innerHTML = totalPageCount;
    pageNumber.innerHTML = currentPage;

    if (currentPage === 1) {
        previousBtn.disabled = true;
    } else {
        previousBtn.disabled = false;
    }

    if (currentPage === totalPageCount) {
        nextBtn.disabled = true;
    } else {
        nextBtn.disabled = false;
    }
}

updateTable();