<?php

namespace SpaethTech\Annotations;

use SpaethTech\Endpoints\Country;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class AnnotationReaderTests
 *
 * @package SpaethTech\Annotations
 * @author Ryan Spaeth <rspaeth@spaethtech.com>
 */
class AnnotationReaderTests extends TestCase
{
    /** @var AnnotationReader  */
    protected $classReader = null;


    /**
     * @throws ReflectionException
     */
    protected function setUp(): void
    {
        $this->classReader = new AnnotationReader(Country::class);
    }

    #region CACHING

    public function testCache()
    {
        AnnotationReader::cacheDir(__DIR__);
        print_r($this->classReader->getAnnotations());

        $path = AnnotationReader::cacheDir()."/.cache/".Country::class;

        $this->assertFileExists($path."/class.json");
        $this->assertFileExists($path."/method.getName.json");
        $this->assertFileExists($path."/method.getCode.json");
        $this->assertFileExists($path."/property.name.json");
        $this->assertFileExists($path."/property.code.json");
    }

    public function testClearCache()
    {
        AnnotationReader::cacheDir(__DIR__);
        //$this->classReader->cacheClear();
        $this->classReader->cacheClear([Country::class]);

        $path = AnnotationReader::cacheDir()."/.cache/".Country::class;

        $this->assertFileNotExists($path."/class.json");
    }

    #endregion

    #region REFLECTION

    public function testGetReflectedClass()
    {
        $class = $this->classReader->getReflectedClass();

        echo "AnnotationReader::getReflectedClass()\n";
        echo "> Name      : {$class->getName()}\n";
        echo "> Namespace : {$class->getNamespaceName()}\n";
        echo "\n";

        $this->assertEquals("Tests\\SpaethTech\\Annotations\\Examples\\Country", $class->getName());
    }

    public function testGetReflectedMethods()
    {
        $methods = $this->classReader->getReflectedMethods();

        echo "AnnotationReader::getReflectedMethods()\n";

        foreach($methods as $method)
        {
            /** @var \ReflectionMethod $method */
            echo "> {$method->getName()}\n";
        }

        echo "\n";

        $this->assertCount(2, $methods);
    }

    public function testGetReflectedMethod()
    {
        $method = $this->classReader->getReflectedMethod("getName");

        echo "AnnotationReader::getReflectedMethod('getName')\n";

        /** @var \ReflectionMethod $method */
        echo "> {$method->getName()}\n";
        echo "\n";

        $this->assertEquals("getName", $method->getName());
    }

    public function testGetReflectedProperties()
    {
        $properties = $this->classReader->getReflectedProperties();

        echo "AnnotationReader::getReflectedProperties()\n";

        foreach($properties as $property)
        {
            /** @var \ReflectionProperty $property */
            echo "> {$property->getName()}\n";
        }

        echo "\n";

        $this->assertCount(2, $properties);
    }

    public function testGetReflectedProperty()
    {
        $property = $this->classReader->getReflectedProperty("name");

        echo "AnnotationReader::getReflectedProperty('name')\n";

        /** @var \ReflectionProperty $property */
        echo "> {$property->getName()}\n";
        echo "\n";

        $this->assertEquals("name", $property->getName());
    }

    #endregion

    #region NAMESPACES

    public function testGetUseStatements()
    {
        $uses = $this->classReader->getUseStatements();

        echo "AnnotationReader::getUseStatements()\n";

        foreach($uses as $class => $namespace)
        {
            echo "> $class => $namespace\n";
        }

        echo "\n";

        $this->assertGreaterThan(0, count($uses));
    }

    public function testGetNamespace()
    {
        $namespace = $this->classReader->getNamespace();

        echo "AnnotationReader::getNamespace()\n";
        echo "> $namespace\n";
        echo "\n";

        $this->assertEquals("Tests\SpaethTech\Annotations\Examples", $namespace);
    }

    public function testFindAnnotationClass()
    {
        $annotationClass = $this->classReader->findAnnotationClass("EndpointAnnotation");

        echo "AnnotationReader::findAnnotationClass('EndpointAnnotation')\n";
        echo "> $annotationClass\n";
        echo "\n";

        $this->assertEquals("Tests\SpaethTech\Annotations\EndpointAnnotation", $annotationClass);
    }

    #endregion

    #region ANNOTATIONS: Class

    public function testGetClassAnnotations()
    {
        AnnotationReader::cacheDir(__DIR__);

        $annotations = $this->classReader->getClassAnnotations();
        print_r($annotations);

        $this->assertEquals("rspaeth@spaethtech.com", $annotations["author"]["email"]);
    }

    public function testGetClassAnnotation()
    {
        $annotations = $this->classReader->getClassAnnotation("endpoint");
        print_r($annotations);

        $this->assertEquals("/countries", $annotations["get"]);
    }

    public function testGetClassAnnotationsLike()
    {
        $annotations = $this->classReader->getClassAnnotationsLike("/endpoint[s]*/");
        print_r($annotations);

        $this->assertCount(2, $annotations);
    }

    public function testHasClassAnnotation()
    {
        $annotations = $this->classReader->hasClassAnnotation("endpoint");

        $this->assertTrue($annotations);
    }

    #endregion

    #region ANNOTATIONS: Method

    public function testGetMethodAnnotations()
    {
        $annotations = $this->classReader->getMethodAnnotations();
        print_r($annotations);

        $this->assertArrayHasKey("getCode", $annotations);

        $annotations = $this->classReader->getMethodAnnotations("getCode");
        print_r($annotations);

        $this->assertArrayHasKey("return", $annotations);
    }

    public function testGetMethodAnnotation()
    {
        $annotations = $this->classReader->getMethodAnnotation("getName", "return");
        print_r($annotations);

        $this->assertArrayHasKey("types", $annotations);
        $this->assertArrayHasKey("description", $annotations);
    }

    public function testGetMethodAnnotationsLike()
    {
        $annotations = $this->classReader->getMethodAnnotationsLike("getName", "/return/");
        print_r($annotations);

        $this->assertCount(1, $annotations);
    }

    public function testHasMethodAnnotation()
    {
        $annotations = $this->classReader->hasMethodAnnotation("getName", "return");

        $this->assertTrue($annotations);
    }

    #endregion

    #region ANNOTATIONS: Property

    public function testGetPropertyAnnotations()
    {
        //$annotations = $this->classReader->getPropertyAnnotations();
        //print_r($annotations);

        //$this->assertArrayHasKey("name", $annotations);
        //$this->assertArrayHasKey("code", $annotations);

        $annotations = $this->classReader->getPropertyAnnotations("name");
        print_r($annotations);

        //$this->assertArrayHasKey("var", $annotations);
    }

    public function testGetPropertyAnnotation()
    {
        $annotations = $this->classReader->getPropertyAnnotation("name", "var");
        print_r($annotations);

        $this->assertArrayHasKey("types", $annotations);
        $this->assertArrayHasKey("name", $annotations);
        $this->assertArrayHasKey("description", $annotations);
    }

    public function testGetPropertyAnnotationsLike()
    {
        $annotations = $this->classReader->getPropertyAnnotationsLike("name", "/var/");
        print_r($annotations);

        $this->assertCount(1, $annotations);
    }

    public function testHasPropertyAnnotation()
    {
        $annotations = $this->classReader->hasPropertyAnnotation("name", "var");

        $this->assertTrue($annotations);
    }

    #endregion

}
