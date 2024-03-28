<?php

namespace App\Helpers;

class PaginationHelper
{
  /**
   * Create a formatted array containing pagination information.
   *
   * @param \Illuminate\Pagination\LengthAwarePaginator $paginate
   *
   * @return array
   */
  public static function createPagination($paginate)
  {
    $paginate = $paginate->toArray();

    return [
      'current_page' => $paginate['current_page'],
      'first_page_url' => $paginate['first_page_url'],
      'from' => $paginate['from'],
      'last_page' => $paginate['last_page'],
      'last_page_url' => $paginate['last_page_url'],
      'links' => $paginate['links'],
      'next_page_url' => $paginate['next_page_url'],
      'per_page' => $paginate['per_page'],
      'prev_page_url' => $paginate['prev_page_url'],
      'to' => $paginate['to'],
      'total' => $paginate['total'],
    ];
  }
}
