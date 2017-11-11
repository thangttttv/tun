<?php
namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property \App\Models\Poll $entity
 */
class PollPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields        = [];
}
