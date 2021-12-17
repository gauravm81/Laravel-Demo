<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class HelperForms
{

    public static function getStatesList()
    {
        $states = array(
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        );

        return $states;
    }

    public static function getStateNameByCode($code) {
        $states = self::getStatesList();

        if ( $states[$code] )
            return  $states[$code];
        else
            return null;
    }


    public static function getNext30Days($offset = 0) {
        $days = [];

        $date = Carbon::now();

        if ( $offset > 0 )
        $date->addDays($offset);

        for ( $i=1; $i<=30; $i++ ) {
            $key = $date->toDateString();
            $value = $date->format("m/d/Y");

            $days[$key] = $value;

            $date->addDays(1);
        }

        return $days;
    }


    public static function showTimePickerValues($show_minutes_less = false) {
        $time = [];

        $minutes = ['00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'];
        $minutes_less = ['00', '30'];
        $hours = [
            '00' => '12', 
            '01' => '1', 
            '02' => '2', 
            '03' => '3', 
            '04' => '4', 
            '05' => '5', 
            '06' => '6', 
            '07' => '7', 
            '08' => '8', 
            '09' => '9', 
            '10' => '10', 
            '11' => '11',
            '12' => '12',
            '13' => '1',
            '14' => '2',
            '15' => '3',
            '16' => '4',
            '17' => '5',
            '18' => '6',
            '19' => '7',
            '20' => '8',
            '21' => '9',
            '22' => '10',
            '23' => '11',
        ];
        if ($show_minutes_less)
        $minutes = $minutes_less;

        $i = 1;
        foreach ( $hours as $key => $val ) {
            foreach ( $minutes as $m) {
                $time[$key.':'.$m] = $val.':'.$m.' '.( $i>12 ? 'pm' : 'am');
            }
            $i++;
        }

        return $time;
    }


    public static function getTimezonesList() {
        return [
            'America/New_York' => [
                'name' => '(UTC-05:00) Eastern Time (US & Canada)',
                'value' => '-05:00',
            ],
            'America/Chicago' => [
                'name' => '(UTC-06:00) Central Time (US & Canada)',
                'value' => '-06:00',
            ],
            'America/Denver' => [
                'name' => '(UTC-07:00) Mountain Time (US & Canada)',
                'value' => '07:00',
            ],
            'America/Los_Angeles' => [
                'name' => '(UTC-08:00) Pacific Time (US & Canada)',
                'value' => '08:00',
            ],
            'America/Anchorage' => [
                'name' => '(UTC-09:00) Alaska',
                'value' => '-09:00',
            ],
            'Pacific/Honolulu' => [
                'name' => '(UTC-10:00) Hawaii',
                'value' => '-10:00',
            ],
        ];
    }


    public static function getContentTypes() {
        return [
            'Link' => 'Link',
            'Message' => 'Message',
            'Photo' => 'Photo',
            'Video' => 'Video'
        ];
    }


    public static function getHomeMinPriceFilterOptions()
    {
        $options = [
            "25000" => "25,000",
            "50000" => "50,000",
            "75000" => "75,000",
            "100000" => "100,000",
            "150000" => "150,000",
            "200000" => "200,000",
            "250000" => "250,000",
            "300000" => "300,000",
            "350000" => "350,000",
            "400000" => "400,000",
            "450000" => "450,000",
            "500000" => "500,000",
            "750000" => "750,000",
            "1000000" => "1,000,000",
        ];

        return $options;
    }

    public static function getHomeMaxPriceFilterOptions()
    {
        $options = [
            "50000" => "50,000",
            "75000" => "75,000",
            "100000" => "100,000",
            "150000" => "150,000",
            "200000" => "200,000",
            "250000" => "250,000",
            "300000" => "300,000",
            "350000" => "350,000",
            "400000" => "400,000",
            "450000" => "450,000",
            "500000" => "500,000",
            "750000" => "750,000",
            "1000000" => "1,000,000",
            "1500000" => "1,500,000",
            "2000000" => "2,000,000",
            "3000000" => "3,000,000",
            "4000000" => "4,000,000",
            "5000000" => "5,000,000",
            "10000000" => "10,000,000",
        ];

        return $options;
    }

}

