<?php

namespace Configuration;

interface ParserInterface
{

    public function __construct($path);

    public function setPath($path);

    public function getPath();

    public function getData();
} 