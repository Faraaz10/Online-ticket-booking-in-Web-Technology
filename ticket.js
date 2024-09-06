document.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector('.search');
    const loginForm = document.querySelector('.form-container');
    const loginButton = document.querySelector('#login');
    const closeButton = document.querySelector('#close-btn');

    document.querySelector('#search-box').onclick = () => {
        search.classList.toggle('active');
    };

    window.onscroll = () => {
        search.classList.remove('active');
        if (window.scrollY > 80) {
            document.querySelector('.header1').classList.add('active');
        } else {
            document.querySelector('.header1').classList.remove('active');
        }
    };

    window.onload = () => {
        if (window.scrollY > 80) {
            document.querySelector('.header1').classList.add('active');
        } else {
            document.querySelector('.header1').classList.remove('active');
        }
    };

    if (loginButton) {
        loginButton.addEventListener('click', () => {
            alert('Login button clicked!');
            loginForm.classList.toggle('active');
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', () => {
            loginForm.classList.remove('active');
        });
    }
});
