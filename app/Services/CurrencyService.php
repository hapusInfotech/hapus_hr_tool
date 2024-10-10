<?php
namespace App\Services;

class CurrencyService
{
    
    public function convertCurrency($amount, $from_currency, $to_currency)
    {
        $apiKey = env('CURRENCY_API_KEY'); // Use a currency conversion API
        $url = "https://api.exchangerate-api.com/v4/latest/$from_currency";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!isset($data['rates'][$to_currency])) {
            return $amount;
        }

        $conversionRate = $data['rates'][$to_currency];
        $convertedAmount = $amount * $conversionRate;

        return $convertedAmount;
    }
    public function getCurrencyByCountry($country)
    {
        $currencies = [
            'IN' => ['currency' => 'INR', 'symbol' => '₹'], // India
            'AE' => ['currency' => 'AED', 'symbol' => 'د.إ'], // United Arab Emirates
            'AF' => ['currency' => 'AFN', 'symbol' => '؋'], // Afghanistan
            'AL' => ['currency' => 'ALL', 'symbol' => 'L'], // Albania
            'AM' => ['currency' => 'AMD', 'symbol' => '֏'], // Armenia
            'AN' => ['currency' => 'ANG', 'symbol' => 'ƒ'], // Netherlands Antillean Guilder
            'AO' => ['currency' => 'AOA', 'symbol' => 'Kz'], // Angola
            'AR' => ['currency' => 'ARS', 'symbol' => '$'], // Argentina
            'AU' => ['currency' => 'AUD', 'symbol' => 'A$'], // Australia
            'AW' => ['currency' => 'AWG', 'symbol' => 'ƒ'], // Aruba
            'AZ' => ['currency' => 'AZN', 'symbol' => '₼'], // Azerbaijan
            'BA' => ['currency' => 'BAM', 'symbol' => 'KM'], // Bosnia and Herzegovina
            'BB' => ['currency' => 'BBD', 'symbol' => 'Bds$'], // Barbados
            'BD' => ['currency' => 'BDT', 'symbol' => '৳'], // Bangladesh
            'BG' => ['currency' => 'BGN', 'symbol' => 'лв'], // Bulgaria
            'BH' => ['currency' => 'BHD', 'symbol' => 'BD'], // Bahrain
            'BI' => ['currency' => 'BIF', 'symbol' => 'FBu'], // Burundi
            'BM' => ['currency' => 'BMD', 'symbol' => '$'], // Bermuda
            'BN' => ['currency' => 'BND', 'symbol' => 'B$'], // Brunei
            'BO' => ['currency' => 'BOB', 'symbol' => 'Bs'], // Bolivia
            'BR' => ['currency' => 'BRL', 'symbol' => 'R$'], // Brazil
            'BS' => ['currency' => 'BSD', 'symbol' => '$'], // Bahamas
            'BT' => ['currency' => 'BTN', 'symbol' => 'Nu.'], // Bhutan
            'BW' => ['currency' => 'BWP', 'symbol' => 'P'], // Botswana
            'BY' => ['currency' => 'BYN', 'symbol' => 'Br'], // Belarus
            'BZ' => ['currency' => 'BZD', 'symbol' => 'BZ$'], // Belize
            'CA' => ['currency' => 'CAD', 'symbol' => 'C$'], // Canada
            'CD' => ['currency' => 'CDF', 'symbol' => 'FC'], // Congo
            'CH' => ['currency' => 'CHF', 'symbol' => 'CHF'], // Switzerland
            'CL' => ['currency' => 'CLP', 'symbol' => '$'], // Chile
            'CN' => ['currency' => 'CNY', 'symbol' => '¥'], // China
            'CO' => ['currency' => 'COP', 'symbol' => '$'], // Colombia
            'CR' => ['currency' => 'CRC', 'symbol' => '₡'], // Costa Rica
            'CU' => ['currency' => 'CUP', 'symbol' => '₱'], // Cuba
            'CZ' => ['currency' => 'CZK', 'symbol' => 'Kč'], // Czech Republic
            'DK' => ['currency' => 'DKK', 'symbol' => 'kr'], // Denmark
            'DO' => ['currency' => 'DOP', 'symbol' => 'RD$'], // Dominican Republic
            'DZ' => ['currency' => 'DZD', 'symbol' => 'د.ج'], // Algeria
            'EG' => ['currency' => 'EGP', 'symbol' => '£'], // Egypt
            'ER' => ['currency' => 'ERN', 'symbol' => 'Nfk'], // Eritrea
            'ET' => ['currency' => 'ETB', 'symbol' => 'Br'], // Ethiopia
            'EU' => ['currency' => 'EUR', 'symbol' => '€'], // Eurozone
            'FJ' => ['currency' => 'FJD', 'symbol' => 'FJ$'], // Fiji
            'FK' => ['currency' => 'FKP', 'symbol' => '£'], // Falkland Islands
            'FO' => ['currency' => 'FOK', 'symbol' => 'kr'], // Faroe Islands
            'GB' => ['currency' => 'GBP', 'symbol' => '£'], // United Kingdom
            'GE' => ['currency' => 'GEL', 'symbol' => '₾'], // Georgia
            'GH' => ['currency' => 'GHS', 'symbol' => 'GH₵'], // Ghana
            'GI' => ['currency' => 'GIP', 'symbol' => '£'], // Gibraltar
            'GM' => ['currency' => 'GMD', 'symbol' => 'D'], // Gambia
            'GN' => ['currency' => 'GNF', 'symbol' => 'FG'], // Guinea
            'GT' => ['currency' => 'GTQ', 'symbol' => 'Q'], // Guatemala
            'GY' => ['currency' => 'GYD', 'symbol' => 'G$'], // Guyana
            'HK' => ['currency' => 'HKD', 'symbol' => 'HK$'], // Hong Kong
            'HN' => ['currency' => 'HNL', 'symbol' => 'L'], // Honduras
            'HR' => ['currency' => 'HRK', 'symbol' => 'kn'], // Croatia
            'HT' => ['currency' => 'HTG', 'symbol' => 'G'], // Haiti
            'HU' => ['currency' => 'HUF', 'symbol' => 'Ft'], // Hungary
            'ID' => ['currency' => 'IDR', 'symbol' => 'Rp'], // Indonesia
            'IL' => ['currency' => 'ILS', 'symbol' => '₪'], // Israel
            'IQ' => ['currency' => 'IQD', 'symbol' => 'ع.د'], // Iraq
            'IR' => ['currency' => 'IRR', 'symbol' => '﷼'], // Iran
            'IS' => ['currency' => 'ISK', 'symbol' => 'kr'], // Iceland
            'JM' => ['currency' => 'JMD', 'symbol' => 'J$'], // Jamaica
            'JO' => ['currency' => 'JOD', 'symbol' => 'JD'], // Jordan
            'JP' => ['currency' => 'JPY', 'symbol' => '¥'], // Japan
            'KE' => ['currency' => 'KES', 'symbol' => 'KSh'], // Kenya
            'KG' => ['currency' => 'KGS', 'symbol' => 'лв'], // Kyrgyzstan
            'KH' => ['currency' => 'KHR', 'symbol' => '៛'], // Cambodia
            'KR' => ['currency' => 'KRW', 'symbol' => '₩'], // South Korea
            'KW' => ['currency' => 'KWD', 'symbol' => 'KD'], // Kuwait
            'KZ' => ['currency' => 'KZT', 'symbol' => '₸'], // Kazakhstan
            'LA' => ['currency' => 'LAK', 'symbol' => '₭'], // Laos
            'LB' => ['currency' => 'LBP', 'symbol' => 'ل.ل'], // Lebanon
            'LK' => ['currency' => 'LKR', 'symbol' => 'රු'], // Sri Lanka
            'LR' => ['currency' => 'LRD', 'symbol' => 'L$'], // Liberia
            'LS' => ['currency' => 'LSL', 'symbol' => 'L'], // Lesotho
            'LY' => ['currency' => 'LYD', 'symbol' => 'LD'], // Libya
            'MA' => ['currency' => 'MAD', 'symbol' => 'MAD'], // Morocco
            'MD' => ['currency' => 'MDL', 'symbol' => 'L'], // Moldova
            'MG' => ['currency' => 'MGA', 'symbol' => 'Ar'], // Madagascar
            'MK' => ['currency' => 'MKD', 'symbol' => 'ден'], // North Macedonia
            'MM' => ['currency' => 'MMK', 'symbol' => 'K'], // Myanmar
            'MN' => ['currency' => 'MNT', 'symbol' => '₮'], // Mongolia
            'MO' => ['currency' => 'MOP', 'symbol' => 'MOP$'], // Macau
            'MR' => ['currency' => 'MRU', 'symbol' => 'UM'], // Mauritania
            'MU' => ['currency' => 'MUR', 'symbol' => '₨'], // Mauritius
            'MV' => ['currency' => 'MVR', 'symbol' => 'Rf'], // Maldives
            'MW' => ['currency' => 'MWK', 'symbol' => 'MK'], // Malawi
            'MX' => ['currency' => 'MXN', 'symbol' => '$'], // Mexico
            'MY' => ['currency' => 'MYR', 'symbol' => 'RM'], // Malaysia
            'MZ' => ['currency' => 'MZN', 'symbol' => 'MT'], // Mozambique
            'NA' => ['currency' => 'NAD', 'symbol' => '$'], // Namibia
            'NG' => ['currency' => 'NGN', 'symbol' => '₦'], // Nigeria
            'NO' => ['currency' => 'NOK', 'symbol' => 'kr'], // Norway
            'NP' => ['currency' => 'NPR', 'symbol' => '₨'], // Nepal
            'NZ' => ['currency' => 'NZD', 'symbol' => 'NZ$'], // New Zealand
            'OM' => ['currency' => 'OMR', 'symbol' => 'OMR'], // Oman
            'PA' => ['currency' => 'PAB', 'symbol' => 'B/.'], // Panama
            'PE' => ['currency' => 'PEN', 'symbol' => 'S/'], // Peru
            'PG' => ['currency' => 'PGK', 'symbol' => 'K'], // Papua New Guinea
            'PH' => ['currency' => 'PHP', 'symbol' => '₱'], // Philippines
            'PK' => ['currency' => 'PKR', 'symbol' => '₨'], // Pakistan
            'PL' => ['currency' => 'PLN', 'symbol' => 'zł'], // Poland
            'QA' => ['currency' => 'QAR', 'symbol' => 'QR'], // Qatar
            'RO' => ['currency' => 'RON', 'symbol' => 'lei'], // Romania
            'RS' => ['currency' => 'RSD', 'symbol' => 'дин'], // Serbia
            'RU' => ['currency' => 'RUB', 'symbol' => '₽'], // Russia
            'RW' => ['currency' => 'RWF', 'symbol' => 'FRw'], // Rwanda
            'SA' => ['currency' => 'SAR', 'symbol' => '﷼'], // Saudi Arabia
            'SB' => ['currency' => 'SBD', 'symbol' => 'SI$'], // Solomon Islands
            'SC' => ['currency' => 'SCR', 'symbol' => '₨'], // Seychelles
            'SD' => ['currency' => 'SDG', 'symbol' => '£'], // Sudan
            'SE' => ['currency' => 'SEK', 'symbol' => 'kr'], // Sweden
            'SG' => ['currency' => 'SGD', 'symbol' => 'S$'], // Singapore
            'SH' => ['currency' => 'SHP', 'symbol' => '£'], // Saint Helena
            'SL' => ['currency' => 'SLE', 'symbol' => 'Le'], // Sierra Leone
            'SO' => ['currency' => 'SOS', 'symbol' => 'Sh'], // Somalia
            'SR' => ['currency' => 'SRD', 'symbol' => '$'], // Suriname
            'ST' => ['currency' => 'STN', 'symbol' => 'Db'], // Sao Tome and Principe
            'SY' => ['currency' => 'SYP', 'symbol' => '£'], // Syria
            'TH' => ['currency' => 'THB', 'symbol' => '฿'], // Thailand
            'TJ' => ['currency' => 'TJS', 'symbol' => 'ЅМ'], // Tajikistan
            'TN' => ['currency' => 'TND', 'symbol' => 'د.ت'], // Tunisia
            'TO' => ['currency' => 'TOP', 'symbol' => 'T$'], // Tonga
            'TR' => ['currency' => 'TRY', 'symbol' => '₺'], // Turkey
            'TT' => ['currency' => 'TTD', 'symbol' => 'TT$'], // Trinidad and Tobago
            'TZ' => ['currency' => 'TZS', 'symbol' => 'TSh'], // Tanzania
            'UA' => ['currency' => 'UAH', 'symbol' => '₴'], // Ukraine
            'UG' => ['currency' => 'UGX', 'symbol' => 'USh'], // Uganda
            'US' => ['currency' => 'USD', 'symbol' => '$'], // United States
            'UY' => ['currency' => 'UYU', 'symbol' => '$U'], // Uruguay
            'UZ' => ['currency' => 'UZS', 'symbol' => 'лв'], // Uzbekistan
            'VE' => ['currency' => 'VES', 'symbol' => 'Bs.S'], // Venezuela
            'VN' => ['currency' => 'VND', 'symbol' => '₫'], // Vietnam
            'ZA' => ['currency' => 'ZAR', 'symbol' => 'R'], // South Africa
            'ZM' => ['currency' => 'ZMW', 'symbol' => 'ZK'], // Zambia
            'ZW' => ['currency' => 'ZWL', 'symbol' => 'Z$'], // Zimbabwe
        ];

        return $currencies[$country] ?? ['currency' => 'INR', 'symbol' => '₹']; // Default to INR and ₹ symbol
    }
}
