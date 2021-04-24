<?php


namespace Services\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\User\Repositories\IUserRepository;

class ProfileController extends Controller
{
    /**
     * @var IUserRepository
     */
    private $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $user = auth('web')->user();
            return view('profile' , compact('user'));
        } catch (\Exception $e) {
            return view('error');
        }
    }

    public function update(Request $request)
    {
//        try {
        $request->validate([
            'name' => 'sometimes|nullable|string',
            'username' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|string',
            'mobile' => 'sometimes|nullable|string',
            'new_password' => 'sometimes|nullable|string',
            'avatar' => 'sometimes|nullable|image|max:5000'
        ]);

        $this->repository->updateProfile($request);
        return redirect(route('dashboard'));

//        } catch (\Exception $e) {
//            return view('error');
//        }
    }
}
