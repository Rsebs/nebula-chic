<?php

namespace App\Helpers;

class PaginationHelper
{
  /**
   * Create a formatted array containing pagination information.
   *
   * @param \Illuminate\Pagination\LengthAwarePaginator $oPaginate
   *
   * @return array
   */
  public static function createPagination($oPaginate)
  {
    $aPaginate = $oPaginate->toArray();

    return [
      'current_page' => $aPaginate['current_page'],
      'first_page_url' => $aPaginate['first_page_url'],
      'from' => $aPaginate['from'],
      'last_page' => $aPaginate['last_page'],
      'last_page_url' => $aPaginate['last_page_url'],
      'links' => $aPaginate['links'],
      'next_page_url' => $aPaginate['next_page_url'],
      'per_page' => $aPaginate['per_page'],
      'prev_page_url' => $aPaginate['prev_page_url'],
      'to' => $aPaginate['to'],
      'total' => $aPaginate['total'],
    ];
  }
}
