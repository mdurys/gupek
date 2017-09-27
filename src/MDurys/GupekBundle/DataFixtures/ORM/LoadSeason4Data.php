<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Symfony\Component\Yaml\Yaml;

class LoadSeason4Data extends SeasonFixture
{
    /**
     * @return array
     */
    protected function getMeetingData()
    {
        $data = Yaml::parse(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Season4.yml'));

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 40;
    }
}
