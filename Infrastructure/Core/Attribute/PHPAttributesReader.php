<?php

declare(strict_types=1);


namespace Infrastructure\Core\Attribute;

/**
 * @description Класс для работы с нативными аттрибутами PHP
 */
final class PHPAttributesReader extends AttributeReader
{

    protected function getClassAttributes(\ReflectionClass $class, ?string $name): iterable
    {
        return $this->format($class, $class->getAttributes($name, \ReflectionAttribute::IS_INSTANCEOF));
    }


    protected function getFunctionAttributes(\ReflectionFunctionAbstract $function, ?string $name): iterable
    {
        return $this->format($function, $function->getAttributes($name, \ReflectionAttribute::IS_INSTANCEOF));
    }


    protected function getPropertyAttributes(\ReflectionProperty $property, ?string $name): iterable
    {
        return $this->format($property, $property->getAttributes($name, \ReflectionAttribute::IS_INSTANCEOF));
    }


    protected function getConstantAttributes(\ReflectionClassConstant $const, ?string $name): iterable
    {
        return $this->format($const, $const->getAttributes($name, \ReflectionAttribute::IS_INSTANCEOF));
    }

    protected function getParameterAttributes(\ReflectionParameter $param, ?string $name): iterable
    {
        return $this->format($param, $param->getAttributes($name, \ReflectionAttribute::IS_INSTANCEOF));
    }


    /**
     * @throws \ReflectionException
     * @throws SemanticAttributeException
     */
    private function format(\Reflector $context, iterable $attributes): iterable
    {
        foreach ($attributes as $attribute) {
            $this->assertClassExists($attribute->getName(), $context);

            yield new \ReflectionClass($attribute->getName()) => $attribute->getArguments();
        }
    }
}