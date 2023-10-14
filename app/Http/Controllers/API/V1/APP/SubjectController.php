<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\APP\SubjectResource;
use App\Http\ValidatorResponse;
use App\Models\Subject;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Subject",
 *     title="Subject title",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Successfully"),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *				@OA\Property(property="title", type="string"),
 *         )
 *     ),
 *     @OA\Property(property="code", type="integer", example=200),
 * )
 */
class SubjectController extends Controller
{
    /**
     *@OA\Get(
     *      path="/api/app",
     *      operationId="subject_index",
     *      description="Retrieve all Subject",
     *      tags={"Subject API CRUD"},
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
     *      path="/v1/api/image/{id}",
     *      operationId="subject_show",
     *      description="Retrieve a single Image by its ID",
     *      tags={"04.Image API CRUD"},
     *      @OA\Parameter(
     *          title="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Image to retrieve",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Subject"),
     *     ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function show(string $id)
    {
        $image = Image::find($id);
        if(!$image){
            return response()->json([
                'message' => "Image not found",
                'code' => 403,
            ]);
        }

        return response()->json([
            'data' => new ImageResource($image),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/v1/api/image",
     *      security={{"api":{}}},
     *      operationId="image_store",
     *      summary="Create a new Image",
     *      description="Add a new Image",
     *      tags={"04.Image API CRUD"},
     *      @OA\RequestBody(required=true, description="Image save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"originalName", "url"},
     *                  @OA\Property(property="originalName", type="string", example=""),
     *					@OA\Property(property="url", type="string", example="")
     *              )
     *          )
     *      ),
     *       @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *       @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $rules = array (
            'title_uz' => ['required', 'string', 'max:255'],
            'title_ru' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $image = new Image();
        $image->originalName = $request->originalName;
        $image->url = $request->url;
        $image->save();
        return response()->json([
            'data' => new ImageResource($image),
            'code' => 200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/v1/api/image/{id}",
     *      security={{"api":{}}},
     *      operationId="image_update",
     *      summary="Update a Image by ID",
     *      description="Update a specific Image by its ID",
     *      tags={"04.Image API CRUD"},
     *      @OA\RequestBody(required=true, description="Image save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"image", "account.employeeAccount.birthDate", "email"},
     *                  @OA\Property(property="image", type="string", format="binary"),
     *                  @OA\Property(property="account.employeeAccount.birthDate", type="number", example="123"),
     *                  @OA\Property(property="email", type="string", example="admin@gmail.com"),
     *				    @OA\Property(property="_method", type="string", example="PUT", description="Read-only: This property cannot be modified."),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *     @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function update(Request $request)
    {
        $rules = array (
            'title_uz' => ['required', 'string', 'max:255'],
            'title_ru' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
        );
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if($validator->fails){
            return response()->json([
                'message' => $validator->response,
                'code' => 400
            ]);
        }
        $user = auth('api')->user();

        $image = $request->file('image');
        $name = time() . "_" . str_replace([" ", '"', "'"], ["", '', ''], $image->getClientOriginalName());
        $image->move(public_path("images/users/"), $name);
        $url = asset("/images/users/$name");

        $model = new Image();
        $model->originalName = $image->getClientOriginalName();
        $model->url = $url;
        $model->save();

        return response()->json([
            'data' => new ImageResource($image),
            'code' => 200
        ]);
    }

    /**
     * @OA\Delete(
     *      path="/v1/api/image/{id}",
     *      security={{"api":{}}},
     *      operationId="image_delete",
     *      summary="Delete a Image by ID",
     *      description="Remove a specific Image by its ID",
     *      tags={"04.Image API CRUD"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the Image to delete",
     *          @OA\Schema(type="integer")
     *      ),
     *          @OA\Response(response=200,description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function destroy(string $id)
    {
        $image = Image::find($id);
        if(!$image){
            return response()->json([
                'message' => "Image not found",
                'code' => 404,
            ]);
        }
        $image->delete();
        return response()->json([
            'data' => new ImageResource($image),
            'code' => 200
        ]);
    }
}
