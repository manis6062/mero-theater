<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageCategoryModel extends Model
{
    protected $table = 'category_tbl';
    protected $guarded = ['id'];
}
