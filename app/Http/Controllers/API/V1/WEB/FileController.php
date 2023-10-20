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
     *      path="/api/web/file/{filename}",
     *      operationId="get_file_web",
     *      description="Get File",
     *      tags={"File Web"},
     *      @OA\Parameter(
     *          name="filename",
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
    public function getFiles($filename)
    {
        $filePath = public_path('uploads/files/' . $filename);

        if ($filePath) {
            return response()->file($filePath);
        }
        else
        {
            return response()->json(['errors' => ['Not found']], 404);
        }
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
     * @OA\Post(
     *     path="/api/web/search/{text}",
     *     operationId="file_search_web",
     *     tags={"File Web"},
     *     description="Search File",
     *     @OA\Parameter(
     *          name="text",
     *          in="path",
     *          required=true,
     *          description="text",
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/File")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function search(Request $request)
    {
        $text = explode(' ', $request->text);
        $model = File::where(function ($query) use ($text) {
            foreach ($text as $term) {
                $query->orWhere(function ($subQuery) use ($term) {
                    $subQuery->where('keywords', 'LIKE', "$term %")->
                    orWhere('keywords', 'like', "% $term %")->
                    orWhere('keywords', 'like', "% $term")->
                    orWhere('keywords', 'like', "$term");
                });
            }
        })->
        paginate(10);
        return response()->json(FileResource::collection($model));
    }
}
