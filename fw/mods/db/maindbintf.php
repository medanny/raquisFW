<?php

namespace fw\mods\db;

interface mainDbIntf{
     public function connect($host=null,$dbname=null,$dbuser=null,$dbpass=null);
}