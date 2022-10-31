<?php
declare(strict_types=1);

namespace SpaethTech\Annotations;

use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;
use SpaethTech\Common\FileSystem;
use SpaethTech\Endpoints\Country;
use SpaethTech\Endpoints\State;
use PHPUnit\Framework\TestCase;

/**
 * Class AnnotationReaderTests
 *
 * @package SpaethTech\Annotations
 * @author Ryan Spaeth <rspaeth@spaethtech.com>
 */
class AnnotationReaderTest extends TestCase
{
    protected ?AnnotationReader $countryAnnotationReader = null;
    protected ?AnnotationReader $stateAnnotationReader = null;
    
    protected function setUp(): void
    {
        AnnotationReader::cacheDir(PROJECT_DIR . "/.cache");
        
        $this->countryAnnotationReader = new AnnotationReader(Country::class);
        $this->stateAnnotationReader = new AnnotationReader(State::class);
    }
    
    // =================================================================================================================
    // HELPERS
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @throws ReflectionException
     */
    protected function createCountryCache()
    {
        $this->countryAnnotationReader->getAnnotations();
    }
    
    /**
     * @throws ReflectionException
     */
    protected function createStateCache()
    {
        $this->stateAnnotationReader->getAnnotations();
    }
    
    // =================================================================================================================
    // TESTS: Cache
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @covers AnnotationReader::cacheDir
     */
    public function testCacheDir()
    {
        // NOTE: Initially configured in setUp()

        $expected = FileSystem::path(PROJECT_DIR . "/.cache");
        $cacheDir = AnnotationReader::cacheDir();
        $this->assertEquals($cacheDir, $expected);

        $tempExpected = FileSystem::path(PROJECT_DIR . "/.cache-test");
        $cacheDir = AnnotationReader::cacheDir($tempExpected);
        $this->assertEquals($cacheDir, $tempExpected);

        // Cleanup!
        FileSystem::rmdir($tempExpected);

        // Reset to the normal location!
        AnnotationReader::cacheDir($expected);
    }
    
    /**
     *
     * @throws ReflectionException
     */
    public function testCache()
    {
        $this->createCountryCache();

        $path = AnnotationReader::cacheDirForClass(Country::class);

        $this->assertFileExists($path . "/class.json");
        $this->assertFileExists($path . "/method.getCode.json");
        $this->assertFileExists($path . "/property.name.json");
        $this->assertFileExists($path . "/property.code.json");

        // NOTE: This file should NOT exist, as it is a dynamic method described in the Class annotation.
        $this->assertFileDoesNotExist($path . "/method.getName.json");
    }
    
    /**
     * @covers AnnotationReader::cacheClear
     * @throws ReflectionException
     */
    public function testCacheClear()
    {
        $this->createCountryCache();
        $countryPath = AnnotationReader::cacheDirForClass(Country::class);
        $this->assertDirectoryExists($countryPath);
        AnnotationReader::cacheClear();
        $this->assertDirectoryDoesNotExist($countryPath);

        $this->createCountryCache();
        $this->createStateCache();
        $statePath = AnnotationReader::cacheDirForClass(State::class);
        $this->assertDirectoryExists($countryPath);
        $this->assertDirectoryExists($statePath);
        AnnotationReader::cacheClear([Country::class]);
        $this->assertDirectoryDoesNotExist($countryPath);
        $this->assertDirectoryExists($statePath);
    }
    
    // =================================================================================================================
    // TESTS: Reflection
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @covers AnnotationReader::getReflectedClass
     * @throws ReflectionException
     */
    public function testGetReflectedClass()
    {
        $class = $this->countryAnnotationReader->getReflectedClass();

        echo "AnnotationReader::getReflectedClass()\n";
        echo "> Name      : {$class->getName()}\n";
        echo "> Namespace : {$class->getNamespaceName()}\n";
        echo "\n";

        $this->assertEquals("SpaethTech\\Endpoints\\Country", $class->getName());
    }
    
    /**
     * @covers AnnotationReader::getReflectedMethods
     * @throws ReflectionException
     */
    public function testGetReflectedMethods()
    {
        $methods = $this->countryAnnotationReader->getReflectedMethods();

        echo "AnnotationReader::getReflectedMethods()\n";

        foreach ($methods as $method) {
            /** @var ReflectionMethod $method */
            echo "> {$method->getName()}\n";
        }

        echo "\n";

        $this->assertCount(1, $methods);
    }
    
    /**
     * @covers AnnotationReader::getReflectedMethod
     * @throws ReflectionException
     */
    public function testGetReflectedMethod()
    {
        $method = $this->countryAnnotationReader->getReflectedMethod("getCode");

        echo "AnnotationReader::getReflectedMethod('getName')\n";

        echo "> {$method->getName()}\n";
        echo "\n";

        $this->assertEquals("getCode", $method->getName());
        
    }
    
    /**
     * @covers AnnotationReader::getReflectedProperties
     * @throws ReflectionException
     */
    public function testGetReflectedProperties()
    {
        $properties = $this->countryAnnotationReader->getReflectedProperties();

        echo "AnnotationReader::getReflectedProperties()\n";

        foreach ($properties as $property) {
            /** @var ReflectionProperty $property */
            echo "> {$property->getName()}\n";
        }

        echo "\n";

        $this->assertCount(2, $properties);
    }
    
    /**
     * @covers AnnotationReader::getReflectedProperty
     * @throws ReflectionException
     */
    public function testGetReflectedProperty()
    {
        $property = $this->countryAnnotationReader->getReflectedProperty("name");

        echo "AnnotationReader::getReflectedProperty('name')\n";

        echo "> {$property->getName()}\n";
        echo "\n";

        $this->assertEquals("name", $property->getName());
    }

    // =================================================================================================================
    // TESTS: Namespace/Misc
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @covers AnnotationReader::getUseStatements
     * @throws ReflectionException
     */
    public function testGetUseStatements()
    {
        $uses = $this->countryAnnotationReader->getUseStatements();

        echo "AnnotationReader::getUseStatements()\n";

        foreach ($uses as $class => $namespace) {
            echo "> $class => $namespace\n";
        }

        echo "\n";

        $this->assertGreaterThan(0, count($uses));
    }
    
    /**
     * @covers AnnotationReader::getNamespace
     * @throws ReflectionException
     */
    public function testGetNamespace()
    {
        $namespace = $this->countryAnnotationReader->getNamespace();

        echo "AnnotationReader::getNamespace()\n";
        echo "> $namespace\n";
        echo "\n";

        $this->assertEquals("SpaethTech\\Endpoints", $namespace);
    }
    
    /**
     * @covers AnnotationReader::findAnnotationClass
     * @throws ReflectionException
     */
    public function testFindAnnotationClass()
    {
        $annotationClass = $this->countryAnnotationReader->findAnnotationClass("EndpointAnnotation");

        echo "AnnotationReader::findAnnotationClass('EndpointAnnotation')\n";
        echo "> $annotationClass\n";
        echo "\n";

        $this->assertEquals("SpaethTech\\Annotations\\EndpointAnnotation", $annotationClass);
    }
    
    // =================================================================================================================
    // TESTS: Class
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @covers AnnotationReader::getClassAnnotations
     * @throws ReflectionException
     */
    public function testGetClassAnnotations()
    {
        $annotations = $this->countryAnnotationReader->getClassAnnotations();
        print_r($annotations);

        $this->assertEquals("rspaeth@spaethtech.com", $annotations["author"]["email"]);
    }
    
    /**
     * @covers AnnotationReader::getClassAnnotation
     * @throws ReflectionException
     */
    public function testGetClassAnnotation()
    {
        $annotations = $this->countryAnnotationReader->getClassAnnotation("endpoint");
        print_r($annotations);

        $this->assertEquals("/countries", $annotations["get"]);
    }
    
    /**
     * @covers AnnotationReader::getClassAnnotationsLike
     * @throws ReflectionException
     */
    public function testGetClassAnnotationsLike()
    {
        $annotations = $this->countryAnnotationReader->getClassAnnotationsLike("/endpoints*/");
        print_r($annotations);

        $this->assertCount(2, $annotations);
    }
    
    /**
     * @covers AnnotationReader::hasClassAnnotation
     * @throws ReflectionException
     */
    public function testHasClassAnnotation()
    {
        $annotations = $this->countryAnnotationReader->hasClassAnnotation("endpoint");

        $this->assertTrue($annotations);
    }
    
    // =================================================================================================================
    // TESTS: Methods
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @covers AnnotationReader::getMethodAnnotations
     * @throws ReflectionException
     */
    public function testGetMethodAnnotations()
    {
        $annotations = $this->countryAnnotationReader->getMethodAnnotations();
        print_r($annotations);

        $this->assertArrayHasKey("getCode", $annotations);

        $annotations = $this->countryAnnotationReader->getMethodAnnotations("getCode");
        print_r($annotations);

        $this->assertArrayHasKey("return", $annotations["getCode"]);
    }
    
    /**
     * @covers AnnotationReader::getMethodAnnotation
     * @throws ReflectionException
     */
    public function testGetMethodAnnotation()
    {
        $annotations = $this->countryAnnotationReader->getMethodAnnotation("getCode", "return");
        print_r($annotations);

        $this->assertArrayHasKey("types", $annotations);
        $this->assertArrayHasKey("description", $annotations);
    }
    
    /**
     * @covers AnnotationReader::getMethodAnnotationsLike
     * @throws ReflectionException
     */
    public function testGetMethodAnnotationsLike()
    {
        $annotations = $this->countryAnnotationReader->getMethodAnnotationsLike("getCode", "/return/");
        print_r($annotations);

        $this->assertCount(1, $annotations);
    }
    
    /**
     * @covers AnnotationReader::hasMethodAnnotation
     * @throws ReflectionException
     */
    public function testHasMethodAnnotation()
    {
        $annotations = $this->countryAnnotationReader->hasMethodAnnotation("getCode", "return");

        $this->assertTrue($annotations);
    }
    
    // =================================================================================================================
    // TESTS: Properties
    // -----------------------------------------------------------------------------------------------------------------
    
    /**
     * @covers AnnotationReader::getPropertyAnnotations
     * @throws ReflectionException
     */
    public function testGetPropertyAnnotations()
    {
        $annotations = $this->countryAnnotationReader->getPropertyAnnotations();
        print_r($annotations);

        $this->assertArrayHasKey("name", $annotations);
        $this->assertArrayHasKey("code", $annotations);

        $annotations = $this->countryAnnotationReader->getPropertyAnnotations("name");
        print_r($annotations);

        $this->assertArrayHasKey("var", $annotations["name"]);
    }
    
    /**
     * @covers AnnotationReader::getPropertyAnnotation
     * @throws ReflectionException
     */
    public function testGetPropertyAnnotation()
    {
        $annotations = $this->countryAnnotationReader->getPropertyAnnotation("name", "var");
        print_r($annotations);

        $this->assertArrayHasKey("types", $annotations);
        $this->assertArrayHasKey("name", $annotations);
        $this->assertArrayHasKey("description", $annotations);
    }
    
    /**
     * @covers AnnotationReader::getPropertyAnnotationsLike
     * @throws ReflectionException
     */
    public function testGetPropertyAnnotationsLike()
    {
        $annotations = $this->countryAnnotationReader->getPropertyAnnotationsLike("name", "/var/");
        print_r($annotations);

        $this->assertCount(1, $annotations);
    }
    
    /**
     * @covers AnnotationReader::hasPropertyAnnotations
     * @throws ReflectionException
     */
    public function testHasPropertyAnnotation()
    {
        $annotations = $this->countryAnnotationReader->hasPropertyAnnotation("name", "var");

        $this->assertTrue($annotations);
    }



}
