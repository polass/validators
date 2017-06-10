<?php

namespace Polass\Tests;

use PHPUnit\Framework\TestCase;
use Polass\Validators\Validator;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

class ModelTest extends TestCase
{
    /**
     * テストの準備
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->validator = new Validator(
            new Translator(new ArrayLoader, 'en'), [], []
        );
    }

    /**
     * `validateContains()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForContains
     */
    public function testValidateContains($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateContains('attribute', $value, $parameters)
        );
    }

    /**
     * `validateContains()` のテストのためのデータプロバイダ
     *
     */
    public function provideForContains()
    {
        return [
            [ 'foobar', [ 'foo' ], true ],
            [ 'foobar', [ 'foo', 'bar' ], true ],
            [ 'foobar', [ 'baz' ], false ],
            [ 'foobar', [ 'foo', 'baz' ], false ],
            [ null, [ 'foo' ], false ],
        ];
    }

    /**
     * `validateNotContains()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForNotContains
     */
    public function testValidateNotContains($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateNotContains('attribute', $value, $parameters)
        );
    }

    /**
     * `validateNotContains()` のテストのためのデータプロバイダ
     *
     */
    public function provideForNotContains()
    {
        return [
            [ 'foobar', [ 'foo' ], false ],
            [ 'foobar', [ 'foo', 'bar' ], false ],
            [ 'foobar', [ 'baz' ], true ],
            [ 'foobar', [ 'foo', 'baz' ], false ],
            [ null, [ 'foo' ], true ],
        ];
    }

    /**
     * `validateAscii()` の正常系のテスト
     *
     * @param mixed $value
     * @param bool $passes
     *
     * @dataProvider provideForAscii
     */
    public function testValidateAscii($value, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateAscii('attribute', $value)
        );
    }

    /**
     * `validateAscii()` のテストのためのデータプロバイダ
     *
     */
    public function provideForAscii()
    {
        return [
            [ 'foobar', true ],
            [ '123', true ],
            [ '*=-', true ],
            [ "foo\nbar", true ],
            [ 123, true ],
            [ "\n", true ],
            [ 'ｆｏｏｂａｒ', false ],
            [ "ｆｏｏ\nｂａｒ", false ],
            [ '１２３', false ],
            [ 'あいうえお', false ],
            [ '漢字', false ],
            [ '└─┬┐', false ],
            [ '', true ],
            [ null, true ],
        ];
    }

    /**
     * `validateNotAscii()` の正常系のテスト
     *
     * @param mixed $value
     * @param bool $passes
     *
     * @dataProvider provideForNotAscii
     */
    public function testValicateNotAscii($value, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateNotAscii('attribute', $value)
        );
    }

    /**
     * `validateNotAscii()` のテストのためのデータプロバイダ
     *
     */
    public function provideForNotAscii()
    {
        return [
            [ 'foobar', false ],
            [ '123', false ],
            [ '*=-', false ],
            [ "foo\nbar", false ],
            [ 123, false ],
            [ "\n", true ],
            [ 'ｆｏｏｂａｒ', true ],
            [ "ｆｏｏ\nｂａｒ", true ],
            [ '１２３', true ],
            [ 'あいうえお', true ],
            [ '漢字', true ],
            [ '└─┬┐', true ],
            [ '', true ],
            [ null, true ],
        ];
    }

    /**
     * `validateStartsWith()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForStartsWith
     */
    public function testValidateStartsWith($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateStartsWith('attribute', $value, $parameters)
        );
    }

    /**
     * `validateStartsWith()` のテストのためのデータプロバイダ
     *
     */
    public function provideForStartsWith()
    {
        return [
            [ 'foobar', [ 'foo' ], true ],
            [ 'foobar', [ 'foo', 'bar' ], true ],
            [ 'foobar', [ 'baz' ], false ],
            [ 'foobar', [ 'foo', 'baz' ], true ],
            [ "foo\nbar", [ 'foo' ], true ],
            [ '', [ 'foo' ], false ],
            [ null, [ 'foo' ], false ],
        ];
    }

    /**
     * `validateNotStartsWith()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForNotStartsWith
     */
    public function testValidateNotStartsWith($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateNotStartsWith('attribute', $value, $parameters)
        );
    }

    /**
     * `validateNotStartsWith()` のテストのためのデータプロバイダ
     *
     */
    public function provideForNotStartsWith()
    {
        return [
            [ 'foobar', [ 'foo' ], false ],
            [ 'foobar', [ 'foo', 'bar' ], false ],
            [ 'foobar', [ 'baz' ], true ],
            [ 'foobar', [ 'foo', 'baz' ], false ],
            [ "foo\nbar", [ 'foo' ], false ],
            [ '', [ 'foo' ], true ],
            [ null, [ 'foo' ], true ],
        ];
    }

    /**
     * `validateEndsWith()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForEndsWith
     */
    public function testValidateEndsWith($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateEndsWith('attribute', $value, $parameters)
        );
    }

    /**
     * `validateEndsWith()` のテストのためのデータプロバイダ
     *
     */
    public function provideForEndsWith()
    {
        return [
            [ 'foobar', [ 'bar' ], true ],
            [ 'foobar', [ 'foo', 'bar' ], true ],
            [ 'foobar', [ 'baz' ], false ],
            [ 'foobar', [ 'foo', 'baz' ], false ],
            [ "foo\nbar", [ 'bar' ], true ],
            [ '', [ 'foo' ], false ],
            [ null, [ 'foo' ], false ],
        ];
    }

    /**
     * `validateNotEndsWith()` の正常系のテスト
     *
     * @param mixed $value
     * @param array $parameters
     * @param bool $passes
     *
     * @dataProvider provideForNotEndsWith
     */
    public function testValidateNotEndsWith($value, $parameters, $passes)
    {
        $this->assertEquals(
            $passes, $this->validator->validateNotEndsWith('attribute', $value, $parameters)
        );
    }

    /**
     * `validateNotEndsWith()` のテストのためのデータプロバイダ
     *
     */
    public function provideForNotEndsWith()
    {
        return [
            [ 'foobar', [ 'bar' ], false ],
            [ 'foobar', [ 'foo', 'bar' ], false ],
            [ 'foobar', [ 'baz' ], true ],
            [ 'foobar', [ 'foo', 'baz' ], true ],
            [ "foo\nbar", [ 'bar' ], false ],
            [ '', [ 'foo' ], true ],
            [ null, [ 'foo' ], true ],
        ];
    }
}
