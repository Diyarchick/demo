document.addEventListener('DOMContentLoaded', async () => {
    const gameList = document.querySelector('.game-list');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    let games = await fetchGames();

    async function fetchGames() {
        const response = await fetch('get_games.php');
        return await response.json();
    }

    function renderGames(games) {
        gameList.innerHTML = '';
        games.forEach(game => {
            const gameItem = document.createElement('div');
            gameItem.classList.add('game-item');
            gameItem.innerHTML = `
                <img src="${game.image}" alt="${game.name}">
                <h3>${game.name}</h3>
                <p>${game.description}</p>
                <p>Цена: $${game.price}</p>
                <p>Рейтинг: ${game.rating.toFixed(1)}</p>
                <button onclick="addToCart(${game.id})">Добавить в корзину</button>
               
            `;
            gameList.appendChild(gameItem);
        });
    }

    searchButton.addEventListener('click', async () => {
        const query = searchInput.value.toLowerCase();
        const filteredGames = games.filter(game => game.name.toLowerCase().includes(query));
        renderGames(filteredGames);
    });

    window.addToCart = async function(gameId) {
        const response = await fetch('add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ gameId })
        });
        const result = await response.json();
        if (result.success) {
            alert(`${result.gameName} добавлен в корзину!`);
        }
    };

    window.showReviewForm = function(gameId) {
        const game = games.find(g => g.id === gameId);
        if (!game) {
            alert('Игра не найдена');
            return;
        }
        const reviewForm = document.createElement('div');
        reviewForm.classList.add('review-form');
        reviewForm.innerHTML = `
         
            <input type="text" id="reviewer-name" placeholder="Ваше имя">
            <textarea id="review-text" placeholder="Ваш отзыв"></textarea>
            <select id="review-rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button onclick="submitReview(${game.id})">Отправить</button>
        `;
        document.body.appendChild(reviewForm);
    };

    window.submitReview = async function(gameId) {
        const name = document.getElementById('reviewer-name').value;
        const text = document.getElementById('review-text').value;
        const rating = parseInt(document.getElementById('review-rating').value);
        const response = await fetch('submit_review.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ gameId, name, text, rating })
        });
        const result = await response.json();
        if (result.success) {
            games = await fetchGames();
            renderGames(games);
            alert('Ваш отзыв был отправлен!');
            document.querySelector('.review-form').remove();
        } else {
            alert(result.message);
        }
    };

    renderGames(games);
});
