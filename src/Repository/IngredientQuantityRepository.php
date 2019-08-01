<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Repository;

use App\Entity\IngredientQuantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IngredientQuantity|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientQuantity|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientQuantity[]    findAll()
 * @method IngredientQuantity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientQuantityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IngredientQuantity::class);
    }

    // /**
    //  * @return IngredientQuantity[] Returns an array of IngredientQuantity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientQuantity
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param $recipeId
     * @return mixed
     */
    public function getAllItemsByRecipe($recipeId)
    {
        return $this->createQueryBuilder('items')
            ->andWhere('items.recipe = :val')
            ->setParameter('val', $recipeId)
            ->getQuery()
            ->getResult()
        ;
    }
}
