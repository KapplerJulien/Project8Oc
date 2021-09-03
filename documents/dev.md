Pour les developpeurs. Il y a plusieurs règles à savoir : 

Tout d'abord lorsque vour travaillez à plusieurs sur un même projet. Il faut faire des nouvelles branches sur github.
(commande git branch) 

Après ça, vous pouvez faire votre travail, mais il faut au maximum ne pas modifier les mêmes fichier aux mêmes moment par 2 personnes différentes. C'est à dire qu'il faut pas
que 2 personnes modifie la page d'accueil en même temps, sinon il va y avoir des conflits. 
Faites toujours des pull request et faites vérifier votre code par une tierce personne. ça peut toujours aider d'avoir un autre avis et puis il pourra trouver des potentiels
bug sur votre application.
(commande push pour une nouvelle branch)
Si une personne push sa branche sur le master, il vous suffira juste de merge votre branche avec le master puis de repush sur la pull request puis vous pourrez push celle-ci. 
(commande git merge)

Pour les règles à respecter sur la qualité du code : 

Il y a plusieurs règle qu'on essaye au maximum de respecter, déjà ce qu'on appel les cases, si vous voyez que les fonctions sont écrites comme ça "fonction_1", ne changez pas
en "fonction2", utilisez toujours les mêmes syntaxe d'écritures qui sont déjà présentes sur les fichiers. 
Il y a aussi d'autres chose à savoir qu'on doit au maximum respecter pour la qualité du code. 
 - Un fichier ne doit pas dépasser 250 lignes, il faut soit en créer plusieurs, soit des choses se répètent ou ne servent à rien. 
 - éviter la répétition aux niveaux des blocs, si c'est le cas, faites une autre fonction ou un service (pour symfony)
 - éviter de faire des fonctions trop longue, qui dépasse 25lignes, si une fonction devient trop longue, elle devient difficile à comprendre et donc à débugguer. 
 - Et surtout, soyez clairs et précis, ne rendez pas votre code compliqué, utilisez des noms de fonctions et variables compréhensible. Il faut que normalement votre code soit 
compréhensible sans commentaire, vous n'avez pas besoin d'en mettre sauf cas exceptionnel si il faut expliquer une situation particulière. 

