document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('login-button');
    const registerButton = document.getElementById('register-button');
    const logoutButton = document.getElementById('logout-button');
    const userInfo = document.getElementById('user-info');
    const loginForm = document.getElementById('login-form');
    const userNameSpan = document.getElementById('user-name');

    loginButton?.addEventListener('click', async () => {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        if (username && password) {
            const response = await fetch('login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            });
            const result = await response.json();
            if (result.success) {
                localStorage.setItem('currentUser', result.username);
                userNameSpan.textContent = result.username;
                loginForm.style.display = 'none';
                userInfo.style.display = 'block';
            } else {
                alert(result.message);
            }
        }
    });

    registerButton?.addEventListener('click', async () => {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        if (username && password) {
            const response = await fetch('register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            });
            const result = await response.json();
            if (result.success) {
                alert('Регистрация успешна! Теперь вы можете войти.');
            } else {
                alert(result.message);
            }
        } else {
            alert('Пожалуйста, заполните все поля');
        }
    });

    logoutButton?.addEventListener('click', () => {
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
});
