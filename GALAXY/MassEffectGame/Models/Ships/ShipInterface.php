<?php


namespace MassEffectGame\Models\Ships;


use MassEffectGame\Models\Enhancements\EnhancementInterface;
use MassEffectGame\Models\Projectiles\ProjectileInterface;
use MassEffectGame\Models\StarSystemInterface;

interface ShipInterface
{
    /**
     * @return StarSystemInterface
     */
    public function getStarSystem();

    /**
     * @param StarSystemInterface $starSystem
     * @return void
     */
    public function setStarSystem(StarSystemInterface $starSystem);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getDamage();

    /**
     * @param int $value
     * @return void
     */
    public function setDamage( $value);

    /**
     * @return int
     */
    public function getHealth();

    /**
     * @param int $value
     * @return void
     */
    public function setHealth( $value);

    /**
     * @return int
     */
    public function getShields();

    /**
     * @param int $value
     * @return void
     */
    public function setShields($value);

    /**
     * @return float
     */
    public function getFuel();

    /**
     * @param int $value
     * @return void
     */
    public function setFuel($value);

    /**
     * @return string
     */
    public function getProjectileType();

    /**
     * @return int
     */
    public function getProjectileDamage();

    /**
     * @return void
     */
    public function increaseProjectilesFired();

    /**
     * @return bool
     */
    public function isDestroyed();

    /**
     * @param string $name
     * @param EnhancementInterface $enhancement
     * @return void
     */
    public function addEnhancement( $name, EnhancementInterface $enhancement);

    /**
     * @param ProjectileInterface $projectile
     * @return void
     */
    public function takeDamage(ProjectileInterface $projectile);

    /**
     * @param StarSystemInterface $to
     * @return void
     */
    public function plotJumpTo(StarSystemInterface $to);

    /**
     * @return string[]
     */
    public function getReport();
}