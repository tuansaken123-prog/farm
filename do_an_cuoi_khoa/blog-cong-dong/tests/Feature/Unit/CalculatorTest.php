<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function test_basic_math()
    {
        $this->assertEquals(4, 2 + 2);
    }

    public function test_string_slug_conversion()
    {
        $title = "Học Laravel 11 Cùng MyBlog";
        $slug = \Illuminate\Support\Str::slug($title);
        
        $this->assertEquals('hoc-laravel-11-cung-myblog', $slug);
    }
}