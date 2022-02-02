<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotification;
use App\Mail\WelcomeMail;

use App\Repositories\BlogRepository;
use App\Repositories\DrugRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    private $blogRepository;
    private $drugRepository;

    public function __construct(BlogRepository $blogRepository,DrugRepository $drugRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->drugRepository = $drugRepository;
    }

    public function getBlogs()
    {
        return view('templates.web.blog.index',['blogs'=>$this->blogRepository->getFeaturedBlogs()]);
    }

    public function viewBlog($id){
        $blog = $this->blogRepository->getById($id);

        if (!is_null($blog)) {
            return view('templates.web.blog.view',['blog'=>$blog,'drugs'=>$this->drugRepository->getLatest10()]);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photto' => 'required',
            'description' => 'required',
        ]);

        if ($this->blogRepository->store($request)) {
            session()->flash('success', 'Blogu është regjistruar!');
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'photto' => 'required',
            'description' => 'required',
        ]);

        $blog = $this->blogRepository->getById($request->input('id'));
        if (!is_null($blog)) {
            if ($this->blogRepository->update($request, $blog)) {
                session()->flash('success', 'Blogu është përditsuar!');
                return redirect()->action([DashboardController::class, 'index']);
            } else {
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function featuredState($id,$type){

        if($this->blogRepository->changeActiveState($id)){
            session()->flash('success','Blogu është bërë '. $this->getAdvertiseTypeName($type));
            return redirect()->action([DashboardController::class, 'index']);
        }else{
            return redirect()->back()->with('error','Gabim ne procesim !');
        }
    }

    private function getAdvertiseTypeName($type){
        switch ($type){
            case 0:
                return "Jo Aktiv";
                break;
            case 1:
                return "Aktiv";
                break;
        }
    }
}
