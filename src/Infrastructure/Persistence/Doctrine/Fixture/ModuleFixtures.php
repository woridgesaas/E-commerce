<?php

namespace App\Infrastructure\Persistence\Doctrine\Fixture;

use App\Infrastructure\Persistence\Doctrine\Entity\ModuleDoctrine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        /** @var [[]] $AviableServices list of woridge modules*/
        $AviableServices = [
            ['Authentication Service' , 'ms-auth' , 'sql-server'],
            ['Notification Service' , 'ms-notif' , 'sql-server'],

            ['Internal User Service' , 'ms-user-internal' , 'postgresql'],
            ['Attendance Service' , 'ms-attendance' , 'postgresql'],
            ['Documents Service' , 'ms-administrative-docs' , 'postgresql'],

            ['Settings Service' , 'ms-settings' , 'postgresql'],

            ['Interview Scheduling Service' , 'ms-interview' , 'sql-server'],
            ['Job Offre Service' , 'ms-joboffre' , 'sql-server'],
            ['Condidate Management Service' , 'ms-condidate' , 'sql-server'],
            ['Chatbot Service' , 'ms-chatbot' , 'postgresql'],
            ['Filtrage Service' , 'ms-filtrage' , 'sql-server'],
        ];

        foreach ($AviableServices as $module) {
            $table =new ModuleDoctrine();
            $table->setName($module[0]);
            $table->setServiceKey($module[1]);
            $table->setServerType($module[2]);

            $manager->persist($table);
        }
        $manager->flush();
    }
}
