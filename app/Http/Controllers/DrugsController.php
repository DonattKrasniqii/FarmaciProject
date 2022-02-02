<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Repositories\CategoryRepository;
use App\Repositories\DrugRepository;
use App\Repositories\DrugSeenRepository;
use App\Repositories\UserRepository;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DrugsController extends Controller
{
    private $drugRepository;
    private $drugSeenRepository;
    private $categoryRepository;
    private $userRepository;

    public function __construct(DrugRepository $drugRepository,DrugSeenRepository $drugSeenRepository,CategoryRepository $categoryRepository,UserRepository $userRepository)
    {
        $this->drugRepository = $drugRepository;
        $this->drugSeenRepository=$drugSeenRepository;
        $this->categoryRepository=$categoryRepository;
        $this->userRepository=$userRepository;
    }
    public function viewDrug($id){
        $drug = $this->drugRepository->getById($id);
        if(!is_null($drug) && $drug->isAccepted()){
            $this->drugSeenRepository->addVisit($drug->id);
            return view('templates.web.drugs.index',['drug'=>$drug,'related'=>$this->drugRepository->findRelatedDrugs($drug)]);
        }
        else{
            return redirect()->action([HomeController::class, 'index']);
        }
    }
    public function addDrugView()
    {
        if(auth()->user()->is_admin) {
            return view('templates.web-dashboard.drugs.add', ['categories' => $this->categoryRepository->getAll(), 'stores' => $this->userRepository->getAll()]);
        }
        return view('templates.web-dashboard.drugs.add', ['categories' => $this->categoryRepository->getAll(), 'stores' => null]);
    }

    public function editDrugView($id)
    {
        if(auth()->user()->is_admin) {
            return view('templates.web-dashboard.drugs.edit', ['drug' => $this->drugRepository->getById($id),'categories'=>$this->categoryRepository->getAll(),'stores'=>$this->userRepository->getAll()]);
        }
        return view('templates.web-dashboard.drugs.edit', ['drug' => $this->drugRepository->getById($id),'categories'=>$this->categoryRepository->getAll(),'stores'=>null]);
    }

    public function saveDrug(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'headline'=>'required',
            'main_photo' => 'required'
        ]);


        if ($this->drugRepository->store($request)) {
            if(auth()->user()->isAdmin()){
                session()->flash('success', 'Medikamenti është regjistruar');
            }else {
                session()->flash('success', 'Medikamenti është regjistruar , ju lutem prisni aprovimin e një administratori!');
            }
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function updateDrug(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'category' => 'required',
            'headline'=>'required',
            'name' => 'required',
        ]);
        $drug = $this->drugRepository->getById($request->input('id'));
        if (!is_null($drug) && $drug->user_id == auth()->user()->id || auth()->user()->is_admin) {
            if ($this->drugRepository->update($request, $drug)) {
                session()->flash('success', 'Medikamenti është përditesuar!');
                return redirect()->action([DashboardController::class, 'index']);
            } else {
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function deleteDrug($id)
    {
        $drug = $this->drugRepository->getById($id);
        if (!is_null($drug)) {
            if ($drug->user_id == auth()->user()->id) {
                if ($this->drugRepository->delete($id)) {
                    $msg = 'Medikamenti u fshi me sukses , oops , <a href="'. action('DrugsController@restore',$drug->id) . '"> <strong>kliko këtu </strong></a>  për të rikthyer medikamentin';
                    session()->flash('warning', $msg);
                    return redirect()->action([DashboardController::class, 'index']);
                }
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
            $msg = 'Nuk jeni i autorizuar të fshini këtë medikament , medikamenti i takon barnatores <a href="'. action('UserController@viewStore',$drug->drugStore->id) . '">'. '<strong>' . $drug->drugStore->name . '</strong>' . '</a>';
            return redirect()->back()->with('error', $msg);
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function dontAcceptDrug($id)
    {
        $drug = $this->drugRepository->getById($id);
        if (!is_null($drug)) {
            if (auth()->user()->isAdmin()) {
                if ($this->drugRepository->delete($id)) {
                    $msg = 'Nuk u pranua , oops , <a href="'. action('DrugsController@restore',$drug->id) . '"> kliko këtu </a>  për të rikthyer medikamentin';
                    session()->flash('success', $msg);
                    return redirect()->action([DashboardController::class, 'index']);
                }
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
            return redirect()->back()->with('error', 'Gabim në procesim !');
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function acceptDrug($id){

        if(auth()->user()->is_admin){
        $drug = $this->drugRepository->getById($id);
             if(!is_null($drug)) {
                 if ($this->drugRepository->changeStateOfDrug($id)) {
                     session()->flash('success', 'Medikamenti është pranuar me sukses');
                     return redirect()->action([DashboardController::class, 'index']);
                 }
             }
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
        return redirect()->back()->with('error', 'Gabim në procesim !');
    }

    public function restore($id){

        $drug = Drug::withTrashed()->find($id);
        if(auth()->user()->isAdmin()) {
            if ($drug && $drug->trashed()) {
                $drug->restore();
            }
            session()->flash('success', 'Medikamenti eshte rikthyer me sukses :)');
            return redirect()->action([DashboardController::class, 'index']);
        }else{
            session()->flash('error', 'Ndodhi nje gabim :)');
            return redirect()->action([DashboardController::class, 'index']);
        }

    }
}
