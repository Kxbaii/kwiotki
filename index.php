<?php
session_start();
if (!isset($_SESSION['LoggedIN'])){
    $_SESSION['LoggedIN'] = false;
}
if (!isset($_SESSION['products_ids'])) {
    $_SESSION['products_ids'] = [];
}

if (isset($_POST['product_id']) && isset($_POST['addToCart'])) {
    $product_id = $_POST['product_id'];

    if (!in_array($product_id, $_SESSION['products_ids'])) {
        $_SESSION['products_ids'][] = $product_id;
    }
}

if (isset($_GET['reset_cart']) && $_GET['reset_cart'] == 'true') {
    $_SESSION['products_ids'] = [];  
    echo "<h6>Cart has been reset.</h6>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="scroll-wrapper">
        <section class="landingpagebg">
            <section class="landingpageshadow">
                <section class="landingpage">
                    <header class="landingpageTOP">
                        <h1 class="pseudologo">Greenery</h1>
                        <nav class="headerButtons">
                            <a href="
                            <?php if($_SESSION['LoggedIN'] == false){
                                echo "loginForm.php";
                                } elseif ($_SESSION['LoggedIN'] == true) {
                                    echo "account.php";
                                };
                                ?>" 
                            class="href">
                            <img src="images/Bez nazwy.png" alt="" class="navIMG"></a>
                            <a href="cart.php" class="href2"><h4 class="amountCart">0</h4><img src="images/grocery-store.png" alt="" class="navIMG"></a>
                        </nav>
                    </header>
                    <div class="mainContent">
                        <section class="landingpageLEFT">
                            <h1 class="motto">Prostota natury, piękno twoje.</h1>
                            <h2>
                                W Greenery wierzymy, że prawdziwe piękno to prostota natury. Każda roślina to odrobina harmonii, która wzbogaca Twoje wnętrze i wprowadza spokój.
                            </h2>
                        </section>
                        <section class="landingpageRIGHT">
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
                            <div class="scroll-bar">
                                <div class="scroll-indicator"></div>
                            </div>
                        </section>
                    </div>
                    <footer class="landingpageDOWN">
                        <a href="#exampleProducts" class="more">Sprawdź naszą ofertę!</a>
                    </footer>
                </section>
            </section>
        </section>
        <section class="transition"></section>
        <section id="exampleProductsbg">
            <section id="exampleProducts">
                <?php
                require 'db_connect.php';
                $sql = "SELECT * FROM produkty";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='productCard'>
                            <img src='images/" . ($row["zdjecie"]) . ".jpeg' alt='" . ($row["nazwa"]) . "' class='productCardIMG'>
                            <div class='overlay'>
                                <h1 class='productName'>" . ($row["nazwa"]) . "</h1>
                                <div class='productBottom'>
                                    <h3>Cena: " . ($row['cena']) . "zł</h3>
                                    <form class='formm' method='POST'>
                                        <button type='submit' name='addToCart' class='addToCart'><img src='images/plusIcon.svg' alt=''></button>
                                        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                    </form>
                                </div>
                            </div>
                            <div class='popup' id='popup-" . $row['id'] . "'>
                                <p><span>" . ($row["nazwa"]) . "</span> 
                                <br>  
                                </p>
                            </div>
                        </div>";
                    }
                    $conn->close();
                } else {
                    echo "0 results";
                }
                ?>
            </section>
        </section>
    </div>

    <script src="app.js" defer></script>
    <script src="app2.js" defer></script>

</body>
</html>
