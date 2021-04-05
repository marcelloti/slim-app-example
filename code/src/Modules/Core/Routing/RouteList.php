<?php

(new \SlimExample\Modules\Core\CoreRoute($app))->create();
(new \SlimExample\Modules\Authentication\AuthRoute($app))->create();
(new \SlimExample\Modules\Users\UsersRoute($app))->create();
(new \SlimExample\Modules\Transactions\TransactionsRoute($app))->create();