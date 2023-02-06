<?php

namespace App\Enums;

enum UserTypeEnum:string {
    case Admin = "admin";
    case Moderator = "moderator";
    case User = "user";
}