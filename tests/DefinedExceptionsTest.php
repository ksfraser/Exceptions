<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions\Tests;

use Ksfraser\Exceptions\CustomException;
use Ksfraser\Exceptions\IException;
use PHPUnit\Framework\TestCase;

final class DefinedExceptionsTest extends TestCase
{
    /**
     * @dataProvider exceptionProvider
     */
    public function testExceptionIsInstantiableAndExtendsCustomException(string $exceptionClass): void
    {
        $class = "Ksfraser\\Exceptions\\$exceptionClass";
        $this->assertTrue(class_exists($class), "Class $class does not exist");

        $exception = new $class('Test Message');

        $this->assertInstanceOf(CustomException::class, $exception);
        $this->assertInstanceOf(IException::class, $exception);
        $this->assertSame('Test Message', $exception->getMessage());
    }

    public function exceptionProvider(): array
    {
        return [
            ['FieldNotSetException'],
            ['ValueNotSetException'],
            ['VarNotSetException'],
            ['ResultNotSetException'],
            ['FieldNotClassVarException'],
            ['PrikeyNotSetException'],
            ['PrikeyNotDefinedException'],
            ['TableNotDefinedException'],
            ['NoMatchFoundException'],
            ['InvalidDataTypeException'],
            ['InvalidDataValueException'],
            ['UnknownDataTypeException'],
            ['FcnNotOverriddenException'],
            ['FcnPathOverrideException'],
            ['FcnNotExistException'],
            ['LostConnectionException'],
            ['ConfigNotExistException'],
            ['SearchedValueNotFoundException'],
            ['FcnRefactoredException'],
            ['FileOpenFailedException'],
            ['FileReadonlyException'],
            ['FilePtrNotSetException'],
            ['ClassRenamedDeprecException'],
            ['DataAccessDeniedException'],
            ['ModuleAccessDeniedException'],
        ];
    }
}
