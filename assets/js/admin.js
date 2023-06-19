var form = document.getElementById("addAdminForm");
var adminFname = document.getElementById("fullname");
var adminNo = document.getElementById("adminNo");

var email = document.getElementById("email");
var address = document.getElementById("address");
var phone_num = document.getElementById("phone_num");
var date = document.getElementById("date");
var password = document.getElementById("password");
var role = document.getElementById("role");

form.addEventListener('submit', function (evt) {
    evt.preventDefault();
    // //! FUll NAME VALIDATION
    var adminFnameVal = adminFname.value;
    if (adminFnameVal.length == 0) {
        window.alert("Full name is required?");
        return false
    }
    //?To remove the extra spaces within the string
    var newFname = adminFnameVal[0];
    for (var i = 1; i < adminFnameVal.length; i++) {
        if (!(adminFnameVal[i - 1] === " " && adminFnameVal[i] === " ")) {
            newFname += adminFnameVal[i];
        }
    }
    //? This to make sure that user input are basically aphabets, spaces and  doesn't contain any symbols
    var index = 0;
    for (var i = 0; i < newFname.length; i++) {
        if (!((newFname[i] >= 'a' && newFname[i] <= 'z') || (newFname[i] >= 'A' && newFname[i] <= 'Z') || newFname[i] === ' ')) {
            window.alert("Please enter a valid name!");
            return false;
        }
        if (newFname[i] === ' ') {
            index++;
        }
    }
    if (index < 1) {
        window.alert("Please enter at least two names!");
        return false;
    }



    //! EMPLOYEE NUMBER VALIDATION
    var adminNoVal = adminNo.value;

    if (adminNoVal.length == 0) {
        window.alert("Admin number is required");
        return false;
    }
    //?To remove the extra spaces within the string
    if (adminNoVal.indexOf(" ") !== -1) {
        window.alert("The Admin number shoudn't contain any spaces");

        return false;
    }


    //! EMAIL ADDRESS VALIDATION
    var emailVal = email.value;
    if (emailVal.length == 0) {
        window.alert("Email Address is required");
        return false;
    }

    var atPosition = emailVal.indexOf("@");
    var dotPosition = emailVal.lastIndexOf(".");
    if (atPosition < 1 || dotPosition < atPosition + 2 || dotPosition + 2 >= emailVal.length) {
        window.alert("Email address is invalid");

        return false;
    }


    //! GENDER VALIDATION
    if ((gender[0].checked == false) && (gender[1].checked == false)) {
        alert("Please choose your gender!");
        return false;
    }

    //! PHONE VALIDATION
    var phoneVal = phone_num.value;
    if (phoneVal.length == 0) {
        window.alert("Please enter your phone number!");
        return false;
    }
    var onlyDigitsChars = "";
    for (var i = 0; i < phoneVal.length; i++) {
        if (phoneVal.charCodeAt(i) >= 48 && phoneVal.charCodeAt(i) <= 57) {
            onlyDigitsChars += phoneVal[i];
        }
    }
    if (onlyDigitsChars.length !== 10) {
        window.alert("Your phone number must be at least 10 digits!");
        return false;
    }



    //! ADDRESS VALIDATION
    var addressVal = address.value;
    if (addressVal.length == 0) {
        window.alert("Please enter your address!");
        return false;
    }




    ////! DATE VALIDATION
    // Get the value of the date input
    var dateVal = date.value;

    // Initialize variables to store year, month and day values extracted from input
    var year = "";
    var month = "";
    var day = "";

    // Initialize variable to count the number of dashes in the input
    var dashCount = 0;

    // Check if the input is empty
    if (dateVal.length == 0) {
        window.alert("Please enter the date!");
        return false;
    }

    // Loop through the input characters and extract year, month, and day values
    for (var i = 0; i < dateVal.length; i++) {
        var currentChar = dateVal[i];

        if (currentChar === "-") {
            dashCount++;
        } else if (currentChar >= "0" && currentChar <= "9") {
            if (dashCount === 0) {
                year += currentChar;
            } else if (dashCount === 1) {
                month += currentChar;
            } else if (dashCount === 2) {
                day += currentChar;
            }
        } else {
            // If a non-numeric or non-dash character is encountered, return false
            return false;
        }
    }

    // Check if the year, month, and day values have the correct number of digits
    if (year.length !== 4 || month.length !== 2 || day.length !== 2) {
        window.alert("The year must contain 4 digits, the month must contain 2 digits and the day must contain 2 digits.");
        return false;
    }

    // Convert the year, month, and day values to integers
    year = parseInt(year);
    month = parseInt(month);
    day = parseInt(day);

    // Create Date objects for the input date and today's date
    var inputDate = new Date(year, month - 1, day);
    var today = new Date();

    // Compare the input date to today's date
    if (inputDate.setHours(0, 0, 0, 0) < today.setHours(0, 0, 0, 0)) {
        window.alert("Please enter today's date.");
        return false;
    }

    if (inputDate.setHours(0, 0, 0, 0) > today.setHours(0, 0, 0, 0)) {
        window.alert("Please do not enter future date.");
        return false;
    }

    // Check if the month value is between 1 and 12
    if (month < 1 || month > 12) {
        window.alert("The number of month must be between 1 and 12");
        return false;
    }

    // Check if the day value is between 1 and 31 depending on the month
    if (day < 1 || day > 31) {
        window.alert("The number of days must be between 1 and 31 depending on the month.");
        return false;
    }

    // Check if the day value is between 1 and 30 depending on the month (April, June, September, November)
    if ((month === 4 || month === 6 || month === 9 || month === 11) && day > 30) {
        window.alert("The number of days must be between 1 and 30 depending on the month.");
        return false;
    }

    // Check if the day value is valid for February
    if (month === 2) {
        // If the day value is greater than 29, it's invalid
        if (day > 29) {
            window.alert("Sorry! The number of days in February must be between 1 and 29.");
            return false;

        }
        if (day > 28 && (!(year % 4 === 0 && year % 100 !== 0) && year % 400 !== 0)) {
            return false;
        }
    }

    //! PASSWORD VALIDATION
    var passwordValu = password.value;

    if (passwordValu.length == 0) {
        window.alert("Password number is required");
        return false;
    }
    // Check if the password is at least 8 characters long
    if (passwordValu.length < 8) {
        window.alert("Password must be at least 8 characters long");

        return false;
    }

    // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
    var specialChars = "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    var hasSpecialChar = false;
    var hasUpperCase = false;
    var hasLowerCase = false;
    var hasNumber = false;

    for (var i = 0; i < passwordValu.length; i++) {
        if (specialChars.indexOf(passwordValu[i]) !== -1) {
            hasSpecialChar = true;
        }
        if (passwordValu[i] >= 'A' && passwordValu[i] <= 'Z') {
            hasUpperCase = true;
        }
        if (passwordValu[i] >= 'a' && passwordValu[i] <= 'z') {
            hasLowerCase = true;
        }
        if (passwordValu[i] >= '0' && passwordValu[i] <= '9') {
            hasNumber = true;
        }
    }
    if (!hasSpecialChar || !hasUpperCase || !hasLowerCase || !hasNumber) {
        window.alert("Password must at least contains uppercase, lowercase, digits and special characters");

        return false;

    }


    //! ROLE VALIDATION
    var roleVal = role.value;
    if (roleVal == 0) {
        window.alert("Please select your Role!");
        return false;
    }


    // Create a FormData object to store the form data
    var formData = new FormData(form);

    // Create an XMLHttpRequest object to send the form data
    var xhr = new XMLHttpRequest();

    // Open a POST request to the PHP script
    xhr.open("POST", "../../admin/newAdminScript.php");

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
