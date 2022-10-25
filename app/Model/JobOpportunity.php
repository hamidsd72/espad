<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobOpportunity extends Model
{
    protected $table = 'job_opportunities';

    protected $fillable = [
        "title",
        "sub_cat_id",
        "history",
        "education",
        "type",
        "amount",
        "address",
        "description",
        "attach",
    ];
}
