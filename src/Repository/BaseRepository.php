<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
    /**
     * @param string $namedLock
     * @param int $timeoutSeconds
     * @return bool
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     */
    public function aquireNamedLock(string $namedLock, int $timeoutSeconds = 10): ?bool
    {
        $sql = "SELECT GET_LOCK('{$namedLock}', {$timeoutSeconds}) AS lockAcquired";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        switch ($row['lockAcquired']) {
            case 1:
                return true;
            case 0:
                throw new \RuntimeException("Failed acquiring lock {$namedLock}: the attempt timed out (for example, because another client has previously locked the name)");
            default:
                throw new \RuntimeException("Failed acquiring lock {$namedLock}: an error occurred (such as running out of memory or the thread was killed with mysqladmin kill)");
        }
    }

    /**
     * @param string $namedLock
     * @return bool
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function releaseNamedLock($namedLock): ?bool
    {
        $sql = "SELECT RELEASE_LOCK('{$namedLock}') AS lockReleased";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        switch($row['lockReleased']) {
            case 1:
                return true;
            case 0:
                throw new \RuntimeException("Failed releasing lock {$namedLock}: lock was not established by this thread (in which case the lock is not released)");
            default:
                throw new \RuntimeException("Failed releasing lock {$namedLock}: the named lock did not exist");
        }
    }
}
