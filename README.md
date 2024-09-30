Diia API SDK for PHP
Overview
The Diia API SDK for PHP provides a simple and effective way to integrate with the Diia digital services platform, allowing developers to implement functionalities such as document signing and sharing. This SDK facilitates seamless interactions with the Diia API, enabling users to authenticate, create branches, manage offers, and generate links for signing documents.

Features
Authentication: Easily obtain and manage session tokens for secure API access.
Document Signing: Generate signing links for documents, utilizing various signing algorithms.
Branch and Offer Management: Create, retrieve, and delete branches and offers associated with your application.
Dynamic Linking: Create deep links for document signing and sharing, ensuring a smooth user experience.
Installation
To install the SDK, simply add it to your project using Composer:

bash

composer require your-vendor/diia-api-sdk
Usage
Here is a brief example of how to use the SDK for generating a signing link:

php

use DiiaAPI;

$diiaAPI = new DiiaAPI($environment, $acquirerToken, $authAcquirerToken);

$signLink = $diiaAPI->getSignLink($branchId, $offerId, $returnLink, $requestId, $signAlgo, $fileName, $fileHash);
echo "Generated signing link: $signLink";
Documentation
For detailed documentation on how to use the SDK, including method descriptions and examples, please refer to the Wiki or the API Documentation.

Contributing
Contributions are welcome! If you would like to contribute to the SDK, please fork the repository and submit a pull request. For any issues or feature requests, please open an issue in the GitHub repository.

License
This SDK is licensed under the MIT License. See the LICENSE file for more information.
