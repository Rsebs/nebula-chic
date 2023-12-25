<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
  /**
   * Delete a file from the storage.
   *
   * This method allows you to delete a file from the storage by providing
   * the path to the file. It transforms the path from the "storage" to the "public"
   * directory before attempting to delete the file. If the file does not exist,
   * it throws an exception with a message indicating that the path was not found.
   *
   * @param string $path Example: /storage/images/example.jpg
   *
   * @throws \Exception When the specified file path is not found.
   *
   * @return void
   */
  public static function deleteFileStorage($path)
  {
    $path = str_replace("storage", "public", $path);

    if (Storage::exists($path)) {
      Storage::delete($path);
    } else {
      return throw new Exception("Path not found: $path");
    }
  }
}
