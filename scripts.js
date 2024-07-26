document.addEventListener('DOMContentLoaded', () => {
    const games = [
        { id: 1, name: 'Game 1', price: 29.99, description: 'Описание игры 1', image: 'game1.jpg' },
        { id: 2, name: 'Game 2', price: 49.99, description: 'Описание игры 2', image: 'game2.jpg' },
        { id: 3, name: 'Game 3', price: 19.99, description: 'Описание игры 3', image: 'game3.jpg' },
    ];

    const gameList = document.querySelector('.game-list');
    const cartItems = document.querySelector('.cart-items');
    const loginButton = document.getElementById('login-button');
    const registerButton = document.getElementById('register-button');
    const logoutButton = document.getElementById('logout-button');
    const userInfo = document.getElementById('user-info');
    const loginForm = document.getElementById('login-form');
    const userNameSpan = document.getElementById('user-name');

    function renderGames() {
        if (gameList) {
            gameList.innerHTML = '';
            games.forEach(game => {
                const gameItem = document.createElement('div');
                gameItem.classList.add('game-item');
                gameItem.innerHTML = `
                    <img src="${game.image}" alt="${game.name}">
                    <h3>${game.name}</h3>
                    <p>${game.description}</p>
                    <p>Цена: $${game.price}</p>
                    <button onclick="addToCart(${game.id})">Добавить в корзину</button>
                `;
                    gameList.appendChild(gameItem);
                });
            }
        }
    
        window.addToCart = function (gameId) {
            const game = games.find(g => g.id === gameId);
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <h3>${game.name}</h3>
                <p>Цена: $${game.price}</p>
            `;
            if (cartItems) {
                cartItems.appendChild(cartItem);
            }
        }
    
        loginButton.addEventListener('click', () => {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            if (username && password) {
                const users = JSON.parse(localStorage.getItem('users')) || {};
                if (users[username] && users[username] === password) {
                    localStorage.setItem('currentUser', username);
                    userNameSpan.textContent = username;
                    loginForm.style.display = 'none';
                    userInfo.style.display = 'block';
                } else {
                    alert('Неверное имя пользователя или пароль');
                }
            }
        });
    
        registerButton.addEventListener('click', () => {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            if (username && password) {
                let users = JSON.parse(localStorage.getItem('users')) || {};
                if (!users[username]) {
                    users[username] = password;
                    localStorage.setItem('users', JSON.stringify(users));
                    alert('Регистрация успешна! Теперь вы можете войти.');
                } else {
                    alert('Пользователь с таким именем уже существует');
                }
            } else {
                alert('Пожалуйста, заполните все поля');
            }
        });
    
        logoutButton.addEventListener('click', () => {
            localStorage.removeItem('currentUser');
            loginForm.style.display = 'flex';
            userInfo.style.display = 'none';
        });
    
        const savedUsername = localStorage.getItem('currentUser');
        if (savedUsername) {
            userNameSpan.textContent = savedUsername;
            loginForm.style.display = 'none';
            userInfo.style.display = 'block';
        }
    
        renderGames();
    });
    