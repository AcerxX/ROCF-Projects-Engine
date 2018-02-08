<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * @param Request $request
     * @param ProjectService $projectService
     * @return JsonResponse
     */
    public function addProject(Request $request, ProjectService $projectService): JsonResponse
    {
        $userId = $request->request->get('user_id');

        $response = [
            'isError' => false === (
                $userId !== null
                && $projectService->addProjectForUser($userId)
            )
        ];

        return new JsonResponse($response);
    }
}