<?php


namespace App\Common;

class DatabaseFields
{

    public static function ActiveField($table){
        $table->tinyInteger('is_active')->default(1);
    }

    public static function AddCommonField($table)
    {
        $table->bigInteger('created_by')->unsigned()->nullable();
        $table->bigInteger('updated_by')->unsigned()->nullable();
        $table->bigInteger('deleted_by')->unsigned()->nullable();
        $table->softDeletes()->nullable();
    }
}
