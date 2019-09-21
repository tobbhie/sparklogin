const form = document.getElementsByTagName('form');
const email = document.querySelectorAll('input[type=email]');
const pass = document.querySelectorAll('input[type=password]');
const submit_btn = document.querySelectorAll('.submit');
const username = document.querySelectorAll('#username');
let errDiv = document.querySelectorAll('.error');


//check for empty values
//check for validity of input
//use fetch to submit to php file

//Error Message function display for sign up
const err = (string, boo) => {
        if (boo === false) {
            errDiv[0].style.display = 'block';
            errDiv[0].style.color = 'red';
            errDiv[0].innerHTML = string;
            setTimeout(() => {
                errDiv[0].style.display = 'none';
                errDiv[0].innerHTML = '';
            }, 6000);
        } else {
            errDiv[0].style.display = 'block';
            errDiv[0].style.color = 'green';
            errDiv[0].innerHTML = string;
            setTimeout(() => {
                errDiv[0].style.display = 'none';
                errDiv[0].innerHTML = '';
            }, 1000);
        }
    }
    //Error Message function display for log in
const err1 = (string, boo) => {
    if (boo === false) {
        errDiv[1].style.display = 'block';
        errDiv[1].style.color = 'red';
        errDiv[1].innerHTML = string;
        setTimeout(() => {
            errDiv[1].style.display = 'none';
            errDiv[1].innerHTML = '';
        }, 6000);
    }
}

submit_btn[0].addEventListener('click', (e) => {
    e.preventDefault();
    const confPass = document.querySelector('#repeat_password').value;
    const name = document.querySelector('#name');

    if (pass[0].value.length < 6) { //valid password check
        err('Password must be greater than 6 characters', false);
        return false;
    } else {
        let formattedFormData = new FormData(form[0]);
        //Append the input data
        formattedFormData.append('username', username[0].value);
        formattedFormData.append('name', name.value);
        formattedFormData.append('confirm_password', confPass);
        formattedFormData.append('email', email[0].value);
        formattedFormData.append('password', pass[0].value);
        formattedFormData.append('submit', submit_btn[0]);


        async function fetchData(dataForm) {
            const response = await fetch('register.php', {
                method: 'POST',
                body: dataForm
            });
            console.log(response);
            const data = await response.text();
            //Handle PHP Response respectively
            // alert(data);
            if (data === 'REGD_SUCCESS') {
                err('Registration Successful, you shall be redirected to the Dashboard', true);
                setTimeout(() => { window.location = 'dashboard.php'; }, 4000)
            } else {
                err(data, false);
            }
        }

        //Initialize fetch
        fetchData(formattedFormData);
    }
});

//validation for Sign In 
submit_btn[1].addEventListener('click', (e) => {
    console.log('sign in event triggered');
    e.preventDefault();

    let formattedFormData = new FormData(form[1]);
    //Append the input data
    formattedFormData.append('email', email[1].value);
    formattedFormData.append('password', pass[2].value);
    formattedFormData.append('submit', submit_btn[1]);


    async function fetchData(dataForm) {
        const response = await fetch('login.php', {
            method: 'POST',
            body: dataForm
        });
        console.log(response);
        const data = await response.text();
        //Show an alert of successful registration based on PHP output
        // alert(data);
        if (data === 'ALREADY_LOGGED_IN' || data === 'LOG_IN') {
            window.location = 'dashboard.php';
        } else {
            err1(data, false);
        }
    }

    //Initialize fetch
    fetchData(formattedFormData);
});