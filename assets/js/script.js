

//Event Listener
function validation() {

    //! Validation with simple approch


    const form = document.getElementById('form')
    const username = document.getElementById('username')
    const passowrd = document.getElementById('password')



    //! Show input Error massage
    function showError(input, message) {
        const formContorl = input.parentElement;
        formContorl.className = "row error";
        const small = formContorl.querySelector('small')
        small.innerHTML = message
    }


    /// checking Required Feilds 
    function checkRequired(inputArr) {
        inputArr.forEach((input) => {
            if (input.value.trim() === '') {
                showError(input, `${getFieldNameCap(input)} is required`)
            }
        })
    }
    // Get fieldname Capitalize 
    function getFieldNameCap(input) {
        return input.id.charAt(0).toUpperCase() + input.id.slice(1)
    }

    //Check input Lenght
    function checkLenght(input, min, max) {
        if (input.value.length < min) {
            showError(input, `${getFieldNameCap(input)} must be at least ${min} characters`)

        } else if (input.value.length > max) {
            showError(input, `${getFieldNameCap(input)} must be less then ${max} characters`)

        }

    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        checkRequired([username, passowrd])
        checkLenght(username, 3, 15)
        checkLenght(passowrd, 8, 30)

    })



}