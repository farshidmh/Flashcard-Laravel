# Flashcard

This is the at home assignment for the StuDocu backend developer position.

## Requirements
Design document can be found here: https://docs.google.com/document/d/1d_rgAW18qabmSRZT2xmfcOzIO_bE9deROx8j9wetnfg/edit?usp=sharing

## Person of contact
Name: Jakub

## Brief description of the project
The project is a simple flashcard application. It allows the user to create a deck of cards and then quiz themselves on the deck.

## Nice to do later
- Create a frontend for the application instead of using the interactive command
- Create multi user support
- Create scoring system
- Create a way to share decks

## Case sensitivity
Questions can have case-sensitive answers (this was not mentioned in the document but I thought it would be a nice feature to have )

## How to run the project

_Note:_ Application will setup the database and seed it with some data on the first run. You don't need to run any migrations or seeders.

### Run the project

```bash
docker-compose up -d
```

### Access the application's container

```bash
docker exec -it flashcard /bin/sh
```

### Access the application

```bash
php artisan flashcard:interactive
```

### Stop the project

```bash
docker-compose down
```

