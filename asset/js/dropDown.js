
export const dropDown = () => {

    const dropDown = document.querySelector('.drop-down');
    const dropItems = document.querySelector('.drop-items');
    console.log(dropDown);

    dropDown.addEventListener('click', () => {
        dropItems.classList.toggle('show');
    });

    window.addEventListener('click', (e) => {
        if (!e.target.matches('.drop-down')) {
            dropItems.classList.remove('show');
        }
    });
    return dropDown;
}
