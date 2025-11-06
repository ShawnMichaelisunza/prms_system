<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Services\OrganizationService;

class OrganizationController extends Controller
{

    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = $this->organizationService->selectAllOrganizationService();
        return view('sidebar_links.organizations.organizations', ['organizations' => $organizations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOrganization()
    {
        
        return view('sidebar_links.organizations.organization-form', ['organization' => [] ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOrganization(StoreOrganizationRequest $storeOrganizationRequest)
    {
        $validatedOrganizationStoreRequest = $storeOrganizationRequest->validated();

        $this->organizationService->storeOrganizationService($validatedOrganizationStoreRequest);
        return redirect()->back()->with('success', 'Organization created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editOrganization($id)
    {
        $organization = $this->organizationService->editOrganizationService($id);
        return view('sidebar_links.organizations.organization-form', ['organization' => $organization ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOrganization(UpdateOrganizationRequest $updateOrganizationRequest, $id)
    {
        $validatedOrganizationUpdateRequest = $updateOrganizationRequest->validated();

        $this->organizationService->updateOrganizationService($id, $validatedOrganizationUpdateRequest);
         return redirect()->back()->with('success', 'Organization updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOrganization($id)
    {
        $this->organizationService->destroyOrganizationService($id);
         return redirect()->back()->with('success', 'Organization deleted successfully!');
    }
}
