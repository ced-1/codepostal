Code postal
=============
Ce projet met à disposition un service web qui à partir d'un code postal retourne la commune, le département, la région et le pays associé.

#Configuration du fichier cron-dl-cp.sh

Modifier la ligne 7
`tab=(GP GF MQ RE YT PM MF BL WF TF NC PF FR)`
afin de traiter les régions souhaités.

Par défaut France métropolitaine + DOM + TOM

#Installation du service web code postal

* dans un shell linux et le répertoire cp
```
chmod +x cron-dl-cp.sh
./cron-dl-cp.sh
```
* dans le fichier host codePostal
```
#Code Postal
127.0.0.1		codepostal
::1             codepostal
```
* dans apache on ajoute un vhosts qui pointe vers le répertoire cp
```
#Code Postal
<VirtualHost *:80>
    ServerName www.codepostal
    ServerAlias codepostal
    DocumentRoot "c:\wamp\www\cp"
    <Directory "c:\wamp\www\cp">
        AllowOverride All
    </Directory>
</VirtualHost>
```
#Utilisation
Requete HTTP
`GET http://codepostal/?cp=97440`

#Credit
Inspirer de [bano]

Données fourni par [GEONAMES]
[bano]:https://github.com/osm-fr/bano-addr-collect/
[GEONAMES]:http://www.geonames.org
