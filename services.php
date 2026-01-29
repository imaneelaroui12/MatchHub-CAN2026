<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services CAN 2026 - Transport & Hébergement</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroc-vert: #064e3b;
            --maroc-vert-light: #0d7a5d;
            --maroc-rouge: #991b1b;
            --gold: #d4af37;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0; 
            background-color: #f3f4f6; 
            color: #111827; 
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
        }
        
        /* NAVIGATION HARMONISÉE AVEC L'ACCUEIL */
        nav { 
            background: linear-gradient(90deg, var(--maroc-vert) 0%, var(--maroc-vert-light) 100%);
            color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; 
            position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid var(--gold);
        }
        
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; transition: 0.3s; padding: 8px 12px; border-radius: 5px; }
        .nav-links a:hover { background: rgba(255,255,255,0.1); color: var(--gold); }

        /* HERO MINI POUR LES SERVICES */
        .hero-mini { 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1542296332-2e4473faf563?q=80&w=1200'); 
            background-size: cover; background-position: center; color: white; padding: 60px 20px; text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .container { max-width: 1100px; margin: -40px auto 50px; padding: 0 20px; }
        
        .header-section h1 { color: white; margin-bottom: 10px; font-weight: 800; font-size: 2.5rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.5); }
        .header-section p { color: rgba(255,255,255,0.9); font-size: 1.1rem; }

        /* GRILLE ET CARTES WOW */
        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 35px; }
        
        .service-card { 
            background: var(--glass); 
            backdrop-filter: blur(10px);
            border-radius: 25px; 
            padding: 35px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            border-top: 8px solid var(--maroc-rouge);
            transition: 0.4s;
        }
        .service-card:hover { transform: translateY(-10px); box-shadow: 0 20px 45px rgba(0,0,0,0.15); }

        .service-card h2 { color: var(--maroc-vert); display: flex; align-items: center; gap: 12px; margin-top: 0; font-weight: 800; font-size: 1.6rem; }
        
        .form-group { margin-bottom: 25px; text-align: left; }
        label { display: block; font-weight: 600; margin-bottom: 10px; color: #374151; font-size: 0.95rem; }
        select, input { 
            width: 100%; padding: 14px; border: 2px solid #e5e7eb; border-radius: 12px; 
            font-size: 1rem; box-sizing: border-box; transition: 0.3s; font-family: 'Poppins', sans-serif;
        }
        select:focus, input:focus { border-color: var(--maroc-vert); outline: none; background: #f0fdf4; }
        
        .info-box { 
            background: #fffbeb; border-left: 5px solid var(--gold); padding: 18px; 
            border-radius: 12px; font-size: 0.9rem; margin-bottom: 25px; color: #92400e;
        }
        
        .btn-service { 
            background: linear-gradient(135deg, var(--maroc-vert) 0%, #043a2c 100%);
            color: white; border: none; padding: 16px; border-radius: 12px; cursor: pointer; 
            font-weight: 800; width: 100%; font-size: 1.1rem; transition: 0.3s; text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(6, 78, 59, 0.3);
        }
        .btn-service:hover { filter: brightness(1.2); transform: scale(1.02); }

        footer { background: #0f172a; color: white; text-align: center; padding: 50px 20px; margin-top: 80px; }
        footer a { color: var(--gold); font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026 <span style="color:var(--gold)">SERVICES</span></div>
    <div class="nav-links">
        <a href="index.php">Calendrier</a>
        <a href="services.php">Transport & Hôtels</a>
        <a href="stats.php">Live & Stats</a>
        <a href="inscription.php" style="background:var(--maroc-rouge); border-radius:8px;">S'inscrire</a>
    </div>
</nav>

<div class="hero-mini">
    <div class="header-section">
        <h1>Logistique et Réservations</h1>
        <p>Optimisez votre expérience CAN 2026 dans les 6 villes hôtes du Royaume.</p>
    </div>
</div>

<div class="container">
    <div class="services-grid">
        
        <div class="service-card">
            <h2>🚌 Transport & Navettes</h2>
            <p style="color:#666; margin-bottom:25px;">Navettes officielles reliant les gares, aéroports et les 9 stades.</p>
            
            <div class="form-group">
                <label>Ville de départ :</label>
                <select>
                    <option>Rabat (Gare Agdal / Ville)</option>
                    <option>Casablanca (Gare Voyageurs)</option>
                    <option>Tanger (Gare Tanger Ville)</option>
                    <option>Marrakech (Gare Marrakech)</option>
                    <option>Fès (Gare Fès)</option>
                    <option>Agadir (Centre Ville)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Stade de destination :</label>
                <select>
                    <option>Rabat - Prince Moulay Abdellah</option>
                    <option>Rabat - Stade Al Barid</option>
                    <option>Rabat - Stade Olympique Annexe</option>
                    <option>Rabat - Moulay El Hassan</option>
                    <option>Casablanca - Stade Mohammed V</option>
                    <option>Marrakech - Grand Stade</option>
                    <option>Agadir - Grand Stade</option>
                    <option>Fès - Complexe Sportif</option>
                    <option>Tanger - Grand Stade (Ibn Batouta)</option>
                </select>
            </div>

            <div class="info-box">
                📍 <strong>Note Officielle :</strong> Les navettes circulent 3h avant le match et 2h après le coup de sifflet final.
            </div>

            <button class="btn-service">Réserver Navette (50 DH)</button>
        </div>

        <div class="service-card">
            <h2>🏨 Hébergement Partenaire</h2>
            <p style="color:#666; margin-bottom:25px;">Réservez dans les hôtels officiels à proximité des sites de compétition.</p>
            
            <div class="form-group">
                <label>Sélectionnez la Ville Hôte :</label>
                <select>
                    <option>Rabat (4 stades à proximité)</option>
                    <option>Casablanca (Stade Mohammed V)</option>
                    <option>Tanger (Grand Stade)</option>
                    <option>Marrakech (Grand Stade)</option>
                    <option>Agadir (Grand Stade)</option>
                    <option>Fès (Complexe Sportif)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Type de logement :</label>
                <select>
                    <option>Hôtel 5★ (Pack Premium)</option>
                    <option>Hôtel 4★ (Confort)</option>
                    <option>Hôtel 3★ (Standard)</option>
                    <option>Appartement certifié CAN</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nombre de nuitées :</label>
                <input type="number" min="1" placeholder="Ex: 2">
            </div>

            <button class="btn-service" style="background: linear-gradient(135deg, var(--maroc-rouge) 0%, #7f1d1d 100%);">Rechercher les disponibilités</button>
        </div>

    </div>
</div>

<footer>
    <p style="font-size: 1.2rem; font-weight: 800; margin-bottom: 5px;">&copy; 2026 Comité d'Organisation CAN Maroc</p>
    <p style="opacity: 0.7; margin-bottom: 20px;">Gestion des 9 Stades Officiels du Royaume</p>
    <p><a href="admin_dashboard.php">Espace Administratif</a> | <a href="#" style="color:white; font-weight:normal; opacity:0.8;">Contactez le Support</a></p>
</footer>

</body>
</html>