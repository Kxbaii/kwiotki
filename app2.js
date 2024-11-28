document.addEventListener('DOMContentLoaded', function() {
    var forms = document.querySelectorAll(".formm");
    var cartItems = document.querySelector(".amountCart");


    let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];


    if (cartArray.length > 0) {
        cartItems.textContent = cartArray.length;
        cartItems.style.visibility = "visible";
    } else {
        cartItems.style.visibility = "hidden";
    }

    forms.forEach(function(form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            var productId = form.querySelector("input[name='product_id']").value;
            var productname = form.parentElement.parentElement.querySelector(".productName").textContent;
            var productprice = form.parentElement.querySelector("h3").textContent.match(/\d+/)[0];

            let product = cartArray.find(item => item.productId == productId);

            if (!product) {

                cartArray.push({
                    productId: productId,
                    productName: productname,
                    productPrice: productprice,
                    quantity: 1
                });
            }


            localStorage.setItem('cartArray', JSON.stringify(cartArray));


            cartItems.textContent = cartArray.length;
            cartItems.style.visibility = "visible";

            let info = false
            var popup = document.getElementById('popup-' + productId);
            if (!product && !info) {
                let p = document.createElement('p')
                p.innerHTML = "Dodano do koszyka"
                p.id = "succADD"
                popup.appendChild(p)
                info = true
            } else if (product && !info) {
                let p = document.createElement('p')
                p.innerHTML = "Produkt znajduje się już w koszyku"
                p.id = "errorADD"
                popup.appendChild(p)
                info = true
            }
            if (popup) {
                popup.classList.add('show')
                setTimeout(function() {
                    popup.classList.add('hide')
                    setTimeout(function() {
                        popup.classList.remove('show')
                        popup.classList.remove('hide')
                    }, 500);
                    if (document.getElementById("succADD")) {
                        document.getElementById("succADD").remove()
                        info = false
                    } else if (document.getElementById("errorADD")) {
                        document.getElementById("errorADD").remove()
                        info = false
                    }
                }, 2500);
            }

            var formData = new FormData();
            formData.append("product_id", productId);
            formData.append("addToCart", "1");
            fetch('index.php', {
                method: 'POST',
                body: formData
            });
        });
    });
});