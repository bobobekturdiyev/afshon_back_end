<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\APP\FileResource;
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
     *      path="/api/app/file/{subject_id}",
     *      operationId="file_index",
     *      description="Retrieve all File",
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

        return response()->json([
            'data' => FileResource::collection($subjects),
        ]);

    }
}
