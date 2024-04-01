<?php


namespace App\Enums;


enum OrderTypeEnums : string
{
    case NEW = 'new';

    case PENDING = 'قيد الانتظار';

    case COMPLETE = 'مكتمل';

    case CANCELLED = 'تم الغاءه';
}
