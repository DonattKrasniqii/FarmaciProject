<?php namespace App\Repositories;

use App\Models\Drug;
use App\Models\Drug_Images;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DrugRepository
{
    public function getById($id)
    {
        return Drug::find($id);
    }

    public function getDrugs()
    {
        if (auth()->user()->is_admin) {
            return Drug::where('is_accepted', 1)->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            return Drug::where('user_id', auth()->user()->id)->where('is_accepted', 1)->orderBy('created_at', 'DESC')->paginate(10);
        }
    }

    public function getNotAcceptedDrugs()
    {
        if (auth()->user()->is_admin) {
            return Drug::where('is_accepted', 0)->orderBy('created_at', 'DESC')->paginate(10);
        }
    }

    public function changeStateOfDrug($id)
    {
        $drug = Drug::find($id);

        $drug->is_accepted = 1;

        return $drug->save();
    }

    public function getLatest10()
    {
        return Drug::latest()->take(10)->get();
    }

    public function getDrugsWithPagination(Request $request)
    {
        $drugs = Drug::join('users', 'drugs.user_id', '=', 'users.id')
            ->where('drugs.is_accepted', 1)
            ->select('drugs.*');

        if ($request->has('q')) {
            $drugs->where(function ($query) use ($request) {
                $query->where('drugs.is_accepted', 1);
                $query->where('drugs.name', 'like', '%' . $request->get('q') . '%');
                $query->orWhere('drugs.headline', 'like', '%' . $request->get('q') . '%');
                $query->orWhere('drugs.description', 'like', '%' . $request->get('q') . '%');
                $query->orWhere('users.name', 'like', '%' . $request->get('q') . '%');
            });
        }

        if ($request->has('category')) {
            $drugs->where(function ($query) use ($request) {
                $query->where('drugs.is_accepted', 1);
                $query->where('drugs.category_id', $request->get('category'));
            });
        }

        if ($request->has('searchQuery')) {
            $searchQuery = $request->get('searchQuery');
            if ($searchQuery == "Today") {
                $drugs->where(function ($query) use ($request) {
                    $query->whereDate('drugs.created_at', Carbon::today());
                });
            }
            if($searchQuery == 'lastSixHours'){
                $drugs->where(function ($query) use ($request) {
                    $query->where('drugs.created_at','>',Carbon::now()->subHour(6)->toDateString());
                });
            }

            if($searchQuery == 'LastWeek'){
                $drugs->where(function ($query){
                   $query->where('drugs.created_at','>',Carbon::now()->subDays(7)->toDateString());
                });
            }
            if($searchQuery == 'lastYear'){
                $drugs->where(function ($query){
                   $query->where('drugs.created_at','>',Carbon::now()->subYear(1)->toDateString());
                });
            }


            if ($searchQuery == 'byVisits') {
                \DB::statement("SET SQL_MODE=''");
                $drugs = Drug::select(DB::raw('drugs.*,count(*) as views'))
                    ->join('drug_seen', 'drugs.id', 'drug_seen.drug_id')
                    ->groupBy('drugs.id')->orderByRaw('views DESC');
            }

        }
        else{
            $drugs->orderBy('drugs.created_at', 'desc')
                ->orderBy('users.advertise_type', 'asc');
        }

        return $drugs->paginate(20);
    }

    public function store(Request $request)
    {
        return $this->update($request, new Drug());
    }

    public function update(Request $request, $drug)
    {
        if (!$drug instanceof Drug) {
            $drug = $this->getById($drug);
        }

        if(auth()->user()->is_admin){
            $drug->user_id = $request->input('store');
        }
        else{
            $drug->user_id = auth()->user()->id;
        }


        if(auth()->user()->isAdmin()){
            $drug->is_accepted = 1;
        }

        $drug->category_id = $request->input('category');
        $drug->name = $request->input('name');
        $drug->headline = $request->input('headline');
        $drug->description = $request->input('description');
        if (!is_null($request->input('price') && floatval($request->input('price')) > 0)) {
            $drug->price = floatval($request->input('price'));
        }
        $drug->save();
        if ($request->hasFile('main_photo')) {
            $this->deleteMainPhoto($drug->id);
            $main = $request->file('main_photo');
            $fileName = microtime() . '.' . $main->getClientOriginalExtension();
            $img = Image::make($main->getRealPath());
            $img->resize(400, 400);
            $img->stream();
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');

            $mainObj = new Drug_Images();
            $mainObj->drug_id = $drug->id;
            $mainObj->is_main = true;
            $mainObj->image = "/storage/images/" . $fileName;
            $mainObj->save();
        }

        if ($request->hasFile('other_photos')) {
            $this->deleteOtherPhotos($drug->id);
            foreach ($request->file('other_photos') as $image) {
                $fileName = microtime() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(345, 345);
                $img->stream();
                Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');

                $mainObj = new Drug_Images();
                $mainObj->drug_id = $drug->id;
                $mainObj->is_main = false;
                $mainObj->image = "/storage/images/" . $fileName;
                $mainObj->save();
            }
        }

        return true;
    }

    public function delete($id)
    {
        $drug = $this->getById($id);
        return $drug->delete();
    }

    private function deleteMainPhoto($id)
    {
        Drug_Images::where('drug_id', $id)->where('is_main', 1)->delete();
    }

    private function deleteOtherPhotos($id)
    {
        Drug_Images::where('drug_id', $id)->where('is_main', 0)->delete();
    }

    public function findRelatedDrugs(Drug $drug)
    {
        return Drug::join('users', 'drugs.user_id', '=', 'users.id')
            ->where('drugs.id', '<>', $drug->id)->where('drugs.name', 'like', '%' . $drug->name . '%')
            ->orWhere('drugs.id', '<>', $drug->id)->where('drugs.headline', 'like', '%' . $drug->name . '%')
            ->orWhere('drugs.id', '<>', $drug->id)->where('drugs.description', 'like', '%' . $drug->name . '%')
            ->orderBy('drugs.created_at', 'DESC')
            ->orderBy('users.advertise_type', 'asc')
            ->select('drugs.*')
            ->take(8)->get();
    }


    public function countStores()
    {
        return User::where('is_admin', 0)->count();
    }

    public function countDrugs()
    {
        return Drug::where('is_accepted',1)->count();
    }

    public function countTotal(){

        return Drug::where('is_accepted',1)->sum('price');
    }

    public function countNotAccepted(){

        return Drug::where('is_accepted',0)->count();
    }
}
