<?php

namespace App;

use App\Line;

class TimeCode
{
  public function __construct(protected array $lines)
  {
    $this->lines = $this->discardInvalidChar(array_map('trim', $lines));
  }
  static function load(string $path): self
  {
    $line = file($path);

    return new static($line);
  }

  public function toObjArray(): array
  {
    return array_map(
      fn($line) => new Line((int) $line[0], $line[1], $line[2]),
      array_chunk($this->lines, 3)
    );
  }

  public function __toString(): string
  {
    return implode("\n", $this->lines);
  }

  protected function discardInvalidChar(array $lines): array
  {
    return array_values(
      array_filter($lines)
    );
  }

  protected function linesToAnchors(array $lines): array
  {
    return array_map(function (Line $line) {
      $timestamp = trim(explode("-->", $line->timestamp)[0]);
      return "{$line->id} . <a href='{$timestamp}'>{$line->body}</a>";
    }, $lines);
  }

  public function asHtml(): string
  {
    return implode("\n", $this->linesToAnchors($this->toObjArray()));
  }

}