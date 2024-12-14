# Dressing en ligne

[![Build](https://github.com/arthaud-proust/dev.arthaud.dressing/actions/workflows/build.yml/badge.svg)](https://github.com/arthaud-proust/dev.arthaud.dressing/actions/workflows/build.yml)

## Installation

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
./vendor/bin/sail up -d
```

```bash
./vendor/bin/sail artisan key:generate
```

```bash
./vendor/bin/sail artisan migrate --seed
```

```bash
yarn
```

```bash
yarn dev
```

## Besoin initial

- Savoir où sont mes vêtements ? (Chez Papa, Maman, Internat)

## User stories

### MVP

- Quand je fais ma valise, je veux savoir quoi emmener
- J’ai souvent besoin de changer un vêtement de lieu
- Je dois pouvoir accéder facilement au site

### V1.1

- J’ajoute de nouveaux vêtement une première fois en masse, puis d’autres rarement
-

### V1.2

- Je veux pouvoir comparer les dressings pour équilibrer mes affaires et éviter des achats superflus

## Fonctionnalités

- Catégoriser les vêtement (t shirt, pull etc) (pour afficher le nombre dans chaque lieu)
- Photo du vêtement optionelle (l'utilisateur ne veut pas forcément photographier ses slips)
- Image du vêtement (généré par IA locale ? banque d'illustrations ?)
- Description du vêtement optionnelle
- Description automatique ?
- Catégorie ? (Pyjama, sortie etc)
