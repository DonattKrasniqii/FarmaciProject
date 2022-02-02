<?php namespace App\Repositories;

use App\Models\Blog;
use Cassandra\Blob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogRepository
{
    public function getById($id)
    {


        $blog = new Blog();
        $response = Http::get('http://127.0.0.1:100/api/blog/'.$id);


        $list = $response->json();
        $blog->id = $list['id'] ;
        $blog->name = $list['name'];
        $blog->image_path = $list['image_path'];
        $blog->description = $list['description'];
        $blog->created_at = $list['created_at'];
        $blog->updated_at = $list['updated_at'];
        $blog->is_featured = $list['is_featured'];



        return $blog;


    }

    public function getBlogs()
    {


        $response = Http::get('http://127.0.0.1:100/api/allBlogs');

        $arrayOfObjects = $response->json();


        $blogs = [];

        for($i=0;$i<count($arrayOfObjects);$i++){
            $blog = new Blog();
            $blog->id = $arrayOfObjects[$i]['id'];
            $blog->name = $arrayOfObjects[$i]['name'];
            $blog->description = $arrayOfObjects[$i]['description'];
            $blog->image_path = $arrayOfObjects[$i]['image_path'];
            $blog->created_at = $arrayOfObjects[$i]['created_at'];
            $blog->updated_at = $arrayOfObjects[$i]['updated_at'];
            $blog->is_featured = $arrayOfObjects[$i]['is_featured'];

            $blogs [] = $blog;
        }

        return $blogs;
    }

    public function getFeaturedBlogs()
    {

        $response = Http::get('http://127.0.0.1:100/api/featuredBlogs');

        $arrayOfObjects = $response->json();

        $blogs = [];

        for($i=0;$i<count($arrayOfObjects);$i++){
            $blog = new Blog();
            $blog->id = $arrayOfObjects[$i]['id'];
            $blog->name = $arrayOfObjects[$i]['name'];
            $blog->description = $arrayOfObjects[$i]['description'];
            $blog->image_path = $arrayOfObjects[$i]['image_path'];
            $blog->created_at = $arrayOfObjects[$i]['created_at'];
            $blog->updated_at = $arrayOfObjects[$i]['updated_at'];
            $blog->is_featured = $arrayOfObjects[$i]['is_featured'];

            $blogs [] = $blog;
        }

        return $blogs;
    }

    public function store(Request $request)
    {
        return $this->update($request, new Blog());
    }

    public function update(Request $request, $blog)
    {
        if (!$blog instanceof Blog) {
            $blog = $this->getById($blog);
        }
        $respone = '';
        if($request->hasFile('photto')){
            $image = $request->file('photto');

           $respone =  Http::attach('attachment',file_get_contents($image),'image.jpg')
                ->post('http://127.0.0.1:100/api/saveBlog',$request->all());
        }else{
            Http::post('http://127.0.0.1:100/api/saveBlog',$request->all());
        }


        return $respone->successful();
    }

    public function changeActiveState($id){

         $response = Http::post("http://127.0.0.1:100/api/changeState/".$id);

         return $response->successful();
    }


}
