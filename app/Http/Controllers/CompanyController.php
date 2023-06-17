<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Requests\CompanRequest;
use App\Repositories\CompanyRepository;
class CompanyController extends Controller
{
    private  $companyRepository;
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):Response
    {
        $limit = $request->get('limit') ?: 10;
        if ($limit > 100) $limit = 100;
        $company = $this->companyRepository
        ->getCompanies($request)
        ->paginate($limit);
        return Inertia::render('Admin/Companies/CompanyIndex',['companies'=>CompanyResource::collection($company)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
       return Inertia::render('Admin/Companies/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanRequest $request)
    {
        $this->companyRepository->add($request);
        return to_route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company=Company::query()->find($id);
        return Inertia::render('Admin/Companies/edit',['company'=>new CompanyResource($company)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company=Company::query()->find($id);
        $this->companyRepository->update($request, $company);
        return to_route('companies.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company=Company::query()->find($id);
        $this->companyRepository->delete($company);
        return back();

    }
}
