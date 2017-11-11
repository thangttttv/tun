<?php
namespace App\Repositories\Eloquent;

use App\Models\OauthClient;
use App\Repositories\OauthClientRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class OauthClientRepository extends SingleKeyModelRepository implements OauthClientRepositoryInterface
{
    public function getBlankModel()
    {
        return new OauthClient();
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
