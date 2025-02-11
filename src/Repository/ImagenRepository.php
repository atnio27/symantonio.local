<?php

namespace App\Repository;

use App\Entity\Imagen;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Imagen>
 */
class ImagenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imagen::class);
    }

    public function remove(Imagen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Imagen[] Returns an array of Imagen objects
     */
    public function findLikeDescripcion(string $value): array
    {
        $qb = $this->createQueryBuilder('i');
        $qb->Where($qb->expr()->like('i.descripcion', ':val'))->setParameter('val', '%' . $value . '%');
        return $qb->getQuery()->getResult();
    }

    public function findImagenesConCategoria(
        string $ordenacion,
        string $tipoOrdenacion,
        User $usuario
    ): array {
        $qb = $this->createQueryBuilder('imagen')
            ->addSelect('categoria')
            ->innerJoin('imagen.categoria', 'categoria')
            ->orderBy('imagen.' . $ordenacion, $tipoOrdenacion);

        $this->addUserFilter($qb, $usuario);

        return $qb->getQuery()->getResult();
    }

    public function findImagenes(string $busqueda, User $usuario): array
    {
        $qb = $this->createQueryBuilder('imagen')
            ->where('imagen.descripcion LIKE :busqueda')
            ->setParameter('busqueda', '%' . $busqueda . '%');

        $this->addUserFilter($qb, $usuario);

        return $qb->getQuery()->getResult();
    }

    // Corrección clave: Usar Doctrine\ORM\QueryBuilder
    private function addUserFilter(QueryBuilder $qb, User $usuario): void
    {
        if (!in_array('ROLE_ADMIN', $usuario->getRoles())) {
            $qb->andWhere('imagen.usuario = :usuario')
                ->setParameter('usuario', $usuario);
        }
    }

    //    /**
    //     * @return Imagen[] Returns an array of Imagen objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Imagen
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
