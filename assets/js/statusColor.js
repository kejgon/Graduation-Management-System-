

// Get all <td> elements with class "status"
const cells = document.querySelectorAll('td.status');

// Loop through each cell and apply the appropriate CSS class
cells.forEach((cell) => {
    const status = cell.textContent.trim().toUpperCase();
    switch (status) {
        case 'APPROVED':
            cell.classList.add('approved');
            break;
        case 'REJECTED':
            cell.classList.add('rejected');
            break;
        case 'PENDING':
            cell.classList.add('pending');
            break;
        default:
            break;
    }
});
