<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DBHelper
{
  public static function resetAutoIncrement($tableName)
  {
    DB::statement("SET @count = 0;");
    DB::statement("UPDATE `$tableName` SET `$tableName`.`id` = @count:= @count + 1;");
    DB::statement("ALTER TABLE `$tableName` AUTO_INCREMENT = 1;");
  }
}
