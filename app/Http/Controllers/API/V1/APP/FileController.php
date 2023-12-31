<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\APP\FileResource;
use App\Models\File;
use App\Models\FileJoinSubject;
use App\Models\ViewFile;
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
     *     path="/api/app/file-search",
     *     operationId="file_search",
     *     tags={"File"},
     *     description="Search File",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(required={"text"},
     *             @OA\Property(property="text", type="string",)
     *         )
     *     ),
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
                         orWhere('keywords', 'like', "% $term")->
                         orWhere('keywords', 'like', "% $term %")->
                         orWhere('keywords', 'like', "$term");
                });
            }
        })->
        paginate(10);
        return response()->json(FileResource::collection($model));
    }
    /**
     * @OA\Post(
     *     path="/api/app/file-read",
     *     operationId="file_read",
     *     tags={"File"},
     *     description="View File",
     *     @OA\RequestBody(required=true,
     *         @OA\JsonContent(required={"file_id"},
     *             @OA\Property(property="file_id", type="integer")
     *         )
     *     ),
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
    public function read(Request $request)
    {
        $id = $request->file_id;
        $student = auth('student')->user();
        if(!$student){
            return response()->json(['message' => 'Not authorized'], 401);
        }
        $model = ViewFile::where('file_id', $id)->where('student_id',$student->id)->first();
        if(!$model){
            $model = new ViewFile();
            $model->student_id = $student->id;
            $model->file_id = $id;
            $model->save();
            return response()->json(['message' => 'Viewed']);
        }
        return response()->json(['message' => 'File is not found'], 404);
    }
}
