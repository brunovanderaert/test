à faire :
    redis,
    panter test
    tests databas probleme   
            - SQLSTATE[08006] [7] could not connect to server: Connection refused  
            Is the server running on host "127.0.0.1" and accepting             
            TCP/IP connections on port 32770?   
    tests sur mail admin (tests en commentaires)

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

18 - 

ampq : 
  - cosommer les messages : symfony console messenger:consume async -vv
  - interface de rabitmq (admin : "guet", password : "guest") : symfony open:local:rabbitmq
  - en arrière plan : symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
  - lister tous les worker en arrière plan : symfony server:status
  - pour arrêter les workers : kill 15774
  - Inspectez les messages : symfony console messenger:failed:show
  - Inspectez les messages : symfony console messenger:failed:retry
    symfonyCloud : 
    - symfony tunnel:open
    - symfony open:remote:rabbitmq
    - when done : symfony tunnel:close
    - Executer des workers : symfony logs --worker=messages all


19 - WORKFLOW

voir l'état du workflow : symfony console workflow:dump comment | dot -Tpng -o workflow.png

doc : 
    State machine : https://symfony.com/doc/current/workflow/workflow-and-state-machine.html
    Workflow : https://symfony.com/doc/current/workflow.html

20 - envoyer des emails aux admins

- installer la dépendances : composer req mailer
- insytaller du css pour les emails : symfony composer req twig/cssinliner-extra twig/inky-extra

doc :  
    mailer documentation : https://symfony.com/doc/master/mailer.html

21 - Cache Http

- commande de vérification : curl -s -I -X GET https://127.0.0.1:8000/
- enlever le cache : rm -rf var/cache/dev/http_cache/
- supprimer un fichier : rm src/EventSubscriber/TwigEventSubscriber.php

pour les tests
- cache pour l'admin : curl -I -X PURGE -u admin:admin `symfony var:export SYMFONY_DEFAULT_ROUTE_URL`/admin/http-cache/
- curl -I -X PURGE -u admin:admin `symfony var:export SYMFONY_DEFAULT_ROUTE_URL`/admin/http-cache/conference_header
  
- composents processeur : composer req process
- creer un controlleur : symfony console make:command app:step:info

- mettre le composant cache de symfony : composer req cache
  
pour la production :
- curl -X PURGE -H 'x-purge-token PURGE_NOW' `symfony env:urls --first`
- curl -X PURGE -H 'x-purge-token PURGE_NOW' `symfony env:urls -- first`conference_header

