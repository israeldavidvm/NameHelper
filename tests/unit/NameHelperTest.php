<?php

namespace Israeldavidvm\Tests;

use Israeldavidvm\NameHelper\NameHelper;
use PHPUnit\Framework\TestCase;
use Exception;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;


#[CoversClass(NameHelper::class)]
#[UsesClass(NameHelper::class)]

final class NameHelperTest extends TestCase
{

    // =========================================================================
    // Tests de funciones de utilidad de nombres y rutas
    // =========================================================================


    public static function provideNamesToTransform(): array
    {
        return [
            ['Mi Nombre Ágil de Archivo_123.jpg', 'mi-nombre-agil-de-archivo-123.jpg'],
            ['Hello World', 'hello-world'],
            ['Con - Guiones', 'con---guiones'],
            ['Qué tal, mundo?', 'que-tal-mundo'],
        ];
    }

    #[DataProvider('provideNamesToTransform')]
    public function testTransformNameToRouteName(string $input, string $expected): void
    {
        $this->assertEquals($expected, NameHelper::transformNameToRouteName($input));
    }


    public static function provideRouteCombinations(): array
    {
        return [
            ['/ruta/base', 'imagen.jpg', '/ruta/base/imagen.jpg'],
            ['/ruta/base/', 'imagen.jpg', '/ruta/base/imagen.jpg'],
            ['/ruta/base', '/imagen.jpg', '/ruta/base/imagen.jpg'],
            ['/ruta/base/', '/imagen.jpg', '/ruta/base/imagen.jpg'],
            // ['/ruta/base////', '/imagen.jpg', '/ruta/base/imagen.jpg'],

        ];
    }

    #[DataProvider('provideRouteCombinations')]
    public function testConcatenateRoutes(string $url1, string $url2, string $expected): void
    {
        $this->assertEquals($expected, NameHelper::concatenateRoutes($url1, $url2));
    }

    public static function provideFilesForGetExt(): array
    {
        return [
            ['documento.pdf', 'pdf'],
            ['/ruta/al/archivo.tar.gz', 'gz'],
            ['archivo-con.varios.puntos.zip', 'zip'],
        ];
    }

    #[DataProvider('provideFilesForGetExt')]
    public function testGetExtOfFile(string $fileName, string $expected): void
    {
        $this->assertEquals($expected, NameHelper::getExtOfFile($fileName));
    }

    public function testGetExtOfFileThrowsExceptionOnNoExtension(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('pareciera no tener una extension');
        NameHelper::getExtOfFile('archivo-sin-ext');
    }

    public static function provideFilesForGetFileWithoutExt(): array
    {
        return [
            ['archivo.txt', 'archivo'],
            ['mi.archivo.con.puntos.js', 'mi.archivo.con.puntos'],
            ['/ruta/al/archivo.zip', 'archivo'],
            ['/ruta/al/directorio/', 'directorio'],
            ['sin-extension', 'sin-extension'],
        ];
    }

    #[DataProvider('provideFilesForGetFileWithoutExt')]
    public function testGetFileOrDirNameWithoutExt(string $fileName, string $expected): void
    {
        $this->assertEquals($expected, NameHelper::getFileOrDirNameWithoutExt($fileName));
    }

    public static function provideFileLocators(): array
    {
        return [
            ['archivo.txt', 'archivo.txt'],
            ['/ruta/al/archivo.zip', 'archivo.zip'],
            ['/ruta/al/directorio/', 'directorio'],
            ['directorio/subdirectorio', 'subdirectorio'],
        ];
    }

    
    #[DataProvider('provideFileLocators')]
    public function testGetFileOrDirName(string $fileLocatorName, string $expected): void
    {
        $this->assertEquals($expected, NameHelper::getFileOrDirName($fileLocatorName));
    }

    // // =========================================================================
    // // Tests de funciones de generación de nombres responsivos
    // // =========================================================================
    public static function provideImageNamesForResponsiveTest(): array
    {
        return [
            ['imagen-prueba.png'],
            ['documento-23.jpg'],
            ['imagen-con-nombre-largo.jpeg'],
        ];
    }


    #[DataProvider('provideImageNamesForResponsiveTest')]
    public function testGenerateResponsiveImageNames(string $imageName): void
    {
        $responsiveNames = NameHelper::generateResponsiveImageNames($imageName);

        // 1. Asegura que el resultado es un array
        $this->assertIsArray($responsiveNames);

        // 2. Asegura que la cantidad de elementos es correcta (tamaños + la imagen original)
        $this->assertCount(count(NameHelper::$responsiveImageSizes) + 1, $responsiveNames);

        // 3. Asegura que la imagen original se incluye en la primera posición
        $this->assertEquals($imageName, $responsiveNames[0]);

        // 4. Itera sobre los tamaños para verificar que cada versión responsiva existe y es correcta
        foreach (NameHelper::$responsiveImageSizes as $size) {
            $expectedName = "{$size}-{$imageName}";

            $this->assertArrayHasKey($size, $responsiveNames);
            $this->assertEquals($expectedName, $responsiveNames[$size]);
        }
    }

    public function testGenerateResponsiveImageNamesThrowsExceptionOnNoExtension(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('pareciera no tener una extension');
        NameHelper::generateResponsiveImageNames('imagen-sin-extension');
    }

    // // =========================================================================
    // // Tests de funciones de generación de rutas con baseUrl
    // // =========================================================================

    public function testGenerateRouteToImageInBaseRouteWithBaseUrl(): void
    {
        $this->assertEquals('/base/path/mi-imagen.jpg', NameHelper::generateRouteToImageInBaseRoute('mi-imagen.jpg', '/base/path'));
    }

    public function testGenerateRouteToImageInBaseRouteWithoutBaseUrl(): void
    {
        $this->assertEquals('mi-imagen.jpg', NameHelper::generateRouteToImageInBaseRoute('mi-imagen.jpg'));
    }
    
    public function testGenerateRouteToConvetionalImageDirInBaseRouteWithBaseUrl(): void
    {
        $this->assertEquals('/base/path/mi-imagen', NameHelper::generateRouteToConvetionalImageDirInBaseRoute('mi-imagen.jpg', '/base/path'));
    }
    
    public function testGenerateRouteToConvetionalImageDirInBaseRouteWithoutBaseUrl(): void
    {
        $this->assertEquals('mi-imagen', NameHelper::generateRouteToConvetionalImageDirInBaseRoute('mi-imagen.jpg'));
    }
    
    public function testGenerateRoutesToResponsiveImagesInBaseRoute(): void
    {
        $imageName = 'laptop.jpeg';
        $baseUrl = '/storage/images/laptop';
        $urls = NameHelper::generateRoutesToResponsiveImagesInBaseRoute($imageName, $baseUrl);

        $this->assertIsArray($urls);
        $this->assertEquals('/storage/images/laptop/laptop.jpeg', $urls[0]);

        foreach (NameHelper::$responsiveImageSizes as $size) {
            $expectedUrl = "/storage/images/laptop/{$size}-{$imageName}";
            
            $this->assertArrayHasKey($size, $urls); // Opcional: asegura que la clave existe
            $this->assertEquals($expectedUrl, $urls[$size]);
        }
    }

    // // =========================================================================
    // // Tests de funciones de Laravel
    // // =========================================================================
    
    public function testGenerateRouteToConvetionalDirInLaravelConvetionalLink(): void
    {
        $this->assertEquals('/storage/images/mi-imagen', NameHelper::generateRouteToConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg'));
    }

    public function testGenerateRouteToImageInConvetionalDirInLaravelConvetionalLink(): void
    {
        $this->assertEquals('/storage/images/mi-imagen/mi-imagen.jpg', NameHelper::generateRouteToImageInConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg'));
    }

    public function testGenerateRouteToConvetionalDirInLaravelConvetionalStorage(): void
    {
        $this->assertEquals('/images/mi-imagen', NameHelper::generateRouteToConvetionalDirInLaravelConvetionalStorage('mi-imagen.jpg'));
    }

    public function testGenerateRouteToImageInConvetionalDirInLaravelConvetionalStorage(): void
    {
        $this->assertEquals('/images/mi-imagen/mi-imagen.jpg', NameHelper::generateRouteToImageInConvetionalDirInLaravelConvetionalStorage('mi-imagen.jpg'));
    }
    
    public function testGenerateRoutesToResponsiveImagesInConvetionalDirInLaravelConvetionalLink(): void
    {
        $urls = NameHelper::generateRoutesToResponsiveImagesInConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg');
        $this->assertIsArray($urls);
        $this->assertEquals('/storage/images/mi-imagen/mi-imagen.jpg', $urls[0]);
        $this->assertEquals('/storage/images/mi-imagen/360-mi-imagen.jpg', $urls[360]);
    }

    // // =========================================================================
    // // Tests de funciones de Laravel con ruta base (absolutas)
    // // =========================================================================

    public function testGenerateAbsoluteRouteToConvetionalDirInLaravelConvetionalLink(): void
    {
        $baseUrl = 'http://example.com';
        $this->assertEquals('http://example.com/storage/images/mi-imagen', NameHelper::generateRouteToConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg', $baseUrl));
    }

    public function testGenerateAbsoluteRouteToImageInConvetionalDirInLaravelConvetionalLink(): void
    {
        $baseUrl = 'http://example.com';
        $this->assertEquals('http://example.com/storage/images/mi-imagen/mi-imagen.jpg', NameHelper::generateRouteToImageInConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg', $baseUrl));
    }

    public function testGenerateAbsoluteRouteToConvetionalDirInLaravelConvetionalStorage(): void
    {
        $baseUrl = 'http://example.com';
        $this->assertEquals('http://example.com/images/mi-imagen', NameHelper::generateRouteToConvetionalDirInLaravelConvetionalStorage('mi-imagen.jpg', $baseUrl));
    }

    public function testGenerateAbsoluteRouteToImageInConvetionalDirInLaravelConvetionalStorage(): void
    {
        $baseUrl = 'http://example.com';
        $this->assertEquals('http://example.com/images/mi-imagen/mi-imagen.jpg', NameHelper::generateRouteToImageInConvetionalDirInLaravelConvetionalStorage('mi-imagen.jpg', $baseUrl));
    }

    public function testGenerateAbsoluteRoutesToResponsiveImagesInConvetionalDirInLaravelConvetionalLink(): void
    {
        $baseUrl = 'http://example.com';
        $urls = NameHelper::generateRoutesToResponsiveImagesInConvetionalDirInLaravelConvetionalLink('mi-imagen.jpg', $baseUrl);
        $this->assertIsArray($urls);
        $this->assertEquals('http://example.com/storage/images/mi-imagen/mi-imagen.jpg', $urls[0]);
        $this->assertEquals('http://example.com/storage/images/mi-imagen/360-mi-imagen.jpg', $urls[360]);
    }
}