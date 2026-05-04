<?php

namespace Modules\AuthManagement\Actions;

use Modules\AuthManagement\DTOs\Login\LoginData;
use Modules\AuthManagement\Repositories\LoginRepository;

class LoginAction{
    public function __construct(
        protected LoginRepository $repo
    ) {}

    /**
     * Execute the login action.
     * @param LoginData $data
     */
    public function execute(LoginData $data)
    {
        return $this->repo->login($data);
    }
}