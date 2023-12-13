<?php

namespace App;

class Line
{

  public function __construct(
    public int $id,
    public string $timestamp,
    public string $body
  ) {
  }
}