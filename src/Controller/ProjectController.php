<?php

namespace App\Controller;

use App\Dto\ProjectRequestDto;
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
    public function createProject(Request $request, ProjectService $projectService): JsonResponse
    {
        $userId = $request->request->get('user_id');

        $response = [
            'isError' => false === (
                $userId !== null
                && $projectService->createProjectForUser($userId)
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
    public function getProjectInfo(Request $request, ProjectService $projectService): JsonResponse
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

    /**
     * @param Request $request
     * @param ProjectService $projectService
     * @return JsonResponse
     */
    public function updateProjectInfo(Request $request, ProjectService $projectService): JsonResponse
    {
        $jmsSerializer = $this->get('jms_serializer');
        $projectRequestDto = $jmsSerializer->fromArray(
            $request->request->all(),
            ProjectRequestDto::class
        );

        $response = [
            'isError' => false
        ];

        try {
            $projectService->updateProject($projectRequestDto);
        } catch (\Exception $e) {
            $response['isError'] = true;
        }

        return new JsonResponse($response);
    }
}