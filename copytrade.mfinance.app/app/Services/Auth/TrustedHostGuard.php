<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class TrustedHostGuard implements Guard
{
  protected $request;
  protected $provider;
  protected $user;

  public function __construct(UserProvider $provider, Request $request)
  {
    $this->request = $request;
    $this->provider = $provider;
    $this->user = NULL;
  }

  /**
   * Determine if the current user is authenticated.
   *
   * @return bool
   */
  public function check()
  {
    return ! is_null($this->user());
  }

  /**
   * Determine if the current user is a guest.
   *
   * @return bool
   */
  public function guest()
  {
    return ! $this->check();
  }

  /**
   * Get the currently authenticated user.
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function user()
  {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $user = $this->provider->retrieveByCredentials(['host' => $this->request->getHost()]);

        return $this->user = $user;
  }

  /**
   * Get the ID for the currently authenticated user.
   *
   * @return string|null
  */
  public function id()
  {
    if ($user = $this->user()) {
      return $this->user()->getAuthIdentifier();
    }
  }

  /**
   * Validate a user's credentials.
   *
   * @return bool
   */
  public function validate(Array $credentials=[])
  {
    $user = $this->provider->retrieveByCredentials(['host' => $this->request->getHost()]);

    if (! is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
        $this->setUser($user);

        return true;
    } else {
        return false;
    }
  }

  /**
   * Set the current user.
   *
   * @param  Array $user User info
   * @return void
   */
  public function setUser(Authenticatable $user)
  {
    $this->user = $user;
    return $this;
  }
}