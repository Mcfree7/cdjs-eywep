<?php

namespace App\Support;

class Countries
{
    /**
     * Liste des pays — Afrique en premier, puis reste du monde.
     * Retourne un tableau ['code' => 'Nom'] ou tableau simple selon $withKeys.
     */
    public static function list(): array
    {
        return [
            // ── Afrique de l'Ouest
            'BF' => 'Burkina Faso',
            'BJ' => 'Bénin',
            'CI' => "Côte d'Ivoire",
            'CV' => 'Cap-Vert',
            'GH' => 'Ghana',
            'GM' => 'Gambie',
            'GN' => 'Guinée',
            'GW' => 'Guinée-Bissau',
            'LR' => 'Libéria',
            'ML' => 'Mali',
            'MR' => 'Mauritanie',
            'NE' => 'Niger',
            'NG' => 'Nigéria',
            'SL' => 'Sierra Leone',
            'SN' => 'Sénégal',
            'TG' => 'Togo',
            // ── Afrique Centrale
            'AO' => 'Angola',
            'CD' => 'République Démocratique du Congo',
            'CF' => 'République Centrafricaine',
            'CG' => 'Congo',
            'CM' => 'Cameroun',
            'GA' => 'Gabon',
            'GQ' => 'Guinée Équatoriale',
            'ST' => 'Sao Tomé-et-Príncipe',
            'TD' => 'Tchad',
            // ── Afrique de l'Est
            'BI' => 'Burundi',
            'DJ' => 'Djibouti',
            'ER' => 'Érythrée',
            'ET' => 'Éthiopie',
            'KE' => 'Kenya',
            'KM' => 'Comores',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MU' => 'Maurice',
            'MZ' => 'Mozambique',
            'RW' => 'Rwanda',
            'SC' => 'Seychelles',
            'SO' => 'Somalie',
            'SS' => 'Soudan du Sud',
            'TZ' => 'Tanzanie',
            'UG' => 'Ouganda',
            'YT' => 'Mayotte',
            'ZM' => 'Zambie',
            'ZW' => 'Zimbabwe',
            // ── Afrique du Nord
            'DZ' => 'Algérie',
            'EG' => 'Égypte',
            'LY' => 'Libye',
            'MA' => 'Maroc',
            'SD' => 'Soudan',
            'TN' => 'Tunisie',
            // ── Afrique Australe
            'BW' => 'Botswana',
            'LS' => 'Lesotho',
            'NA' => 'Namibie',
            'SZ' => 'Eswatini',
            'ZA' => 'Afrique du Sud',
            // ── Reste du monde (sélection)
            'FR' => 'France',
            'BE' => 'Belgique',
            'CH' => 'Suisse',
            'CA' => 'Canada',
            'US' => 'États-Unis',
            'GB' => 'Royaume-Uni',
            'DE' => 'Allemagne',
            'ES' => 'Espagne',
            'IT' => 'Italie',
            'PT' => 'Portugal',
            'NL' => 'Pays-Bas',
            'CN' => 'Chine',
            'JP' => 'Japon',
            'IN' => 'Inde',
            'BR' => 'Brésil',
            'AU' => 'Australie',
        ];
    }

    /**
     * Retourne uniquement les noms (valeurs), sans codes.
     */
    public static function names(): array
    {
        return array_values(self::list());
    }
}
