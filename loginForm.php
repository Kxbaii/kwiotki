<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>
</head>
<body>
<section class="main">
    <a href="index.php"><img src="images/home.png" alt=""></a>
    <section class="login">
        <h1 class="loginText">Zaloguj się poniżej <br> <span>Lub skorzystaj z rejestracji.</span></h1>
        <form method="post" action="loginHandler.php"> 

        <div class="formInput">
            <input type="email" placeholder="example@example.com" id="email" name="email" required>
            <label for="email">Adres e-mail</label>
        </div>

        <div class="formInput">
            <input type="password" id="logpassword" name="password" placeholder="*****" required>
            <label for="password">Hasło</label>
        </div>
        <input type="hidden" name="origin" value="loginForm">
<?php 

if (isset($_SESSION['logstatus']) && $_SESSION['logstatus'] == 'error') {
    echo '<input type="submit" value="Niepoprawne dane logowania" id="logiin" style="color:red;">';
    $_SESSION['logstatus'] = null;
    echo "<script>
    var login = document.getElementById('logiin');
    setTimeout(function(){
        if (login){
            login.style.color = '';
            login.value = 'Zaloguj się';
        }
    }, 2000)
</script>";
} else {
   echo '<input type="submit" value="Zaloguj się" id="logiin">';
}
?>

        </form>
    </section>
    <section class="register">
        <h1 class="registerText">Nie masz jeszcze konta? <br> <span>Możesz stworzyć je poniżej!</span></h1>
        <form method="post" action="loginHandler.php"> 

        <div class="formInput">
            <input type="text" placeholder="Jan" name="name" id="name" required>
            <label for="name">Imię</label>
        </div>

        <div class="formInput">
            <input type="text" placeholder="Kowalski" name="surname" id="surname" required>
            <label for="surname">Nazwisko</label>
        </div>   

        <div class="formInput">
            <input type="email" placeholder="example@example.com" id="email" name="email" required>
            <label for="email">Adres e-mail</label>
        </div>

        <div class="formInput">
            <input type="number" placeholder="111222333" id="telephone" name="telephone" min="1" step="1" max="999999999" required>
            <label for="telephone">Numer telefonu</label>
        </div>

        <div class="formInput">
            <input type="password" id="password" name="password" placeholder="*****" required>
            <label for="password">Hasło</label>
        </div>

        <div class="formInput">
            <input type="password" id="password2" name="password2" placeholder="*****" required>
            <label for="password2">Potwierdź hasło</label>
        </div>
        <input type="hidden" name="origin" value="loginForm">
<?php 
if (isset($_SESSION['regstatus']) && $_SESSION['regstatus'] == 'error') {
    echo '<input type="submit" value="Adres e-mail jest już w użyciu" id="register" style="color:red;">';
    $_SESSION['regstatus'] = null;
    echo "<script>
    var register = document.getElementById('register');
    setTimeout(function(){
        if (register){
            register.style.color = '';
            register.value = 'Zarejestruj się';
        }
    }, 2000)
</script>";
} else {
    echo '<input type="submit" value="Zarejestruj się" id="register">';
} ?>
        </form>
    </section>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
?>
</section>
</body>
</html>