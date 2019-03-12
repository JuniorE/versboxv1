<?php

    namespace JuniorE\Versbox;


    use Exception;
    use GuzzleHttp\Client;
    use GuzzleHttp\RequestOptions;
    use GuzzleHttp\Exception\GuzzleException;
    use GuzzleHttp\Exception\RequestException;
    use Illuminate\Contracts\Config\Repository;


    class Versbox
    {

        private const BASE_URI = 'https://api.cloudlatching.eu/api/public/v1/latches/allocation/temporary';

        /**
         * @var Client
         */
        protected $client;

        /**
         * @var Repository
         */
        protected $config;

        public function __construct(Repository $config, Client $client = null)
        {
            $this->config = $config;
            $this->client = $client ?: new Client([
                RequestOptions::HEADERS => [
                    'CLP_API_USER_PASSWORD' => $this->config->get('versbox.auth_password'),
                    'CLP_API_USER_E_MAIL'   => $this->config->get('versbox.auth_login'),
                    'CLP_API_SECRET'        => $this->config->get('versbox.api_secret'),
                    'CLP_API_OPERATOR_CODE' => $this->config->get('versbox.operator_code')
                ],
                RequestOptions::VERIFY  => false
            ]);
        }

        /**
         *
         * @param string $firstname
         * @param string $lastname
         * @param string $mobile
         * @param string $email
         * @param string $notifications
         * @param string $pickup_date_time
         * @param string $disability
         * @param string $api_reference
         * @param string $service_location_code
         * @return mixed
         * @throws GuzzleException
         */
        public function allocateLatch(string $firstname, string $lastname, string $mobile, string $email, string $notifications, string $pickup_date_time, string $disability, string $api_reference, string $service_location_code = null)
        {
            $arrQueryParams = [
                'first_name'                => $firstname,
                'last_name'                 => $lastname,
                'mobile_number_1'           => $mobile,
                'e_mail_address_1'          => $email,
                'ready_notification_method' => $notifications,
                'pickup_date_time'          => $pickup_date_time,
                'disability'                => $disability,
                'api_reference'             => $api_reference
            ];
            if ($service_location_code) {
                array_unshift($arrQueryParams, ['service_location_code' => $service_location_code]);
            }
            try {
                $response = $this->client->request(
                    'POST',
                    static::BASE_URI,
                    [
                        RequestOptions::QUERY => $arrQueryParams
                    ]
                );
                return json_decode($response->getBody()->read($response->getBody()->getSize()), JSON_PRETTY_PRINT);
            } catch (RequestException $exception) {
                throw new Exception($exception->getMessage());
            }
        }

        public function setAllocatedLatchReadyByReference(string $api_reference, string $mobile)
        {
            try {
                $response = $this->client->request(
                    'POST',
                    static::BASE_URI,
                    [
                        RequestOptions::QUERY => [
                            'api_reference'   => $api_reference,
                            'mobile_number_1' => $mobile
                        ]
                    ]
                );
                return json_decode($response->getBody()->read($response->getBody()->getSize()), JSON_PRETTY_PRINT);
            } catch (RequestException $exception) {
                throw new Exception($exception->getMessage());
            }
        }


    }
