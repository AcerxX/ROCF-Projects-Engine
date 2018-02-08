<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bridge\Doctrine\RegistryInterface;


class CategoryService
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * UserService constructor.
     * @param RegistryInterface $doctrine
     */
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getCategories(): array
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $this->doctrine->getRepository('App:Category');
        /** @var Category[] $categories */
        $categories = $categoryRepository->findBy(
            [
                'status' => Category::STATUS_ENABLED
            ]
        );

        return $this->formatCategoriesForResponse($categories);
    }

    /**
     * @param Category[] $categories
     * @return array
     */
    private function formatCategoriesForResponse(array $categories): array
    {
        $formattedCategories = [];

        foreach ($categories as $category) {
            $formattedCategory = [
                'id' => $category->getId(),
                'nameRo' => $category->getNameRo(),
                'nameEn' => $category->getNameEn(),
                'imagePath' => $category->getImagePath()
            ];
            $formattedCategories[] = $formattedCategory;
        }

        return $formattedCategories;
    }
}

