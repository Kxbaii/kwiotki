document.addEventListener('DOMContentLoaded', function() {
    const increaseButtons = document.querySelectorAll('.plus');
    const decreaseButtons = document.querySelectorAll('.minus');
    const items = document.querySelectorAll('.product');
    const deleteButtons = document.querySelectorAll('.deleteProd');
    const amountItems = document.querySelector('.cartAmount')
    let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
    let cartAmount = cartArray.length;
    
    if (cartAmount == 1) {
        amountItems.textContent =  `Masz ${cartAmount} produkt w koszyku`
    } else if (cartAmount > 1 && cartAmount < 5) { 
        amountItems.textContent =  `Masz ${cartAmount} produkty w koszyku`
    } else {
        amountItems.textContent =  `Masz ${cartAmount} produktów w koszyku`
    }
    


    items.forEach(function(item){
        const productId = item.querySelector('input[name="productID"]').value;
        let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
        const product = cartArray.find(item => item.productId === productId);
        let product_price = item.querySelector(".productPrice").value;
        if (product) {
            item.querySelector('p[class="quantity"]').textContent = product.quantity;
            item.querySelector('p[class="price"]').textContent = product.quantity * product_price + "zł"
         }
})

    deleteButtons.forEach(function(button) {
button.addEventListener('click', function(event) {
    event.preventDefault();
    const productId = button.closest('.product').querySelector('input[name="productID"]').value;
    let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
    const product = cartArray.find(item => item.productId === productId);
    const index = cartArray.indexOf(product);
    if (index > -1) {
        cartArray.splice(index, 1);
        cartAmount = cartArray.length;
    }
    localStorage.setItem('cartArray', JSON.stringify(cartArray));
    let productName = button.closest('.product').querySelector('.productName').textContent;
    button.closest('.product').remove();
    const formData = new FormData();
        formData.append("product_id", productId);
        formData.append("action", "remove");
        fetch('update_cart.php', {
            method: 'POST',
            body: formData,
        })
        deleteSummary(productName)
        if (cartArray.length == 0){
            document.querySelector(".order").style.display = "none"
            document.querySelector(".adres").style.display = "none"
            document.querySelector(".info").textContent = "Brak produktów w koszyku"
            document.querySelector(".info").style.border = "none"
        }
        if (cartAmount == 1) {
            amountItems.textContent =  `Masz ${cartAmount} produkt w koszyku`
        } else if (cartAmount > 1 && cartAmount < 5) { 
            amountItems.textContent =  `Masz ${cartAmount} produkty w koszyku`
        } else {
            amountItems.textContent =  `Masz ${cartAmount} produktów w koszyku`
        }
})


    })
    increaseButtons.forEach(function(button) {
        button.addEventListener('click', function(event) { 
            const productId = button.closest('.product').querySelector('input[name="productID"]').value;
            let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
            const product = cartArray.find(item => item.productId === productId);
            let product_price = button.closest('.product').querySelector(".productPrice").value;
            if (product.quantity < 50){
            if (product) {
                product.quantity += 1; 
            }

            localStorage.setItem('cartArray', JSON.stringify(cartArray));
            updateSummary()
            button.parentElement.parentElement.querySelector('p[class="quantity"]').textContent = product.quantity;
            button.parentElement.parentElement.parentElement.querySelector('p[class="price"]').textContent = product.quantity * product_price + "zł"
        }
        });
    });

    decreaseButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            const productId = button.closest('.product').querySelector('input[name="productID"]').value;
            let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
            let product_price = button.closest('.product').querySelector(".productPrice").value;
            const product = cartArray.find(item => item.productId === productId);

            if (product && product.quantity > 1) {
                product.quantity -= 1; 
            }

            localStorage.setItem('cartArray', JSON.stringify(cartArray));
            updateSummary()
            button.parentElement.parentElement.querySelector('p[class="quantity"]').textContent = product.quantity;
            button.parentElement.parentElement.parentElement.querySelector('p[class="price"]').textContent = product.quantity * product_price + "zł"
        });
    });
if (cartArray.length > 0){
let summary = document.querySelector('.summary');
let podsumowanie = document.createElement('div');
podsumowanie.className = 'podsumowanie'
summary.prepend(podsumowanie);
    summary.querySelector('.info').remove()
    let info = document.createElement('h1');
        info.className = 'info';
        info.textContent = 'Podsumowanie';
        podsumowanie.prepend(info);
        info.style.borderBottom = '1px solid white';
   
    cartArray.forEach(function(product) {
    let productInfo = document.createElement('p');
    let productName = product.productName;
    let productPrice = product.productPrice;
    let productQuantity = product.quantity;
    let totalPrice = productPrice * productQuantity;
     productInfo.className = 'productInfoo';
     let productContent = `${productName} (${productPrice}zł) ${productQuantity}szt. • ${totalPrice}zł`
     productInfo.innerHTML = productContent;
    podsumowanie.appendChild(productInfo);
})
    } else {
        document.querySelector(".order").style.display = "none"
        document.querySelector(".adres").style.display = "none"
    }

document.querySelector(".changeAdres").addEventListener('click', function(event){
        document.querySelector(".adresWindowBG").style.display = "flex"

})
document.querySelector(".close").addEventListener('click', function(event){
document.querySelector(".adresWindowBG").style.display = "none"
})

const radios = document.querySelectorAll('input[type="radio"]');
radios.forEach(radio => {
    radio.addEventListener('change', function () {
        radios.forEach(r => {
            if (r !== this) {
                r.checked = false;
            }
            document.querySelectorAll('.adres').forEach(adres => adres.classList.remove('selected'));
            radio.closest('.adres').classList.add('selected');
        });
    });
});
});


function updateSummary(){
    let cartArray = JSON.parse(localStorage.getItem('cartArray')) || [];
    if (cartArray.length > 0){
let summary = document.querySelector('.summary');
document.querySelector('.podsumowanie').remove();
let podsumowanie = document.createElement('div');
podsumowanie.className = 'podsumowanie'
summary.prepend(podsumowanie);
if (summary.querySelector('.info')){
summary.querySelector('.info').remove()
}
    let info = document.createElement('h1');
        info.className = 'info';
        info.textContent = 'Podsumowanie';
        podsumowanie.prepend(info);
        info.style.borderBottom = '1px solid white';
    
    cartArray.forEach(function(product) {
    let productInfo = document.createElement('p');
    let productName = product.productName;
    let productPrice = product.productPrice;
    let productQuantity = product.quantity;
    let totalPrice = productPrice * productQuantity;
     productInfo.className = 'productInfoo';
     let productContent = `${productName} (${productPrice}zł) ${productQuantity}szt. • ${totalPrice}zł`
     productInfo.innerHTML = productContent;
    podsumowanie.appendChild(productInfo);
})
}
}

function deleteSummary(productName){
let summary = document.querySelector('.podsumowanie');
summary.childNodes.forEach(function(product){
if (product.textContent.includes(productName)){
    product.remove();
}
})

}





