<?php

require_once __DIR__ . '/../../layout/admin/layout.php';

function HomeController()
{


      return AdminLayout(
            __DIR__ . "/view.php",
            [
                  'username' => "user name for the name land"
            ]
      );
}
