import './bootstrap';

// Функція для отримання даних про користувача та відображення їх у таблиці (GET)
function getUsers() {
    axios.get('/api/users')
        .then(response => {
            const users = response.data;
            const tableBody = document.querySelector('#userTable tbody');
            tableBody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.city}</td>
                    <td>${user.images_count}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error(error);
        });
}


// Функція для відправки даних користувача і зображення на сервер (POST)
function addUser(event) {
    event.preventDefault();

    const form = document.getElementById('userForm');
    const name = document.getElementById('name').value;
    const city = document.getElementById('city').value;
    const image = document.getElementById('image').files[0];

    const formData = new FormData();
    formData.append('name', name);
    formData.append('city', city);
    formData.append('image', image);

    axios.post('/api/users', formData)
        .then(response => {
            form.reset();
            getUsers();
        })
        .catch(error => {
            console.error(error);
        });
}

// Загрузка данных пользователей при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    getUsers();
});

// Обработка отправки формы
document.getElementById('userForm').addEventListener('submit', addUser);

