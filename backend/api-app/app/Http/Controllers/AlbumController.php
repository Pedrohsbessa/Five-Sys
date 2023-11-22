<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return Album::all();
    }

    public function show($id)
    {
        $album = Album::find($id);

        if (!$album) {
            return response()->json(['error' => 'Álbum não encontrado'], 404);
        }

        return $album;
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ];

            $messages = [
                'title.required' => 'O campo título é obrigatório.',
                'title.max' => 'O campo título não pode ter mais de :max caracteres.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $album = Album::create($validatedData);

            return $album;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ];

            $messages = [
                'title.required' => 'O campo título é obrigatório.',
                'title.max' => 'O campo título não pode ter mais de :max caracteres.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $album = Album::find($id);

            if (!$album) {
                return response()->json(['error' => 'Álbum não encontrado'], 404);
            }

            $album->update($validatedData);

            return $album;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $album = Album::find($id);

            if (!$album) {
                return response()->json(['error' => 'Álbum não encontrado'], 404);
            }

            $album->delete();

            return response()->json(['message' => 'Álbum excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storePhoto(Request $request, $albumId)
    {
        try {
            $album = Album::find($albumId);

            if (!$album) {
                return response()->json(['error' => 'Álbum não encontrado'], 404);
            }

            $rules = [
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $messages = [
                'title.required' => 'O campo título é obrigatório.',
                'title.max' => 'O campo título não pode ter mais de :max caracteres.',
                'image.required' => 'É necessário fornecer uma imagem.',
                'image.image' => 'O arquivo deve ser uma imagem.',
                'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif ou svg.',
                'image.max' => 'A imagem não pode ter mais de :max kilobytes.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $image = $request->file('image');
            $imagePath = $image->store('photos', 'public');

            $photo = new Photo([
                'title' => $validatedData['title'],
                'album_id' => $album->id,
                'image_path' => $imagePath,
            ]);

            $photo->save();

            return $photo;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroyPhoto($albumId, $photoId)
    {
        try {
            $album = Album::find($albumId);

            if (!$album) {
                return response()->json(['error' => 'Álbum não encontrado'], 404);
            }

            $photo = Photo::where('album_id', $albumId)->find($photoId);

            if (!$photo) {
                return response()->json(['error' => 'Foto não encontrada'], 404);
            }

            $photo->delete();

            return response()->json(['message' => 'Foto excluída com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showPhotos($id)
    {
        try {
            $album = Album::with('photos')->find($id);

            if (!$album) {
                return response()->json(['error' => 'Álbum não encontrado'], 404);
            }

            return $album->photos;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
