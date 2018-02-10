<?php

namespace App\Controller;

use App\Dto\PerkRequestDto;
use App\Dto\UpdatePerkInfoRequestDto;
use App\Entity\Perk;
use App\Service\PerkService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PerkController extends Controller
{
    /**
     * @param Request $request
     * @param PerkService $perkService
     * @return JsonResponse
     */
    public function addPerk(Request $request, PerkService $perkService): JsonResponse
    {
        $jmsSerializer = $this->container->get('jms_serializer');
        $perkRequestDto = $jmsSerializer->fromArray(
            $request->request->all(),
            PerkRequestDto::class
        );

        $response = [
            'isError' => false
        ];

        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->beginTransaction();
        try {
            $response['data'] = $perkService->addPerk($perkRequestDto);
            $entityManager->commit();
        } catch (\Exception $e) {
            $entityManager->rollback();
            $response['isError'] = true;
            $response['errorMessage'] = 'A aparut o eroare la adaugarea recompensei. Va rugam sa incercati din nou.';
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \LogicException
     */
    public function removePerk(Request $request): JsonResponse
    {
        $perkId = $request->request->get('perk_id');

        $response = [
            'isError' => false
        ];

        $entityManager = $this->getDoctrine()->getManager();

        $perk = $entityManager->getRepository('App:Perk')->find($perkId);
        if ($perk === null) {
            $response['isError'] = true;
        } else {
            $perk->setStatus(Perk::STATUS_DISABLED);
            $entityManager->persist($perk);
            $entityManager->flush();
        }

        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @param PerkService $perkService
     * @return JsonResponse
     */
    public function updatePerkInfo(Request $request, PerkService $perkService): JsonResponse
    {
        $jmsSerializer = $this->get('jms_serializer');
        $projectRequestDto = $jmsSerializer->fromArray(
            $request->request->all(),
            UpdatePerkInfoRequestDto::class
        );

        $response = [
            'isError' => false
        ];

        try {
            $perkService->updatePerk($projectRequestDto);
        } catch (\Exception $e) {
            $response['isError'] = true;
        }

        return new JsonResponse($response);
    }

}