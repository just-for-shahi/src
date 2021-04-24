<?php


namespace Services\Post\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Services\Category\Repositories\ICategoryRepository;
use Services\Post\Repositories\IPostRepository;
use Services\Post\Requests\PostRequests;
use Services\Tag\Repositories\ITagRepository;

class WebController extends Controller
{
    private $repository;
    /**
     * @var ICategoryRepository
     */
    private $categories;
    /**
     * @var ITagRepository
     */
    private $tags;

    public function __construct(IPostRepository $repository , ICategoryRepository $categories , ITagRepository $tags)
    {
        $this->repository = $repository;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function index()
    {
        try {
            $weblogs = $this->repository->paginate();
            return view('views::post', compact('weblogs'));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function create()
    {
        try {
            $categories = $this->categories->all();
//            $tags = $this->tags->all();
            return view('views::create' , compact('categories'));
        } catch (Exception $e) {
            return view('error');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:194',
            'categories' => 'sometimes|nullable|array',
            'abstract' => 'required|string',
            'description' => 'required|string',
            'cover' => 'required|image|max:5000'
        ]);
        $this->repository->store($request);
        return redirect(route('post.index'));
    }

//    public function show($uuid)
//    {
//        try {
//            return Ok($this->repository->show($uuid));
//        } catch (\Exception $exp) {
//            return view('error');
//        }
//    }

    public function edit($uuid)
    {
        try {
            $weblog = $this->repository->db()->with(['categories'])->findUUID($uuid);
            $categories = $this->categories->all();
            return view('views::edit', compact('weblog','categories'));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function update(Request $request , $uuid)
    {
        $request->validate([
            'title' => 'sometimes|nullable|string|max:194',
            'categories' => 'sometimes|nullable|array',
            'abstract' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'cover' => 'sometimes|nullable|image|max:5000'
        ]);
        $weblog = $this->repository->db()->with(['categories'])->findUUID($uuid);
        $this->repository->updateAll($request , $weblog);
        return redirect(route('post.index'));
    }

    public function destroy($uuid)
    {
        try {
            $weblog = $this->repository->db()->with(['categories'])->findUUID($uuid);
            $this->repository->destroyAll($weblog);
            return redirect(route('post.index'));
        } catch (Exception $e) {
            return view('error');
        }
    }
}
