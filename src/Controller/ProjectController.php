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

    /**
     * @param Request $request
     * @param ProjectService $projectService
     * @return JsonResponse
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function getProject(Request $request, ProjectService $projectService): JsonResponse
    {
        $projectId = $request->get('id');

        $response = [
            'isError' => false
        ];

        try {
            $info = $projectService->getProjectInfo($projectId);
            $response['data'] = $info;
        } catch (\Exception $e) {
            $response['isError'] = true;
        }

        return new JsonResponse($response);
    }
}