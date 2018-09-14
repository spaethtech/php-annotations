<?php
/**
 * Created by PhpStorm.
 * User: rspaeth
 * Date: 9/11/2018
 * Time: 12:25 PM
 */

namespace Tests\MVQN\Annotations;

use MVQN\Annotations\AnnotationReader;
use Tests\MVQN\Annotations\Examples\Country;

class AnnotationReaderTests extends \PHPUnit\Framework\TestCase
{
    /** @var AnnotationReader  */
    protected $classReader = null;

    protected function setUp()
    {
        //AnnotationReader::cacheDir(__DIR__);
        $this->classReader = new AnnotationReader(Country::class);
    }

    public function testCache()
    {
        print_r($this->classReader->getAnnotations());
        //print_r($this->classReader->getClassAnnotations());
        //$this->classReader->getMethodAnnotations();
        //$this->classReader->getPropertyAnnotations();

        //print_r($this->classReader->getMethodAnnotations("getCode"));
    }

    public function testClearCache()
    {
        //$this->classReader->cacheClear();
        $this->classReader->cacheClear([Country::class]);
    }




    #region REFLECTION

    public function testGetReflectedClass()
    {
        $class = $this->classReader->getReflectedClass();

        echo "AnnotationReader::getReflectedClass()\n";
        echo "> Name      : {$class->getName()}\n";
        echo "> Namespace : {$class->getNamespaceName()}\n";
        echo "\n";

        $this->assertEquals("Tests\\MVQN\\Annotations\\Examples\\Country", $class->getName());
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

        $this->assertEquals("Tests\MVQN\Annotations\Examples", $namespace);
    }

    public function testFindAnnotationClass()
    {
        $annotationClass = $this->classReader->findAnnotationClass("EndpointAnnotation");

        echo "AnnotationReader::findAnnotationClass('EndpointAnnotation')\n";
        echo "> $annotationClass\n";
        echo "\n";

        $this->assertEquals("Tests\MVQN\Annotations\Examples\EndpointAnnotation", $annotationClass);
    }

    #endregion



    public function testGetClassAnnotations()
    {
        $annotations = $this->classReader->getClassAnnotations();

        print_r($annotations);


    }




}
