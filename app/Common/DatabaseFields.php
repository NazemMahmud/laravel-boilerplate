<?php


namespace App\Common;

use Illuminate\Support\Facades\Auth;

class DatabaseFields
{

    protected static $commonFields = ['created_by', 'updated_by'];

    /*public static function MakeCommonField($table)
    {
        $table->bigInteger('created_by');
        $table->bigInteger('updated_by');
        $table->bigInteger('deleted_by')->nullable();
        $table->softDeletes('deleted_at')->nullable();
        $table->timestamps();
    }*/

    public static function ActiveField($table){
        $table->tinyInteger('is_active')->default(1);
    }

    public static function AddCommonField($table)
    {
        $table->bigInteger('created_by')->unsigned();
        $table->bigInteger('updated_by')->unsigned()->nullable();
        $table->bigInteger('deleted_by')->unsigned()->nullable();
        $table->softDeletes()->nullable();
    }

    /*public static function createCommonFields($fields, $resource): array
    {
        $user_id = isset(Auth::user()->id) ? Auth::user()->id : 1;
        foreach ($fields as $key => $field) {
            if (in_array($field, self::$commonFields)) {
                unset($fields[$key]);
                $resource->$field = $user_id;
            }
        }
        $resource->company_id = Auth::user()->company_id;

        return [
            'fields' => $fields,
            'resource' => $resource
        ];
    }*/
}
