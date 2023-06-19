var form = document.getElementById("regUpdateStatusForm");
var upStatus = document.getElementById("status");







form.addEventListener('submit', function (evt) {
    evt.preventDefault();


    //! YEAR VALIDATION
    var upStatusVal = upStatus.value;
    if (upStatusVal == 0) {
        window.alert("Please select select the status");
        return false;
    }


    // Create a FormData object to store the form data
    var formData = new FormData(form);

    // Create an XMLHttpRequest object to send the form data
    var xhr = new XMLHttpRequest();

    // Open a POST request to the PHP script
    xhr.open("POST", "../../registrar/updateStatusScript.php");

    // Send the form data
    xhr.send(formData);

    // Handle the response from the PHP script
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            alert(response);
        }
    };


    return true;
});
