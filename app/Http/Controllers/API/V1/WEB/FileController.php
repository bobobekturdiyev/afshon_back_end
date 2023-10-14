<?php

namespace App\Http\Controllers\API\V1\WEB;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\WEB\FileResource;
use App\Models\File;
use App\Models\FileJoinSubject;
use Illuminate\Http\Request;
/**
 * @OA\Schema(
 *     schema="File Web",
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
     *      path="/api/web/file-by-subject/{subject_id}",
     *      operationId="file_index_web",
     *      description="Get file with subject ID",
     *      tags={"File Web"},
     *      @OA\Parameter(
     *          name="subject_id",
     *          in="path",
     *          required=true,
     *          description="ID of subject",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/File Web"),
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

        return FileResource::collection($subjects);

    }

    /**
     * @OA\Get(
     *      path="/api/web/file-by-keyword/{keyword}",
     *      operationId="file_show_web",
     *      description="Get file by keyword",
     *      tags={"File Web"},
     *      @OA\Parameter(
     *          name="keyword",
     *          in="path",
     *          required=true,
     *          description="Keyword of subject",
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
    public function show($keyword)
    {
        $keyword = strtolower($keyword);
        $model = File::where('keywords', 'LIKE', "%$keyword%")->get();

        return FileResource::collection($model);
    }

    /**
     * @OA\Get(
     *      path="/api/web/search/{text}",
     *      operationId="file_search_web",
     *      description="Search File",
     *      tags={"File Web"},
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
    public function search($text)
    {
        $model = File::where(function ($query) use ($text) {
            $query->where('name_uz', 'like', "%$text%")->
            orWhere('name_ru', 'like', "%$text%")->
            orWhere('name_en', 'like', "%$text%")->
            orWhere('excerpt_uz', 'like', "%$text%")->
            orWhere('excerpt_ru', 'like', "%$text%")->
            orWhere('excerpt_en', 'like', "%$text%")->
            orWhere('keywords', 'like', "%$text%")->
            orWhere('image', 'like', "%$text%");
        })->paginate(10);
        return FileResource::collection($model);
    }
}