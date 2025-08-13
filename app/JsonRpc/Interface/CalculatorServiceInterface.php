<?php
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/3/17
 * Time: 11:38
 */

namespace App\JsonRpc\Interface;

interface CalculatorServiceInterface
{
    public function add(int $a, int $b): int;
}