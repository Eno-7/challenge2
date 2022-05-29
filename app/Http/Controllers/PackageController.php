<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePackageRequest;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * @property PackageRepositoryInterface $packageRepository
 */
class PackageController extends Controller
{

    public function __construct(PackageRepositoryInterface $packageRepository)
    {
       $this->packageRepository = $packageRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $packages = $this->packageRepository->getAll();

        return response()->json($packages);
    }

    /**
     * @param StorePackageRequest $request
     * @return JsonResponse
     */
    public function store(StorePackageRequest $request): JsonResponse
    {
        $packageData = $request->validated();

        $package = $this->packageRepository->create($packageData);

        return response()->json($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
