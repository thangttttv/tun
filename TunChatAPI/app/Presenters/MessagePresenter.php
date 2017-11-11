<?php
namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property \App\Models\Message $entity
 */
class MessagePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields        = [];
}
