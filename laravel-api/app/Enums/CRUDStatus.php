<?php
namespace App\Enums;

enum CRUDStatus: string
{
    case CREATE         = 'Item created successfully';
    case UPDATE         = 'Item updated successfully';
    case DELETE         = 'Item deleted successfully';
    case NOTFOUND       = 'Item Not Found!!!';
}