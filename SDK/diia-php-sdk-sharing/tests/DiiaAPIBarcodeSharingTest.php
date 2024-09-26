<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIBarcodeSharingTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testbarcodeSharing(): void
    {
        $branchId = 'Branch_Id'; // Branch identifier
        $barcode = '3389798072091'; // Document barcode
        $requestId = '9895269c-d117-4a1c-8e7e-7492a611e15a'; // UUID v4
        $useDiiaId = true; // or false

        try {
            $result = $this->diiaAPI->barcodeSharing($branchId, $barcode, $requestId, $useDiiaId);
            $this->assertTrue($result, 'Request was not successful');
        } catch (Exception $e) {
            $this->fail('Error occurred while sending the request: ' . $e->getMessage());
        }
    }
}
