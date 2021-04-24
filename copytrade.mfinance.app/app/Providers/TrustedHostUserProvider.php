<?php

namespace App\Providers;
 
use App\User;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
 
class TrustedHostUserProvider implements UserProvider
{
  /**
   * The User Model
   */
  private $model;
 
  /**
   * Create a new user provider.
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   * @return void
   */
  public function __construct(User $model)
  {
    $this->model = $model;
  }
 
  /**
   * Retrieve a user by the given credentials.
   *
   * @param  array  $credentials
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByCredentials(array $credentials)
  {
        if (empty($credentials)) {
            return;
        } 

        $user = $this->model->whereJsonContains('trusted_hosts', $credentials['host'])->first();
 
        return $user;
  }
  
  /**
   * Validate a user against the given credentials.
   *
   * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
   * @param  array  $credentials  Request credentials
   * @return bool
   */
  public function validateCredentials(Authenticatable $user, Array $credentials)
  {

        return true;
  }
 
  public function retrieveById($identifier) {}
 
  public function retrieveByToken($identifier, $token) {}
 
  public function updateRememberToken(Authenticatable $user, $token) {}
}