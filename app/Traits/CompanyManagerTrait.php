<?php

namespace App\Traits;

use App\Models\Company;

trait CompanyManagerTrait
{
    public function setCompany(Company|int $company): static
    {
        if (! $company instanceof Company) {
            $company = Company::find($company);
        }

        if (! $this->userHasCompany($company)) {
            request()->user()->update([
                'current_company_id' => null,
            ]);
        }

        if ($company->id !== auth()->user()->current_company_id) {
            auth()->user()->update([
                'current_company_id' => $company->id,
            ]);
        }

        session()->put('current_company', $company);

        return $this;
    }

    public function destroyCompanySession(): static
    {
        session()->forget('current_company');

        return $this;
    }

    public function userHasCompany(Company|int $company): bool
    {
        $exists = auth()->user()->companies->find($company);

        if ($exists) {
            session()->put('current_company', $exists);
        }

        return $exists !== null;
    }
}
