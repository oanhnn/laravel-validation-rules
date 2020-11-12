<?php

namespace Tests\Integration;

use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

use function dirname;
use function file_get_contents;
use function resource_path;

/**
 * Class ServiceProviderTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Tests lang file is existed in lang directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Validation\\ServiceProvider"
     *
     * @return void
     */
    public function testItShouldPublishVendorLang()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/resources/lang/en/message.php';
        $targetFile = resource_path('lang/vendor/validation-rules/en/message.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Validation\\ServiceProvider',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Set up before test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();
    }

    /**
     * Clear up after test
     */
    protected function tearDown(): void
    {
        $this->files->delete([
            $this->app->resourcePath('lang/vendor/validation-rules'),
        ]);

        parent::tearDown();
    }
}
