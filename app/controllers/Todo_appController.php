<?php

// Backward-compatibility alias: map old controller name `Todo_appController` to `TaskController`.
// If the legacy name is used in routes, this file ensures the class exists and defers to TaskController.

require_once __DIR__ . '/TaskController.php';

class Todo_appController extends TaskController
{
    // No extra code needed; inherits all methods from TaskController.
}
