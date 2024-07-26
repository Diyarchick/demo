document.addEventListener('DOMContentLoaded', async () => {
    let cartItems = await fetchCartItems();
    const cartContainer = document.querySelector('.cart-items');
    const totalCostElement = document.querySelector('.total-cost');
    const checkoutButton = document.getElementById('checkout-button');

    async function fetchCartItems() {
        const response = await fetch('get_cart.php');
        return await response.json();
    }

    function renderCartItems() {
        cartContainer.innerHTML = '';
        cartItems.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <h3>${item.name}</h3>
                <p>Цена: $${item.price}</p>
                <button class="remove-item" data-index="${index}">Удалить</button>
            `;
            cartContainer.appendChild(cartItem);
        });
        updateTotalCost();
    }

    function updateTotalCost() {
        const totalCost = cartItems.reduce((total, item) => total + parseFloat(item.price), 0);
        totalCostElement.textContent = `Общая стоимость: $${totalCost.toFixed(2)}`;
    }

    async function removeItem(index) {
        const response = await fetch('remove_from_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ index })
        });
        const result = await response.json();
        if (result.success) {
            cartItems.splice(index, 1);
            renderCartItems();
        } else {
            alert(result.message);
        }
    }

    cartContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-item')) {
            const index = event.target.getAttribute('data-index');
            removeItem(index);
        }
    });

    checkoutButton.addEventListener('click', async () => {
        if (cartItems.length > 0) {
            const response = await fetch('checkout.php', { method: 'POST' });
            const result = await response.json();
            if (result.success) {
                window.location.href = 'confirm.php';
            }
        } else {
            alert('Ваша корзина пуста.');
        }
    });

    renderCartItems();
});
