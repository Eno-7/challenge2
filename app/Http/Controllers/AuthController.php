<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property CompanyRepositoryInterface $companyRepository
 * @property UserRepositoryInterface $userRepository
 */
class AuthController extends Controller
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $registerData = $request->validated();
        $registerData['password'] = Hash::make($registerData['password']);
        $user = $this->userRepository->create($registerData);
        $registerData['user_id'] = $user->id;
        $registerData['status'] = true;
        $token = $user->createToken('APIToken')->plainTextToken;

        $company = $this->companyRepository->create($registerData);

        return response()->json(['status'=> true, 'company_id'=>$company->id, 'token'=>$token]);

    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $loginData = $request->validated();

        if(!Auth::attempt($loginData)){
            return response()->json(['status' => false, 'message' => 'Kullanıcı bulunamadı.'], 401);
        }

        return response()->json([
            'status' => true,
            'token' => \auth()->user()->createToken('APIToken')->plainTextToken
        ]);
    }
}
