#Installation du service web code postal
dans un shell linux et le répertoire cp
```
chmod +x cron-dl-cp.sh
./cron-dl-cp.sh
```
dans le fichier host codePostal
```
#Code Postal
127.0.0.1		codepostal
::1             codepostal
```
dans apache on ajoute un vhosts qui pointe vers le répertoire cp
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
http://codepostal/?cp=97440
