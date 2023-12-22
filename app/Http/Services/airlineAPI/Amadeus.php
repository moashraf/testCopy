<?php

namespace App\Http\Services\airlineAPI;

use Illuminate\Support\Facades\Http;
use SoapClient;


/* 

Amadeus api has 2 envoriments, one for free and the other for producation
    1- the free envoriments has cached data from amadeus
    2- it is a must to use (acc_auth) funcation to get the acess token 2Auth from amadues before performing any funcation
------ book a flight ------
1- use (airline_chec) funcation to search about the flight (Flight Offers Search)
2- then use (airline_check_price) funcation to ensure the flight price (Flight Offers Price)
3- finally to book the ticket use (airline_check_book) funcation (Flight Create Orders)

------- A request example

        $origin = "CAI";
        $destination = "AUH";
        $departure = "2023-03-25";
        $return = "2023-03-27";
        $adult = 1;
        $child = 0;

        $check_flight = app(Amadeus::class)->airline_check($origin, $destination, $departure);

        $chosen_flight = $check_flight['data'][0];

        $price = app(Amadeus::class)->airline_check_price($chosen_flight);


        $price_chosen = $price['data']['flightOffers'][0];

        $traveler = app(Amadeus::class)->traveler("1982-01-16", "JORGE", "GONZALES", "MALE", "jorge.gonzales833@telefonica.es", "34", "480080076", "Madrid", "Madrid", "2015-04-14", "00000000", "2025-04-14", "ES", "ES", "ES");

        $book = app(Amadeus::class)->airline_check_book($price_chosen, $traveler);

        dd($book);
        


------- A traveler information 

 "travelers" => [
                        [
                            "id" => "1",
                            "dateOfBirth" => "1982-01-16",
                            "name" => [
                                "firstName" => "JORGE",
                                "lastName" => "GONZALES"
                            ],
                            "gender" => "MALE",
                            "contact" => [
                                "emailAddress" => "jorge.gonzales833@telefonica.es",
                                "phones" => [
                                    [
                                        "deviceType" => "MOBILE",
                                        "countryCallingCode" => "34",
                                        "number" => "480080076"
                                    ]
                                ]
                            ],
                            "documents" => [
                                [
                                    "documentType" => "PASSPORT",
                                    "birthPlace" => "Madrid",
                                    "issuanceLocation" => "Madrid",
                                    "issuanceDate" => "2015-04-14",
                                    "number" => "00000000",
                                    "expiryDate" => "2025-04-14",
                                    "issuanceCountry" => "ES",
                                    "validityCountry" => "ES",
                                    "nationality" => "ES",
                                    "holder" => true
                                ]
                            ]
                        ],
                    ],
                    "remarks" => [
                        "general" => [
                            [
                                "subType" => "GENERAL_MISCELLANEOUS",
                                "text" => "ONLINE BOOKING FROM INCREIBLE VIAJES"
                            ]
                        ]
                    ],
                    "ticketingAgreement" => [
                        "option" => "DELAY_TO_CANCEL",
                        "delay" => "6D",
                    ],
                    "contacts" => [
                        [
                            "addresseeName" => [
                                "firstName" => "PABLO",
                                "lastName" => "RODRIGUEZ"
                            ],
                            "companyName" => "INCREIBLE VIAJES",
                            "purpose" => "STANDARD",
                            "phones" => [
                                [
                                    "deviceType" => "LANDLINE",
                                    "countryCallingCode" => "34",
                                    "number" => "480080071"
                                ],
                                [
                                    "deviceType" => "MOBILE",
                                    "countryCallingCode" => "33",
                                    "number" => "480080072"
                                ]
                            ],
                            "emailAddress" => "support@increibleviajes.es",
                            "address" => [
                                "lines" => [
                                    "Calle Prado, 16"
                                ],
                                "postalCode" => "28014",
                                "cityName" => "Madrid",
                                "countryCode" => "ES"
                            ]
                        ]
                    ]
*/

class Amadeus
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function acc_auth()
    {
        $auth = Http::asForm()->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => 'oWqFng58DtiERIJ1ClEWTFQFtPg74Kqg',
            'client_secret' => 'XGwnV7bMWYPpZ6QH'
        ]);

        $acess_token = $auth['access_token'];
        return $acess_token;
    }

    public function airline_check($origin, $destination, $departure, $return = null)
    {

        $acess_token = $this->acc_auth();

        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $acess_token,
        ];

        $apiURL = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

        $res = $client->request('POST', $apiURL, [
            'headers' => $headers,
            'json' => [
                "currencyCode" => "EGP",
                "originDestinations" => [
                    [
                        "id" => "1",
                        "originLocationCode" => $origin,
                        "destinationLocationCode" => $destination,
                        "departureDateTimeRange" => [
                            "date" => $departure,
                            // "time" => "10:00:00"
                        ],
                        "returnDate" => [
                            "date" => $return,
                            // "time" => "10:00:00"
                        ]
                    ]
                ],
                "travelers" => [
                    [
                        "id" => "1",
                        "travelerType" => "ADULT"
                    ]
                ],
                "sources" => [
                    "GDS"
                ],
                "searchCriteria" => [
                    "maxFlightOffers" => 10,
                    "flightFilters" => [
                        "cabinRestrictions" => [
                            [
                                "cabin" => "ECONOMY",
                                "coverage" => "MOST_SEGMENTS",
                                "originDestinationIds" => [
                                    "1"
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ]);

        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody(), true);

        return $responseBody;
    }


    public function airline_check_price($data)
    {

        $acess_token = $this->acc_auth();

        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $acess_token,
        ];

        $apiURL = 'https://test.api.amadeus.com/v1/shopping/flight-offers/pricing';

        $res = $client->request('POST', $apiURL, [
            'headers' => $headers,
            'json' => [
                "data" => [
                    "type" => "flight-offers-pricing",
                    "flightOffers" => [$data],
                ]
            ],
        ]);

        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody(), true);

        return $responseBody;
    }


    public function airline_check_book($data, $travelers)
    {
        $acess_token = $this->acc_auth();

        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $acess_token,
        ];

        $apiURL = 'https://test.api.amadeus.com/v1/booking/flight-orders';

        $res = $client->request('POST', $apiURL, [
            'headers' => $headers,
            'json' => [
                "data" => [
                    "type" => "flight-offers-pricing",
                    "flightOffers" => [$data],
                    "travelers" => [$travelers],
                ]
            ],
        ]);

        $statusCode = $res->getStatusCode();
        $responseBody = json_decode($res->getBody(), true);

        return $responseBody;
    }



    public function traveler($dateOfBirth, $firstName, $lastName, $gender, $email = null, $countryCallingCode, $phone_number, $birthPlace, $issuanceLocation, $issuanceDate, $passport_number, $expiryDate, $issuanceCountry, $validityCountry, $nationality)
    {
        $travelers = [
            "id" => "1",
            "dateOfBirth" => $dateOfBirth,
            "name" => [
                "firstName" => $firstName,
                "lastName" => $lastName,
            ],
            "gender" => $gender,
            "contact" =>  [
                "emailAddress" => $email,
                "phones" => [
                    [
                        "deviceType" => "MOBILE",
                        "countryCallingCode" => $countryCallingCode,
                        "number" => $phone_number
                    ]
                ],
            ],
            "documents" => [
                [
                    "documentType" => "PASSPORT",
                    "birthPlace" => $birthPlace,
                    "issuanceLocation" => $issuanceLocation,
                    "issuanceDate" => $issuanceDate,
                    "number" => $passport_number,
                    "expiryDate" => $expiryDate,
                    "issuanceCountry" => $issuanceCountry,
                    "validityCountry" => $validityCountry,
                    "nationality" => $nationality,
                    "holder" => true
                ]
            ]
        ];

        return $travelers;
    }
}