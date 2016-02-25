#!/bin/bash
#initialisation en supprimant les anciens
rm *.zip
rm *.txt

#liste des fichiers a telecharger FR + DOM + TOM
tab=(GP GF MQ RE YT PM MF BL WF TF NC PF FR)
#pour le moment les TOM ne dispose pas apriori de code iso

#telechargement de chaque element de la liste
for i in ${tab[@]}; do
wget "http://download.geonames.org/export/zip/"${i}".zip"
done

#extraction des archives
unzip -o \*.zip

#suppression du fichier inutile
rm readme.txt
rm *.zip

#fusion de tous les fichiers txt
cat *.txt >> all.txt

#chargement du fichier en BDD si nécessaire
#LOAD DATA LOCAL INFILE 'D:\\Download\\STAGEnepassup\\all.txt' REPLACE INTO TABLE `partenaires`.`codepostal` CHARACTER SET utf8 FIELDS TERMINATED BY '	' OPTIONALLY ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (`country_code`, `postal_code`, `place_name`, `admin_name1`, `admin_code1`, `admin_name2`, `admin_code2`, `admin_name3`, `admin_code3`, `latitude`, `longitude`, `accuracy`);

#execution du script min.php afin de garder uniquement les attributs necessaires et reduire de moitie la taille du fichier
php min.php

#fin du script
exit 0
