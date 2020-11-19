<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Transformers\Auth\AuthTransformer;
use App\Managers\Auth\AuthManager;
use App\Http\Requests\CreativeRequestValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $manager;

    public function __construct(AuthManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    public function postLoginAction(CreativeRequestValidator $request)
    {
        try {
            $validation = $request->validate($request->rules());
            if (empty($validation) === false) {
                return $this->setStatusCode(400)
                            ->respondWithError('Invalid request');
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->setStatusCode(403)
                            ->respondWithError('Access Unauthorized.');
            }

            $user = $this->manager->getUserByEmail($request->email);
            if (Hash::check($request->password, $user->password, []) === false) {
                return $this->setStatusCode(403)
                            ->respondWithError('Access Unauthorized.');
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return $this->respondWithItem($token, new AuthTransformer());
        } catch (\Exception $ex) {
            return $this->setStatusCode(403)
                        ->respondWithError($ex->getMessage());
        }
    }
}
