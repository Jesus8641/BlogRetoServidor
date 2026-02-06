<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        $data = ['status'=>'Ok', 'data'=>$posts];

        return response()->json($data, 200);
    }

    public function show(string $id)
    {
        $post = Post::find($id);

        if($post != null){

            $data = ['status'=>'Ok', 'data'=>$post];
            $codigo = 200;
        }else{
            $data = ['status'=>'No ok', 'data'=>'Post no encontrado'];
            $codigo = 404;
        }

        return response()->json($data, $codigo);
    }

    public function edit(Request $request ,$id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'autor' => 'required|string'
        ]);

        if ($validator->fails()) {

            $data = ['status'=>'No ok', 'data'=>$validator->errors()];
            $codigo = 422;
            
            return response()->json($data, $codigo);
        }

        $post = Post::find($id);

        if (!$post) {

            $data = ['status'=>'No ok', 'data'=>'Post no encontrado'];
            $codigo = 404;
            
            return response()->json($data, $codigo);
        }

        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->autor = $request->autor;
        $post->save();

        $data = ['status'=>'Ok', 'data'=>$post];
        $codigo = 200;

        
        return response()->json($data, $codigo);
    }

    
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if($post != null) {

            $data = ['status'=>'Ok', 'data'=>$post];

            $post->delete();

            $codigo = 200;

        }
        else {

            $data = ['status'=>'No ok', 'data'=>'Post no encontrado'];
            $codigo = 404;

            
        }
        return response()->json($data, $codigo);
    }
}
