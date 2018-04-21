<?php

namespace App\Controller;

use App\Dto\UpdateProjectInfoRequestDto;
use App\Entity\Project;
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
        $response = [
            'isError' => false
        ];

        $userId = $request->request->get('user_id');

        if ($userId === null) {
            $response['isError'] = true;
        } else {
            try {
                $response['data'] = $projectService->createProjectForUser($userId);
            } catch (\Exception $e) {
                $response['isError'] = true;
                $response['errorMessage'] = $e->getMessage();
            }
        }

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
            UpdateProjectInfoRequestDto::class
        );

        $response = [
            'isError' => false
        ];

        try {
            $projectService->updateProject($projectRequestDto);
        } catch (\Exception $e) {

            $response['isError'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \LogicException
     */
    public function removeProject(Request $request): JsonResponse
    {
        $projectId = $request->request->get('project_id');

        $response = [
            'isError' => false
        ];

        $entityManager = $this->getDoctrine()->getManager();

        $project = $entityManager->getRepository('App:Project')->find($projectId);
        if ($project === null) {
            $response['isError'] = true;
        } else {
            $project->setStatus(Project::STATUS_DISABLED);
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return new JsonResponse($response);
    }
}