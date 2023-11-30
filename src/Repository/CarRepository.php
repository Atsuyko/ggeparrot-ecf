<?php

namespace App\Repository;

use App\Entity\Car;
use App\Model\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findMinMax(SearchData $searchData): array
    {
        $result = $this->getSearchQuery($searchData, true, true, true)
            ->select(
                'MIN(cars.price) as minPrice',
                'MAX(cars.price) as maxPrice',
                'MIN(cars.km) as minKm',
                'MAX(cars.km) as maxKm',
                'MIN(SUBSTRING(cars.year, 1, 4)) as minYear',
                'MAX(SUBSTRING(cars.year, 1, 4)) as maxYear'
            )
            ->getQuery()
            ->getScalarResult();

        return [
            $result[0]['minPrice'],
            $result[0]['maxPrice'],
            $result[0]['minKm'],
            $result[0]['maxKm'],
            $result[0]['minYear'],
            $result[0]['maxYear']
        ];
    }

    public function findBySearch(SearchData $searchData): array
    {
        $query = $this->getSearchQuery($searchData);
        return $query->getQuery()->getResult();
    }

    private function getSearchQuery(SearchData $searchData, $ignorePrice = false, $ignoreKm = false, $ignoreYear = false): QueryBuilder
    {
        $query = $this->createQueryBuilder('cars');

        if (!empty($searchData->minPrice) && $ignorePrice === false) {
            $query = $query
                ->andWhere('cars.price >= :minPrice')
                ->setParameter('minPrice', $searchData->minPrice);
        }

        if (!empty($searchData->maxPrice) && $ignorePrice === false) {
            $query = $query
                ->andWhere('cars.price <= :maxPrice')
                ->setParameter('maxPrice', $searchData->maxPrice);
        }

        if (!empty($searchData->minKm) && $ignoreKm === false) {
            $query = $query
                ->andWhere('cars.km >= :minKm')
                ->setParameter('minKm', $searchData->minKm);
        }

        if (!empty($searchData->maxKm) && $ignoreKm === false) {
            $query = $query
                ->andWhere('cars.km <= :maxKm')
                ->setParameter('maxKm', $searchData->maxKm);
        }

        if (!empty($searchData->minYear) && $ignoreYear === false) {
            $query = $query
                ->andWhere('SUBSTRING(cars.year, 1, 4) >= :minYear')
                ->setParameter('minYear', $searchData->minYear);
        }

        if (!empty($searchData->maxYear) && $ignoreYear === false) {
            $query = $query
                ->andWhere('SUBSTRING(cars.year, 1, 4) <= :maxYear')
                ->setParameter('maxYear', $searchData->maxYear);
        }

        return $query;
    }
}
