<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function selectAllOrganizationService()
    {
        $organizations = Organization::orderBy('created_at', 'DESC')->paginate(10);
        return $organizations;
    }

    public function storeOrganizationService($data)
    {
        $organization = Organization::create($data);
        return $organization;
    }

    public function editOrganizationService($id)
    {
        $decryptedEditOrganizationId = decrypt($id);
        $organization = Organization::findOrFail($decryptedEditOrganizationId);

        return $organization;
    }

    public function updateOrganizationService($id, $data)
    {
        $decryptedUpdateOrganizationId = decrypt($id);
        $organization = Organization::findOrFail($decryptedUpdateOrganizationId);
        $organization->update($data);

        return $organization;
    }

    public function destroyOrganizationService($id)
    {
        $decryptedDeleteOrganizationId = decrypt($id);
        $organization = Organization::findOrFail($decryptedDeleteOrganizationId);
        $organization->delete();

        return $organization;
    }
}
