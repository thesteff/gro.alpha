# Grenoble Reggae Orchestra - Plateforme Collaborative

## Qu'est-ce que le Grenoble Reggae Orchestra ?

Le Grenoble Reggae Orchestra (GRO) est un collectif de musicien de la région de Grenoble (France). Ce collectif organise régulièrement des jam xxl dont l'organisation est assurée en grande partie grâce à la plateforme collaborative [le-gro.com](https://www.le-gro.com).

Ce dépot permet à ceux qui le souhaitent de venir améliorer l'expérience d'utilisation de la plateforme collaborative avec pour ligne de mire de créer une plateforme plus généraliste et utilisable pour d'autres groupe/collectifs.

Pour rester connecter à l'actualité du collectif, vous pouvez vous inscrire sur le site ou suivre le groupe facebook du [Grenoble Reggae Orchestra](https://www.facebook.com/le.grenoble.reggae.orchestra).


## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Utilisaton du dépot

Ce dépot est utilisé afin de permettre de travailler de manière collaborative sur la plateforme du gro. De nombreux scripts sont actuellement inexistants afin de rendre l'application utilisable telle quelle (création de base de données, etc...).

## Contribuer

Toute contribution est la bienvenue. N'hésitez pas à contacter le collectif via <contact@le-gro.com>
