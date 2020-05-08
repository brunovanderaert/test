A - COMMANDE

1 Symfony cli

a) Démarrage du projet
- démarre le serveur : symfony server:start -d
- donne les erreurs du site : symfony server:log

- donne la version php de symfony cli : symfony php --version 

- version de php à utiliser : echo 7.4 > .php-version

- ouvrir rabbitmq : symfony open:local:rabbitmq
- 

2 Commande docker et docker-compose

- arrêter : docker-compose stop 
- redémarrer : docker-compose up -d

- docker-compose down : efface la base de donnée

B - NOTE DU PROJET


19 - WORKFLOW

voir l'état du workflow : symfony console workflow:dump comment | dot -Tpng -o workflow.png

State machine : https://symfony.com/doc/current/workflow/workflow-and-state-machine.html
Workflow : https://symfony.com/doc/current/workflow.html

20 - envoyer des emails aux admins

installer la dépendances : composer req mailer

mailer documentation : https://symfony.com/doc/master/mailer.html