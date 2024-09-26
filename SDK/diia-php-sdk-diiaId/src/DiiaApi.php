<?php

class DiiaAPI
{
    private $diiaHost;
    private $token;
    
    
    public function __construct($environment, $acquirerToken, $authAcquirerToken = null)
    {
        $this->diiaHost = $environment === 'test' ? 'https://api2s.diia.gov.ua' : 'https://api2.diia.gov.ua';
        $this->token = $this->getSessionToken($acquirerToken, $authAcquirerToken);
    }
    
    
    protected function getSessionToken($acquirerToken, $authAcquirerToken = null): string
    {
        /*
        At this point, you can retrieve a previously obtained session token
        that has not yet expired from your storage.
        Here is an example of how this can be done:
        
        $sessionToken = YourStorage::getDiiaSessionToken($acquirerToken);
        if (!empty($sessionToken)) {
            return $sessionToken;
        }
        */

        $url = sprintf('%s/api/v1/auth/acquirer/%s', $this->diiaHost, $acquirerToken);

        $headers = [
            'Accept' => 'application/json'
        ];

        if ($authAcquirerToken) {
            $headers['Authorization'] = 'Basic ' . $authAcquirerToken;
        }

        $response = $this->sendRequest($url, 'GET', $headers);

        if (isset($response['token'])) {
            return $response['token'];
        } else {
            throw new Exception('Failed to retrieve session token');
        }
    }
    
    
    public function getToken(): string
    {
        return $this->token;
    }
    
    
    private function sendRequest($url, $method = 'GET', $headers = [], $body = null): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($headers) {
            $curlHeaders = [];
            foreach ($headers as $key => $value) {
                $curlHeaders[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        }

        if ($method !== 'GET' && $body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception('Request Error: ' . curl_error($ch));
        }
        
        if ($httpCode === 204) {
            return [];
        }

        curl_close($ch);

        if ($httpCode >= 400) {
            throw new Exception("HTTP Error: $httpCode");
        }

        return json_decode($response, true);
    }
    
    
    public function createBranch($branchData): string
    {
        if (empty($branchData)) {
            throw new Exception('Branch data not provided');
        }
        
        $url = $this->diiaHost . '/api/v2/acquirers/branch';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json'
        ];

        $response = $this->sendRequest($url, 'POST', $headers, json_encode($branchData));

        if (isset($response['_id'])) {
            return $response['_id'];
        } else {
            throw new Exception('Failed to create branch');
        }
    }
    
    
    public function getBranches($skip = 0, $limit = 10): array
    {
        $this->validateSkipAndLimit($skip, $limit);
        
        $url = sprintf('%s/api/v2/acquirers/branches?skip=%d&limit=%d', $this->diiaHost, $skip, $limit);

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json'
        ];

        $response = $this->sendRequest($url, 'GET', $headers);

        return $response['branches'] ?? [];
    }
    
    
    public function deleteBranch($branchId): bool
    {
        $this->validateBranchId($branchId);
        
        $url = $this->diiaHost . '/api/v2/acquirers/branch/' . $branchId;

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $this->sendRequest($url, 'DELETE', $headers);

        return true;
    }
    
    
    public function createOffer($branchId, $offerName, $scope): string
    {
        $this->validateBranchId($branchId);
        $this->validateOfferName($offerName);
        
        $url = $this->diiaHost . '/api/v1/acquirers/branch/' . $branchId . '/offer';

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $body = [
            'name' => $offerName,
            'scopes' => [
                'diiaId' => [$scope]
            ]
        ];

        $response = $this->sendRequest($url, 'POST', $headers, json_encode($body));

        if (isset($response['_id'])) {
            return $response['_id'];
        } else {
            throw new Exception('Failed to create offer');
        }
    }
    
    
    public function getOffers($branchId, $skip = 0, $limit = 10): array
    {
        $this->validateBranchId($branchId);
        $this->validateSkipAndLimit($skip, $limit);
        
        $url = sprintf('%s/api/v1/acquirers/branch/%s/offers?skip=%d&limit=%d', $this->diiaHost, $branchId, $skip, $limit);

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json'
        ];

        $response = $this->sendRequest($url, 'GET', $headers);

        return $response['offers'] ?? [];
    }
    
    
    public function deleteOffer($branchId, $offerId): bool
    {
        $this->validateBranchId($branchId);
        $this->validateOfferId($offerId);
        
        $url = $this->diiaHost . '/api/v1/acquirers/branch/' . $branchId . '/offer/' . $offerId;

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $this->sendRequest($url, 'DELETE', $headers);

        return true;
    }
    
    
    public function getSignLink($branchId, $offerId, $returnLink, $requestId, $signAlgo, $fileName, $fileHash): string
    {
        $this->validateBranchId($branchId);
        $this->validateOfferId($offerId);
        
        $url = $this->diiaHost . '/api/v2/acquirers/branch/' . $branchId . '/offer-request/dynamic';

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $body = json_encode([
            'offerId' => $offerId,
            'returnLink' => $returnLink,
            'requestId' => $requestId,
            'signAlgo' => $signAlgo,
            'data' => [
                'hashedFilesSigning' => [
                    'hashedFiles' => [
                        [
                            'fileName' => $fileName,
                            'fileHash' => $fileHash,
                        ]
                    ]
                ]
            ]
        ]);

        $response = $this->sendRequest($url, 'POST', $headers, $body);

        if (isset($response['deeplink'])) {
            return $response['deeplink'];
        } else {
            throw new Exception('Failed to obtain deeplink');
        }
    }
    
    
    public function getAuthLink($branchId, $offerId, $returnLink, $requestId, $signAlgo): string
    {
        $this->validateBranchId($branchId);
        $this->validateOfferId($offerId);
        
        $url = $this->diiaHost . '/api/v2/acquirers/branch/' . $branchId . '/offer-request/dynamic';

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $body = json_encode([
            'offerId' => $offerId,
            'returnLink' => $returnLink,
            'requestId' => $requestId,
            'signAlgo' => $signAlgo
        ]);

        $response = $this->sendRequest($url, 'POST', $headers, $body);

        if (isset($response['deeplink'])) {
            return $response['deeplink'];
        } else {
            throw new Exception('Failed to obtain deeplink');
        }
    }
    
    
    private function validateBranchId($branchId): bool
    {
        if (empty($branchId)) {
            throw new Exception('Branch ID not specified');
        }
        
        if (gettype($branchId) !== 'string') {
            throw new Exception('branchId must be of type string');
        }
        
        return true;
    }
    
    
    private function validateOfferId($offerId): bool
    {
        if (empty($offerId)) {
            throw new Exception('Offer ID not specified');
        }
        
        if (gettype($offerId) !== 'string') {
            throw new Exception('offerId must be of type string');
        }
        
        return true;
    }
    
    
    private function validateOfferName($offerName): bool
    {
        if (empty($offerName)) {
            throw new Exception('Offer name not specified');
        }
        
        if (gettype($offerName) !== 'string') {
            throw new Exception('offerName must be of type string');
        }
        
        return true;
    }
    
    
    private function validateSkipAndLimit($skip, $limit): bool
    {
        if (!is_int($skip)) {
            throw new Exception('The "skip" argument must be an integer, given type ' . gettype($skip));
        }
        
        if (!is_int($limit)) {
            throw new Exception('The "limit" argument must be an integer, given type ' . gettype($limit));
        }
        
        return true;
    }
}
