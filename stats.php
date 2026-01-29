<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Stats - CAN 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --maroc-vert: #064e3b; --maroc-vert-light: #0d7a5d; --maroc-rouge: #991b1b; --gold: #d4af37; }
        body { font-family: 'Poppins', sans-serif; margin: 0; background-color: #f3f4f6; background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); }
        
        nav { background: linear-gradient(90deg, var(--maroc-vert) 0%, var(--maroc-vert-light) 100%); color: white; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); border-bottom: 3px solid var(--gold); }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; transition: 0.3s; padding: 8px 12px; border-radius: 5px; }
        .nav-links a:hover { background: rgba(255,255,255,0.1); color: var(--gold); }
        .btn-nav { background: var(--maroc-rouge); }

        .live-container { max-width: 800px; margin: 50px auto; padding: 20px; }
        .score-card { background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 40px rgba(0,0,0,0.1); border-top: 8px solid var(--maroc-rouge); text-align: center; }
        
        .live-badge { background: var(--maroc-rouge); color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 0.8rem; animation: blink 1s infinite; display: inline-block; margin-bottom: 20px; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
        
        .teams-flex { display: flex; justify-content: space-between; align-items: center; margin: 20px 0; }
        .team { flex: 1; }
        .team img { width: 80px; height: auto; }
        .score-box { background: #f1f5f9; padding: 15px 30px; border-radius: 15px; font-size: 3.5rem; font-weight: 800; color: var(--maroc-vert); }
        
        .stat-row { margin-top: 30px; text-align: left; }
        .bar-bg { background: #e2e8f0; height: 12px; border-radius: 10px; margin-top: 8px; overflow: hidden; }
        .bar-fill { background: var(--maroc-vert); height: 100%; border-radius: 10px; }
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

    <div class="live-container">
        <div class="score-card">
            <div class="live-badge">● LIVE - 78'</div>
            <div class="teams-flex">
                <div class="team">
                    <div style="font-size: 4rem;">🇲🇦</div>
                    <h2 style="margin: 5px 0;">MAROC</h2>
                </div>
                <div class="score-box">2 - 0</div>
                <div class="team">
                    <div style="font-size: 4rem;">🇰🇲</div>
                    <h2 style="margin: 5px 0;">COMORES</h2>
                </div>
            </div>
            <p style="color: #64748b; font-weight: 600;">📍 Stade Prince Moulay Abdellah, Rabat</p>
            
            <div class="stat-row">
                <div style="display:flex; justify-content:space-between"><b>Possession</b><span>64% - 36%</span></div>
                <div class="bar-bg"><div class="bar-fill" style="width: 64%;"></div></div>
            </div>
            <div class="stat-row">
                <div style="display:flex; justify-content:space-between"><b>Tirs Cadrés</b><span>9 - 2</span></div>
                <div class="bar-bg"><div class="bar-fill" style="width: 80%;"></div></div>
            </div>
        </div>
    </div>
</body>
</html>