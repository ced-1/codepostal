#!/bin/bash
#initialisation en supprimant les anciens
#rm *.zip
rm *.txt

#liste des fichiers a telecharger FR + DOM + TOM
tab=(FR GP GF MQ RE YT PM MF BL WF TF NC PF)
#pour le moment les TOM ne dispose pas apriori de code iso

#telechargement de chaque element de la liste
for i in ${tab[@]}; do
wget "http://download.geonames.org/export/zip/"${i}".zip"
done

#extraction des archives
unzip -oq \*.zip

#suppression du fichier inutile
rm readme.txt
rm *.zip

#fusion de tous les fichiers txt
cat *.txt >> all.txt

for i in ${tab[@]}; do
rm ${i}".txt"
done
#execution du script min.php afin de garder uniquement les attributs necessaires et reduire de moitie la taille du fichier
php min.php
rm all.txt LICENSE
date
#fin du script
exit 0
