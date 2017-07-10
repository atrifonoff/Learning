<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 09.07.17
 * Time: 10:47
 */

namespace Game;




class Game implements GameInterface
{

    /**
     * @var GalaxyInterface
     */
    private $galaxy;

    public function start()
    {
        $this->galaxy->addStarSystem('Artemis-Tau', new StarSystem('Artemis-Tau'));
        $this->galaxy->addStarSystem('Serprnt-Nebula', new StarSystem('Serprnt-Nebula'));
        $this->galaxy->addStarSystem('Hades-Gamma', new StarSystem('Hades-Gamma'));
        $this->galaxy->addStarSystem('Kepler-Verge', new StarSystem('Kepler-Verge'));
    }




}