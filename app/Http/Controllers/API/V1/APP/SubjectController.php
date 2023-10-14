<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\APP\SubjectResource;
use App\Http\Resources\API\V1\APP\SubjectShowResource;
use App\Models\Subject;

/**
 * @OA\Schema(
 *     schema="Subject",
 *     title="Subject title",
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
class SubjectController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/app/subject",
     *      operationId="subject_index",
     *      description="Retrieve all Subject",
     *      tags={"Subjects"},
     *      @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function index()
    {
        $subjects = Subject::all();
        return response()->json([
            'data' => SubjectResource::collection($subjects),
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/app/subject/{id}",
     *      operationId="subject_show",
     *      description="Retrieve a single Image by its ID",
     *      tags={"Subjects"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of subject",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Subject")
     *     ),
     *      @OA\Response(response=404, description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *      ),
     * )
     */

    public function show(string $id)
    {
        $model = Subject::find($id);
        if (!$model) {
            return response()->json([
                'message' => "Subject is not found",
            ], 404);
        }
        return new SubjectShowResource($model);
    }

}
