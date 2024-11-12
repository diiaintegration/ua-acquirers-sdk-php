Project Overview

The Diia API SDK allows developers to integrate with the Diia digital services platform for functionalities like document signing and sharing. This SDK enables:
- Authentication to securely access API.
- Document signing with multiple algorithm options.
- Branch and Offer Management.
- Obtaining deeplinks for document sharing and signing scenarios.

Project Contents

The SDK includes the following files and folders:
- `src/DiiaApi.php`: Main API client class for interacting with the Diia platform.
- `tests/`: A collection of test files for each SDK feature, ensuring correct functionality.
- `composer.json` and `composer.lock`: Configuration files for managing dependencies.
- `README.md`: Project documentation with usage instructions.

Dependencies

This SDK requires the following PHP components:
- PHP version >= 7.4
- [Guzzle](https://docs.guzzlephp.org/en/stable/) (for HTTP requests)
- JSON (for data handling)
- PHPUnit 


Installation

To install the SDK, use **Composer**:
1. Make sure Composer is installed on your device.
2. In your project directory, run the following command:
   “```bash
   composer require your-vendor/diia-api-sdk
   ```”
   This will add the SDK and its dependencies to your project.
  
The `composer.json` file will automatically install the required packages when you run the installation command above.

Configuration Details

1. **API Key and Secrets**: You need an API key and secret to authenticate with the Diia platform. These should be securely stored, preferably as environment variables. In your project root, create a `.env` file and add:
   ```env
   DIIA_API_KEY=acquirer_token
   DIIA_API_SECRET=auth_acquirer_token




Testing

The SDK includes a series of test files in the `tests/` directory to validate the functionalities, such as `DiiaAPIAuthTest.php` for authentication and `DiiaAPICreateOfferTest.php` for offer creation. To run the tests, use:
```bash
vendor/bin/phpunit tests
```


Our scenarios: 
Sharing scenario
Review Technical Documentation
Please review the general technical documentation available here.
Diia Signature scenario
Review Technical Documentation
Please review the general technical documentation available here.

Obtaining a Test Token
To obtain a test token, please complete the application form here.
These steps provide initial access to the API for testing and preparing your integration with the system.

Important links
https://integration.diia.gov.ua/en/home.html - description of all available services
https://t.me/AiDiiaStartBot -reach us out to start the integration
