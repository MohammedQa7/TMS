
export function appendPriorityClass(priority, badge = false) {
    if (badge) {
        const priorityStyles = {
            Urgent: 'bg-urgentBadge',
            Normal: 'bg-normalBadge',
            Low: 'bg-lowBadge',
        };
        return priorityStyles[priority] ?? 'text-white';
    } else {
        const priorityStyles = {
            Urgent: 'text-urgentBadge-foreground',
            Normal: 'text-normalBadge-foreground ',
            Low: 'text-lowBadge-foreground',
        };
        return priorityStyles[priority] ?? 'text-white';
    }

}