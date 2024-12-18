# Dressing en ligne

[![Build](https://github.com/arthaud-proust/dev.arthaud.dressing/actions/workflows/build.yml/badge.svg)](https://github.com/arthaud-proust/dev.arthaud.dressing/actions/workflows/build.yml)

## Besoin initial

Dressing s'adresse aux enfants de familles séparés qui doivent régulièrement faire leur valise pour aller de chez un parent à chez un autre.
En effet, la gestion des habits (ai-je assez de pantalons chez mon père ?) peut être fastidieuse et fatiguante à la longue.

Dressing propose de créer des dressings et d'y ajouter ses vêtements (tâche fastidieuse aussi, que l'on essaie de rendre la plus simple possible). En définissant un minimum de vêtement par catégorie, on peut ainsi indiquer quels vêtements manquent chez l'autre parent quand on fait sa valise pour y aller.

## Fonctionnalités

- Aide pour faire sa valise d'un endroit A à un endroit B (indique quels vêtements en fonction de ce qu'il y a dans le dressing 
- Catégoriser les vêtement (t shirt, pull etc) pour afficher le nombre dans chaque lieu
- Photo du vêtement optionelle (l'utilisateur ne veut pas forcément photographier ses slips)
- Description du vêtement optionnelle
- Ajout rapide de vêtements à la chaîne
- Comparaison des vêtements par catégorie et par dressing

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
