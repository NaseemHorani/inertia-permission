<?php

namespace App\Repositories;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use function auth;
//use function convertToSeparatedTokens;

class CompanyRepository {

        public function add(Request $request)
        {
            $company = Company::create([
                'name' => $request->name,
                'website' => $request->website,
                'email' =>$request->email,
            ]);

            $company->logo = uploadFile('logo', 'company');

            $company->save();

        }

    public function getCompanies(Request $request)
    {
        $companies = Company::query();

        if ($search = $request->get('search')) {
            
        }
        return $companies;
    }


    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        if ($request->hasFile('logo')) {
            // if there is an old background_image delete it
            if ($company->logo != null) {
                $company->logo = Storage::disk('public')->delete($company->logo);
            }
            $company->logo = uploadFile('logo', 'company');
        }
    $company->save();
        return $company;
    }


    public function delete(Company $company)
    {

        $company->delete();
    }

}

