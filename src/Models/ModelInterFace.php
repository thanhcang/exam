<?php

namespace Src\Models;

interface ModelInterFace
{
    public function getTable();

    public function getPrimary();

    public function getInstance();
}