<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Spark Login Page</title>
    <link rel=stylesheet href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    </head>

    <body>

        <!-- Main Container -->
        <div class="cont">


            <!--Info & Sign-Up Section-->

            <div class="sub-cont">
                <!-- Info Box -->
                <div class="img- header">
                    <img class="team-name" src="src/sparkLogo.svg">
                    <div class="img__text- m--up info">
                        <h2>Hey, There!</h2>
                        <p>Stay connected with us</p>
                    </div>
                    <div class="img__text m--in info">
                        <h2>Welcome Back!</h2>
                        <p>Have an account with us?</p>
                    </div>
                    <div class="img__btn btn-container">
                        <span class="m--up">Sign Up</span>
                        <span class="m--in">Sign In</span>
                    </div>
                </div>

                <!--Registration or signup page-->


                <form class="label sign-up" action="register.php" method="POST">
                    <h2 id="create-account">Create Account</h2>
                    <div class="error"></div>
                    <div class="awesomeholder">
                        <input type="text" placeholder=" Full Name" id="name" name="name" required/>
                        <label for="name"><i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i></label>
                    </div>

                    <div class="awesomeholder">
                        <input type="email" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                        <label for="email"><i class="fa fa-envelope fa-lg fa-fw"></i></label>
                    </div>

                    <div class="awesomeholder">
                        <input type="text" placeholder="Username" type="text" id="username" name="username" required/>
                        <label for="username"><i class="fa fa-user fa-lg fa-fw"></i></label>
                    </div>

                    <div class="awesomeholder">
                        <input type="password" placeholder="Password" id="password" name="password" minlength="6" maxlength="15" required/>
                        <label for="password"><i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i></label>
                    </div>

                    <div class="awesomeholder">
                        <input type="password" placeholder="Repeat Password" id="repeat_password" name="repeatpassword" minlength="6" maxlength="15" required/>
                        <label for="repeat_password"><i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i></label>
                    </div>

                    <button type="submit" class="submit">Sign Up</button>
                </form>
            </div>


            <!--Sign In-->

            <form class="label sign-in" action="login.php" method="POST">
                <h2 id="login-header">Log In</h2>
                <div class="error"></div>
                <div class="awesomeholder">
                    <input type="email" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                    <label for="email">
                <i class="fa fa-envelope fa-lg fa-fw"></i>
              </label>
                </div>

                <div class="awesomeholder">
                    <input id="pw" name="pw" type="password" placeholder="Password" required minlength="6" maxlength="15" />
                    <label for="password"><i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i></label>
                </div>


                <a class="forget-pass" href="#" onclick="return alert('This functionality is not available right now')">Forgot password?</a>
                <hr class=forgot-pass-hr>
                <button type="submit" class="submit">Sign In</button>
            </form>
            <!--Ends here-->
        </div>
        <!--Ends here-->

        <script>
            document.querySelector('.img__btn').addEventListener('click', function() {
                document.querySelector('.cont').classList.toggle('s--signup');
            });

            var password = document.getElementById("password"),
                confirm_password = document.getElementById("repeat_password");

            function validatePassword() {
                if (password.value != repeat_password.value) {
                    repeat_password.setCustomValidity("Passwords Don't Match");
                } else {
                    repeat_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            repeat_password.onkeyup = validatePassword;
        </script>
        <script src="assets/script/validate.js"></script>

    </body>

</html>
