<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAN 2026 - Plateforme Officielle Maroc</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroc-vert: #064e3b;
            --maroc-vert-light: #0d7a5d;
            --maroc-rouge: #991b1b;
            --gold: #d4af37;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0; 
            background-color: #f3f4f6; 
            color: #111827; 
            line-height: 1.5;
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            scroll-behavior: smooth;
        }
        
        nav { 
            background: linear-gradient(90deg, var(--maroc-vert) 0%, var(--maroc-vert-light) 100%);
            color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; 
            position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border-bottom: 3px solid var(--gold);
        }
        
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; transition: 0.3s; padding: 8px 12px; border-radius: 5px; }
        .nav-links a:hover { background: rgba(255,255,255,0.1); color: var(--gold); }
        .btn-nav { background: var(--maroc-rouge); }

        .hero { 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000'); 
            background-size: cover; background-position: center; color: white; padding: 100px 20px; text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        /* --- BARRE DE RECHERCHE --- */
        .search-box {
            max-width: 600px; margin: -30px auto 40px; position: relative; z-index: 10;
        }
        .search-box input {
            width: 100%; padding: 20px 30px; border-radius: 50px; border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-size: 1.1rem; outline: none;
            font-family: 'Poppins', sans-serif;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .section-title { border-left: 6px solid var(--maroc-rouge); padding-left: 15px; margin: 50px 0 25px; color: var(--maroc-vert); text-transform: uppercase; font-size: 1.8rem; font-weight: 800; }

        .date-header { 
            padding: 12px 25px; border-radius: 50px; color: white; font-weight: bold; margin-top: 40px; 
            display: inline-flex; align-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-transform: uppercase; letter-spacing: 1px;
        }
        .bg-green { background: linear-gradient(135deg, #10b981, #059669); } 
        .bg-yellow { background: linear-gradient(135deg, #f59e0b, #d97706); } 
        .bg-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); } 
        .bg-brown { background: linear-gradient(135deg, #78350f, #451a03); } 

        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; margin-top: 20px; }
        
        .match-card { 
            background: rgba(255, 255, 255, 0.95); border-radius: 18px; padding: 25px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.06); border-top: 5px solid var(--maroc-vert); 
            transition: 0.4s; backdrop-filter: blur(5px); position: relative; overflow: hidden;
        }
        .match-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 35px rgba(6, 78, 59, 0.2);
            border-top-color: var(--maroc-rouge);
        }
        
        .match-time { color: var(--maroc-rouge); font-weight: 800; font-size: 1.1rem; display: block; margin-bottom: 8px; }
        .match-teams { font-size: 1.3rem; font-weight: 800; margin-bottom: 12px; color: #1f2937; }
        .match-stadium { font-size: 0.9rem; color: #6b7280; margin-bottom: 20px; min-height: 45px; display: flex; align-items: center; gap: 5px; }
        
        .price-tag { 
            display: block; color: var(--maroc-vert); font-weight: 800; font-size: 1.2rem; 
            margin-bottom: 15px; border-top: 2px dashed #eee; padding-top: 15px; 
        }
        
        .btn { 
            background: linear-gradient(135deg, var(--maroc-rouge) 0%, #7f1d1d 100%);
            color: white; border: none; padding: 14px; border-radius: 10px; cursor: pointer; 
            font-weight: bold; width: 100%; transition: 0.3s; text-transform: uppercase;
        }
        .btn:hover { filter: brightness(1.2); transform: scale(1.02); }

        .final-highlight { border: 3px solid var(--gold); background: #fffbeb; text-align: center; }
        footer { background: #0f172a; color: white; text-align: center; padding: 50px; margin-top: 80px; }
        footer a { color: var(--gold); text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<nav>
    <div style="font-size: 1.5rem; font-weight: 800;">🏆 CAN 2026 <span style="color:var(--gold)">MAROC</span></div>
    <div class="nav-links">
        <a href="index.php">Calendrier</a>
        <a href="services.php">Transport & Hôtels</a>
        <a href="stats.php">Live & Stats</a>
        <a href="inscription.php" class="btn-nav">S'inscrire</a>
    </div>
</nav>

<div class="hero">
    <h1>PLATEFORME OFFICIELLE CAN 2025/26</h1>
    <p>Billetterie, Logistique et Statistiques en temps réel</p>
</div>

<div class="container">
    <div class="search-box">
        <input type="text" id="searchInput" onkeyup="searchMatch()" placeholder="Rechercher une équipe (ex: Maroc, Algérie, Sénégal)...">
    </div>

    <div id="matchesContainer">
        <div class="date-header bg-green">🟢 21 DÉCEMBRE 2025</div>
        <div class="grid">
            <div class="match-card">
                <span class="match-time">🕗 20h00</span>
                <div class="match-teams">🇲🇦 MAROC vs 🇰🇲 COMORES</div>
                <div class="match-stadium">📍 Prince Moulay Abdellah Stadium, Rabat <br><strong>(Match d'ouverture)</strong></div>
                <span class="price-tag">Prix : 600 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
        </div>

        <div class="date-header bg-yellow">🟡 22 DÉCEMBRE 2025</div>
        <div class="grid">
            <div class="match-card">
                <span class="match-time">🕑 14h00</span>
                <div class="match-teams">🇲🇱 MALI vs 🇿🇲 ZAMBIE</div>
                <div class="match-stadium">📍 Stade Mohammed V, Casablanca</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕔 17h00</span>
                <div class="match-teams">🇿🇦 AFRIQUE DU SUD vs 🇦🇴 ANGOLA</div>
                <div class="match-stadium">📍 Grand Stade de Marrakech, Marrakech</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕗 20h00</span>
                <div class="match-teams">🇪🇬 ÉGYPTE vs 🇿🇼 ZIMBABWE</div>
                <div class="match-stadium">📍 Grand Stade d’Agadir, Agadir</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
        </div>

        <div class="date-header bg-purple">🟣 23 DÉCEMBRE 2025</div>
        <div class="grid">
            <div class="match-card">
                <span class="match-time">🕛 12h30</span>
                <div class="match-teams">🇨🇩 RD CONGO vs 🇧🇯 BÉNIN</div>
                <div class="match-stadium">📍 Stade El Barid, Rabat</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕒 15h00</span>
                <div class="match-teams">🇸🇳 SÉNÉGAL vs 🇧🇼 BOTSWANA</div>
                <div class="match-stadium">📍 Grand Stade de Tanger, Tanger</div>
                <span class="price-tag">Prix : 450 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕟 17h30</span>
                <div class="match-teams">🇳🇬 NIGÉRIA vs 🇹🇿 TANZANIE</div>
                <div class="match-stadium">📍 Complexe Sportif de Fès, Fès</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕗 20h00</span>
                <div class="match-teams">🇹🇳 TUNISIE vs 🇺🇬 OUGANDA</div>
                <div class="match-stadium">📍 Stade Olympique, Rabat</div>
                <span class="price-tag">Prix : 350 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
        </div>

        <div class="date-header bg-brown">🟤 24 DÉCEMBRE 2025</div>
        <div class="grid">
            <div class="match-card">
                <span class="match-time">🕛 12h30</span>
                <div class="match-teams">🇧🇫 BURKINA FASO vs 🇬🇶 GUINÉE ÉQ.</div>
                <div class="match-stadium">📍 Stade Mohammed V, Casablanca</div>
                <span class="price-tag">Prix : 300 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕒 15h00</span>
                <div class="match-teams">🇩🇿 ALGÉRIE vs 🇸🇩 SOUDAN</div>
                <div class="match-stadium">📍 Prince Moulay El Hassan Stadium, Rabat</div>
                <span class="price-tag">Prix : 400 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕡 18h30</span>
                <div class="match-teams">🇨🇮 CÔTE D’IVOIRE vs 🇲🇿 MOZAMBIQUE</div>
                <div class="match-stadium">📍 Grand Stade de Marrakech, Marrakech</div>
                <span class="price-tag">Prix : 400 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
            <div class="match-card">
                <span class="match-time">🕘 21h00</span>
                <div class="match-teams">🇨🇲 CAMEROUN vs 🇬🇦 GABON</div>
                <div class="match-stadium">📍 Grand Stade d’Agadir, Agadir</div>
                <span class="price-tag">Prix : 450 DH</span>
                <a href="inscription.php"><button class="btn">Réserver Billet</button></a>
            </div>
        </div>

        <h2 class="section-title">Phases Finales (Janvier 2026)</h2>
        <div class="grid">
            <div class="match-card final-highlight">
                <span class="match-time" style="color:var(--gold)">🏆 18 JANVIER - 20h00</span>
                <div class="match-teams" style="font-size: 1.8rem;">GRANDE FINALE</div>
                <div class="match-stadium">📍 Prince Moulay Abdellah Stadium, Rabat</div>
                <p><strong>Affiche : Vainqueur Demi-finale 1 vs 2</strong></p>
                <span class="price-tag">Prix : 600 DH - 1500 DH</span>
                <a href="inscription.php"><button class="btn" style="background:var(--gold); box-shadow: 0 4px 15px rgba(212,175,55,0.4);">Accéder à la Billetterie</button></a>
            </div>
        </div>
    </div>
</div>

<footer>
    <p style="font-size: 1.2rem; font-weight: bold; margin-bottom: 5px;">&copy; 2026 Comité d'Organisation CAN Maroc</p>
    <p style="opacity: 0.7; margin-bottom: 20px;">Fédération Royale Marocaine de Football</p>
    <p><a href="admin_dashboard.php">Espace Administratif</a> | <a href="#" style="color:white;">Contactez-nous</a></p>
</footer>

<script>
    // --- JS : BARRE DE RECHERCHE ---
    function searchMatch() {
        let input = document.getElementById('searchInput').value.toUpperCase();
        let cards = document.getElementsByClassName('match-card');
        
        for (let i = 0; i < cards.length; i++) {
            let teams = cards[i].getElementsByClassName('match-teams')[0].innerText;
            if (teams.toUpperCase().indexOf(input) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>