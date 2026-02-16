<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions\Tests;

use Ksfraser\Exceptions\CustomException;
use PHPUnit\Framework\TestCase;

final class CustomExceptionTest extends TestCase
{
	public function testToStringIncludesMessageAndLocation(): void
	{
		$e = new class('boom') extends CustomException {
		};

		$s = (string)$e;
		self::assertStringContainsString('boom', $s);
		self::assertStringContainsString(' in ', $s);
		self::assertStringContainsString('(', $s);
		self::assertStringContainsString(')', $s);
	}

	public function testEmptyMessageBecomesUnknownClass(): void
	{
		$e = new class('') extends CustomException {
		};
		self::assertStringContainsString('Unknown', $e->getMessage());
	}
}
