<?php

/**
 * Classe Controle : Classe statique permettant le contrôle des données saisies
 *
 * @Author : Guy Verghote
 * @Version 2021.1
 * @Date : 12/04/2021
 */

class Controle
{

    /**
     * Vérifie l'existence des variables passées par POST ou GET
     * Accepte un nombre variable de paramètres qui représentent les variables dont il faut vérifier l'existence
     * Exemple d'appel : if (!Controle::existe('id', 'nom', 'prenom')) {...}
     * @return boolean vrai si toutes les clés existent dans le tableau
     */

    static public function existe()
    {
        foreach (func_get_args() as $unChamp) {
            if (!isset($_REQUEST[$unChamp])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Suppression des espaces superflus à l'intérieur et aux extrémités d'un chaine.
     * @param string $unChamp chaîne à transformer
     * @return string
     */

    static public function supprimerEspace($unChamp)
    {
        return preg_replace("#[[:space:]]{2,}#", " ", trim($unChamp));
    }

    /**
     * Contrôle si la valeur du champ respecte le motif accepté par ce champ
     * la fonction est bloquante : si le format n'existe pas la fonction retourne 0
     * @param string $unChamp valeur à controler
     * @param string $format format à respecter
     * @return boolean vrai si le champ $valeur respecte le format $format
     */

    static public function formatValide($valeur, $format)
    {
        $correct = false;
        switch ($format) {
            case 'ville':
            case 'nom':
            case 'prenom' :
                // lettre espace tiret apostrophe
                $correct = preg_match("/^[a-z]([ '-]?[a-z])*$/i", $valeur);
                break;
            case 'nomAvecAccent':
            case 'villeAvecAccent' :
            case 'prenomAvecAccent' :
                $correct = preg_match("/^[a-zàáâãäåòóôõöøèéêëçìíîïùúûüÿñ]([ '-]?[a-zàáâãäåòóôõöøèéêëçìíîïùúûüÿñ])*$/i", $valeur);
                break;
            case 'codePostal':
                $correct = preg_match("/^[0-9]{5}$/", $valeur);
                break;
            case 'rue' : // tous sauf : [ # & / * ? < > | \ : + _ ] { } %
                $correct = !preg_match('~[{}[#&"/*?<>|\\\\:\]+_]~', $valeur);
                break;
            case 'email':
                $correct = preg_match("/^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-_.]?[0-9a-z])*\.[a-z]{2,4}$/i", $valeur);
                break;
            case 'entier':
                $correct = preg_match("/^[0-9]*$/", $valeur);
                break;
            case 'reel':
                $correct = preg_match("/^[-+]?[0-9]+(\.[0-9]+)?$/", $valeur);
                break;
            case 'tel':
                $correct = preg_match("/^0[1-9][0-9]{8}$/", $valeur);
                break;
            case 'fixe':
                $correct = preg_match("/^0[1-59][0-9]{8}$/", $valeur);
                break;
            case 'mobile':
                $correct = preg_match("/^0[67][0-9]{8}$/", $valeur);
                break;
            case 'dateFr':
                $correct = preg_match('`^([0-9]{2})[-/.]([0-9]{2})[-/.]([0-9]{4})$`', $valeur, $tdebut);
                if ($correct) {
                    $correct = checkdate($tdebut[2], $tdebut[1], $tdebut[3]) && ($tdebut[3] > 1900);
                }
                break;
            case 'dateMysql':
                $correct = preg_match('`^([0-9]{4})-([0-9]{2})-([0-9]{2})$`', $valeur, $tdebut);
                if ($correct) {
                    $correct = checkdate($tdebut[2], $tdebut[3], $tdebut[1]) && ($tdebut[1] > 1900);
                }
                break;
            case 'temps' : // [hh]:mm:ss autres séparateurs . ou ,
                $correct = preg_match("/^([0-9]{1,2}[.,:]?)?[0-5][0-9][.,:]?[0-5][0-9]$/", $valeur);
                break;
            case 'url': // modification du 10/03/2015 ajout du . dans []
                $correct = preg_match("`((http://|https://)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(/([a-zA-Z-_/.0-9#:?=&;,]*)?)?)`", $valeur);
                // $correct = preg_match("`((http:\/\/|https:\/\/)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)`", $valeur);
                break;
            default :
                // si on contrôle un motif inexistant on bloque !
                $correct = false;
        }
        return $correct;
    }
}