<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Exceptions\CustomException;

class AuthorController extends Controller
{
    // GET /api/authors -> Получить список авторов
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $authors = Author::paginate($perPage);
        return response()->json([
            'success' => true,
            'data' => AuthorResource::collection($authors),
            'message' => 'Data has been successfully output'
        ]);
    }

    // GET /api/authors/{id} -> Получить автора по id
    public function show($id)
    {
        $author = Author::find($id);
        if(!$author)
        {
            throw new CustomException("Author with the id {$id} was not found");
        }

        return response()->json([
            'success' => true,
            'data' => new AuthorResource($author),
            'message' => 'Data has been successfully output'
        ]);
    }

    //POST /api/authors -> Создание автора
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'] //Не должно быть пустым, Тип данных, Длина не больше 255
        ]);

        if (Author::where('name', $validated['name'])->exists()) {
            throw new CustomException('Author with that name already exists');
        }

        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'data' => new AuthorResource($author),
            'message' => 'Data saved successfully'
        ]);
    }

    // PUT /api/authors/{id} -> Обновление данных автора с определенным id
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'] //Не должно быть пустым, Тип данных, Длина не больше 255
        ]);
        if (Author::where('name', $validated['name'])->exists()) {
            throw new CustomException('Author with that name already exists');
        }

        $author = Author::find($id);
        if(!$author)
        {
            throw new CustomException("Author with the id {$id} was not found");
        }

        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'] //Проверка если переменная есть в поле ввода, Тип данных, Длина не больше 255
        ]);

        $author->update($request->all());

        return response()->json([
            'success' => true,
            'data' => new AuthorResource($author)->fresh(),
            'message' => 'The data has been updated successfully'
        ]);
    }

    //DELETE /api/authors/{id} -> Удаление автора с определенным id
    public function destroy($id)
    {
        $author = Author::find($id);
        if(!$author)
        {
            throw new CustomException("Author with the id {$id} was not found");
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data has been successfully deleted'
        ]);
    }
}
