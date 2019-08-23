<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * RecipeRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return mixed
     */
    public function getThreeLatest()
    {
        return $this->createQueryBuilder('recipe')
            ->andWhere('recipe.validation = :val')
            ->setParameter('val', 1)
            ->orderBy('recipe.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function getRecipeByName(string $search)
    {
        return $this->createQueryBuilder('recipe')
            ->andWhere('REGEXP(recipe.name, :regexp) = true')
            ->setParameter('regexp', $search)
            ->andWhere('recipe.validation = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return mixed
     */
    public function getOneNonValidate()
    {
        return $this->createQueryBuilder('recipe')
            ->andWhere('recipe.validation = :val')
            ->setParameter('val', 0)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return mixed
     */
    public function findAllValid()
    {
        return $this->createQueryBuilder('recipe')
            ->andWhere('recipe.validation = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $authorId
     * @return mixed
     */
    public function getRecipeByAuthor($authorId)
    {
        return $this->createQueryBuilder('recipe')
            ->andWhere('recipe.author = :val')
            ->setParameter('val', $authorId)
            ->getQuery()
            ->getResult()
            ;
    }
}