
export function closeDialog(emit) {
    const dialogContent = document.querySelector('.radix-dialog-content');
    dialogContent.setAttribute('data-state', 'closed');
    setTimeout(() => {
        emit('Close', false);
    }, 100);
}