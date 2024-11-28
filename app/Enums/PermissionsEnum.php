<?php
namespace App\Enums;

enum PermissionsEnum: string
{
    // Chat Permissions
    case VIEW_CHAT = 'View Chat';
    case SEND_MESSAGE = 'Send Message';
    
}