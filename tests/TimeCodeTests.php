<?php

namespace Tests;

use App\Line;
use App\TimeCode;


class TimeCodeTests extends \PHPUnit\Framework\TestCase
{
  protected TimeCode $timeCode;
  public function setUp(): void
  {
    $this->timeCode = TimeCode::load(__DIR__ . '/../sample.vvt');

  }

  public function test_wholeString()
  {
    $this->assertIsString($this->timeCode->__toString());
  }


  public function test_array_objects()
  {
    $this->assertContainsOnlyInstancesOf(Line::class, $this->timeCode->toObjArray());
  }

  public function test_asHtml()
  {
    var_dump($this->timeCode->asHtml());
    $this->assertIsString($this->timeCode->asHtml());
  }
}