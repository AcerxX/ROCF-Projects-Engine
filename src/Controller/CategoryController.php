<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{

    public function getCategories(CategoryService $categoryService)
    {
        $categories = $categoryService->getCategories();
        return new JsonResponse($categories);
    }
}