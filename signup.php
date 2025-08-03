<?php
session_start();
require_once("includes/current_user_data.php");

$activeForm = 'signup';
if (isset($_GET['form']) && $_GET['form'] === 'login') {
    $activeForm = 'login';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Kaivera SignUp</title>
    <link rel="icon" href="assets/images/kaivera logo icon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/69e1242b61.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="js/script.js" defer></script>
</head>

<body data-page="signup">


    <!-- Navigation -->

    <?php

    if (isset($user_type)) {

        if ($user_type == 'admin') {
            require_once("includes/admin_navigation.php");
        }
        if ($user_type == 'user') {
            require_once("includes/user_navigation.php");
        }
    } else {

        require_once("includes/navigation.php");
    }
    ?>

    <!-- Navigation ends -->
    <div class="notification"></div>

    <div class="fade-overlay"></div>

    <main>

        <!-- Help Bubble -->
        <div class="help-bubble"></div>
        <section class="signup_section">
            <div class="video">
                <div class="spinner" id="spinner">
                    <div class="absolute top-0 right-0 h-screen w-screen z-50 flex justify-center items-center">
                        <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2"></div>
                    </div>
                </div>
                <video src="assets/videos/Gradientsection.mp4" id="header_video" autoplay muted playsinline loop></video>
            </div>

            <div class="signup_wrapper">
                <h1>Sign Up</h1>
                <?php

                if (isset($_SESSION['success'])) {
                    echo "<p style='color: #9fc9b7;'>{$_SESSION['success']}</p>";
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo "<p style='color: rgb(214, 102, 102);'>{$_SESSION['error']}</p>";
                    unset($_SESSION['error']);
                }

                ?>


                <form action="controllers/signup.php" id="signup_form" enctype="multipart/form-data" method="POST">
                    <div>
                        <label for="username_input"><i class="fa-solid fa-user"></i></label>
                        <input type="text" name="username" id="username_input" placeholder="Username" onkeyup="checkAvailability('username', this.value)">
                        <span id="username_status"></span>
                    </div>
                    <div>
                        <label for="email_input"><i class="fa-solid fa-envelope"></i></label>
                        <input type="email" name="email" id="email_input" placeholder="Email" onkeyup="checkAvailability('email', this.value)">
                        <span id="email_status"></span>
                    </div>
                    <div>
                        <label for="phone_input"><i class="fa-solid fa-phone"></i></label>
                        <input type="number" name="phone" id="phone_input" placeholder="Phone">
                    </div>
                    <div>
                        <label for="password_input"><i class="fa-solid fa-key"></i></label>
                        <input type="password" name="password" id="password_input" placeholder="Set Password">
                    </div>
                    <div>
                        <label for="repeat_password_input"><i class="fa-solid fa-key"></i></label>
                        <input type="password" name="repeat_password" id="repeat_password_input" placeholder="Repeat Password">
                    </div>
                    <button type="submit">SignUp</button>
                </form>
                <div class="error_message">
                    <p id="signup_error_message"></p>
                </div>
                <p>Already Have An Account ? <button id="loginBtn">Login</button></p>
            </div>

            <!-- Login Form -->

            <div class="login_wrapper">
                <h1>Login</h1>
                <?php

                if (isset($_SESSION['login_success'])) {
                    echo "<p style='color: #9fc9b7;'>{$_SESSION['login_success']}</p>";
                    unset($_SESSION['login_success']);
                }
                if (isset($_SESSION['login_error'])) {
                    echo "<p style='color: rgb(214, 102, 102);'>{$_SESSION['login_error']}</p>";
                    unset($_SESSION['login_error']);
                }


                ?>
                <form action="controllers/login.php" id="login_form" method="POST">
                    <div>
                        <label for="login_email_input"><i class="fa-solid fa-envelope"></i></label>
                        <input type="email" name="email" id="login_email_input" placeholder="Email">
                    </div>
                    <div>
                        <label for="login_password_input"><i class="fa-solid fa-key"></i></label>
                        <input type="password" name="password" id="login_password_input" placeholder="Set Password">
                    </div>

                    <button type="submit">Login</button>
                </form>
                <div class="error_message">
                    <p id="login_error_message"></p>
                </div>
                <span>Forgot Password ? <a href="user/reset_password.php">Reset Password</a></span>
                <p>Doesn't Have An Account ? <button id="signUpBtn">Sign Up</button></p>
            </div>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/CustomEase.min.js"></script>

    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"
        integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/SplitText.min.js"
        integrity="sha512-wOeEC+9qERAzhliwBFPDb6t8TiFFxdxG8vhK/Ygs7TuC44bpg8pg/X2/U/u+0X4fK05wb9id1EIipnF02+CFQw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"
        integrity="sha512-P2IDYZfqSwjcSjX0BKeNhwRUH8zRPGlgcWl5n6gBLzdi4Y5/0O4zaXrtO4K9TZK6Hn1BenYpKowuCavNandERg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function checkAvailability(type, value) {
            if (value.length === 0) {
                document.getElementById(type + "_status").innerText = "";
                return;
            }

            fetch("controllers/check_availability.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `type=${type}&value=${encodeURIComponent(value)}`
                })
                .then(res => res.json())
                .then(data => {
                    const statusElement = document.getElementById(type + "_status");
                    if (data.status === "taken") {
                        statusElement.innerText = `${type} is already taken`;
                        statusElement.style.color = "#8d4444ff";
                    } else if (data.status === "available") {
                        statusElement.innerText = `${type} is available`;
                        statusElement.style.color = "#43895fff";
                    } else {
                        statusElement.innerText = "Error checking";
                        statusElement.style.color = "orange";
                    }
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const activeForm = "<?php echo $activeForm; ?>";

            if (activeForm === 'login') {

                gsap.set(".signup_wrapper", {
                    xPercent: -100,
                })

                gsap.set(".login_wrapper", {
                    xPercent: 0,
                    clipPath: "polygon(0 0, 100% 0, 100% 100%, 0% 100%)"
                });
            } else {

                gsap.set(".login_wrapper", {
                    xPercent: 100
                });
                gsap.set(".signup_wrapper", {
                    xPercent: 0,
                    clipPath: "polygon(0 0, 100% 0, 100% 100%, 0% 100%)"


                });

            }
        });
    </script>
</body>

</html>