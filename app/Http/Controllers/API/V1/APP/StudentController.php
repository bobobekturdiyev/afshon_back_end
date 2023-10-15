<?php

namespace App\Http\Controllers\API\V1\APP;

use App\Http\Controllers\Controller;
use App\Http\ValidatorResponse;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student', ['except' => ['register', 'login']]);
    }
    /**
     * @OA\Post(
     *      path="/api/app/register",
     *      operationId="register",
     *      tags={"Auth"},
     *      description="Registratsiya qoshish",
     *       @OA\RequestBody(required=true, description="lesson save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"first_name", "last_name", "email", "password"},
     *                 @OA\Property(property="first_name", type="string", format="text", example="Salohiddin"),
     *                 @OA\Property(property="last_name", type="string", format="text", example="Nuridinov"),
     *                 @OA\Property(property="email", type="string", format="email", example="admin@gmail.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="admin123"),
     *              )
     *          )
     *      ),
     *      @OA\Response(response=200, description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function register(Request $request){
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password' => ['required', 'string', 'min:8'],
        ];
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json($validator->response, 400);
        }
        $user = Student::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'success' => false,
                'message' => "Avval Ro'yxatdan o'tgansiz",
                'data' => null,
                'code' => 400
            ]);
        }
        $user = new Student();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = auth('student')->login($user);
        $user = auth('student')->user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/app/login",
     *      operationId="auth_login",
     *      tags={"Auth"},
     *      description="Login Parol yordamida kirish",
     *       @OA\RequestBody(required=true, description="lesson save",
     *           @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(type="object", required={"email", "password"},
     *                 @OA\Property(property="email", type="string", format="email", example="admin@gmail.com"),
     *                 @OA\Property(property="password", type="string", format="password", example="admin123"),
     *              )
     *          )
     *      ),
     *      @OA\Response(response=200, description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/Subject"),
     *      ),
     *      @OA\Response(response=404,description="Not found",
     *          @OA\JsonContent(ref="#/components/schemas/Error"),
     *      ),
     * )
     */
    public function login(Request $request)
    {
        $rules  = [
            'email' => 'required|string|email',
            'password' => 'required',
        ];
        $validator = new ValidatorResponse();
        $validator->check($request, $rules);
        if ($validator->fails) {
            return response()->json($validator->response, 400);
        }
        $model = Student::where('email', $request->email)->first();
        if ($model) {
            if (Hash::check($request->password, $model->password))
            {
                $credentials = request(['email','password']);
                $token = auth('student')->attempt($credentials);
                $user = auth('student')->user();
                return response()->json(['user' => $user,
                    'authorization' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ], 200);
            }else {
                return response()->json(['errors' => ['Password incorrect']],400);

            }
        }else{
            return response()->json(['errors' => ['User not found']],400);
        }

    }
}
