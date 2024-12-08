# Festival Bière

Festival Bière est une application Laravel permettant de gérer et d'explorer des avis sur des bières.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [PHP 8.x](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)
- [Node.js](https://nodejs.org/)

---

## Étapes d'installation

### 1. Cloner le dépôt

Clonez le dépôt depuis le gestionnaire de version :

```bash
git clone <url_du_dépôt>
cd <nom_du_projet>
```

### 2. Configuration du .env

Modifier le .env.example en .env et configurer ses creds


### 3. Installer dépendances PHP

```bash
composer install
```

### 4. Installation des dépendances front

```bash
npm install
```

### 5. Générer une clé d'application

```bash
php artisan key:generate
```

### 6. Création des tables et de la BDD

```bash
php artisan migrate
```

### 7. Seed la BDD

```bash
php artisan db:seed
```

### 8. 🔴 Regénérer un lien de connexion au storage 🔴

Etape obligatoire pour réussir à ajouter des images

Si Windows
```bash
rmdir public\storage
php artisan storage:link
```
Si Linux 
```bash
rm -rf public/storage
php artisan storage:link
```

### 9. Compilation des assets

```bash
npm run dev
```

### 10. Lancement du serveur local

```bash
php artisan serve
```

### 11. 🔴 Création d'un compte 🔴

La création d'un compte est nécessaire afin d'accéder au panel administrateur présent sur /admin