<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <div class="container">
            <h1>Connexion</h1>
            <form id="login-form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <h1>Inscription</h1>
            <form id="register-form">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email:</label>
                    <input type="email" id="register-email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Mot de passe:</label>
                    <input type="password" id="register-password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="register-password-confirm">Confirmer le mot de passe:</label>
                    <input type="password" id="register-password-confirm" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">S'inscrire</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            axios.post('/api/login', { email, password })
                .then(response => {
                    alert('Connexion réussie!');
                    // Redirection ou autre action
                })
                .catch(error => {
                    alert('Erreur de connexion.');
                });
        });

        document.getElementById('register-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const passwordConfirmation = document.getElementById('register-password-confirm').value;

            axios.post('/api/register', { name, email, password, password_confirmation: passwordConfirmation })
                .then(response => {
                    alert('Inscription réussie!');
                    // Redirection ou autre action
                })
                .catch(error => {
                    alert('Erreur d\'inscription.');
                });
        });
    </script>
</body>
</html>
