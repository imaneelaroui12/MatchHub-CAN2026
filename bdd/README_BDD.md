# 🗃️ Partie Base de Données - CAN 2026

Cette section contient toute la modélisation et structure de la base de données.

## 📊 Structure des tables

### 1. Tables principales
- **villes** : Villes hôtes du tournoi
- **stades** : Stades avec capacité et localisation  
- **equipes** : 24 équipes participantes
- **matchs** : Programme des rencontres
- **billets** : Système de réservation
- **users** : Utilisateurs (admin/clients)
- **services** : Services annexes (hôtel/transport)

### 2. Relations clés
- Un stade → une ville
- Un match → un stade + deux équipes
- Un billet → un utilisateur + un match
- Un service → une ville

## 🛠️ Utilisation

### Importer la structure
```bash
# Méthode 1 : Via phpMyAdmin
# Importer le fichier structure.sql

# Méthode 2 : En ligne de commande
mysql -u root -p < bdd/structure.sql
