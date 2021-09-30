<?php

namespace App\Twig;

use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class EmployeesExtension extends AbstractExtension
{

    private AreaRepository $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('searchArea', [$this, 'search']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('searchArea', [$this, 'search']),
        ];
    }

    public function search()
    {
        return $this->areaRepository->findAll();
    }
}
