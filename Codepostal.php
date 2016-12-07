<?php

namespace App\Support\Codepostal;

class Codepostal
{
    static public function cp($codePostal)
    {
        $tab = [];
        $json = [
            "success"=>"false",
            'input'=>$codePostal,
            "postalCodes"=>$tab
        ];

        if (strlen($codePostal)==5 && ctype_digit($codePostal)) {
            $file = 'cp.txt';
            // get the file contents, assuming the file to be readable (and exist)
            $contents = file_get_contents(__DIR__."/".$file);
            // escape special characters in the query
            $pattern = preg_quote($codePostal, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store in $tab all matching occurences in $matches
            if(preg_match_all($pattern, $contents, $matches)) {
                //pour chaque ligne trouvé, on compile le résultat
                foreach ($matches[0] as $key => $value) {
                    list($cp,$ville,$departement,$region,$pays)= explode("\t", $value);
                    $tab[$key] = ["placeName" => $ville, "adminName2" => $departement, "adminName1" => $region, "countryCode" => $pays];
                    $placeName[] = $ville;
                }
                //si plus d'une ville trouvé pour le code postal
                if (isset($tab[1])) {
                    $tab[0]['placeName'] = $placeName;
                    $json = ["success" => true,
                    'input'=>$codePostal,
                     "postalCodes" => $tab[0]];
                } else {
                    $json = ["success" => true,
                    'input'=>$codePostal,
                     "postalCodes" => $tab[0]];
                }
            }
        }
        return $json;
    }
}
