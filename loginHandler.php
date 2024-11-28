<?php
session_start();
if (!isset($_SESSION['LoggedIN'])){
    $_SESSION['LoggedIN'] = false;
}
if (!isset($_SESSION['accID'])){
    $_SESSION['accID'] = 0;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['surname'])) {
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$telNumber = $_POST['telephone'];

require 'db_connect.php';
$sql = "SELECT * FROM uzytkownik WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['regstatus'] = 'error';
    $conn->close();
    header('Location: loginForm.php');
} else {
    $readyPassword = sha1($_POST['password']);
    $sql1 = "INSERT INTO dane_klient (imie, nazwisko, numer_tel) VALUES ('$name', '$surname', '$telNumber')";
    $conn->query($sql1);
    $sql2 = "SELECT id FROM dane_klient WHERE imie = '$name' AND nazwisko = '$surname' AND numer_tel = '$telNumber'";
    $result = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $sql3 = "INSERT INTO uzytkownik (email, haslo, id_dane_klient) VALUES ('$email', '$readyPassword', '$id')";
    $conn->query($sql3);
    $_SESSION['LoggedIN'] = true;
    $sql4 = "SELECT id FROM uzytkownik WHERE email = '$email'";
    $result = $conn->query($sql4);
    $row = $result->fetch_assoc();
    $_SESSION['accID'] = $row['id'];
    $conn->close();
    header('Location: index.php');
}
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $readyPassword = sha1($_POST['password']);
    $origin = isset($_POST['origin']) ? $_POST['origin'] : 'loginForm';
    require 'db_connect.php';
    $sql = "SELECT * FROM uzytkownik WHERE email = '$email' AND haslo = '$readyPassword'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['LoggedIN'] = true;
        $row = $result->fetch_assoc();
        $_SESSION['accID'] = $row['id'];
        $conn->close();
        if ($origin === 'cart') {
            header('Location: cart.php');
        } else {
        header('Location: index.php');
    } 
    exit;
    } else {
        $_SESSION['logstatus'] = 'error';
        $conn->close();
        if ($origin === 'cart') {
            header('Location: cart.php');
        } else {
        header('Location: loginForm.php');
    }
    exit;
}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logOut'])) {
    $_SESSION['LoggedIN'] = false;
    $_SESSION['accID'] = null;
    $conn->close();
    header('Location: index.php');
}
?>

