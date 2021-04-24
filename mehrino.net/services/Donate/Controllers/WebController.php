<?php


namespace Services\Donate\Controllers;


use Illuminate\Http\Request;
use Services\Donate\Repositories\IDonateRepository;

class WebController
{

    /**
     * @var IDonateRepository
     */
    private $repository;

    public function __construct(IDonateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(){
        try{
            return view('views::show');
        }catch (\Exception $e){
            return abort(500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'valueSelect' => 'required_without:customPrice',
            'customPrice' => 'required_without:valueSelect',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        return redirect($this->repository->storeDonate($request));
    }

}
