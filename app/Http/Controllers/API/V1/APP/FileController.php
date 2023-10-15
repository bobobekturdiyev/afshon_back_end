<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\APP\FileResource;
use App\Models\File;
use App\Models\FileJoinSubject;
use Illuminate\Http\Request;
/**
 * @OA\Schema(
 *     schema="File",
 *     title="File title",
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="title", type="string"),
 *         )
 *     ),
 * )
 */
class FileController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/app/file-by-subject/{subject_id}",
     *      operationId="file_index",
     *      description="Get file with subject ID",
     *      tags={"File"},
     *      @OA\Parameter(
     *          name="subject_id",
     *          in="path",
     *          required=true,
     *          description="ID of subject",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/File"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function index($subject_id)
    {
        $subjects = FileJoinSubject::select('files.*')->
        join('files', 'files.id', 'file_join_subjects.file_id')->
        where('file_join_subjects.subject_id', $subject_id)->
        get();

        return response()->json(FileResource::collection($subjects));

    }

    /**
     * @OA\Get(
     *      path="/api/app/file-by-keyword/{keyword}",
     *      operationId="file_show",
     *      description="Get file with keyword",
     *      tags={"File"},
     *      @OA\RequestBody(required=true,
     *          @OA\MediaType(mediaType="application/json",
     *          @OA\Schema(type="object",
     *                  required={"text"},
     *              @OA\Property(property="text", type="integer", format="number", example="1"),
     *          )
     *      )
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/File"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function show($keyword)
    {
        $keyword = strtolower($keyword);
        $model = File::where('keywords', 'LIKE', "%$keyword%")->get();

        return response()->json(FileResource::collection($model));
    }

    /**
     * @OA\Post(
     *      path="/api/app/file-search/",
     *      operationId="file_search",
     *      description="Search File",
     *      tags={"File"},
     *      @OA\Parameter(
     *          name="text",
     *          in="path",
     *          required=true,
     *          description="text",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/File"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function search(Request $request)
    {
        $text = explode(' ', $request->text);
        $model = File::where(function ($query) use ($text) {
            foreach ($text as $term) {
                $query->orWhere(function ($subQuery) use ($term) {
                    $subQuery->where('name_uz', 'LIKE', "%{$term}%")->
                         orWhere('name_ru', 'like', "%$term%")->
                         orWhere('name_en', 'like', "%$term%")->
                         orWhere('excerpt_uz', 'like', "%$term%")->
                         orWhere('excerpt_ru', 'like', "%$term%")->
                         orWhere('excerpt_en', 'like', "%$term%")->
                         orWhere('keywords', 'like', "%$term%")->
                         orWhere('image', 'like', "%$term%");
                });
            }
        })->
        paginate(10);
        return response()->json(FileResource::collection($model));
    }
}
