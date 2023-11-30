<?php

namespace App\Model;

use DateTimeImmutable;

class SearchData
{
  /**
   * @var null|integer
   */
  public $minPrice;

  /**
   * @var null|integer
   */
  public $maxPrice;

  /**
   * @var null|integer
   */
  public $minKm;

  /**
   * @var null|integer
   */
  public $maxKm;

  /**
   * @var null|?DateTimeImmutable
   */
  public $minYear;

  /**
   * @var null|?DateTimeImmutable
   */
  public $maxYear;
}
