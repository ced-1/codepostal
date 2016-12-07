<?php
// Minify a big codepostal file with just neccessary column
$fileToMinify = 'all.txt';
$contents = file_get_contents($fileToMinify);
$fileMinified = 'cp.txt';
file_put_contents($fileMinified, "");
$somecontent = "";
// Assurons nous que le fichier est accessible en écriture
if (is_writable($fileMinified)) {

    // Dans notre exemple, nous ouvrons le fichier $fileMinified en mode d'ajout
    // Le pointeur de fichier est placé à la fin du fichier
    // c'est là que $somecontent sera placé
    if (!$handle = fopen($fileMinified, 'a')) {
        echo "Impossible d'ouvrir le fichier ($fileMinified)";
        exit;
    }
    // Ecrivons quelque chose dans notre fichier.

    //on crée un tableau contenant chaque ligne du fichier initial
    $contents = explode("\n", $contents);

    //pour chaque ligne on écrit dans un nouveau fichier uniquement les champs intéressant ce qui divise la taille du fichier par 2 et accelerera probablement les recherches
    foreach ($contents as $key => $value) {
        if(!empty($value)) {
            $temp = explode("\t", $value);
            $somecontent = $temp[1]."\t".$temp[2]."\t".$temp[5]."\t".$temp[3]."\t".$temp[0]."\n";
            fwrite($handle, $somecontent);
        }
    }
    echo "L'écriture des code postaux dans le fichier ($fileMinified) a réussi.\n";
    fclose($handle);
} else {
    echo "Le fichier $fileMinified n'est pas accessible en écriture.";
}
exit;
?>
