# 🗃️ Partie Base de Données - CAN 2026

Cette section contient toute la modélisation et structure de la base de données.

## 📊 Structure des tables

### 1. Tables principales
- **villes** : Les 6 villes hôtes officielles (Rabat, Casa, Tanger, etc.)
- **stades** : Les 6 stades officiels reliés aux villes
- **equipes** : Les 24 équipes qualifiées (avec Groupes A-F)
- **matchs** : Calendrier réel des rencontres
- **users** : Gestion des utilisateurs et administrateurs
- **transports** : Offres de train/avion avec lien vers site officiel
- **hotels** : Hôtels partenaires avec lien vers site officiel
- **billets** : Réservations de matchs (table de liaison users/matchs)
- **reservations_services** : Historique des simulations de réservation (Hôtel/Transport)

### 2. Relations clés
- Un stade → une ville
- Un match → un stade + deux équipes
- Un billet → un utilisateur + un match
- Un transport/hôtel → contient un lien URL externe ("Deep Linking")

## 🛠️ Utilisation

### Importer la structure
```bash
# Méthode 1 : Via phpMyAdmin
# Importer le fichier structure.sql

# Méthode 2 : En ligne de commande
mysql -u root -p < bdd/structure.sql
