<?php 

namespace App\Enums;

enum UserEnums : string {
    case USER = 'user';

    case VENDOR = 'vendor';
    
    case ADVERTISE = 'advertise';
    
    case ALL = 'all';
}