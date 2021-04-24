<?php


namespace Services\User\Response;

use Facade\FlareClient\Http\Exceptions\NotFound;

/**
 * @OA\Schema(
 *      title="ReqUser",
 *      description="ReqUser",
 *      type="object"
 * )
 */
class ReqUser
{
    /**
     * @OA\Property(
     *      title="mobile",
     *      description="mobile",
     *      example="98932369461"
     * )
     *
     * @var string
     */
    public $mobile;
    /**
     * @OA\Property(
     *      title="name",
     *      description="name"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="country",
     *      description="country",
     *      example="iran"
     * )
     *
     * @var string
     */
    public $country;

    /**
     * @OA\Property(
     *      title="fee",
     *      description="fee",
     *      example=""
     * )
     *
     * @var integer
     */
    public $fee;
    /**
     * @OA\Property(
     *      title="username",
     *      description="username"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="avatar",
     *      description="avatar",
     *      type="file",
     *      format="binary"
     * )
     */
    public $avatar;
    /**
     * @OA\Property(
     *      title="email",
     *      description="email",
     *      example="email@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="private",
     *      description="private",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $private;
    /**
     * @OA\Property(
     *      title="latitude",
     *      description="latitude",
     *      example="23.126548"
     * )
     *
     * @var string
     */
    public $latitude;
    /**
     * @OA\Property(
     *      title="longitude",
     *      description="longitude",
     *      example="54.258455"
     * )
     *
     * @var string
     */
    public $longitude;

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function setFee($fee)
    {
        $this->fee = $fee;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }


    public function setAvatar($avatar)
    {
        $this->avatar = $avatar->file('avatar')->store(uploadPath('profile'));
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    public function setPrivate($private)
    {
        $this->private = (($private === "true") or ($private === true) or ($private === 1) or ($private === "1")) ? 1 : 0;
        return $this;
    }


    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }


    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function toArray()
    {
        return [
            "longitude" => $this->longitude ?? auth()->user()->longitude,
            "latitude" => $this->latitude ?? auth()->user()->latitude,
            "private" => $this->private ?? auth()->user()->private,
            "email" => $this->email ?? auth()->user()->email,
            "avatar" => $this->avatar ?? auth()->user()->avatar,
            "username" => $this->username ?? auth()->user()->username,
            "fee" => $this->fee ?? auth()->user()->fee,
            "name" => $this->name ?? auth()->user()->name,
        ];
    }

}

