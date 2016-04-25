<?php
require 'models/ClassesLoader.php';
require 'models/page.php';

unset($_SESSION);
session_destroy();

require 'views/view-logout.php';