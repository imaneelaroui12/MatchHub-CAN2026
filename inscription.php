<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire - CAN 2026 Maroc</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --maroc-vert: #064e3b; --maroc-vert-light: #0d7a5d; --maroc-rouge: #991b1b; --gold: #d4af37; }
        
        body { 
            font-family: 'Poppins', sans-serif; margin: 0; background: #f3f4f6;
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            display: flex; flex-direction: column; min-height: 100vh;
        }

        nav { 
            background: linear-gradient(90deg, var(--maroc-vert) 0%, var(--maroc-vert-light) 100%);
            color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2); border-bottom: 3px solid var(--gold);
        }
        
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; transition: 0.3s; padding: 8px 12px; border-radius: 5px; }

        .auth-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }

        .register-card { 
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);
            width: 100%; max-width: 500px; border-radius: 25px; padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1); border-top: 8px solid var(--maroc-rouge);
            text-align: center;
        }

        .register-card h2 { color: var(--maroc-vert); font-weight: 800; font-size: 2rem; margin-bottom: 10px; }
        .register-card p { color: #666; margin-bottom: 30px; }

        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #374151; }
        
        input, select { 
            width: 100%; padding: 14px; border: 2px solid #e5e7eb; border-radius: 12px; 
            font-size: 1rem; box-sizing: border-box; transition: 0.3s; font-family: 'Poppins', sans-serif;
        }
        input:focus { border-color: var(--maroc-vert); outline: none; background: #f0fdf4; }

        /* Style pour le conteneur du mot de passe */
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            cursor: pointer;
            color: #666;
            user-select: none;
            font-size: 1.2rem;
        }

        .btn-register { 
            background: linear-gradient(135deg, var(--maroc-rouge) 0%, #7f1d1d 100%);
            color: white; border: none; padding: 16px; border-radius: 12px; cursor: pointer; 
            font-weight: 800; width: 100%; font-size: 1.1rem; transition: 0.3s; text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(153, 27, 27, 0.3); margin-top: 10px;
        }
        .btn-register:hover { filter: brightness(1.2); transform: scale(1.02); }

        .social-login { margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; font-size: 0.9rem; color: #888; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026 <span style="color:var(--gold)">MAROC</span></div>
    <div class="nav-links">
        <a href="index.php">Calendrier</a>
        <a href="services.php">Transport & Hôtels</a>
        <a href="stats.php">Live & Stats</a>
        <a href="inscription.php" style="color:var(--gold)">S'inscrire</a>
    </div>
</nav>

<div class="auth-container">
    <div class="register-card">
        <h2>Créer un compte</h2>
        <p>Rejoignez la communauté des supporters de la CAN 2026.</p>
        
        <form>
            <div class="form-group">
                <label>Nom Complet</label>
                <input type="text" placeholder="Ex: Yassine Bounou" required>
            </div>
            
            <div class="form-group">
                <label>Adresse Email</label>
                <input type="email" placeholder="votre@email.com" required>
            </div>

            <div class="form-group">
                <label>Ville de préférence (Billetterie)</label>
                <select>
                    <option>Rabat (4 stades)</option>
                    <option>Casablanca</option>
                    <option>Tanger</option>
                    <option>Marrakech</option>
                    <option>Agadir</option>
                    <option>Fès</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <div class="password-container">
                    <input type="password" id="password" placeholder="••••••••" required>
                    <span class="toggle-password" id="togglePassword">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn-register">Créer mon compte supporter</button>
        </form>

        <div class="social-login">
            Déjà inscrit ? <a href="#" style="color:var(--maroc-vert); font-weight:bold; text-decoration:none;">Se connecter</a>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Basculer le type d'attribut
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Changer l'icône (Œil ouvert / Œil barré ou fermé)
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

</body>
</html>