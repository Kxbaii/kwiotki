<?php
session_start();
if (!isset($_SESSION['adres'])) {
    $_SESSION['adres'] = 1;
}

if (isset($_POST['deleteProd'])) {
    $product_id = $_POST['productID'];

    $id = array_search($product_id, $_SESSION['products_ids']);
    
    if ($id !== false) {
        unset($_SESSION['products_ids'][$id]);
        $_SESSION['products_ids'] = array_values($_SESSION['products_ids']);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cart.css">
    <script src="app3.js"></script>
    <script src="cart.js" defer></script>
    <link rel="stylesheet" href="addresswindow.css">
</head>
<body>
    <section class="main">
        <header>
            <h1 class="pseudologo">Koszyk</h1>
            <nav class="headerButtons">
            <a href="index.php" class="href2"><img src="images/home.png" alt="" class="navIMG"></a>
                            <a href="
                            <?php if($_SESSION['LoggedIN'] == false){
                                echo "loginForm.php";
                                } elseif ($_SESSION['LoggedIN'] == true) {
                                    echo "account.php";
                                };
                                ?>" 
                            class="href">
                            <img src="images/Bez nazwy.png" alt="" class="navIMG"></a>
                        </nav>
        </header>
        <section class="bot">
            <section class="left">
                <h1 class="cartAmount">
                    Masz 0 produktów w koszyku.
                </h1>
                <div class="productsContainter">
                    <?php 
                    require 'db_connect.php';
                    
                
                    if (!empty($_SESSION['products_ids'])) {
                        $product_ids = implode(',', $_SESSION['products_ids']);
                        $sql = "SELECT * FROM produkty WHERE id IN ($product_ids)";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="product">
                                    <img src='images/<?php echo $row["zdjecie"]; ?>.jpeg' alt='<?php echo $row["nazwa"]; ?>' class='productIMG'>
                                    <h1 class="productName"><?php echo $row['nazwa']; ?></h1>
                                    <div class="productamount">
                                        <p class="quantity">1</p>
                                        <div class="amountButtons">
                                            <button class="minus">-</button>
                                            <button class="plus">+</button>
                                        </div>
                                    </div>
                                    <p class="price"><?php echo $row['cena']; ?>zł</p>
                                    <form>
                                        <button class="deleteProd"><img src="images/bin.png" alt="" class="binIMG"></button>
                                        <input type="hidden" id="productID" name="productID" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" class="productPrice" value="<?php echo $row['cena'];?>">
                                    </form>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Brak produktów w koszyku";
                        }
                    } else {
                        echo "Twój koszyk jest pusty.";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
            <section class="right">
            <p class="userData"><?php
                        if ($_SESSION['LoggedIN'] == true) {
                            require 'db_connect.php';
                            $sql = "SELECT * FROM dane_klient WHERE id = " . $_SESSION['accID'];
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "Witaj, " . $row['imie'] . " " . $row['nazwisko'] . "!";
                            $conn->close();
                        } else {
                            echo "";
                        }
                        ?></p>

<div class="summary">
<?php
if ($_SESSION['LoggedIN'] == false) {
    echo '<h1 class="info">Aby kontynuuować musisz być zalogowany</h1>
    <form method="post" action="loginHandler.php"> 
        <div class="formInput">
            <input type="email" placeholder="example@example.com" id="email" name="email" required>
            <label for="email">Adres e-mail</label>
        </div>
        <div class="formInput">
            <input type="password" id="logpassword" name="password" placeholder="*****" required>
            <label for="password">Hasło</label>
        </div>
        <input type="hidden" name="origin" value="cart">';
    if (isset($_SESSION["logstatus"]) && $_SESSION["logstatus"] == "error") {
        echo '<input type="submit" value="Niepoprawne dane logowania" id="logiin" style="color:red;">';
        $_SESSION["logstatus"] = null;
        echo '<script>
            var login = document.getElementById("logiin");
            setTimeout(function(){
                if (login){
                    login.style.color = "";
                    login.value = "Zaloguj się";
                }
            }, 2000)
        </script>';
    } else {
        echo '<input type="submit" value="Zaloguj się" id="logiin">';
    }
echo'<h1 class="regInfo">
        Nie masz konta? <br> <span>Możesz je stworzyć poniżej!</span>
        </h1>
<a href="loginForm.php" class="registerButton">Zarejestruj się</a>
</form>';}
?>

<?php
echo '<h1 class="info">Brak produktów w koszyku</h1>';
echo '<a href="" class="order">Złóż zamówienie</a>


<div class="adresMain">
    <h1 class="adresInfo">Adres dostawy:</h1>
    <p class="imienazwisko">Anna Nowak</p>
    <p class="ulica">Sportowa 20</p>
    <p class="miasto">Częstochowa 42-200</p>
    <button class="changeAdres">Zmień adres</button>

</div>';

?>
</div>
<script>
    
</script>
            </section>
        </section>
    </section>

<div class="adresWindowBG">
    <div class="addresswindow">
        <header class="address">
            <button class="close">
                <img src="images/close.png" alt="">
            </button>
        </header>
        <section class="addressmain">
    <div class="adresy">
        <div class="adres selected">
            <form action="cart.php" method="POST" class="adresFORM">
                <input type="radio" name="adresSelect" id="adres1" value="adres1">
                <label for="adres1">
                    <div class="dane">
                        <h1 class="imie">Anna Nowak</h1>
                        <p class="ulica">Sportowa 20</p>
                        <p class="miasto">Częstochowa 42-200</p>
                    </div>
                </label>
            </form>
        </div>

        <div class="adres">
            <form action="cart.php" method="POST" class="adresFORM">
                <input type="radio" name="adresSelect" id="adres2" value="adres2">
                <label for="adres2">
                    <div class="dane">
                        <h1 class="imie">Anna Nowak</h1>
                        <p class="ulica">Sportowa 20</p>
                        <p class="miasto">Częstochowa 42-200</p>
                    </div>
                </label>
            </form>
        </div>



    </div>
</section>
    </div>
    </div>
</body>
</html>
